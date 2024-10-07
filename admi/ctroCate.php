<?php
$id_categoria = $_GET['id_categoria'];
$categoria = $_GET['categoria'];

include("../method/productos_class.php");
Productos::agregarCate($id_categoria,$categoria);