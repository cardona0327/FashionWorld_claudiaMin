<!DOCTYPE html>
<html lang="es">
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
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet"> 
  <title>Recuperar Contraseña</title>
  <link rel="stylesheet" type="text/css" href="css/recupeContra.css">
</head>
<body>
<div class="container-fluid" id="contenedor-principal">
    <form id="form-recuperar" action="usuarios/ctroUser.php?recuperar=true" method="post">
        <h1 id="titulo-recuperar">Recuperar Contraseña</h1>
        <!-- Imagen que se mostrará -->
        <div id="campo-imagen" class="mb-3">
            <img id="img-mostrada" src="img/Anotación 2024-09-05 134018.png" alt="Foto" class="img-fluid" style="max-width: 150px; height: auto;"> <!-- Estilo inline para redimensionar la imagen -->
        </div>
        <p id="texto-recuperar">Para recuperar tu contraseña, ingresa tu correo electrónico:</p>
        
        <div class="mb-3" id="campo-correo">
            <label for="input-correo" class="form-label" id="label-correo">Correo electrónico</label>
            <input type="email" name="correo" class="form-control" id="input-correo" aria-describedby="emailHelp" required>
        </div>

        
        
        <button id="btn-enviar" type="submit" class="btn">Enviar</button><br><br>
        
        <center><a href="login.php" id="btn-volver" class="btn"><i class="fas fa-arrow-left"></i> Volver</a></center>
    </form>
</div>
</body>
</html>
