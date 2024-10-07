<?php
$nombre= $_REQUEST["nombre"];

include_once("productos_class.php");
Productos::buscarPro($nombre);