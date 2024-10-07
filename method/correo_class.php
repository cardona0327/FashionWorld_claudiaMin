<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class Correo {
    public static function correos($correo,$asunto,$body){
        include("../PHPMailer/PHPMailer.php");
        include("../PHPMailer/Exception.php");
        include("../PHPMailer/SMTP.php");// Solo si estás usando SMTP

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings   
            $mail->isSMTP();                                                        //Send using SMTP
            $mail->SMTPDebug  =  0;                                                 //Enable verbose debug output                           
            $mail->Host       = 'smtp.gmail.com';                              //Set the SMTP server to send through
            $mail->SMTPAuth   =  true;                                              //Enable SMTP authentication
            $mail->Username   = 'fashionworld0910@gmail.com';    //SMTP username
            $mail->Password   = 'xdvi gywk hnvd wysa';                                 //SMTP password
            $mail->SMTPSecure = 'tls';                                              //Enable implicit TLS encryption
            $mail->Port       =  587;                                               //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('fashionworld0910@gmail.com','FashionWorld');
            $mail->addAddress($correo,'Cliente');     //Add a recipient;

            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $asunto;
            $mail->Body    = $body;

            $mail->send();
            $salida =  '<h1 style="color: #1bff00;">Se ha enviado tu correo correctamente. Revisa tu bandeja de entrada</h1>';
        } catch (Exception $e) {
            $salida =  '<h1 style="color: #df0a0a;">Ops.. ocurrió un error al enviar el correo</h1>';
        }
        return $salida;
    }

    public static function enviarCorreo($correo,$dato){
        include_once("modelo.php");
        include_once("usuarios_class.php");
        include_once("funciones_class.php");
        include_once("token_class.php");
        include_once("encrip_class.php");
        $id = Usuarios::buscarId($correo);
        $name = Modelo::buscarDatosUser(1,$id);
        $message = "esta es la clave nueva ";
        $html = HTMLGenerator::createEmailHtml($name, $message, $dato,EncriptarURl::encriptar($id));
        Modelo::sqlCambiarClave($dato,$id);
        echo Correo::correos($correo,"Recuperar clave",$html);

    }
}

// Modelo::sqlCambiarClave($nuevaClave,$id);

?>