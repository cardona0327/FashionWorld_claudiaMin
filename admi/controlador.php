<?php
include_once("../method/productos_class.php");
if(isset($_GET['idProEliminar'])){
    // echo $_GET['idProEliminar'];
    if(Productos::eliminarPro($_GET['idProEliminar'])==1){
        echo Productos::mostrarPro(); 
    }else{
        echo 0;
    }
}

Productos::eliminarPro($_GET['idProEliminar']);

