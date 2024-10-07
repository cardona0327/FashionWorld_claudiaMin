<?php
/**
 * sacado de stackoverflow
 */
class token{
    /**
 * Método para generar un token aleatorio con una cantidad específica de caracteres.
 *
 * Este método crea un token utilizando caracteres alfanuméricos (mayúsculas, minúsculas y números).
 * El token generado tiene la longitud especificada por el parámetro `$cantidadCaracteres`.
 *
 * @param int $cantidadCaracteres La longitud del token que se desea generar.
 * @return string Retorna el token generado de longitud `$cantidadCaracteres`.
 */
public static function crearToken($cantidadCaracteres)
{
    // Conjunto de caracteres permitidos para el token (mayúsculas, minúsculas y números)
    $Caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    
    // Obtenemos la longitud del conjunto de caracteres
    $ca = strlen($Caracteres);
    $ca--;  // Restamos 1 para ajustar el índice final (empezamos desde 0)
    
    $Hash = '';  // Inicializamos la variable que contendrá el token generado
    
    // Bucle para generar cada carácter del token aleatoriamente
    for ($x = 1; $x <= $cantidadCaracteres; $x++) {
        $Posicao = rand(0, $ca);  // Elegimos una posición aleatoria dentro de los caracteres
        $Hash .= substr($Caracteres, $Posicao, 1);  // Añadimos el carácter correspondiente a esa posición
    }
    
    return $Hash;  // Retornamos el token generado
}

}