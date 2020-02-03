<?php

session_start();

if(isset($_POST['change-password-submit'])){

    $matricula = $_SESSION['usersMatricula'];
    $password = $_POST['pwd'];
    $passwordRepeat = $_POST['pwd-repeat'];

    if(empty($password) || empty($passwordRepeat)){
        header("Location: ../change-password.php?pwd=empty");
        exit();
    } else if($password != $passwordRepeat){
        header("Location: ../change-password.php?pwd=pwdnotsame");
        exit();
    }

    require 'dbh.inc.php';

    $sql = "UPDATE users SET usersSenha=? WHERE usersMatricula=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "There was an error! 3";
        exit();
    } else{
        $newPwdHash = password_hash($password, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, "ss", $newPwdHash, $matricula);
        mysqli_stmt_execute($stmt);

        header("Location: ../index.php?pwd=updated");
    }
}

else{
    header("Location: ../index.php");
}