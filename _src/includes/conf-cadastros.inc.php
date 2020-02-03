<?php
   
    session_start();

    if( isset( $_POST['modal-conf-cadastros-submit'] ) ){

        require '../dbh/mysqli.php';
        
        $id = $_POST['id'];

        $matricula = $_POST['matricula'];
        $nome = $_POST['nome'];
        $estado = "Fora";
        $nivel = $_POST['nivel'];
        $senha = $_POST['senha'];
        $img = $_POST['img'];
        $email = $_POST['email'];
        $mac = $_POST['mac'];
        $curso = $_POST['curso'];
        $addpor = $_SESSION['usersNome'];
        $validade = $_POST['validade'];
        $tipo = $_POST['tipo'];
        $statusconta = "Ativa";
        
        $sql = "UPDATE users SET usersMatricula=?, usersNome=?, usersEstado=?, usersNivel=?, usersSenha=?, usersImg=?, usersEmail=?, usersMac=?, usersCurso=?, usersAddPor=?, usersValidade=?, usersTipo=?, usersStatusConta=? WHERE usersId=?";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../../signup/index.php?error=sqlerror2");
            exit();

        } else{
            mysqli_stmt_bind_param($stmt, "ssssssssssssss", $matricula, $nome, $estado, $nivel, $senha, $img, $email, $mac, $curso, $addpor, $validade, $tipo, $statusconta, $id);
            mysqli_stmt_execute($stmt);

            $_SESSION['conf-cadastro'] = "done";
            $_SESSION['cadastros'] = $_SESSION['cadastros'] - 1;

            header("Location: ../../conf-cadastros/index.php?conf=success");
            exit();
        }


    } else{
		header('location: ../../index.php');
	}
?>

