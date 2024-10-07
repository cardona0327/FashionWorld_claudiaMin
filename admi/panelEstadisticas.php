<?php
// Incluye la conexión a la base de datos
include("../method/db_fashion/cb.php");

// Consulta 1: Total de usuarios registrados
$sqlUsuarios = "SELECT COUNT(*) AS total_usuarios FROM tb_usuarios";
$resultUsuarios = mysqli_query($conexion, $sqlUsuarios);
$dataUsuarios = mysqli_fetch_assoc($resultUsuarios);
$totalUsuarios = $dataUsuarios['total_usuarios'];

// Consulta 2: Productos más vendidos
$sqlProductosVendidos = "
    SELECT p.nombre_producto, SUM(d.cantidad) AS total_vendidos
    FROM tb_detalle_factura d
    JOIN tb_productos p ON d.id_producto = p.id_producto
    GROUP BY p.nombre_producto
    ORDER BY total_vendidos DESC";
$resultProductosVendidos = mysqli_query($conexion, $sqlProductosVendidos);
$productosVendidos = [];
while($row = mysqli_fetch_assoc($resultProductosVendidos)) {
    $productosVendidos[] = [$row['nombre_producto'], (int)$row['total_vendidos']];
}

// Consulta 3: Productos en el carrito
$sqlCarrito = "SELECT COUNT(*) AS total_productos_carrito FROM tb_carrito";
$resultCarrito = mysqli_query($conexion, $sqlCarrito);
$dataCarrito = mysqli_fetch_assoc($resultCarrito);
$totalCarrito = $dataCarrito['total_productos_carrito'];

// Consulta 4: Total de likes por producto
$sqlLikes = "
    SELECT p.nombre_producto, COUNT(l.id_like) AS total_likes
    FROM tb_likes l
    JOIN tb_productos p ON l.producto_id = p.id_producto
    GROUP BY p.nombre_producto
    ORDER BY total_likes DESC";
$resultLikes = mysqli_query($conexion, $sqlLikes);
$likesProductos = [];
while($row = mysqli_fetch_assoc($resultLikes)) {
    $likesProductos[] = [$row['nombre_producto'], (int)$row['total_likes']];
}

// Consulta 5: Total de ventas por fecha
$sqlVentas = "
    SELECT DATE(f.fecha_factura) AS fecha, SUM(f.total) AS total_ventas
    FROM tb_facturas f
    GROUP BY DATE(f.fecha_factura)";
$resultVentas = mysqli_query($conexion, $sqlVentas);
$ventasPorFecha = [];
while($row = mysqli_fetch_assoc($resultVentas)) {
    $ventasPorFecha[] = [$row['fecha'], (float)$row['total_ventas']];
}

// Consulta 6: Productos en la lista de deseos
$sqlListaDeseos = "SELECT COUNT(*) AS total_lista_deseos FROM tb_lista_deseos";
$resultListaDeseos = mysqli_query($conexion, $sqlListaDeseos);
$dataListaDeseos = mysqli_fetch_assoc($resultListaDeseos);
$totalListaDeseos = $dataListaDeseos['total_lista_deseos'];

// Consulta 7: Productos en favoritos
$sqlFavoritos = "SELECT COUNT(*) AS total_favoritos FROM tb_favoritos";
$resultFavoritos = mysqli_query($conexion, $sqlFavoritos);
$dataFavoritos = mysqli_fetch_assoc($resultFavoritos);
$totalFavoritos = $dataFavoritos['total_favoritos'];

// Consulta 8: Cantidad de fechas especiales
$sqlFechasEspeciales = "SELECT COUNT(*) AS total_fechas_especiales FROM tb_fecha_especial";
$resultFechasEspeciales = mysqli_query($conexion, $sqlFechasEspeciales);
$dataFechasEspeciales = mysqli_fetch_assoc($resultFechasEspeciales);
$totalFechasEspeciales = $dataFechasEspeciales['total_fechas_especiales'];

?>

<!DOCTYPE html>
<html>
<head>
    <title>Estadísticas de la tienda</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
    
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawCharts);

        function drawCharts() {
            // Gráfico de total de usuarios
            var dataUsuarios = google.visualization.arrayToDataTable([
                ['Métrica', 'Cantidad'],
                ['Usuarios Registrados', <?php echo $totalUsuarios; ?>]
            ]);

            var optionsUsuarios = {
                title: 'Usuarios Registrados',
                colors: ['#FF5733']
            };

            var chartUsuarios = new google.visualization.PieChart(document.getElementById('usuarios_chart'));
            chartUsuarios.draw(dataUsuarios, optionsUsuarios);

            // Gráfico de productos más vendidos
            var dataProductosVendidos = google.visualization.arrayToDataTable([
                ['Producto', 'Cantidad Vendida'],
                <?php
                foreach ($productosVendidos as $producto) {
                    echo "['".$producto[0]."', ".$producto[1]."],";
                }
                ?>
            ]);

            var optionsProductosVendidos = {
                title: 'Productos Más Vendidos',
                hAxis: {title: 'Producto'},
                vAxis: {title: 'Cantidad Vendida'},
                legend: 'none',
                colors: ['#33FF57']
            };

            var chartProductosVendidos = new google.visualization.ColumnChart(document.getElementById('productos_vendidos_chart'));
            chartProductosVendidos.draw(dataProductosVendidos, optionsProductosVendidos);

            // Gráfico de productos en el carrito
            var dataCarrito = google.visualization.arrayToDataTable([
                ['Métrica', 'Cantidad'],
                ['Productos en Carrito', <?php echo $totalCarrito; ?>]
            ]);

            var optionsCarrito = {
                title: 'Productos en Carrito',
                colors: ['#3357FF']
            };

            var chartCarrito = new google.visualization.PieChart(document.getElementById('carrito_chart'));
            chartCarrito.draw(dataCarrito, optionsCarrito);

            // Gráfico de likes por producto
            var dataLikes = google.visualization.arrayToDataTable([
                ['Producto', 'Likes'],
                <?php
                foreach ($likesProductos as $like) {
                    echo "['".$like[0]."', ".$like[1]."],";
                }
                ?>
            ]);

            var optionsLikes = {
                title: 'Likes por Producto',
                hAxis: {title: 'Producto'},
                vAxis: {title: 'Likes'},
                legend: 'none',
                colors: ['#FFC300']
            };

            var chartLikes = new google.visualization.ColumnChart(document.getElementById('likes_chart'));
            chartLikes.draw(dataLikes, optionsLikes);

            // Gráfico de ventas por fecha
            var dataVentas = google.visualization.arrayToDataTable([
                ['Fecha', 'Ventas'],
                <?php
                foreach ($ventasPorFecha as $venta) {
                    echo "['".$venta[0]."', ".$venta[1]."],";
                }
                ?>
            ]);

            var optionsVentas = {
                title: 'Ventas Totales por Fecha',
                hAxis: {title: 'Fecha'},
                vAxis: {title: 'Ventas'},
                legend: 'none',
                colors: ['#DAF7A6']
            };

            var chartVentas = new google.visualization.LineChart(document.getElementById('ventas_chart'));
            chartVentas.draw(dataVentas, optionsVentas);

            // Gráfico de productos en la lista de deseos
            var dataListaDeseos = google.visualization.arrayToDataTable([
                ['Métrica', 'Cantidad'],
                ['Productos en Lista de Deseos', <?php echo $totalListaDeseos; ?>]
            ]);

            var optionsListaDeseos = {
                title: 'Productos en Lista de Deseos',
                colors: ['#581845']
            };

            var chartListaDeseos = new google.visualization.PieChart(document.getElementById('lista_deseos_chart'));
            chartListaDeseos.draw(dataListaDeseos, optionsListaDeseos);

            // Gráfico de productos en favoritos
            var dataFavoritos = google.visualization.arrayToDataTable([
                ['Métrica', 'Cantidad'],
                ['Productos en Favoritos', <?php echo $totalFavoritos; ?>]
            ]);

            var optionsFavoritos = {
                title: 'Productos en Favoritos',
                colors: ['#C70039']
            };

            var chartFavoritos = new google.visualization.PieChart(document.getElementById('favoritos_chart'));
            chartFavoritos.draw(dataFavoritos, optionsFavoritos);

            // Gráfico de fechas especiales
            var dataFechasEspeciales = google.visualization.arrayToDataTable([
                ['Métrica', 'Cantidad'],
                ['Fechas Especiales', <?php echo $totalFechasEspeciales; ?>]
            ]);

            var optionsFechasEspeciales = {
                title: 'Fechas Especiales',
                colors: ['#900C3F']
            };

            var chartFechasEspeciales = new google.visualization.PieChart(document.getElementById('fechas_especiales_chart'));
            chartFechasEspeciales.draw(dataFechasEspeciales, optionsFechasEspeciales);
        }
    </script>
</head>
<body>
    <h1>Estadísticas de la Tienda</h1>
    <div class="chart-container">
        <div id="usuarios_chart" class="chart"></div>
        <div id="productos_vendidos_chart" class="chart"></div>
        <div id="carrito_chart" class="chart"></div>
        <div id="likes_chart" class="chart"></div>
        <div id="ventas_chart" class="chart"></div>
        <div id="lista_deseos_chart" class="chart"></div>
        <div id="favoritos_chart" class="chart"></div>
        <div id="fechas_especiales_chart" class="chart"></div>
    </div>
</body>
</html>
