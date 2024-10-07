<?php
class FuncionPro{
    /**
 * Método para sanitizar un texto y prevenir ataques XSS (Cross-Site Scripting).
 *
 * Este método elimina etiquetas peligrosas como `<script>`, `<img>`, `<iframe>`, y otras que pueden usarse para ejecutar código malicioso en un sitio web.
 * También elimina cualquier etiqueta HTML presente en el texto.
 *
 * @param string $texto El texto que se desea sanitizar.
 * @return string Retorna el texto sanitizado, libre de posibles vulnerabilidades XSS y etiquetas HTML.
 */
public static function vacunaXxs($texto) {
    // Patrón que busca etiquetas potencialmente peligrosas como <script>, <img>, <iframe>, entre otras
    $patron_xss = '/<\s*(script|img|iframe|frame|video|audio|embed|object|svg|javascript)\b[^>]>.?<\/\s*\1\s*>/i';
    
    // Reemplazamos cualquier coincidencia con el patrón de XSS por una cadena vacía (eliminando el contenido peligroso)
    $salida = preg_replace($patron_xss, '', $texto);
    
    // Eliminamos cualquier etiqueta HTML restante para mayor seguridad
    $salida = strip_tags($salida);
    
    return $salida;  // Retornamos el texto sanitizado
}

}