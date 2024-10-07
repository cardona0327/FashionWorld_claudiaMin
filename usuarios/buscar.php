<?php
include_once("../method/productos_class.php");
if(isset($_GET['idBuscador'])){
    if(Productos::eliminarPro($_GET['idBuscador'])==1){
        echo Productos::mostrarPro(); 
    }else{
        echo 0;
    }
}
?>