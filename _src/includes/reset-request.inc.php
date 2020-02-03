<?php

if(isset($_POST['reset-request-submit'])){

    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);

    $url = "10.100.100.3/create-new-password.php?selector=".$selector."&validator=".bin2hex($token);

    $expires = date("U") + 1800;

    require '../dbh/mysqli.php';

    $userEmail = $_POST['mail'];

    $sql = "DELETE FROM pwdreset WHERE pwdResetEmail=?"; 
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "There was an error! error code: 1";
        exit();
    } else{
        mysqli_stmt_bind_param($stmt, "s", $userEmail);
        mysqli_stmt_execute($stmt);
    }

    $sql = "INSERT INTO pwdreset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "There was an error! error code: 2";
        exit();
    } else{
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $hashedToken, $expires);
        mysqli_stmt_execute($stmt);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    // $to = $userEmail;

    $subject = 'LPA - Mude sua senha';

    $message = '<p>Nós recebemos um pedido de alteração de senha. Segue abaixo o link para alteração da sua senha. Se não foi você quem fez o pedido, ignore essa mensagem.</p>';
    $message .= '<p>Link para alteração da senha: </br>';
    $message .= '<a href="' . $url . '">LINK</a></p>';

    // $headers = "From: mmtuts <usemmtuts@gmail.com>\r\n";
    // $headers .= "Reply-To: usemmtuts@gmail.com\r\n";
    // $headers .= "Content-type: text/html\r\n";

    // mail($to, $subject, $message, $headers);

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
    $mail->Subject = $subject;
    $mail->Body = $message;
    $mail->AddAddress($userEmail);

    $mail->Send();

    header("Location: ../../reset-password/index.php?resetrequest=success");

}

else{
    header("Location: ../../index.php");
}