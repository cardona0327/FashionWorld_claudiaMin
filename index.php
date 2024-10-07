<?php

/**
 * Analisis y desarollo del software 
 * Claudia cardona olaya
 */

//Si existe un archivo que se llame instalador
//El programa redigira a un apartado para instalar la base de datos
if(file_exists('instalador.php') === true){
    header("Location: instalar.php");
    exit();
}else{
    //Si el archvio no Existe redireccionara al inicio
    header("Location: login.php");
    exit();
}

?>