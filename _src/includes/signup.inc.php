<?php

if(isset($_POST['signup-submit'])){

    require '../dbh/mysqli.php';

    $username = $_POST['name'];
    $matricula = $_POST['matricula'];
    $email = $_POST['mail'];
    $password = $_POST['password'];
    $passwordRepeat = $_POST['password-repeat'];
    $curso = $_POST['curso'];
    $img = $_POST['file'];

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
                $fileNameNew = uniqid($matricula).".".$fileActualExt;
                $fileDestination= 'profilepics/'.$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
            }else {
                echo "o arquivo é muito grande";
            }
        } else{
            echo "ocorreu um erro!";
        }
    } else {
        echo "voce nao pode upar arquivos desse tipo!";
    }
 
    // Verificando se o usuário não inseriu o nome completo
    $nomeCompleto = $_POST['name']; 
    $partes = explode(' ', $nomeCompleto); 
    if($partes[1] == null){
        header("Location:../../signup/index.php?error=notcompletename&nome=".$username."&curso=".$curso."&matricula=".$matricula."&email=".$email); 
        exit();
    }

    // Verificando se o usuário não inseriu uma imagem de perfil
    else if(empty($fileName)) {
        header("Location:../../signup/index.php?error=emptyimg&nome=".$username."&email=".$email."&matricula=".$matricula."&curso=".$curso); 
        exit();
    }
    
    // Verificando se o e-mail E o nome inserido são válidos
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]*$/", $username)){
        header("Location:../../signup/index.php?error=invalidmailandname&matricula=".$matricula."&curso=".$curso);
        exit();
    }

    // Verificando se o e-mail inserido é válido
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        header("Location:../../signup/index.php?error=invalidmail&nome=".$username."&matricula=".$matricula."&curso=".$curso);
        exit();
    }

    // Verificando se o nome inserido é válido
    else if(!preg_match("/^[a-zA-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]*$/", $username)){
        header("Location:../../signup/index.php?error=invalidname&email=".$email."&matricula=".$matricula."&curso=".$curso);
        exit();
    }

    // Verificando se a senha inserida no campo 'senha' e no campo 'repetir senha' batem
    else if($password !== $passwordRepeat){
        header("Location:../../signup/index.php?error=passwordcheck&nome=".$username."&email=".$email."&matricula=".$matricula."&curso=".$curso);
        exit();
    } 
    //Verificando se a senha inserida no campo 'senha' tem pelo menos 6 caracteres
    else if(strlen($password)<6){
        header("Location:../../signup/index.php?error=passwordlength&nome=".$username."&curso=".$curso."&matricula=".$matricula."&email=".$email);
    }
    
    else{
        // Verificando se já existe um usuário cadastrado com a mesma matrícula inserida 
        $sql = "SELECT usersMatricula FROM users WHERE usersMatricula=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location:../../signup/index.php?error=sqlerror1");
            exit();
        } else{
            mysqli_stmt_bind_param($stmt, "s", $matricula);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if($resultCheck > 0){
                header("Location:../../signup/index.php?error=matriculataken&nome=".$username."&curso=".$curso."&matricula=".$matricula."&email=".$email);
                exit();

            } else{
                // Verificando se já existe um usuário cadastrado com o mesmo e-mail inserido
                $sql = "SELECT usersEmail FROM users WHERE usersEmail=?";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location:../../signup/index.php?error=sqlerror33");
                    exit();
                } else{
                    mysqli_stmt_bind_param($stmt, "s", $email);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                    $resultCheck = mysqli_stmt_num_rows($stmt);
                    if($resultCheck > 0){
                        header("Location:../../signup/index.php?error=emailtaken&nome=".$username."&curso=".$curso."&matricula=".$matricula."&email=".$email);
                        exit();

                    } else{
                        // Inserindo as informações do novo usuário no banco de dados
                        $sql = "INSERT INTO users (usersNome, usersMatricula, usersEmail, usersSenha, usersMac, usersCurso, usersValidade, usersEstado, usersImg, usersTipo, usersStatusConta, usersNivel, usersAddPor) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                        $stmt = mysqli_stmt_init($conn);

                        if(!mysqli_stmt_prepare($stmt, $sql)){
                            header("Location:../../signup/index.php?error=sqlerror2");
                            exit();

                        } else{
                            $mac = "00-00-00-00-00-00";
                            $validade = "2020-12-16";
                            $estado = "Fora";
                            $tipo = "Comum";
                            $addpor = "Sistema";
                            $nivel = "C";
                            $statusconta = "ConfEmail";
                            $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                            mysqli_stmt_bind_param($stmt, "sssssssssssss", $username, $matricula, $email, $hashedPwd, $mac, $curso, $validade, $estado, $fileNameNew, $tipo, $statusconta, $nivel, $addpor);
                            mysqli_stmt_execute($stmt);

                            $url = "http://10.100.100.3/conf-user-email.php/index.php?email=".$email;

                            $to = $email;

                            $subject = 'LPA - Confirme seu e-mail';

                            $message = '
                            <p style="font-size: 20px;">Nós recebemos uma solicitação de cadastro, para continuar clique no botão abaixo.</p>
                            <p style="font-size: 20px;">Ao clicar em Confirmar E-mail você confirma que leu e concordou com os termos do <br>Regulamento do LPA que se encontra em anexo.</p>
                            <a href="'.$url.'" style="background-color: #FF0000; border-radius: 30px; color: white; padding: 15px 32px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px;">Confirmar E-mail</a>
			    <p>Ou <a href="'.$url.'" >clique aqui</a> para executar a mesma a��o.</p>                                   
                            <p style="font-size: 20px;">Caso você não tenha feito essa solicitação, ignore esta mensagem.</p>
                            ';

                            $headers = "From: LPA <lpa.ifto@gmail.com>\r\n";
                            $headers .= "Reply-To: lpa.ifto@gmail.com\r\n";
                            $headers .= "Content-type: text/html\r\n";

                            mail($to, $subject, $message, $headers);

                            require_once('../../_ext/PHPMailer/PHPMailerAutoload.php');

                            $mail = new PHPMailer();
                            $mail->isSMTP();
                            $mail->SMTPAuth = true;
                            $mail->SMTPSecure = 'ssl';
                            $mail->Host = 'smtp.gmail.com';
                            $mail->Port = '465';
                            $mail->isHTML();
                            $mail->Username = 'lpa.ifto@gmail.com';
                            $mail->Password = 'tq0Dyb5y';
                            $mail->SetFrom('lpa.ifto@gmail.com');
                            $mail->isHTML(true);
                            $mail->Subject = $subject;
                            $mail->Body = $message;
                            $mail->addAttachment('doc.pdf', 'Regulamento LPA.pdf'); // addAttachment('path', 'name')
                            $mail->AddAddress($email);

                            if(!$mail->Send()) {
                                echo 'Message could not be sent. ';
                                echo 'Mailer Error: ' . $mail->ErrorInfo;
                                exit;
                            } else{
                                header("Location: ../index.php?signup=success");
                                exit();
                            }
                        }
                    }
                }
            }
        }
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

else{
    header("Location: ../signup.php");
    exit();
}