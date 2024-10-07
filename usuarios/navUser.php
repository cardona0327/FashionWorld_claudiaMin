<!doctype html>
<html lang="en">
  <head>
     <!-- Google tag (gtag.js) -->
     <script async src="https://www.googletagmanager.com/gtag/js?id=G-MW395SN41J"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
        
          gtag('config', 'G-MW395SN41J');
        </script>
        

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/styProInicio.css">
    <link rel="stylesheet" type="text/css" href="../css/styPerfil.css">
    <link rel="stylesheet" type="text/css" href="../css/styLike.css">
    <link rel="stylesheet" type="text/css" href="../css/styMostrarPro.css">
    <link rel="stylesheet" type="text/css" href="../css/styMostrarCateUser.css">
    <link rel="stylesheet" type="text/css" href="../css/styActuUser.css">
    <link rel="stylesheet" type="text/css" href="../css/styles_deseos.css">
    <link rel="stylesheet" type="text/css" href="../css/styleProCate.css">
    <link rel="stylesheet" type="text/css" href="../css/foro.css">
    <link rel="stylesheet" type="text/css" href="../css/busqueda.css">
    <link rel="stylesheet" type="text/css" href="../css/comprasUser.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="../css/estilo.css" rel="stylesheet">
    <link href="../css/stylePro.css" rel="stylesheet">
    <link href="../css/footer.css" rel="stylesheet">
    <link href="../css/carrito.css" rel="stylesheet">
    <link href="../css/detalleFactu.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/estiloFactura.css">
    <link href="../css/ofertaVis.css" rel="stylesheet">
    <link href="../css/fondo.css" rel="stylesheet">
    <link href="../css/favorito.css" rel="stylesheet">
    <link href="../css/styFactu.css" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<title>HOME USER</title>
    
  </head>
  <body>
  <!-- class="navbar navbar-expand-lg navbar-light bg-light" -->
    <nav  class="navbar navbar-expand-lg navbar-light" style="background-color: #36dafe;">
  <div class="container-fluid">
  <a class="navbar-brand" href="conBaBus.php?seccion=home"><h1><b>FASHION WORLD</b></h1></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
           Menú 
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="conBaBus.php?seccion=perfil"><i class="fas fa-user-circle" style="color: #d3d3d3; font-size: 24px;"></i> Perfil</a></li>
            <li><a class="dropdown-item" href="conBaBus.php?seccion=lista_deseos"><i class="fas fa-star" style="color: #FFD700; font-size: 20px;"></i> Mi lista de deseos</a></li>
            <li><a class="dropdown-item" href="conBaBus.php?seccion=compras"><i class="fas fa-wallet" style="color: #A67C52; font-size: 18px;"></i> Mis compras</a></li>
            <li><a class="dropdown-item" href="conBaBus.php?seccion=cerrarSe"><i class="fas fa-sign-out-alt" style="font-size: 24px; color: #dc3545;"></i> Cerrar sesión</a></li>
          </ul>
        </li>
        <li class="nav-item"><a class="nav-link active" aria-current="page" href="conBaBus.php?seccion=fechaEspecial"><i class="fas fa-calendar-check" style="color: #f52476; font-size: 18px;"></i> Fechas Especiales</a></li> 
        <li class="nav-item"><a class="nav-link active" aria-current="page" href="conBaBus.php?seccion=todo"><i class="fas fa-layer-group" style="color: #d54e00; font-size: 18px;"></i> Categorias</a></li>
        <li class="nav-item"><a class="nav-link active" aria-current="page" href="conBaBus.php?seccion=verTodoProUser"><i class="fas fa-box-open" style="color: #A67C52; font-size: 18px;"></i>  Todos los productos</a></li>
        <li class="nav-item"><a class="nav-link active" aria-current="page" href="conBaBus.php?seccion=favoritos"><i class="fas fa-star" style="color: #f5ef24; font-size: 18px;"></i> favoritos <span id="favoritos-count" class="badge badge-pill badge-primary"></span></a></li>
        <li class="nav-item"><a class="nav-link active" aria-current="page" href="conBaBus.php?seccion=carrito"><i class="fas fa-cart-arrow-down" style="color: #800080; font-size: 18px;"></i> Carrito <span id="carrito-count" class="badge badge-pill badge-primary"></span></a></li>
        <li class="nav-item"><a class="nav-link active" aria-current="page" href="conBaBus.php?seccion=foro"><i class="fas fa-comment-dots" style="color: #f0f0f0; font-size: 18px;"></i> Foro de comentarios</a></li>
        </ul>
      </ul>
    </div>
  </div>
</nav>



</div>
        

            
        
        
        
            <!-- Se declara un contenedor fila y después un contenedor columna. LAs columnas deben sumar 12, según la rejilla Bootstrap. -->
        <div class="container">
                    
        <?php
                
        include( $seccion.".php" );
                
        ?>
        </div>
    </body>

   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../js/ajaxbuscaPro.js"></script>
    <script src="../js/likes.js"></script>
    <script src="../js/foto.js"></script>
    <script src="../js/eventoListaDeseo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/añadirCarro.js"></script>
    <script src="../js/añadirFavo.js"></script>
    <script src="../js/eliminarCarrito.js"></script>
    <script src="../js/mostrarCarro.js"></script>
    <script src="../js/agregarComen.js"></script>
    <script src="../js/responderComen.js"></script>
    <script src="../js/eliComen.js"></script>
    <script src="../js/eliRespuesta.js"></script>
    <script src="../js/eliminarFavo.js"></script>
    <script src="../js/saludo.js"></script>
    
    
    <footer id="footer" class="bg-dark text-center text-lg-start" style="padding: 20px 0;">
    <div class="container p-4">
        <div class="row">
            <div id="footer-brand" class="col-lg-4 col-md-12 mb-4">
                <h5 class="text-uppercase text-white">Fashion World</h5>
                <p class="text-white">&copy; 2024 Fashion World. Todos los derechos reservados.</p>
            </div>
            <div id="footer-contact" class="col-lg-4 col-md-6 mb-4">
                <h5 class="text-uppercase text-white">Contacto</h5>
                <p class="text-white">Para quejas o reclamos, contáctenos al correo: 
                    <a href="mailto:fashionworld0910@gmail.com" class="text-warning">fashionworld0910@gmail.com</a>
                </p>
                <p class="text-white">Teléfono: <strong>3170209457</strong></p>
            </div>
            <div id="footer-social" class="col-lg-4 col-md-6 mb-4">
                <h5 class="text-uppercase text-white">Redes Sociales</h5>
                <p class="text-white">
                    <a href="#" class="text-warning"><i class="fab fa-facebook-f" style="font-size: 24px; color: #3b5998;"></i> Facebook</a> |
                    <a href="#" class="text-warning"><i class="fab fa-instagram" style="font-size: 24px; color: #C13584;"></i> Instagram</a> |
                    <a href="#" class="text-warning"><i class="fab fa-twitter" style="font-size: 24px; color: #1DA1F2;"></i> Twitter</a>
                </p>
            </div>
        </div>
    </div>
</footer>


   
  </body>
</html>