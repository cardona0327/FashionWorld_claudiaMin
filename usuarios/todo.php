
<head>
    <title><?php echo 'CATEGORIAS'; ?></title>
    
</head>
<body> 
<?php 
include_once '../method/productos_class.php';
?>
<div class="producto">
        <div class="container-fluid">
            <div class="row">
                <div class="col-10">
                    <?php
                    
                        include_once '../method/productos_class.php';
                        echo Productos::mostrarCategorias();
                    
                    
                    ?>
                </div>
            </div>
        </div>
</div>


</body>
