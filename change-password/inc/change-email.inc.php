<?php

session_start();

if(isset($_POST['change-email-submit'])){

    $matricula = $_SESSION['usersMatricula'];
    $email = $_POST['email'];

    if(empty($email)){
        header("Location: ../change-password.php?email=empty");
        exit();
    }

    require 'dbh.inc.php';

    $sql = "UPDATE users SET usersEmail=? WHERE usersMatricula=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "There was an error! 3";
        exit();
    } else{
        mysqli_stmt_bind_param($stmt, "ss", $email, $matricula);
        mysqli_stmt_execute($stmt);

        header("Location: ../index.php?email=updated");
    }
}

else{
    header("Location: ../index.php");
}