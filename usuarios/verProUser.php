<?php
    include_once '../method/productos_class.php';
     if(isset($_GET['id_categoria'])){
           $id_categoria = $_GET['id_categoria'];
        echo Productos::mostrarProductosPorCategoria($id_categoria);  
    }
                 
                            
                    
?>