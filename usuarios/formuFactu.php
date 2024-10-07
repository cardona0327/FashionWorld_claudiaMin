<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Pago</title>
    <link rel="stylesheet" href="path/to/bootstrap.css"> <!-- Asegúrate de incluir Bootstrap -->
</head>
<body>
    <div id="contenedor-formulario-pago" class="container">
        <h2 id="titulo-formulario-pago">Formulario de Pago</h2>
        <form id="formulario-pago" action="ctroUser.php" method="GET">
            <input id="input-hidden-agrefa" type="hidden" name="agrefa" value="agregarFactura"> <!-- Variable para el controlador -->

            <div id="grupo-telefono" class="form-group">
                <label for="telefono" id="label-telefono">Teléfono:</label>
                <input id="input-telefono" type="text" class="form-control" name="telefono" required>
            </div>

            <div id="grupo-direccion" class="form-group">
                <label for="direccion" id="label-direccion">Dirección:</label>
                <input id="input-direccion" type="text" class="form-control" name="direccion" required>
            </div>

            <div id="grupo-tarjeta" class="form-group">
                <label for="numeroTarjeta" id="label-tarjeta">Número de tarjeta:</label>
                <input id="input-tarjeta" type="text" class="form-control" name="numeroTarjeta" required>
            </div>

            <div id="grupo-metodoPago" class="form-group">
                <label for="metodoPago" id="label-metodoPago">Método de pago:</label>
                <select id="select-metodoPago" class="form-control" name="metodoPago" required>
                    <option value="tarjeta">Tarjeta</option>
                    <option value="efectivo">Efectivo</option>
                </select>
            </div>

            <button id="btn-realizar-pago" type="submit" class="btn btn-success">Realizar Pago</button>
        </form>
    </div>
</body>
</html>
