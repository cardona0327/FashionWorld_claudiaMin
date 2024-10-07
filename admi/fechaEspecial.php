<?php
require_once '../method/modeloFechaEspe.php'; // Asegúrate de que la ruta sea correcta

// Establece la conexión a la base de datos
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'hola';

$conn = new mysqli($host, $user, $password, $database);

// Verifica si hay algún error en la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Establecer la conexión en la clase FechaEspecial
FechaEspecial::setDb($conn);

$fechas = FechaEspecial::obtenerFechas();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fechas Especiales</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href="../css/fechas_espe.css" rel="stylesheet">
</head>
<body>
    <br><br>
    <div class="container">
        <!-- Título Principal -->
        <h1 class="titulo-principal">Fechas Especiales</h1>

        <!-- Sección del Formulario -->
        <div class="form-fecha-especial">
            <h2 class="subtitulo">Agregar Nueva Fecha Especial</h2>
            <form action="../method/controlFechas.php" method="post">
                <div class="form-group">
                    <label for="evento">Evento:</label>
                    <input type="text" id="evento" name="evento" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="fecha_inicio">Fecha de Inicio:</label>
                    <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="fecha_fin">Fecha de Fin:</label>
                    <input type="date" id="fecha_fin" name="fecha_fin" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="color_evento">Color del Evento:</label>
                    <input type="color" id="color_evento" name="color_evento" class="form-control" required>
                </div>
                <button type="submit" name="accion" value="agregar" class="btn-agregar">Agregar Fecha Especial</button>
            </form>
        </div>

       <!-- Sección del Calendario -->
<h2 class="subtitulo">Listado de Fechas Especiales</h2>
<div class="calendar-container">
    <?php if ($fechas->num_rows > 0): ?>
        <?php while ($fecha = $fechas->fetch_assoc()): ?>
            <div class="calendar" style="border-color: <?php echo htmlspecialchars($fecha['color_evento']); ?>;">
                <div class="calendar-header" style="background-color: <?php echo htmlspecialchars($fecha['color_evento']); ?>;">
                    <div class="calendar-anillos">
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
                <div class="calendar-body">
                    <h3><?php echo htmlspecialchars($fecha['evento']); ?></h3>
                    <p>Inicio: <?php echo htmlspecialchars($fecha['fecha_inicio']); ?></p>
                    <p>Fin: <?php echo htmlspecialchars($fecha['fecha_fin']); ?></p>
                </div>
                <div class="calendar-footer">
                    <form action="../method/controlFechas.php" method="post">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($fecha['id']); ?>">
                        <button type="submit" name="accion" value="eliminar" class="btn-eliminar">Eliminar</button>
                    </form>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <center><p>No hay fechas especiales registradas.</p></center>
    <?php endif; ?>
</div>

</body>
</html>
