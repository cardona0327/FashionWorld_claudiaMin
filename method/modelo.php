<?php
class Modelo{
/**
 * Método para obtener la contraseña de un usuario según su documento.
 * 
 * @param documento {number} número de documento del usuario que se utiliza para realizar la búsqueda en la base de datos.
 * 
 * @return {array|false} retorna un arreglo asociativo con la contraseña del usuario si se encuentra, de lo contrario, retorna false.
 */
    public static function sqlLoguin($documento) {
        include("db_fashion/cb.php"); 
        $documento = $conexion->real_escape_string($documento); // Escapar el documento para evitar inyecciones SQL
        $sql = "SELECT contraseña FROM tb_usuarios WHERE documento='$documento'";
        $resultado = $conexion->query($sql);
    
        if ($resultado && $resultado->num_rows > 0) {
            return $resultado->fetch_assoc(); // Retorna la fila asociativa si se encuentra un resultado
        } else {
            return false; // Retorna false si no hay resultados
        }
        $conexion->close();
    }
/**
 * Método para registrar un nuevo usuario en la base de datos.
 * 
 * @param documento {number} número de documento del usuario.
 * @param nombre {texto} nombre del usuario.
 * @param apellido {texto} apellido del usuario.
 * @param correo {texto} correo electrónico del usuario.
 * @param contraseña {texto} contraseña encriptada del usuario.
 * @param fecha {texto} fecha de registro del usuario.
 * 
 * @return {boolean} retorna true si el usuario fue registrado correctamente, o false si hubo un error.
 */
public static function sqlRegistar($documento, $nombre, $apellido, $correo, $contraseña, $fecha) {
    include("db_fashion/cb.php"); // Incluye la conexión a la base de datos
    $sql = "INSERT INTO tb_usuarios (documento, nombre, apellido, correo, contraseña, fecha, rol) 
            VALUES ('$documento', '$nombre', '$apellido', '$correo', '$contraseña', '$fecha', '2')"; // Consulta SQL para insertar el usuario
    $resultado = $conexion->query($sql); // Ejecuta la consulta
    return $resultado; // Retorna el resultado de la operación
    $conexion->close();
}
    /**
 * Método para obtener los detalles del perfil de un usuario a partir de su documento.
 * 
 * @param id {number} número de documento del usuario.
 * 
 * @return {mysqli_result|boolean} retorna los datos del perfil si se encuentra el usuario, o false si no.
 */
public static function sqlPerfil($id) {
    include("db_fashion/cb.php"); // Incluye la conexión a la base de datos
    $sql = "SELECT * FROM tb_usuarios WHERE documento = '$id'"; // Consulta SQL para obtener los datos del perfil
    $resultado = $conexion->query($sql); // Ejecuta la consulta
    return $resultado; // Retorna el resultado de la consulta
    $conexion->close();
}
/**
 * Método para obtener el rol de un usuario a partir de su documento.
 * 
 * @param id {number} número de documento del usuario.
 * 
 * @return {mysqli_result|boolean} retorna el rol del usuario si se encuentra, o false si no.
 */
public static function sqlRol($id) {
    include("db_fashion/cb.php"); // Incluye la conexión a la base de datos
    $sql = "SELECT rol FROM tb_usuarios WHERE documento = '$id'"; // Consulta SQL para obtener el rol del usuario
    return $resultado = $conexion->query($sql); // Ejecuta la consulta y retorna el resultado
    $conexion->close();
}
    /**
 * Método para agregar un nuevo producto a la base de datos.
 * 
 * @param nombre {texto} nombre del producto.
 * @param precio {number} precio del producto.
 * @param cantidad {number} cantidad disponible del producto.
 * @param descripcion {texto} descripción del producto.
 * @param color {texto} color del producto.
 * @param tallas {texto} tallas disponibles del producto.
 * @param imagen {texto} ruta de la imagen del producto.
 * @param id_categoria {number} identificador de la categoría a la que pertenece el producto.
 * 
 * @return {boolean} retorna true si el producto se agrega correctamente, o false si falla.
 */
public static function sqlAgregarPro($nombre, $precio, $cantidad, $descripcion, $color, $tallas, $imagen, $id_categoria) {
    include("db_fashion/cb.php"); // Incluye la conexión a la base de datos
    $sql = "INSERT INTO tb_productos(nombre_producto, precio, cantidad, detalles, color, tallas, ruta_img, id_categoria) ";
    $sql .= "VALUES ('$nombre', '$precio', '$cantidad', '$descripcion', '$color', '$tallas', '$imagen', '$id_categoria')"; // Inserta un nuevo producto
    return $resultado = $conexion->query($sql); // Ejecuta la consulta y retorna el resultado
    $conexion->close();
}
/**
 * Método para obtener todas las categorías de la base de datos.
 * 
 * @return {array} retorna un arreglo con las categorías disponibles, donde cada categoría incluye su id y nombre.
 */
public static function obtenerCategorias() {
    include("db_fashion/cb.php"); // Conexión a la base de datos
    $sql = "SELECT id_categoria, categoria FROM tb_categoria"; // Consulta para obtener las categorías
    $resultado = $conexion->query($sql); // Ejecuta la consulta
    $categorias = [];
    
    if ($resultado) { // Si se obtuvieron resultados
        while ($row = $resultado->fetch_assoc()) { // Recorre cada fila de resultados
            $categorias[] = $row; // Almacena cada categoría en el arreglo
        }
    }
    
    return $categorias; // Retorna el arreglo de categorías
    $conexion->close();
}
    /**
 * Método para mostrar productos de la base de datos.
 * 
 * @param {string|null} $buscar (opcional) término de búsqueda para filtrar los productos por nombre.
 * @return {mysqli_result} retorna el resultado de la consulta, que puede contener todos los productos o los que coinciden con el término de búsqueda.
 */
public static function sqlMostrarPro($buscar = null) {
    include("db_fashion/cb.php"); // Conexión a la base de datos
    $sql = "SELECT * FROM tb_productos "; // Consulta para obtener todos los productos
    if ($buscar) { // Si hay un término de búsqueda
        $sql .= "WHERE nombre_producto LIKE '%$buscar%';"; // Agrega condición para filtrar productos
    }

    return $resultado = $conexion->query($sql); // Ejecuta la consulta y retorna el resultado
    $conexion->close();
}
    /**
 * Método para contar los 'likes' de un producto.
 * 
 * @param {number} $id_pro ID del producto cuyo conteo de likes se desea obtener.
 * @return {int} retorna el total de 'likes' para el producto, o 0 si no hay 'likes'.
 */
public static function sqlConteoLikes($id_pro) {
    include("db_fashion/cb.php"); // Conexión a la base de datos
    $sql = "SELECT COUNT(id_like) as total_likes FROM tb_likes WHERE producto_id = '$id_pro'"; // Consulta para contar los 'likes' del producto
    $resultado = $conexion->query($sql); // Ejecuta la consulta

    if ($resultado && $fila = $resultado->fetch_assoc()) { // Si hay resultados
        return $fila['total_likes']; // Retorna el total de 'likes'
    } else {
        return 0; // Retorna 0 si no hay 'likes'
    }
    $conexion->close();
}
/**
 * Método para agregar una nueva categoría a la base de datos.
 * 
 * @param {number} $id_categoria ID de la categoría que se desea agregar.
 * @param {text} $categoria Nombre de la categoría que se desea agregar.
 * @return {boolean} Retorna true si la categoría se agregó correctamente, o false en caso contrario.
 */
public static function sqlAgregarCate($id_categoria, $categoria) {
    include("db_fashion/cb.php"); // Conexión a la base de datos
    $sql = "INSERT INTO tb_categoria(id_categoria, categoria) "; 
    $sql .= "VALUES ('$id_categoria', '$categoria')"; // Consulta para insertar la nueva categoría
    return $resultado = $conexion->query($sql); // Ejecuta la consulta y retorna el resultado
    $conexion->close();
}
    /**
 * Método para obtener todas las categorías de la base de datos.
 * 
 * @return {mysqli_result} Retorna un objeto de resultado de MySQLi que contiene todas las categorías.
 */
public static function sqlVerCate() {
    include("db_fashion/cb.php"); // Conexión a la base de datos
    $sql = "SELECT * FROM tb_categoria"; // Consulta para seleccionar todas las categorías
    return $resultado = $conexion->query($sql); // Ejecuta la consulta y retorna el resultado
    $conexion->close();
}
 /**
 * Método para eliminar un producto de la base de datos y sus likes asociados.
 * 
 * @param {number} $id Identificador del producto a eliminar.
 * @return {bool} Retorna verdadero si la eliminación fue exitosa, falso de lo contrario.
 */
public static function sqlEliminarPro($id) {
    include("db_fashion/cb.php"); // Conexión a la base de datos

    // Eliminar los likes asociados al producto
    $sqlLikes = "DELETE FROM tb_likes WHERE producto_id = '$id'";
    $conexion->query($sqlLikes); // Ejecuta la consulta para eliminar los likes

    // Eliminar los detalles de factura asociados al producto
    $sqlDetalleFactura = "DELETE FROM tb_detalle_factura WHERE id_producto = '$id'";
    $conexion->query($sqlDetalleFactura); // Ejecuta la consulta para eliminar los detalles de factura

    // Eliminar el producto de la tabla tb_productos
    $sqlProducto = "DELETE FROM tb_productos WHERE id_producto = '$id'";
    return $resultado = $conexion->query($sqlProducto); // Retorna el resultado de la eliminación del producto
    $conexion->close();
}

    /**
 * Método para eliminar una categoría de la base de datos y los productos asociados.
 * 
 * @param {number} $id Identificador de la categoría a eliminar.
 * @return {bool} Retorna verdadero si la eliminación fue exitosa, falso de lo contrario.
 */
public static function sqlEliminarCate($id) {
    include("db_fashion/cb.php"); // Conexión a la base de datos
    
    // Eliminar los productos asociados a la categoría
    $sqlPro = "DELETE FROM tb_productos WHERE id_categoria = '$id'";
    $conexion->query($sqlPro); // Ejecuta la consulta para eliminar los productos
    
    // Eliminar la categoría de la tabla tb_categoria
    $sql = "DELETE FROM tb_categoria WHERE id_categoria = '$id'";
    return $resultado = $conexion->query($sql); // Retorna el resultado de la eliminación de la categoría
    $conexion->close();
}
    /**
 * Método para obtener una categoría específica de la base de datos.
 * 
 * @param {number} $des Indicador para determinar qué dato se va a seleccionar (1 para 'categoria').
 * @param {number} $idCate Identificador de la categoría a buscar.
 * @return {mysqli_result|bool} Retorna el resultado de la consulta; puede ser un objeto mysqli_result o falso si hubo un error.
 */
public static function sqlCategorias($des, $idCate) {
    include("db_fashion/cb.php"); // Conexión a la base de datos
    $dato = "";
    
    // Determina el dato a seleccionar basado en el valor de $des
    if ($des == 1) {
        $dato = "categoria"; // Selecciona el campo 'categoria'
    }

    // Consulta para obtener la categoría específica
    $sql = "SELECT $dato FROM tb_categoria ";
    $sql .= "WHERE id_categoria = '$idCate'";
    
    return $resultado = $conexion->query($sql); // Retorna el resultado de la consulta
    $conexion->close();
}
    /**
 * Método para editar una categoría existente en la base de datos.
 * 
 * @param {number} $id_categoria Identificador de la categoría que se desea editar.
 * @param {string} $categoria Nuevo nombre de la categoría.
 * @return {mysqli_result|bool} Retorna el resultado de la consulta; puede ser un objeto mysqli_result o falso si hubo un error.
 */
public static function sqlEditar($id_categoria, $categoria) {
    include_once("productos_class.php"); // Incluye la clase de productos
    include("db_fashion/cb.php"); // Conexión a la base de datos
    
    // Consulta para actualizar el nombre de la categoría
    $sql = "UPDATE tb_categoria SET categoria = '$categoria' ";
    $sql .= "WHERE id_categoria = '$id_categoria' ";
    
    return $resultado = $conexion->query($sql); // Retorna el resultado de la consulta
    $conexion->close();
}
    /**
 * Método para eliminar un usuario y sus registros relacionados en la base de datos.
 * 
 * @param {number} $id Identificador del usuario que se desea eliminar.
 * @return {bool|string} Retorna verdadero si la eliminación fue exitosa, o un mensaje de error en caso contrario.
 */
public static function sqlEliminarUser($id) {
    // Incluye el archivo de conexión a la base de datos
    include("db_fashion/cb.php");
    
    // Verifica si la conexión fue exitosa
    if ($conexion->connect_error) {
        return "Error de conexión: " . $conexion->connect_error; // Retorna un mensaje de error si la conexión falla
    }
    
    // Elimina registros relacionados en tb_likes
    $sqlLikes = "DELETE FROM tb_likes WHERE usuario_id = ?";
    if ($stmtLikes = $conexion->prepare($sqlLikes)) {
        $stmtLikes->bind_param("i", $id); // Vincula el parámetro
        $stmtLikes->execute(); // Ejecuta la consulta
        $stmtLikes->close(); // Cierra la declaración
    }
    
    // Elimina registros relacionados en tb_carrito
    $sqlCarrito = "DELETE FROM tb_carrito WHERE documento_usuario = ?";
    if ($stmtCarrito = $conexion->prepare($sqlCarrito)) {
        $stmtCarrito->bind_param("i", $id); // Vincula el parámetro
        $stmtCarrito->execute(); // Ejecuta la consulta
        $stmtCarrito->close(); // Cierra la declaración
    }
    
    // Elimina registros relacionados en tb_facturas
    $sqlFacturas = "DELETE FROM tb_facturas WHERE documento_usuario = ?";
    if ($stmtFacturas = $conexion->prepare($sqlFacturas)) {
        $stmtFacturas->bind_param("i", $id); // Vincula el parámetro
        $stmtFacturas->execute(); // Ejecuta la consulta
        $stmtFacturas->close(); // Cierra la declaración
    }
    
    // Elimina registros relacionados en tb_lista_deseos
    $sqlListaDeseos = "DELETE FROM tb_lista_deseos WHERE documento_usuario = ?";
    if ($stmtListaDeseos = $conexion->prepare($sqlListaDeseos)) {
        $stmtListaDeseos->bind_param("i", $id); // Vincula el parámetro
        $stmtListaDeseos->execute(); // Ejecuta la consulta
        $stmtListaDeseos->close(); // Cierra la declaración
    }
    
    // Elimina el usuario de tb_usuarios
    $sqlUsuarios = "DELETE FROM tb_usuarios WHERE documento = ?";
    if ($stmtUsuarios = $conexion->prepare($sqlUsuarios)) {
        $stmtUsuarios->bind_param("i", $id); // Vincula el parámetro
        $stmtUsuarios->execute(); // Ejecuta la consulta
        $stmtUsuarios->close(); // Cierra la declaración
    } else {
        return "Error al preparar la consulta para tb_usuarios: " . $conexion->error; // Retorna un mensaje de error si la preparación falla
    }
    
    // Verifica si la eliminación fue exitosa
    if ($conexion->affected_rows > 0) {
        return true; // El usuario y las entradas relacionadas se eliminaron con éxito
    } else {
        return "No se eliminaron registros o el usuario no existía."; // Mensaje en caso de que no se elimine ningún registro
    }
    
    // Cierra la conexión a la base de datos
    $conexion->close(); // Cierra la conexión
}
    /**
 * Método para obtener un dato específico de un producto en la base de datos.
 * 
 * @param {number} $des Determina qué dato se desea obtener (1-7).
 * @param {number} $idPro Identificador del producto del que se desea obtener el dato.
 * @return {mixed} Retorna el resultado de la consulta a la base de datos.
 */
public static function sqlDatoPro($des, $idPro) {
    // Incluye el archivo de conexión a la base de datos
    include("db_fashion/cb.php");
    
    // Inicializa la variable que almacenará el nombre del dato a consultar
    $dato = 0;
    
    // Asigna el nombre del dato a consultar según el valor de $des
    if ($des == 1) $dato = "nombre_producto"; // 1: nombre del producto
    if ($des == 2) $dato = "precio"; // 2: precio del producto
    if ($des == 3) $dato = "cantidad"; // 3: cantidad del producto
    if ($des == 4) $dato = "detalles"; // 4: detalles del producto
    if ($des == 5) $dato = "color"; // 5: color del producto
    if ($des == 6) $dato = "tallas"; // 6: tallas del producto
    if ($des == 7) $dato = "ruta_img"; // 7: ruta de la imagen del producto
    
    // Prepara la consulta para obtener el dato específico del producto
    $sql = "SELECT $dato FROM tb_productos ";
    $sql .= "WHERE id_producto = '$idPro'"; // Filtra por el identificador del producto
    
    // Ejecuta la consulta y retorna el resultado
    return $resultado = $conexion->query($sql);
    $conexion->close();
}
    /**
 * Método para actualizar la información de un producto en la base de datos.
 * 
 * @param {number} $id_producto Identificador del producto a editar.
 * @param {string} $nombre Nuevo nombre del producto.
 * @param {number} $precio Nuevo precio del producto.
 * @param {number} $cantidad Nueva cantidad del producto.
 * @param {string} $detalles Nuevos detalles del producto.
 * @param {string} $color Nuevo color del producto.
 * @param {string} $tallas Nuevas tallas del producto.
 * @param {string} $imagen Nueva ruta de la imagen del producto.
 * @return {mixed} Retorna el resultado de la consulta a la base de datos.
 */
public static function sqlEditarPro($id_producto, $nombre, $precio, $cantidad, $detalles, $color, $tallas, $imagen) {
    // Incluye el archivo de conexión a la base de datos
    include("db_fashion/cb.php");
    include_once("productos_class.php");
    
    // Prepara la consulta para actualizar los datos del producto
    $sql = "UPDATE tb_productos 
            SET nombre_producto = '$nombre', 
                precio = '$precio', 
                cantidad = '$cantidad', 
                detalles = '$detalles', 
                color = '$color', 
                tallas = '$tallas', 
                ruta_img = '$imagen' 
            WHERE id_producto = '$id_producto'"; // Filtra por el identificador del producto a editar
            
    // Ejecuta la consulta y retorna el resultado
    return $resultado = $conexion->query($sql);
    $conexion->close();
}
/**
 * Método para obtener todos los registros de la tabla que cuenta usuarios eliminados.
 * 
 * @return {mixed} Retorna el resultado de la consulta a la base de datos.
 */
public static function sqlConteoUserEli() {
    // Incluye el archivo de conexión a la base de datos
    include("db_fashion/cb.php");

    // Prepara la consulta para seleccionar todos los registros de la tabla de conteo de usuarios eliminados
    $sql = "SELECT * FROM tb_conteo_user_eli";

    // Ejecuta la consulta y retorna el resultado
    return $resultado = $conexion->query($sql);
    $conexion->close();
}
    /**
 * Método para obtener todos los registros de la tabla que cuenta usuarios registrados.
 * 
 * @return {mixed} Retorna el resultado de la consulta a la base de datos.
 */
public static function sqlConteoUserReg() {
    // Incluye el archivo de conexión a la base de datos
    include("db_fashion/cb.php");

    // Prepara la consulta para seleccionar todos los registros de la tabla de conteo de usuarios registrados
    $sql = "SELECT * FROM tb_conteo_user_reg";

    // Ejecuta la consulta y retorna el resultado
    return $resultado = $conexion->query($sql);
    $conexion->close();
}
    /**
 * Método para obtener todos los registros de la tabla que cuenta usuarios actualizados.
 * 
 * @return {mixed} Retorna el resultado de la consulta a la base de datos.
 */
public static function sqlConteoUserActu() {
    // Incluye el archivo de conexión a la base de datos
    include("db_fashion/cb.php");

    // Prepara la consulta para seleccionar todos los registros de la tabla de conteo de usuarios actualizados
    $sql = "SELECT * FROM tb_conteo_user_actu";

    // Ejecuta la consulta y retorna el resultado
    return $resultado = $conexion->query($sql);
    $conexion->close();
}
    /**
 * Método para obtener todos los registros de la tabla que cuenta productos eliminados.
 * 
 * @return {mixed} Retorna el resultado de la consulta a la base de datos.
 */
public static function sqlConteoProEli() {
    // Incluye el archivo de conexión a la base de datos
    include("db_fashion/cb.php");

    // Prepara la consulta para seleccionar todos los registros de la tabla de conteo de productos eliminados
    $sql = "SELECT * FROM tb_conteo_pro_eli";

    // Ejecuta la consulta y retorna el resultado
    return $resultado = $conexion->query($sql);
    $conexion->close();
}
    /**
 * Método para obtener todos los registros de la tabla que cuenta productos registrados.
 * 
 * @return {mixed} Retorna el resultado de la consulta a la base de datos.
 */
public static function sqlConteoProReg() {
    // Incluye el archivo de conexión a la base de datos
    include("db_fashion/cb.php");

    // Prepara la consulta para seleccionar todos los registros de la tabla de conteo de productos registrados
    $sql = "SELECT * FROM tb_conteo_pro_reg";

    // Ejecuta la consulta y retorna el resultado
    return $resultado = $conexion->query($sql);
    $conexion->close();
}
    /**
 * Método para obtener todos los registros de la tabla que cuenta productos actualizados.
 * 
 * @return {mixed} Retorna el resultado de la consulta a la base de datos.
 */
public static function sqlConteoProActu() {
    // Incluye el archivo de conexión a la base de datos
    include("db_fashion/cb.php");

    // Prepara la consulta para seleccionar todos los registros de la tabla de conteo de productos actualizados
    $sql = "SELECT * FROM tb_conteo_pro_actu";

    // Ejecuta la consulta y retorna el resultado
    return $resultado = $conexion->query($sql);
    $conexion->close();
}
    /**
 * Método para cambiar la contraseña de un usuario en la base de datos.
 * 
 * @param string $nuevaClave La nueva contraseña que se desea establecer.
 * @param int $id El documento del usuario cuya contraseña se va a cambiar.
 * @return {mixed} Retorna el resultado de la consulta a la base de datos.
 */
public static function sqlCambiarClave($nuevaClave, $id) {
    // Incluye el archivo de conexión a la base de datos
    include("db_fashion/cb.php");

    // Prepara la consulta para actualizar la contraseña del usuario especificado por el documento
    $sql = "UPDATE tb_usuarios SET contraseña = '$nuevaClave' ";
    $sql .= "WHERE documento = '$id'";

    // Ejecuta la consulta y retorna el resultado
    return $resultado = $conexion->query($sql);
    $conexion->close();
}
    /**
 * Método para cambiar la contraseña de un usuario en la base de datos, encriptándola antes de almacenarla.
 * 
 * @param string $nuevaClave La nueva contraseña que se desea establecer.
 * @param int $id El documento del usuario cuya contraseña se va a cambiar.
 * @return {mixed} Retorna el resultado de la consulta a la base de datos.
 */
public static function sqlCambiarClaveEncrip($nuevaClave, $id) {
    // Incluye el archivo de conexión a la base de datos
    include("db_fashion/cb.php");

    // Configuración para password_hash (el tercer parámetro es ignorado para PASSWORD_DEFAULT)
    $cont = [
        "cost" => 12
    ];

    // Encriptar la contraseña usando password_hash
    $contraEncrip = password_hash($nuevaClave, PASSWORD_DEFAULT, $cont);

    // Prepara la consulta para actualizar la contraseña encriptada del usuario especificado por el documento
    $sql = "UPDATE tb_usuarios SET contraseña = '$contraEncrip' ";
    $sql .= "WHERE documento = '$id'";

    // Ejecuta la consulta y retorna el resultado
    return $resultado = $conexion->query($sql);
    $conexion->close();
}
   /**
 * Método para actualizar el rol de un usuario en la base de datos.
 *
 * @param int $idUser El documento del usuario cuyo rol se va a actualizar.
 * @param string $rol El nuevo rol que se desea asignar al usuario.
 * @return mixed Retorna el resultado de la consulta a la base de datos.
 */
public static function sqlActuRol($idUser, $rol) {
    // Incluye el archivo de conexión a la base de datos
    include("db_fashion/cb.php");

    // Prepara la consulta para actualizar el rol del usuario especificado por el documento
    $sql = "UPDATE tb_usuarios SET rol = '$rol' ";
    $sql .= "WHERE documento = '$idUser'";

    // Muestra la consulta para depuración (puede ser removido en producción)
    echo $sql;

    // Ejecuta la consulta y retorna el resultado
    return $resultado = $conexion->query($sql);
    $conexion->close();
}
    /**
 * Método para actualizar la información de un usuario en la base de datos.
 *
 * @param int $idUser El documento del usuario cuya información se va a actualizar.
 * @param string $nombre El nuevo nombre del usuario.
 * @param string $apellido El nuevo apellido del usuario.
 * @param string $correo El nuevo correo electrónico del usuario.
 * @return mixed Retorna el resultado de la consulta a la base de datos.
 */
public static function sqlActualizarUser($idUser, $nombre, $apellido, $correo) {
    // Incluye el archivo de conexión a la base de datos
    include("db_fashion/cb.php");

    // Prepara la consulta para actualizar el nombre, apellido y correo del usuario especificado por el documento
    $sql = "UPDATE tb_usuarios SET nombre = '$nombre', apellido = '$apellido', correo = '$correo' ";
    $sql .= "WHERE documento = '$idUser'";

    // Ejecuta la consulta y retorna el resultado
    return $consulta = $conexion->query($sql);
    $conexion->close();
}
    /**
 * Método para verificar si la contraseña proporcionada coincide con la registrada en la base de datos para un usuario específico.
 *
 * @param string $contraseñaN La contraseña que se desea verificar.
 * @param int $doc El documento del usuario cuyo registro se está verificando.
 * @return mixed Retorna el resultado de la consulta a la base de datos.
 */
public static function verficaClave($contraseñaN, $doc) {
    // Incluye el archivo de conexión a la base de datos
    include("db_fashion/cb.php");

    // Prepara la consulta para contar el número de coincidencias de la contraseña y el documento del usuario
    $sql = "SELECT COUNT(*) FROM tb_usuarios ";
    $sql .= "WHERE contraseña = '$contraseñaN' AND documento = '$doc'";

    // Ejecuta la consulta y retorna el resultado
    return $resultado = $conexion->query($sql);
    $conexion->close();
}
    /**
 * Método para buscar un usuario en la base de datos a través de su correo electrónico.
 *
 * @param string $email El correo electrónico del usuario que se desea buscar.
 * @return mixed Retorna el resultado de la consulta a la base de datos, que puede incluir
 *               los detalles del usuario si se encuentra una coincidencia.
 */
public static function sqlBuscarId($email) {
    // Incluye el archivo de conexión a la base de datos
    include("db_fashion/cb.php");

    // Prepara la consulta para seleccionar todos los detalles del usuario cuyo correo coincide
    $sql = "SELECT * FROM tb_usuarios ";
    $sql .= "WHERE correo = '$email'";

    // Ejecuta la consulta y retorna el resultado
    return $resultado = $conexion->query($sql);
    $conexion->close();
}
/**
 * Método para buscar un usuario en la base de datos basado en diferentes criterios.
 *
 * @param int $des Indica el criterio de búsqueda: 
 *                  1 para buscar por documento, 
 *                  2 para buscar por nombre, 
 *                  3 para buscar por correo.
 * @param string $busqueda El valor que se busca según el criterio especificado.
 * @return mixed Retorna el resultado de la consulta a la base de datos.
 */
public static function sqlBuscarUser($des, $busqueda) {
    // Incluye el archivo de conexión a la base de datos
    include("db_fashion/cb.php");

    // Determina el campo de búsqueda basado en el parámetro $des
    if ($des == 1) $dato = "documento";
    if ($des == 2) $dato = "nombre";
    if ($des == 3) $dato = "correo";

    // Prepara la consulta
    $sql = "SELECT * FROM tb_usuarios WHERE $dato = '$busqueda'";
    echo $sql; // Imprime la consulta para depuración (puede eliminarse en producción)

    // Ejecuta la consulta y retorna el resultado
    return $resultado = $conexion->query($sql);
    $conexion->close();
}
    /**
 * Método para buscar datos de un usuario específico.
 * 
 * @param int $des Descripción del dato a buscar (1: nombre, 2: apellido, 3: correo, 4: fecha).
 * @param int $id Identificación del usuario cuyo dato se desea obtener.
 * @return string Devuelve el dato solicitado del usuario o una cadena vacía si no se encuentra.
 */
public static function buscarDatosUser($des, $id) {
    include("db_fashion/cb.php");
    $salida = "";
    $dato = ""; // Define la variable $dato

    if ($des == 1) $dato = "nombre";
    if ($des == 2) $dato = "apellido";
    if ($des == 3) $dato = "correo";
    if ($des == 4) $dato = "fecha";

    $sql = "SELECT $dato FROM tb_usuarios WHERE documento = '$id'";
    $resultado = $conexion->query($sql);

    while ($fila = $resultado->fetch_array()) {
        $salida = $fila[0];
    }
    return $salida;
    $conexion->close();
}
    /**
 * Método para mostrar información de un usuario o lista de usuarios.
 * 
 * @param string|null $buscaUser Cadena parcial o completa para buscar por documento del usuario. Si es null, busca todos los usuarios.
 * @return mysqli_result Devuelve el resultado de la consulta de usuarios coincidentes.
 */
public static function sqlMostrarUser($buscaUser = null) { 
    include("db_fashion/cb.php");
    $sql = "select * from tb_usuarios ";
    $sql .= "where documento like '%$buscaUser'";
    return $resultado = $conexion->query($sql);
    $conexion->close();
}
    /**
 * Método para mostrar un dato específico de un usuario según el tipo de dato solicitado.
 * 
 * @param int $des Número que representa el dato que se desea obtener (1: nombre, 2: apellido, 3: correo, 4: contraseña, 5: fecha, 6: rol).
 * @param int $idUser Documento del usuario del cual se obtendrá el dato.
 * @return mysqli_result Devuelve el resultado de la consulta con el dato solicitado.
 */
public static function sqlMostrarDaUser($des, $idUser) {
    include("db_fashion/cb.php");
    $dato = 0;
    
    if ($des == 1) $dato = "nombre";
    if ($des == 2) $dato = "apellido";
    if ($des == 3) $dato = "correo";
    if ($des == 4) $dato = "contraseña";
    if ($des == 5) $dato = "fecha";
    if ($des == 6) $dato = "rol";
    
    $sql = "select $dato from tb_usuarios ";
    $sql .= "WHERE documento = $idUser";
    return $resultado = $conexion->query($sql);
    $conexion->close();
}
    /**
 * Método para verificar si un usuario ha dado 'like' a un producto específico.
 * 
 * @param int $usuario_id ID del usuario que se desea verificar.
 * @param int $producto_id ID del producto que se desea verificar.
 * @return mysqli_result Devuelve el resultado de la consulta, que contiene el conteo de 'likes' para ese producto por ese usuario.
 */
public static function sqlVerificLike($usuario_id, $producto_id) {
    // Incluir el archivo de conexión
    include("db_fashion/cb.php"); // Asegúrate de que `$conexion` esté definido en `cb.php`

    // Consulta para verificar el like para un producto específico
    $sql = "SELECT COUNT(*) as count FROM tb_likes WHERE usuario_id = '$usuario_id' AND producto_id = '$producto_id'";
    return $conexion->query($sql);
    $conexion->close();
}    
/**
 * Método para agregar o eliminar un 'like' de un usuario a un producto.
 * 
 * @param int $usuario_id ID del usuario que está interactuando con el producto.
 * @param int $producto_id ID del producto al cual el usuario desea dar o quitar 'like'.
 * @return mysqli_result Devuelve el resultado de la consulta para agregar o eliminar el 'like'.
 */
public static function sqlAgregarLike($usuario_id, $producto_id) {
    // Incluir el archivo de conexión
    include("db_fashion/cb.php"); // Asegúrate de que `$conexion` esté definido en `cb.php`
    include_once("productos_class.php");

    // Verificar si el like ya existe para ese producto
    $likeExists = Productos::verificLike($usuario_id, $producto_id);

    if ($likeExists == 1) {
        // Eliminar el like si ya existe
        $operacion = "DELETE FROM tb_likes WHERE usuario_id = '$usuario_id' AND producto_id = '$producto_id'";
    } else {
        // Insertar un nuevo like
        $operacion = "INSERT INTO tb_likes (producto_id, usuario_id, valor) VALUES ('$producto_id', '$usuario_id', 'like')";
    }

    // Ejecutar la operación y devolver el resultado
    return $conexion->query($operacion);
    $conexion->close();
}
    /**
 * Método para actualizar la foto de perfil de un usuario en la base de datos.
 * 
 * @param string $foto Ruta o nombre del archivo de la nueva foto que se subirá.
 * @param int $id_user ID del usuario cuyo perfil será actualizado.
 * @return bool Devuelve `true` si la actualización fue exitosa, o `false` si ocurrió un error.
 */
public static function sqlActuFoto($foto, $id_user) {
    // Incluir el archivo de conexión a la base de datos
    include("db_fashion/cb.php");

    // Consulta SQL para actualizar la foto del usuario
    $sql = "UPDATE tb_usuarios SET foto = '$foto' WHERE documento = '$id_user'";

    // Ejecutar la consulta y verificar si fue exitosa
    if ($conexion->query($sql) === TRUE) {
        return true;
    } else {
        // Mostrar el error si la consulta falló
        echo "Error en la consulta SQL: " . $conexion->error;
        return false;
    }
    $conexion->close();
}
    /**
 * Método para obtener todas las categorías de productos desde la base de datos.
 * 
 * @return mixed Devuelve el resultado de la consulta SQL si se encuentran categorías, o `null` si no hay categorías disponibles.
 */
public static function obtenerCategoriasUser() {
    // Incluir el archivo de conexión a la base de datos
    include("db_fashion/cb.php"); 

    // Consulta SQL para seleccionar todas las categorías
    $sql = "SELECT * FROM tb_categoria";

    // Ejecutar la consulta
    $result = $conexion->query($sql);

    // Verificar si hay resultados y si el número de filas es mayor a 0
    if ($result && $result->num_rows > 0) {
        return $result; // Devuelve el resultado de la consulta
    } else {
        return null; // No hay categorías encontradas
    }
    $conexion->close();
}
/**
 * Método para obtener los productos asociados a una categoría específica.
 * 
 * @param int $id_categoria El ID de la categoría cuyos productos se desean obtener.
 * @return mixed Devuelve el resultado de la consulta SQL con los productos, o `false` si ocurre un error en la consulta.
 */
public static function obtenerProductosPorCategoria($id_categoria) {
    // Incluir el archivo de conexión a la base de datos
    include("db_fashion/cb.php"); 

    // Consulta SQL para seleccionar los productos que pertenecen a una categoría específica
    $sql = "SELECT * FROM tb_productos WHERE id_categoria = $id_categoria";

    // Ejecutar la consulta y devolver el resultado
    return $resultado = $conexion->query($sql);
    $conexion->close();
}
    /**
 * Método para obtener todos los productos que han sido marcados como favoritos.
 * 
 * @return mixed Devuelve el resultado de la consulta SQL con los productos favoritos.
 */
public static function sqlVerFavoritos() {
    // Incluir el archivo de conexión a la base de datos
    include 'db_fashion/cb.php';

    // Consulta SQL para obtener todos los favoritos
    $sql = "SELECT * FROM tb_favoritos";

    // Ejecutar la consulta y devolver el resultado
    return $consulta = $conexion->query($sql);
    $conexion->close();
}
    /**
 * Método para obtener todos los productos en el carrito de compras.
 * 
 * @return mixed Devuelve el resultado de la consulta SQL con los productos del carrito.
 */
public static function sqlverCarrito() {
    // Incluir el archivo de conexión a la base de datos
    include 'db_fashion/cb.php';

    // Consulta SQL para obtener todos los productos del carrito
    $sql = "SELECT * FROM tb_carrito";

    // Ejecutar la consulta y devolver el resultado
    return $consulta = $conexion->query($sql);
    $conexion->close();
}
    /**
 * Método para agregar un producto a la lista de deseos de un usuario.
 * 
 * @param string $documento_usuario El documento del usuario que realiza la acción.
 * @param string $nombre_deseo El nombre del producto que se desea agregar.
 * @param string $foto_referencia La referencia de la foto del producto.
 * 
 * @return mixed Devuelve el resultado de la consulta a la base de datos.
 */
public static function agregarDeseo($documento_usuario, $nombre_deseo, $foto_referencia) {
    // Incluye la conexión a la base de datos
    include("db_fashion/cb.php"); 
    
    // Consulta SQL para insertar el producto en la lista de deseos
    $sql = "INSERT INTO tb_lista_deseos (documento_usuario, nombre_producto, foto_referencia) 
            VALUES ('$documento_usuario', '$nombre_deseo', '$foto_referencia')";
    
    // Ejecutar la consulta y devolver el resultado
    return $resultado = $conexion->query($sql);
    $conexion->close();
}
    /**
 * Método para obtener la lista de deseos de un usuario específico.
 * 
 * @param string $documento_usuario El documento del usuario cuyos deseos se desean obtener.
 * 
 * @return mixed Devuelve el resultado de la consulta a la base de datos.
 */
public static function obtenerDeseosUsuario($documento_usuario) {
    // Incluye la conexión a la base de datos
    include("db_fashion/cb.php");
    
    // Consulta SQL para seleccionar los deseos del usuario
    $sql = "SELECT * FROM tb_lista_deseos WHERE documento_usuario = '$documento_usuario'";
    
    // Ejecutar la consulta y devolver el resultado
    return $resultado = $conexion->query($sql);
    $conexion->close();
}
/**
 * Método para obtener todos los deseos junto con la foto del usuario que los creó.
 * 
 * @return mixed Devuelve el resultado de la consulta a la base de datos, que incluye deseos y fotos de usuarios.
 */
public static function sqlTodosDeseosConUsuario() {
    // Incluye la conexión a la base de datos
    include("db_fashion/cb.php");
    
    // Consulta SQL para seleccionar deseos y la foto del usuario correspondiente
    $sql = "SELECT d.*, u.foto 
            FROM tb_lista_deseos d
            JOIN tb_usuarios u ON d.documento_usuario = u.documento";
    
    // Retorna el resultado de la consulta
    return $conexion->query($sql);  
    $conexion->close();
}
/**
 * Método para eliminar un deseo de la lista de deseos del usuario.
 * 
 * @param string $id_deseo ID del deseo a eliminar.
 * @return bool Devuelve true si la eliminación fue exitosa, de lo contrario devuelve false.
 */
public static function eliminarDeseo($id_deseo) {
    // Incluye la conexión a la base de datos
    include("db_fashion/cb.php");

    // Consulta SQL para eliminar el deseo especificado
    $sql = "DELETE FROM tb_lista_deseos WHERE id_deseo = '$id_deseo'";
    
    // Ejecuta la consulta
    $resultado = mysqli_query($conexion, $sql);
    
    // Mensaje de éxito o error
    if ($resultado) {
        echo "Deseo eliminado correctamente.";
    } else {
        echo "Error al eliminar el deseo: " . mysqli_error($conexion);
    }
    
    // Retorna el resultado de la operación
    return $resultado;
    $conexion->close();
}
/**
 * Método para agregar un producto a la lista de favoritos de un usuario.
 * 
 * @param string $documentoUsuario Documento del usuario que agrega el producto.
 * @param int $idProducto ID del producto a agregar a favoritos.
 * @param string $nombreProducto Nombre del producto a agregar a favoritos.
 * @return int Devuelve 1 si el producto fue agregado correctamente, 
 *             2 si ya está en favoritos y 0 si hubo un error.
 */
public static function sqlAgregarAFavoritos($documentoUsuario, $idProducto, $nombreProducto) {
    // Incluye la conexión a la base de datos
    include("db_fashion/cb.php");

    // Verificar si el producto ya está en la lista de favoritos del usuario
    $sqlVerificar = "SELECT * FROM tb_favoritos WHERE documento_usuario = '$documentoUsuario' AND id_pro = '$idProducto'";
    $resultadoVerificacion = $conexion->query($sqlVerificar);

    // Si el producto ya está en favoritos, devolver un valor específico
    if ($resultadoVerificacion->num_rows > 0) {
        return 2; // El producto ya está en favoritos
    } else {
        // Si no está, proceder a agregarlo
        $sqlAgregar = "INSERT INTO tb_favoritos (documento_usuario, id_pro, nombre_produc) 
                        VALUES ('$documentoUsuario', '$idProducto', '$nombreProducto')";
        return $conexion->query($sqlAgregar) ? 1 : 0; // 1 si fue agregado, 0 si hubo un error
    }
    $conexion->close();
}
/**
 * Método para mostrar los productos favoritos de un usuario.
 * 
 * @param string $documentoUsuario Documento del usuario cuyas preferencias se quieren mostrar.
 * @return mysqli_result Resultado de la consulta que contiene los productos favoritos y sus detalles.
 */
public static function sqlMostrarFavoritos($documentoUsuario) {
    // Incluye la conexión a la base de datos
    include("db_fashion/cb.php");

    // Consulta para obtener los productos favoritos junto con su precio e imagen
    $sql = "SELECT f.*, p.precio, p.ruta_img 
            FROM tb_favoritos f 
            JOIN tb_productos p ON f.id_pro = p.id_producto 
            WHERE f.documento_usuario = '$documentoUsuario'";
    
    return $resultado = $conexion->query($sql); // Retorna el resultado de la consulta
    $conexion->close();
}
/**
 * Método para eliminar un producto de la lista de favoritos de un usuario.
 * 
 * @param string $id_favo ID del favorito que se desea eliminar.
 * @return bool Resultado de la operación de eliminación; devuelve true si se eliminó correctamente, false en caso contrario.
 */
public static function sqlEliminarFavo($id_favo) {
    // Incluye la conexión a la base de datos
    include("db_fashion/cb.php");
    
    // Consulta para eliminar un favorito específico
    $sql = "DELETE FROM tb_favoritos WHERE id_favo = '$id_favo'";
    
    return $resultado = $conexion->query($sql); // Retorna el resultado de la operación
    $conexion->close();
}
/**
 * Método para mostrar todos los comentarios junto con la información del usuario que los publicó.
 * 
 * @return object|bool Resultado de la consulta; devuelve un objeto con los comentarios y datos del usuario, o false en caso de error.
 */
public static function sqlMostrarComentarios() {
    // Incluye la conexión a la base de datos
    include("db_fashion/cb.php");
    
    // Consulta para obtener los comentarios y la información del usuario
    $sql = "SELECT c.*, u.nombre AS nombre_usuario, u.foto 
            FROM tb_comentarios c
            JOIN tb_usuarios u ON c.documento_usuario = u.documento
            ORDER BY c.fecha_publicacion DESC";
    
    return $conexion->query($sql); // Retorna el resultado de la consulta
    $conexion->close();
}
/**
 * Método para mostrar todas las respuestas a un comentario específico junto con la información del usuario que las publicó.
 * 
 * @param int $idComentario ID del comentario para el cual se desean obtener las respuestas.
 * @return object|bool Resultado de la consulta; devuelve un objeto con las respuestas y datos del usuario, o false en caso de error.
 */
public static function sqlMostrarRespuestas($idComentario) {
    // Incluye la conexión a la base de datos
    include("db_fashion/cb.php");
    
    // Consulta para obtener las respuestas a un comentario específico y la información del usuario
    $sql = "SELECT r.*, u.nombre AS nombre_usuario, u.foto 
            FROM tb_respuestas r
            JOIN tb_usuarios u ON r.documento_usuario = u.documento
            WHERE r.id_comentario = '$idComentario'
            ORDER BY r.fecha_publicacion ASC";
    
    return $conexion->query($sql); // Retorna el resultado de la consulta
    $conexion->close();
}
/**
 * Método para insertar un nuevo comentario en la base de datos.
 * 
 * @param string $documentoUsuario El documento del usuario que está haciendo el comentario.
 * @param string $mensaje El mensaje del comentario.
 * @return bool Resultado de la consulta; devuelve true si se inserta correctamente, o false en caso de error.
 */
public static function sqlAgregarComentario($documentoUsuario, $mensaje) {
    // Incluye la conexión a la base de datos
    include("db_fashion/cb.php");
    
    // Consulta para insertar un nuevo comentario en la tabla tb_comentarios
    $sql = "INSERT INTO tb_comentarios (documento_usuario, mensaje) 
            VALUES ('$documentoUsuario', '$mensaje')";
    
    // Ejecuta la consulta y devuelve el resultado
    return $conexion->query($sql);
    $conexion->close();
}
/**
 * Método para insertar una nueva respuesta a un comentario en la base de datos.
 * 
 * @param string $documentoUsuario El documento del usuario que está respondiendo.
 * @param string $mensaje El mensaje de la respuesta.
 * @param int $idComentario El ID del comentario al que se está respondiendo.
 * @return bool Resultado de la consulta; devuelve true si se inserta correctamente, o false en caso de error.
 */
public static function sqlAgregarRespuesta($documentoUsuario, $mensaje, $idComentario) {
    // Incluye la conexión a la base de datos
    include("db_fashion/cb.php");
    
    // Consulta para insertar una nueva respuesta en la tabla tb_respuestas
    $sql = "INSERT INTO tb_respuestas (documento_usuario, mensaje, id_comentario) 
            VALUES ('$documentoUsuario', '$mensaje', '$idComentario')";
    
    // Ejecuta la consulta y devuelve el resultado
    return $conexion->query($sql);
    $conexion->close();
}
/**
 * Método para eliminar un comentario de la base de datos.
 * 
 * @param int $idComentario El ID del comentario que se desea eliminar.
 * @return bool true si la eliminación fue exitosa, false si hubo un error.
 */
public static function sqlEliminarComentario($idComentario) {
    // Incluye la conexión a la base de datos
    include("db_fashion/cb.php");
    
    // Consulta para eliminar el comentario de la tabla tb_comentarios
    $sql = "DELETE FROM tb_comentarios WHERE id_comentario = '$idComentario'";
    
    // Ejecuta la consulta y devuelve true si fue exitosa, o false en caso contrario
    if ($conexion->query($sql)) {
        return true;  // Eliminación exitosa
    } else {
        return false;  // Fallo en la eliminación
    }
    $conexion->close();
}
/**
 * Método para eliminar una respuesta de la base de datos.
 * 
 * @param int $idRespuesta El ID de la respuesta que se desea eliminar.
 * @return bool true si la eliminación fue exitosa, false si hubo un error.
 */
public static function sqlEliminarRespuesta($idRespuesta) {
    // Incluye la conexión a la base de datos
    include("db_fashion/cb.php");
    
    // Consulta para eliminar la respuesta de la tabla tb_respuestas
    $sql = "DELETE FROM tb_respuestas WHERE id_respuesta = '$idRespuesta'";
    
    // Ejecuta la consulta y devuelve true si fue exitosa, o false en caso contrario
    if ($conexion->query($sql)) {
        return true;  // Eliminación exitosa
    } else {
        return false;  // Fallo en la eliminación
    }
    $conexion->close();
}
/**
 * Método para obtener las compras realizadas por un usuario específico.
 *
 * @param int $id_usuario El ID del usuario cuyas compras se desean consultar.
 * @return array Un array con los detalles de los productos comprados. Retorna un array vacío si no hay compras.
 */
public static function sqlComprasUsuario($id_usuario) {
    // Incluir la conexión a la base de datos
    include("db_fashion/cb.php");
    
    // Consulta SQL para obtener los detalles de los productos comprados por el usuario
    $sql = "
        SELECT df.cantidad, df.precio_unitario, df.subtotal, p.id_producto, p.nombre_producto, p.ruta_img 
        FROM tb_detalle_factura df
        JOIN tb_productos p ON df.id_producto = p.id_producto
        JOIN tb_facturas f ON df.id_factura = f.id_factura
        WHERE f.documento_usuario = '$id_usuario'
    ";

    // Ejecutar la consulta
    $resultado = $conexion->query($sql);
    
    // Comprobar si hay resultados
    if ($resultado && $resultado->num_rows > 0) {
        $productos = []; // Inicializa un array para almacenar los productos
        
        // Extraer datos de cada fila de resultados
        while ($row = $resultado->fetch_assoc()) {
            $productos[] = $row; // Agregar cada fila al array de productos
        }

        return $productos; // Retorna el array de productos
    } else {
        return []; // Retorna un array vacío si no hay productos
    }
    $conexion->close();
}
/**
 * Método para verificar si un usuario es el autor de una respuesta específica.
 *
 * @param int $id_user El ID del usuario que se desea verificar.
 * @param int $id_respuesta El ID de la respuesta que se quiere verificar.
 * @return bool Retorna true si el usuario es el autor de la respuesta, false en caso contrario.
 */
public static function verifiRespuestas($id_user, $id_respuesta) {
    include("db_fashion/cb.php");  // Incluimos la conexión a la base de datos
    
    // Consulta SQL para verificar si el usuario es el autor de la respuesta específica
    $sql = "SELECT COUNT(*) as es_autor FROM tb_respuestas WHERE documento_usuario = '$id_user' AND id_respuesta = '$id_respuesta'";
    
    // Ejecutamos la consulta
    $resultado = $conexion->query($sql);

    // Verificamos si obtuvimos algún resultado
    if ($resultado) {
        $row = $resultado->fetch_assoc();  // Obtenemos la fila de resultados
        
        // Verificamos si el usuario es el autor
        return $row['es_autor'] > 0;  // Retorna true si es autor, false en caso contrario
    } else {
        return false;  // En caso de error, retornamos false
    }
    $conexion->close();
}
/**
 * Método para verificar si un usuario es el autor de un comentario específico.
 *
 * @param int $id_user El ID del usuario que se desea verificar.
 * @param int $id_comentario El ID del comentario que se quiere verificar.
 * @return bool Retorna true si el usuario es el autor del comentario, false en caso contrario.
 */
public static function verifiComentarios($id_user, $id_comentario) {
    include("db_fashion/cb.php");  // Incluimos la conexión a la base de datos
    
    // Consulta SQL para verificar si el usuario es el autor del comentario específico
    $sql = "SELECT COUNT(*) as es_autor FROM tb_comentarios WHERE documento_usuario = '$id_user' AND id_comentario = '$id_comentario'";
    
    // Ejecutamos la consulta
    $resultado = $conexion->query($sql);

    // Verificamos si obtuvimos algún resultado
    if ($resultado) {
        $row = $resultado->fetch_assoc();  // Obtenemos la fila de resultados
        
        // Verificamos si el usuario es el autor
        return $row['es_autor'] > 0;  // Retorna true si es autor, false en caso contrario
    } else {
        return false;  // En caso de error, retornamos false
    }
    $conexion->close();
} 

}