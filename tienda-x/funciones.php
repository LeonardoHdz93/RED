<?php
//funcion para enviar correos electronicos via Gmail.

use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\SMTP;

function enviarCorreo($direccionDelRecipiente,$nombreDelrecipiente,$asunto,$mensaje){
    require_once 'bibliotecas/phpmailer-master/class.smtp.php';
    $correo = new PHPMailer();
    $correoPersonal = "leonardoh1604@gmail.com";
    //conectar con gmail
    $correo->isSMTP();
    $correo->SMTPAuth = true;
    $correo->SMTPSecure = "ssl";
    $correo->host = "smtp.gmail.com";
    $correo->Port = 25;
    //identificar con gmail
    $correo->Username = "hernandez.melendez.leonardo@gmail.com";
    $correo->Password = "Ichl1evedish";
    //componer correo
    $correo->isHTML(true);
    $correo->setFrom("leonardoh1604@gmail.com");
    $correo->Subject = $asunto;
    $correo->CharSet = 'UTF-8';
    $mensaje = "<body style = 'font-family:Verdana,Verdana,Geneva,sans-serif;font-size:14px;color:#000;'>" . $mensaje . "</body> </html>";
    $correo->addAddress($direccionDelRecipiente,$nombreDelrecipiente);
    $correo->Body = $mensaje;
    //Enviar Correo
    try{
    if($correo->send() ){
        echo "<script> 
                alert('Hemos enviado una confirmacion a tu correo');
                </script>";
    }else{
        echo "<script> 
        alert('No hemos podido enviar correo ');
        </script>";
        echo $correo->ErrorInfo;
    }
    /*$correo->send();
    echo "<script> 
                alert('Hemos enviado una confirmacion a tu correo');
                </script>";*/
}catch(Exception $e){
    echo $e->getMessage();

}
}
?>