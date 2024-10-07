<?php


    class ModeloFactu{
/**
 * Método para insertar un producto en el carrito de compras de un usuario.
 *
 * @param int $idProducto ID del producto que se desea agregar al carrito.
 * @param string $nombreProducto Nombre del producto que se desea agregar.
 * @param float $precioProducto Precio del producto.
 * @param int $cantidadProducto Cantidad del producto a agregar.
 * @param string $documentoUsuario Documento del usuario que agrega el producto.
 * @return bool Resultado de la consulta de inserción.
 */
public static function insertarProductoCarrito($idProducto, $nombreProducto, $precioProducto, $cantidadProducto, $documentoUsuario) {
    // Incluir el archivo de conexión a la base de datos
    include("db_fashion/cb.php");
    
    // Consulta SQL para insertar el producto en el carrito
    $sql = "INSERT INTO tb_carrito (id_producto, nombre_producto, precio_pro, cantidad_pro, documento_usuario)
            VALUES ('$idProducto', '$nombreProducto', '$precioProducto', '$cantidadProducto', '$documentoUsuario')";
    
    // Ejecutar la consulta y devolver el resultado (true o false)
    return $resultado = $conexion->query($sql);
    $conexion->close();
}
/**
 * Método para mostrar los productos en el carrito de compras de un usuario específico.
 *
 * @param string $documentoUsuario Documento del usuario cuyo carrito se desea mostrar.
 * @return mysqli_result Resultado de la consulta SQL.
 */
public static function sqlMostrarCarrito($documentoUsuario) {
    // Incluir el archivo de conexión a la base de datos
    include("db_fashion/cb.php");

    // Consulta SQL para seleccionar los productos del carrito del usuario
    $sql = "SELECT id_ca, nombre_producto, cantidad_pro, precio_pro 
            FROM tb_carrito 
            WHERE documento_usuario = '$documentoUsuario'";

    // Ejecutar la consulta y retornar el resultado
    return $conexion->query($sql);
    $conexion->close();
}
/**
 * Método para eliminar un producto específico del carrito de compras de un usuario.
 *
 * @param int $idProducto ID del producto en el carrito que se desea eliminar.
 * @param string $documentoUsuario Documento del usuario cuyo carrito se está modificando.
 * @return bool Resultado de la operación de eliminación.
 */
public static function sqlEliminarProducto($idProducto, $documentoUsuario) {
    // Incluir el archivo de conexión a la base de datos
    include("db_fashion/cb.php");

    // Consulta SQL para eliminar el producto del carrito
    $sql = "DELETE FROM tb_carrito 
            WHERE id_ca = '$idProducto' AND documento_usuario = '$documentoUsuario'";

    // Ejecutar la consulta y retornar el resultado de la operación
    return $conexion->query($sql);
    $conexion->close();
}
/**
 * Método para verificar si un producto específico ya está en el carrito de compras de un usuario.
 *
 * @param int $idProducto ID del producto que se desea verificar en el carrito.
 * @param string $documentoUsuario Documento del usuario cuyo carrito se está revisando.
 * @return array|false Devuelve la fila del producto si existe en el carrito, o `false` si no existe.
 */
public static function verificarProductoEnCarrito($idProducto, $documentoUsuario) {
    // Incluir el archivo de conexión a la base de datos
    include 'db_fashion/cb.php';

    // Consulta SQL para buscar el producto en el carrito del usuario
    $sql = "SELECT * FROM tb_carrito 
            WHERE id_producto = '$idProducto' 
            AND documento_usuario = '$documentoUsuario'";

    // Ejecutar la consulta
    $resultado = $conexion->query($sql);

    // Devolver la fila del producto si existe, o `false` si no existe
    return $resultado->fetch_assoc(); 
    $conexion->close();
}
/**
 * Método para actualizar la cantidad de un producto en el carrito de compras de un usuario.
 *
 * @param int $idProducto ID del producto cuya cantidad se desea actualizar.
 * @param int $nuevaCantidad Nueva cantidad del producto.
 * @param string $documentoUsuario Documento del usuario cuyo carrito se está actualizando.
 * @return bool Devuelve `true` si la actualización se realizó correctamente, o `false` en caso contrario.
 */
public static function actualizarCantidadProducto($idProducto, $nuevaCantidad, $documentoUsuario) {
    // Incluir el archivo de conexión a la base de datos
    include("db_fashion/cb.php");

    // Consulta SQL para actualizar la cantidad del producto en el carrito
    $sql = "UPDATE tb_carrito 
            SET cantidad_pro = '$nuevaCantidad' 
            WHERE id_producto = '$idProducto' 
            AND documento_usuario = '$documentoUsuario'";

    // Ejecutar la consulta y devolver el resultado de la operación
    return $resultado = $conexion->query($sql);
    $conexion->close();
}
/**
 * Método para agregar una nueva factura en la base de datos.
 *
 * @param string $documentoUsuario Documento del usuario que realiza la compra.
 * @param string $metodoPago Método de pago utilizado.
 * @param string $direccion Dirección de envío.
 * @param string $numeroTarjeta Número de tarjeta de crédito o débito.
 * @param string $telefono Teléfono de contacto del usuario.
 * @param float $total Total de la factura.
 * @return int|bool Devuelve el ID de la factura recién creada o `false` en caso de error.
 */
public static function agregarFactura($documentoUsuario, $metodoPago, $direccion, $numeroTarjeta, $telefono, $total) {
    // Incluir el archivo de conexión a la base de datos
    include("db_fashion/cb.php"); // Asegúrate de tener tu conexión a la base de datos aquí

    // Insertar la factura en la tabla tb_facturas
    $sql = "INSERT INTO tb_facturas (documento_usuario, metodo_pago, direccion, numero_tarjeta, telefono, total) 
            VALUES ('$documentoUsuario', '$metodoPago', '$direccion', '$numeroTarjeta', '$telefono', '$total')";

    // Ejecutamos la consulta
    if ($conexion->query($sql)) {
        // Si la factura se inserta correctamente, devolvemos el ID de la factura recién creada
        return $conexion->insert_id; // Esto devuelve el ID de la factura
    } else {
        // Si hay un error en la inserción, devolvemos false
        return false;
    }
    $conexion->close();
}
/**
 * Método para calcular el total del carrito de compras de un usuario.
 *
 * @param string $documentoUsuario Documento del usuario cuyo carrito se va a calcular.
 * @return float Total calculado del carrito o 0 si no hay productos o hay un error.
 */
public static function calcularTotalCarrito($documentoUsuario) {
    // Incluir el archivo de conexión a la base de datos
    include("db_fashion/cb.php");

    // Consulta para calcular el total del carrito de compras
    $sql = "SELECT SUM(cantidad_pro * precio_pro) AS total FROM tb_carrito WHERE documento_usuario = '$documentoUsuario'";
    $resultado = $conexion->query($sql);

    if ($resultado) {
        $fila = $resultado->fetch_assoc();
        return $fila['total'] ? floatval($fila['total']) : 0; // Devuelve el total o 0 si no hay productos
    }

    return 0; // En caso de error
    $conexion->close();
}
/**
 * Método para agregar los detalles de una factura basándose en los productos en el carrito del usuario.
 *
 * @param int $idFactura ID de la factura a la que se agregarán los detalles.
 * @param string $documentoUsuario Documento del usuario cuyo carrito se va a usar.
 * @return bool Retorna true si se agregaron correctamente los detalles, false en caso contrario.
 */
public static function agregarDetallesFactura($idFactura, $documentoUsuario) {
    // Incluir el archivo de conexión a la base de datos
    include("db_fashion/cb.php");

    // Obtener los productos del carrito del usuario
    $sqlCarrito = "SELECT id_producto, cantidad_pro, precio_pro FROM tb_carrito WHERE documento_usuario = '$documentoUsuario'";
    $resultCarrito = $conexion->query($sqlCarrito);

    // Verificar si hay productos en el carrito
    if ($resultCarrito->num_rows > 0) {
        // Recorrer el carrito y agregar cada producto a la tabla de detalles de la factura
        while ($fila = $resultCarrito->fetch_assoc()) {
            $idProducto = $fila['id_producto'];  // ID del producto
            $cantidad = $fila['cantidad_pro'];    // Cantidad del producto
            $precioUnitario = $fila['precio_pro']; // Precio unitario del producto
            $subtotal = $cantidad * $precioUnitario; // Calcular subtotal

            // Insertar los detalles en la tabla tb_detalle_factura
            $sqlDetalle = "INSERT INTO tb_detalle_factura (id_factura, id_producto, cantidad, precio_unitario, subtotal) 
                           VALUES ('$idFactura', '$idProducto', '$cantidad', '$precioUnitario', '$subtotal')";

            if (!$conexion->query($sqlDetalle)) {
                // Si ocurre un error, puedes registrar el error o manejarlo adecuadamente
                return false; // Devolver false si no se pudo insertar el detalle
            }
            
        }

        // Si se agregaron todos los detalles correctamente, retorna true
        return true;
    } else {
        // Si no hay productos en el carrito
        return false; // Devolver false si no hay productos
    }
    $conexion->close();
}
/**
 * Método para mostrar los detalles de una factura
 *
 * @param int $idFactura ID de la factura de la cual se quieren mostrar los detalles.
 * @return objeto $consulta Resultados de la consulta que contiene los detalles de la factura.
 */
public static function sqlMostrarDetallesFactura($idFactura) {
    include("db_fashion/cb.php"); // Se incluye la conexión a la base de datos

    // Consulta para obtener la cantidad, precio unitario, subtotal y nombre del producto
    $sql = "SELECT dp.cantidad, dp.precio_unitario, dp.subtotal, p.nombre_producto 
            FROM tb_detalle_factura dp 
            INNER JOIN tb_productos p ON dp.id_producto = p.id_producto 
            WHERE dp.id_factura = '$idFactura'";

    $consulta = $conexion->query($sql); // Ejecuta la consulta
    return $consulta; // Retorna los resultados de la consulta
}
/**
 * Método para obtener los detalles de una factura
 *
 * @param int $idFactura ID de la factura que se desea obtener.
 * @return array|null Detalles de la factura como un array asociativo o null si ocurre un error.
 */
public static function obtenerFactura($idFactura) {
    include("db_fashion/cb.php"); // Se incluye la conexión a la base de datos

    // Consulta para obtener los detalles de la factura según su ID
    $sql = "SELECT * FROM tb_facturas WHERE id_factura = '$idFactura'";
    $resultado = mysqli_query($conexion, $sql); // Ejecuta la consulta

    if ($resultado) {
        return mysqli_fetch_assoc($resultado); // Retorna los detalles de la factura como un array
    } else {
        return null; // En caso de error o si no existe la factura
    }
    $conexion->close();
}
/**
 * Método para limpiar el carrito de un usuario
 *
 * @param string $documentoUsuario Documento del usuario cuyo carrito se desea limpiar.
 * @return bool Verdadero si el carrito se limpió correctamente, falso en caso contrario.
 */
public static function limpiarCarrito($documentoUsuario) {
    // Incluye la conexión a la base de datos
    include("db_fashion/cb.php");

    // Consulta para eliminar todos los productos del carrito para este usuario
    $query = "DELETE FROM tb_carrito WHERE documento_usuario = '$documentoUsuario'";

    // Ejecuta la consulta
    $resultado = $conexion->query($query);

    // Verifica si se eliminó correctamente
    if ($resultado) {
        return true;  // Se limpió el carrito correctamente
    } else {
        return false; // Ocurrió un error al limpiar el carrito
    }
    $conexion->close();
}
   
}
   
    