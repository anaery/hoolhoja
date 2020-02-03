<?php
	session_start();
	include_once('dbhpdo.inc.php');

	if(isset($_GET['usersId'])){
        $id = $_GET['usersId'];
        
        require '../dbh/mysqli.php';

        $sql = "DELETE FROM users WHERE usersId=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "There was an error! del";
            exit();
        } else{
            mysqli_stmt_bind_param($stmt, "s", $id);
            mysqli_stmt_execute($stmt);

            $_SESSION['conf-users'] = "done";

            header("Location: ../../conf-users/index.php?del=success");
            exit();
        }

	}
	else{
		$_SESSION['message'] = 'Select user to delete first';
	}

	header("Location: ../../conf-users/index.php");

?>