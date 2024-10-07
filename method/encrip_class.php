<?php

class EncriptarURl{

    /**
 * Método para encriptar un dato utilizando Base64.
 *
 * @param string $dato El dato que se desea encriptar.
 * @return string El dato encriptado en formato Base64.
 */
public static function encriptar($dato) {
    return base64_encode($dato);
}
/**
 * Método para desencriptar un dato que fue encriptado utilizando Base64.
 *
 * @param string $dato El dato que se desea desencriptar.
 * @return string El dato desencriptado.
 */
public static function desencriptar($dato) {
    return base64_decode($dato);
}


}
