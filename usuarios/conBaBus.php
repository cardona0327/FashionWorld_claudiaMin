<?php
include_once("../method/usuarios_class.php");
include_once("../method/productos_class.php");
if(!isset($_SESSION))session_start();
if(!isset($_SESSION['id'])){
    header("location: ../index.php");
}else if($_SESSION['id']==0){
    header("location: ../index.php");
}
$seccion = "home";
if(isset($_GET['seccion'])){
    $seccion = $_GET['seccion'];
}

if($seccion=="cerrarSe"){
    session_destroy();
    setcookie(session_name(), "", time()-3600, "/");
    header("location:../index.php");
}

include("navUser.php");

