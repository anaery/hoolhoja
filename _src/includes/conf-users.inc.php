<?php
   
    session_start();

    if( isset( $_POST['modal-conf-users-submit'] ) ){

        require '../dbh/mysqli.php';
        
        $id = $_GET['usersId'];

        $matricula = $_POST['matricula'];
        $nome = $_POST['nome'];
        $nivel = $_POST['nivel'];
        $email = $_POST['email'];
        $mac = $_POST['mac'];
        $curso = $_POST['curso'];
        $addpor = $_SESSION['usersNome'];
        $validade = $_POST['validade'];
        
        $sql = "UPDATE users SET usersMatricula=?, usersNome=?, usersNivel=?, usersEmail=?, usersMac=?, usersCurso=?, usersValidade=? WHERE usersId=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "There was an error! 3";
            exit();
        } else{
            mysqli_stmt_bind_param($stmt, "ssssssss", $matricula, $nome, $nivel, $email, $mac, $curso, $validade, $id);
            mysqli_stmt_execute($stmt);

            $_SESSION['conf-users'] = "done";

            header("Location: ../../conf-users/index.php?conf=success");
            exit();
            }

    } else{
		header('location: ../../index.php');
	}
?>

