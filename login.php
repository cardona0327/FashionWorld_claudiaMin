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
    <title>Inicio de Sesión</title>
    <!-- Incluye SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<link href="css/styInicioSesion.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <img src="img/Anotación 2024-09-05 134018.png" alt="Imagen">
        <div class="form-container">
            <h1>Iniciar sesión</h1>
            <form action="method/controler_login.php?recorrido=1" method="post">
        <input type="number" name="documento" placeholder="Usuario" required><br><br>
    <div>
        <input type="password" id="password" name="contraseña" placeholder="Contraseña" required>
        <input type="checkbox" id="showPassword" onclick="visibilidadcontraseña()">mostrar contraseña
    </div>
    <br>
    <center><iframe src="method/captcha.php" style="border: none; width: 150px; height: 80px;"></iframe></center>
    <input type="text" name="captcha" placeholder="Ingrese el texto mostrado arriba" required>
    <input type="submit" value="Ingresar"><br>
    <center><a href="recuperarContraseña.php">¿Olvidaste tu contraseña?</a></center>
    <center><a href="registrar.php">Registrarse</a></center>
</form>



        </div>
    </div>
    <!-- Incluir SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <!-- Incluir el archivo JavaScript con tus alertas personalizadas -->
    <script src="js/alertError.js"></script>
    <script src="js/verContraseña.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
