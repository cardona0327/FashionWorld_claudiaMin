<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Contraseña</title>
    <link rel="stylesheet" type="text/css" href="css/cambioClave.css">
</head>
<body>
    <form id="form-password" action="usuarios/ctroUser.php?cambioCo=true&codigo=<?php echo $_GET['codigo']; ?>" method="post">
        <div class="mb-3">
            <label for="input-old-password" class="form-label">Ingresa la contraseña que te enviamos</label>
            <input type="password" name="nuevaClave" class="form-control" id="input-old-password" aria-describedby="passwordHelp">
            <input type="checkbox" id="showPasswordE" onclick="visibilidadcontraseñaE()">mostrar contraseña
        </div>
        <div class="mb-3">
            <label for="input-new-password" class="form-label">Ingresa la contraseña nueva</label>
            <input type="password" name="newPassword" class="form-control" id="input-new-password" aria-describedby="newPasswordHelp">
            <input type="checkbox" id="showPasswordN" onclick="visibilidadcontraseñaN()">mostrar contraseña
        </div>
        <button type="submit" id="btn-submit" class="btn btn-primary">Enviar</button>
    </form>
</body>
<script src="js/verClaves.js"></script>
</html>
