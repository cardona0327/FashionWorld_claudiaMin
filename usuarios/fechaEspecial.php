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
    
        <!-- Título Principal -->
        <h1 class="titulo-principal">Fechas Especiales</h1>

       

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
                    Temporadas y fechas especiales🌟
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <center><p>No hay fechas especiales registradas.</p></center>
    <?php endif; ?>
</div>

</body>
</html>
