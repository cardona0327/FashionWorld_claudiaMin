<!DOCTYPE html>
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

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet">
    <title>Registrarse</title>
    <link rel="stylesheet" type="text/css" href="css/styRegistro.css">
   
</head>
<body>
<div class="container">
    <img src="img/Anotación 2024-09-05 134018.png" alt="Imagen">
    <div class="form-container">
        <div class="right-text"><h1>REGÍSTRATE</h1></div>


         <?php
         if(isset($_GET['error']) && $_GET['error']=='usuario_existente'){
            echo "<p style='color: red;'>Este usuario con este documento ya existe. Intente con otro documento.</p>";
         }
         ?>

        <form id="registerForm" action="method/controler_login.php?recorrido=2" method="post">
            <input type="number" name="documento" id="documento" placeholder="Documento" required><br>
            <input type="text" name="nombre" placeholder="Nombre" required><br>
            <input type="text" name="apellido" placeholder="Apellido" required><br>
            <input type="email" name="correo" placeholder="Correo" required><br>
            <input type="password" id="password" name="contraseña" placeholder="Contraseña" required><br>
            <input type="checkbox" id="showPassword" onclick="visibilidadcontraseña()">mostrar contraseña
            <input type="date" name="fecha" placeholder="Fecha de nacimiento" required><br>
    
            

            <div class="form-check mt-3 mb-3">
                <input class="form-check-input" type="checkbox" id="privacyCheck" required>
                <label class="form-check-label" for="privacyCheck"> <a href="politicaPri.php" target="_blank">He leído y acepto la Política de privacidad</a></label>
            </div>
    
            <input type="submit" value="Registrarse" class="btn btn-primary w-100"><br>
            <center>
                <a href="login.php">Inicia sesión</a>
            </center>
        </form>
    </div>
</div>

    <!-- Incluir SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <!-- Incluir el archivo JavaScript con tus alertas personalizadas -->
    <script src="js/alertError.js"></script>
    <script src="js/verContraseña.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7pA2L53ldMtFf06d3oKiG8rx8F3oCk5" crossorigin="anonymous"></script>
</body>
</html>
