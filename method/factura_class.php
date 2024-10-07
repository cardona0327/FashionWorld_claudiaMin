<?php
class Factura {
    /**
 * Método para agregar un producto al carrito de compras de un usuario
 *
 * @param int $idProducto Identificador del producto que se desea agregar.
 * @param string $nombreProducto Nombre del producto que se va a agregar.
 * @param float $precioProducto Precio del producto que se va a agregar.
 * @param int $cantidadProducto Cantidad del producto que se desea agregar.
 * @param string $documentoUsuario Documento del usuario que está realizando la acción.
 * @return int Retorna 2 si se actualizó la cantidad, 1 si se agregó el producto, o 0 si hubo un error.
 */
public static function agregarProductoCarrito($idProducto, $nombreProducto, $precioProducto, $cantidadProducto, $documentoUsuario) {
    include_once("modeloFactu.php");

    // Verificar si el producto ya está en el carrito
    $consulta = ModeloFactu::verificarProductoEnCarrito($idProducto, $documentoUsuario);

    if ($consulta) {
        // Actualizar cantidad si el producto ya existe
        $nuevaCantidad = $consulta['cantidad_pro'] + $cantidadProducto;
        $resultado = ModeloFactu::actualizarCantidadProducto($idProducto, $nuevaCantidad, $documentoUsuario);
        return $resultado ? 2 : 0; // Retornar 2 si se actualizó, 0 si hubo error
    } else {
        // Agregar nuevo producto al carrito
        $resultado = ModeloFactu::insertarProductoCarrito($idProducto, $nombreProducto, $precioProducto, $cantidadProducto, $documentoUsuario);
        return $resultado ? 1 : 0; // Retornar 1 si se agregó, 0 si hubo error
    }
}
/**
 * Método para mostrar el carrito de compras de un usuario
 *
 * @param string $documentoUsuario Documento del usuario cuyo carrito se desea mostrar.
 * @return string Retorna el HTML del carrito de compras con los detalles de los productos y opciones para eliminar.
 */
public static function mostrarCarrito($documentoUsuario) {
    include_once("modeloFactu.php");

    // Obtener los productos del carrito del usuario
    $consulta = ModeloFactu::sqlMostrarCarrito($documentoUsuario);
    $salida = "<div id='contenedor-carrito'>";
    $salida .= "<table class='table table-bordered'>";
    $salida .= "<thead><tr><th>Producto</th><th>Cantidad</th><th>Precio</th><th>Acciones</th></tr></thead><tbody>";

    // Iterar sobre cada producto en el carrito
    while ($fila = $consulta->fetch_assoc()) {
        $salida .= "<tr>";
        $salida .= "<td>" . $fila['nombre_producto'] . "</td>";
        $salida .= "<td>" . $fila['cantidad_pro'] . "</td>";
        $salida .= "<td>$" . $fila['precio_pro'] . "</td>";
        $salida .= "<td><button class='btn btn-danger' onclick='eliminarProducto(" . $fila['id_ca'] . ")'><i class='fa fa-trash'></i> Eliminar</button></td>";
        $salida .= "</tr>";
    }

    $salida .= "</tbody></table>";
    $salida .= "<a href='../usuarios/conBaBus.php?seccion=formuFactu' class='btn btn-secondary'><i class='fas fa-coins' style='color: #FFD700; font-size: 24px;'></i> Pagar</a>"; // Botón de pago
    $salida .= "</div>"; // Cerrar contenedor
    return $salida;
}
/**
 * Método para eliminar un producto del carrito de compras de un usuario
 *
 * @param int $idProducto ID del producto que se desea eliminar del carrito.
 * @param string $documentoUsuario Documento del usuario del cual se eliminará el producto.
 * @return int Retorna 1 si el producto fue eliminado correctamente, o 0 si hubo un error.
 */
public static function eliminarProductoCarrito($idProducto, $documentoUsuario) {
    include_once("modeloFactu.php");

    // Llamar a la función que elimina el producto
    $resultado = ModeloFactu::sqlEliminarProducto($idProducto, $documentoUsuario);

    if ($resultado) {
        return 1;  // Producto eliminado correctamente
    } else {
        return 0;  // Error al eliminar
    }
}
/**
 * Método para mostrar los detalles de una factura específica.
 *
 * @param int $idFactura ID de la factura cuyos detalles se mostrarán.
 * @return string Devuelve una tabla HTML con los detalles de la factura, incluyendo el nombre del producto, cantidad, precio unitario y subtotal.
 */
public static function mostrarDetallesFactura($idFactura) {
    include_once("modeloFactu.php");

    $consulta = ModeloFactu::sqlMostrarDetallesFactura($idFactura);
    $salida = "<div class='table-responsive'>"; // Envuelve la tabla en un div responsivo
    $salida .= "<table id='detallesFactura' class='table table-bordered table-striped'>"; // Clases adicionales para el estilo
    $salida .= "<thead class='thead-light'><tr><th>Producto</th><th>Cantidad</th><th>Precio Unitario</th><th>Subtotal</th></tr></thead><tbody>";

    while ($fila = $consulta->fetch_assoc()) {
        $salida .= "<tr>";
        $salida .= "<td>" . htmlspecialchars($fila['nombre_producto']) . "</td>"; 
        $salida .= "<td>" . htmlspecialchars($fila['cantidad']) . "</td>";
        $salida .= "<td>$" . number_format($fila['precio_unitario'], 2) . "</td>";
        $salida .= "<td>$" . number_format($fila['subtotal'], 2) . "</td>";
        $salida .= "</tr>";
    }

    $salida .= "</tbody></table>";
    $salida .= "</div>"; // Cierra el div responsivo
    return $salida;
}
/**
 * Método para mostrar una factura específica en formato HTML.
 *
 * @param int $idFactura ID de la factura que se desea mostrar.
 * @return string Devuelve el HTML de la factura con los detalles del cliente y de los productos.
 */
public static function mostrarFactura($idFactura) {
    include_once("modeloFactu.php");

    // Obtener los detalles de la factura desde la base de datos
    $factura = ModeloFactu::obtenerFactura($idFactura);
    $detalles = ModeloFactu::sqlMostrarDetallesFactura($idFactura);

    // Comienza a generar el HTML de la factura
    $html = "
    <div id='factura-container' style='border: 2px solid #f0f0f0; padding: 30px; max-width: 900px; margin: 0 auto; font-family: Arial, sans-serif;'>
        <div id='factura-header' style='text-align: center; margin-bottom: 20px;'>
            <img src='../img/Anotación 2024-09-05 134018.png' alt='Logo' style='width: 100px; height: auto; margin-bottom: 10px;' id='factura-logo'>
            <h1 style='font-size: 24px; color: #333;'>Factura de Compra</h1>
        </div>
        <h1 style='font-size: 24px; color: #333;'>Fashion World</h1>
        <div id='factura-info' style='margin-bottom: 20px;'>
            <p><strong>Factura No: </strong>{$factura['id_factura']}</p>
            <p><strong>Fecha: </strong>{$factura['fecha_factura']}</p>
            <p><strong>Cliente: </strong>{$factura['documento_usuario']}</p>
            <p><strong>Teléfono: </strong>{$factura['telefono']}</p>
            <p><strong>Dirección: </strong>{$factura['direccion']}</p>
            <p><strong>Método de Pago: </strong>{$factura['metodo_pago']}</p>
        </div>

        <table id='factura-detalles' style='width: 100%; border-collapse: collapse; margin-bottom: 20px;'>
            <thead>
                <tr>
                    <th style='border: 1px solid #ddd; padding: 10px; background-color: #f8f8f8;'>Producto</th>
                    <th style='border: 1px solid #ddd; padding: 10px; background-color: #f8f8f8;'>Cantidad</th>
                    <th style='border: 1px solid #ddd; padding: 10px; background-color: #f8f8f8;'>Precio Unitario</th>
                    <th style='border: 1px solid #ddd; padding: 10px; background-color: #f8f8f8;'>Subtotal</th>
                </tr>
            </thead>
            <tbody>";

    // Agregar los detalles de cada producto a la factura
    while ($fila = $detalles->fetch_assoc()) {
        $html .= "
            <tr>
                <td style='border: 1px solid #ddd; padding: 10px;'>{$fila['nombre_producto']}</td>
                <td style='border: 1px solid #ddd; padding: 10px;'>{$fila['cantidad']}</td>
                <td style='border: 1px solid #ddd; padding: 10px;'>\${$fila['precio_unitario']}</td>
                <td style='border: 1px solid #ddd; padding: 10px;'>\${$fila['subtotal']}</td>
            </tr>";
    }

    // Cerrar la tabla y agregar el total
    $html .= "
            </tbody>
        </table>

        <div id='factura-total' style='text-align: right; margin-bottom: 20px;'>
            <h3 style='color: #333;'>Total: \${$factura['total']}</h3>
        </div>

        <div id='factura-botones' style='text-align: center; margin-top: 30px;'>
            <button onclick='window.print()' style='padding: 10px 20px; background-color: #007bff; color: white; border: none; cursor: pointer; font-size: 16px;'>Imprimir Factura</button>
        </div>
    </div>";

    return $html;
}   
}
