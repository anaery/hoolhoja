<?php

session_start();

if(isset($_POST['change-profile-picture-submit'])){

    require 'dbh.inc.php';

    $matricula = $_SESSION['usersMatricula'];

    $file = $_FILES['file'];

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png', 'pdf');

    if(in_array($fileActualExt, $allowed)) {
        if($fileError === 0){
            if($fileSize < 5000000){
                //$fileNameNew = uniqid($matricula).".".$fileActualExt;
		$fileNameNew = $matricula . "." . $fileActualExt; // se o arquivo j� existir, ele ser� sobrescrito
                $fileDestination= 'images/'.$fileNameNew;
                if(!move_uploaded_file($fileTmpName, $fileDestination)){
			header("Location: ../index.php?picture=notupdated");
			exit();
		}
            }else {
                echo "O arquivo é muito grande!";
            }
        } else{
            echo "O correu um erro!";
        }
    } else {
        echo "Você não pode upar arquivos desse tipo!";
    }

    $sql = "UPDATE users SET usersImg=? WHERE usersMatricula=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "There was an error! 3";
        exit();
    } else{
        mysqli_stmt_bind_param($stmt, "ss", $fileNameNew, $matricula);
        mysqli_stmt_execute($stmt);

        $_SESSION['usersImg'] = $fileNameNew;

        header("Location: ../index.php?picture=updated");
    }
}

else{
    header("Location: ../index.php");
    exit();
}