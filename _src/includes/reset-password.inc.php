<?php

if(isset($_POST['reset-password-submit'])){

    $selector = $_POST['selector'];
    $validator = $_POST['validator'];
    $password = $_POST['pwd'];
    $passwordRepeat = $_POST['pwd-repeat'];

    if(empty($password) || empty($passwordRepeat)){
        // the code below won't work 'cause there is no token on the url (include the token or send the user to signup page and ask him to start over)
        // I put the selector and validator on the following lines but did not test it. 
        header("Location: ../create-new-password.php?newpwd=empty&selector=" . $selector . "&validator=" . $validator);
        exit();
    } else if($password != $passwordRepeat){
        header("Location: ../create-new-password.php?newpwd=pwdnotsame&selector=" . $selector . "&validator=" . $validator);
        exit();
    }

    $currentDate = date("U");

    require '../dbh/mysqli.php';

    $sql = "SELECT * FROM pwdreset WHERE pwdResetSelector = ? AND pwdResetExpires >= ?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "There was an error! 1";
        exit();
    } else{
        mysqli_stmt_bind_param($stmt, "ss", $selector, $currentDate);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        if(!$row = mysqli_fetch_assoc($result)){
            echo "You need to re-submit your reset request.";
            exit();
        } else{

            $tokenBin = hex2bin($validator);
            $tokenCheck = password_verify($tokenBin, $row['pwdResetToken']);
            
            if($tokenCheck === false){
                echo "You need to re-submit your reset request.";
                exit();
            } else if($tokenCheck === true){

                $tokenEmail = $row['pwdResetEmail'];

                $sql = "SELECT * FROM users WHERE usersEmail = ?";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    echo "There was an error! There is no matching email on database.";
                    exit();
                } else{
                    mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    if(!$row = mysqli_fetch_assoc($result)){
                        echo "There was an error! 2";
                        exit();
                    } else{

                        $sql = "UPDATE users SET usersSenha=? WHERE usersEmail=?";
                        $stmt = mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt, $sql)){
                            echo "There was an error! 3";
                            exit();
                        } else{
                            $newPwdHash = password_hash($password, PASSWORD_DEFAULT);
                            mysqli_stmt_bind_param($stmt, "ss", $newPwdHash, $tokenEmail);
                            mysqli_stmt_execute($stmt);

                            $sql = "DELETE FROM pwdreset WHERE pwdResetEmail=?";
                            $stmt = mysqli_stmt_init($conn);
                            if(!mysqli_stmt_prepare($stmt, $sql)){
                                echo "There was an error! 4";
                                exit();
                            } else{
                                mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                                mysqli_stmt_execute($stmt);
                                header("Location: ../index.php?newpwd=passwordupdated");
                            }
                        }
                    }
                }

            }

        }
    }

}

else{
    header("Location: ../index.php");
}