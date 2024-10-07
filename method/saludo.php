<?php
function obtenerSaludoBienvenida() {
    date_default_timezone_set('America/Bogota'); // Establece la zona horaria
    $hora = date('H'); // Obtiene la hora actual en formato 24 horas

    if ($hora >= 5 && $hora < 12) {
        return "¡Buenos días!";
    } elseif ($hora >= 12 && $hora < 18) {
        return "¡Buenas tardes!";
    } else {
        return "¡Buenas noches!";
    }
}
?>
