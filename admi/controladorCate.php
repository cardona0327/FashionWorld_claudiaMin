<?php
include_once("../method/productos_class.php");
if(isset($_GET['idCateEliminar'])){
    // echo $_GET['idCateEliminar'];
    if(Productos::eliminarCate($_GET['idCateEliminar'])==1){
        echo Productos::mostrarCate(); 
    }else{
        echo 0;
    }
}

Productos::eliminarCate($_GET['idCateEliminar']);