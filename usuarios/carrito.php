
<head>

    <title>Carrito</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    

</head>
<body> 
    <div class="container cart-container">
        <h2 class="cart-title"><i class='fa fa-shopping-cart'></i> Tu carrito</h2>
        <?php
        
        include_once("../method/factura_class.php");
        $id = $_SESSION['id'];
        echo Factura::mostrarCarrito($id);
        ?>
         
         

    </div>
   
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   
    
</body>
