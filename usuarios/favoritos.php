
<head>
    <title>Favoritos</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    
</head>
<body>
    <div class="container favorites-container">
        <h2 class="favorites-title"><i class="fas fa-star" style="color: #f5ef24; font-size: 30px;"></i> Tus favoritos</h2>
        <?php
        include '../method/db_fashion/cb.php';
        include_once '../method/productos_class.php';
        $documentoUsuario = $_SESSION['id'];
        echo Productos::mostrarFavoritos($documentoUsuario);
        ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   
</body>