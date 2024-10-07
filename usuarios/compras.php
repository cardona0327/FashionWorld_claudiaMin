<?php
include_once("../method/productos_class.php");
$idUsuario = $_SESSION['id'];
echo Productos::mostrarProductosCompradosPorUsuario($idUsuario);