<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instalador de Base de Datos</title>
    <!-- Incluir Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-JZR6Spejh4U02d8jH1M7M1OChxhP3fsNJw+DJQ2Ck+8ghcuxP0/9dJ7W1I5XwG8C" crossorigin="anonymous">
    <link href="css/styInstalador.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Instalación de la Base de Datos</h1>
        <form action="instalador.php" method="get">
            <div class="form-group">
                <label for="servidor" class="form-label">Servidor:</label>
                <input type="text" name="servidor" id="servidor" class="form-control" value="localhost" required>
            </div>
            <div class="form-group">
                <label for="root" class="form-label">Usuario:</label>
                <input type="text" name="root" id="root" class="form-control" value="root" required>
            </div>
            <div class="form-group">
                <label for="clave" class="form-label">Contraseña:</label>
                <input type="password" name="clave" id="clave" class="form-control">
            </div>
            <button type="submit" class="btn btn-custom">Instalar</button>
        </form>
    </div>
    <!-- Incluir Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-8ON3tIYB/mzF5LsHhlHjdP1n5iwcE6M2Cxd4ll33EJZWpK00lOmMwBZaAqE3b3+Kr" crossorigin="anonymous"></script>
</body>
</html>
