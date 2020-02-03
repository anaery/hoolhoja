<?php
   
    session_start();

    if( isset( $_POST['modal-conf-cadastros-submit'] ) ){

	require '../dbh/mysqli.php';
	
    $id = $_GET['usersId'];
    $matricula = $_POST['matricula'];
    $nome = $_POST['nome'];
    //$nivel = $_POST['nivel'];
    //$senha = $_POST['senha'];
    $email = $_POST['email'];
    $mac = $_POST['mac'];
    $curso = $_POST['curso'];
    //$addpor = $_SESSION['usersNome'];
    $validade = $_POST['validade'];

    $sql = "UPDATE users SET usersMatricula=?, usersNome=?, usersEmail=?, usersMac=?, usersCurso=?, usersValidade=? WHERE usersId=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "There was an error! 2";
        exit();
    } else{
        mysqli_stmt_bind_param($stmt, "sssssss", $matricula, $nome, $email, $mac, $curso, $validade, $id);
        mysqli_stmt_execute($stmt);
        header('location: ../../conf-cadastros/index.php');
    }
    }
    
	else{
		header('location: ../index.php');
	}
?>