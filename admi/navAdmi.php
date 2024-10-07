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
    <!-- <link rel="stylesheet" type="text/css" href="../css/styAgrePro.css"> -->
    <link rel="stylesheet" type="text/css" href="../css/styMostrarPro.css">
    <link rel="stylesheet" type="text/css" href="../css/styMostrarCate.css">
    <link rel="stylesheet" type="text/css" href="../css/styPerfil.css">
    <link rel="stylesheet" type="text/css" href="../css/botonPer.css">
    <link rel="stylesheet" type="text/css" href="../css/styInfo.css">
    <link rel="stylesheet" type="text/css" href="../css/styConteos.css">
    <link rel="stylesheet" type="text/css" href="../css/styMostrarUser.css">
    <link rel="stylesheet" type="text/css" href="../css/styActuUser.css">
    <link rel="stylesheet" type="text/css" href="../css/styAgregarPro.css">
    <link rel="stylesheet" type="text/css" href="../css/styAgreCate.css">
    <link rel="stylesheet" type="text/css" href="../css/styediPro.css">
    <link rel="stylesheet" type="text/css" href="../css/styEstadistica.css">
    <link rel="stylesheet" type="text/css" href="../css/deseosAdmi.css">
    <link rel="stylesheet" type="text/css" href="../css/styinfoPro.css">
    <link rel="stylesheet" type="text/css" href="../css/tablaConteo.css">
    <link href="../css/fondo.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    

    
  </head>
  <body>
  <!-- class="navbar navbar-expand-lg navbar-light bg-light" -->
    <nav  class="navbar navbar-expand-lg navbar-light" style="background-color: #36dafe;">
  <div class="container-fluid">
    <a class="navbar-brand" href="ctroBar.php?seccion=homeAdmi"><h1><b>FASHION WORLD</b></h1></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Productos
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="ctroBar.php?seccion=agregarPro"><i class="fas fa-plus-circle" style="font-size: 24px; color: #4CAF50;"></i> Agregar productos</a></li>
            <li><a class="dropdown-item" href="ctroBar.php?seccion=verPro"><i class="fas fa-tags" style="color: #4A90E2; font-size: 24px;"></i> ver productos</a></li>
            <li><a class="dropdown-item" href="ctroBar.php?seccion=eliminarPro"><i class="fas fa-trash-alt" style="color: #C62828; font-size: 24px; margin-right: 8px;"></i> Eliminar Productos</a></li>
            
            
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Categorias
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
             <li><a class="dropdown-item" href="ctroBar.php?seccion=agregarCate"><i class="fas fa-folder-plus" style="color: #8B4513; font-size: 24px; margin-right: 8px;"></i> Agregar categorías</a></li>
             <li><a class="dropdown-item" href="ctroBar.php?seccion=verCate"><i class="fas fa-folder" style="color: #FFA500; font-size: 24px; margin-right: 8px;"></i> Ver categorías</a></li>
             <li><a class="dropdown-item" href="ctroBar.php?seccion=eliminarCate"><i class="fas fa-trash-alt" style="color: #C62828; font-size: 24px; margin-right: 8px;"></i> Eliminar Categorías</a></li>
          </ul>
        </li>

        <li class="nav-item"><a class="nav-link active" aria-current="page" href="ctroBar.php?seccion=mostrarUser"><i class="fas fa-users" style="color: #ff8300; font-size: 18px;"></i> Ver usuarios</a></li>
        <li class="nav-item"><a class="nav-link active" aria-current="page" href="ctroBar.php?seccion=perfilAdmi"><i class="fas fa-user-circle" style="color: #6f766e; font-size: 18px;"></i> Perfil</a></li>
        <li class="nav-item"><a class="nav-link active" aria-current="page" href="ctroBar.php?seccion=fechaEspecial"><i class="fas fa-calendar-check" style="color: #f52476; font-size: 18px;"></i> Fecha Especial</a></li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="fas fa-info-circle" style="color: #7511ae; font-size: 20px;"></i> Información
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="ctroBar.php?seccion=infoAdmi">Info usuarios</a></li>
            <li><a class="dropdown-item" href="ctroBar.php?seccion=deseos">Deseos Usuarios</a></li>
            <li><a class="dropdown-item" href="ctroBar.php?seccion=infoAdmiPro">Info productos</a></li>
          </ul>
        </li>
        <li class="nav-item"><a class="nav-link active" aria-current="page"  href="ctroBar.php?seccion=cerrarSe"><i class="fas fa-sign-out-alt" style="font-size: 18px; color: #dc3545;"></i> Cerrar sesión</a></li>

      </ul>
    </div>
  </div>
</nav>
     
            <!-- Se declara un contenedor fila y después un contenedor columna. LAs columnas deben sumar 12, según la rejilla Bootstrap. -->
        <div class="container">
                    
        <?php
                
        include( $seccion.".php" );
        
                
        ?>
        </div>
    </body>

   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="../js/ajax.js"></script>
    <script src="../js/ajaxCate.js"></script>
    <script src="../js/ajaxBusUser.js"></script>
    <script src="../js/fotoAdmi.js"></script>
    <script src="../js/imgPrevia.js"></script>
    <script src="../js/cumplirDeseo.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>  
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   

    

  </body>
</html>