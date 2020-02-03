<?php
	session_start();
	include_once('../dbh/mysqli.php');

	if(isset($_GET['usersId'])){
        $id = $_GET['usersId'];
        
        require 'dbh.inc.php';

        $sql = "DELETE FROM userstemp WHERE usersId=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "There was an error! del";
            exit();
        } else{
            mysqli_stmt_bind_param($stmt, "s", $id);
            mysqli_stmt_execute($stmt);

            $_SESSION['conf-cadastro'] = "done";

            header("Location: ../../conf-cadastros/index.php?del=success");
            exit();
        }

	}
	else{
		$_SESSION['message'] = 'Select user to delete first';
	}

	header("Location: ../../conf-cadastros/index.php");

?>