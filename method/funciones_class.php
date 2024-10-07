<?php

class HtmlGenerator {
    /**
 * Método para crear un correo electrónico en formato HTML
 *
 * @param string $name Nombre del destinatario del correo.
 * @param string $message Mensaje que se incluirá en el correo.
 * @param string $dato Nueva contraseña que se enviará al usuario.
 * @param int $id Identificador asociado a la solicitud de cambio de contraseña.
 * @return string El contenido HTML del correo electrónico.
 */
public static function createEmailHtml($name, $message, $dato, $id) {
    $html = "
        <!DOCTYPE html>
        <html lang='es'>
        <head>
            <meta charset='UTF-8'>
            <title>Mensaje de Correo</title>
            <style>
                body { font-family: Arial, sans-serif; }
                .container { padding: 20px; border: 1px solid #ccc; }
                .message { margin-top: 10px; }
                .code { margin-top: 10px; font-weight: bold; color: #333; }
            </style>
        </head>
        <body>
            <div class='container'>
                <h1>Hola, $name!</h1>   
                <div class='message'>
                    <p>$message</p>
                </div>
                <div class='code'>
                    <p>Ingresa esta nueva contraseña: $dato</p>
                    <a href='localhost/PROYECTO-CLAUDIA/cambioClave.php?codigo=".$id."'>dale click</a>
                </div>
            </div>
        </body>
        </html>
    ";
    return $html; // Retorna el contenido HTML generado
}

}
