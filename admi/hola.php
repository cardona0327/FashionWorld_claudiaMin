<?php
include_once("../method/productos_class.php");
$rutaImagen = Productos::datoPro(5,$_GET['dato']);
echo $rutaImagen; // Verifica que esta ruta sea correcta
?>
