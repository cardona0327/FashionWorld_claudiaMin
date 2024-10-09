<?php
class Productos{

    /**
 * Método para mostrar productos en una interfaz de usuario.
 *
 * @param string|null $buscar Texto opcional para buscar productos específicos.
 * @return string Retorna la salida HTML generada con los productos.
 */
public static function mostrarPro($buscar = null) {
    include_once("controler_login.php");  // Incluir control de sesión y roles
    include_once("modelo.php");  // Incluir el modelo para manejar las consultas de productos

    $salida = "";  // Inicializamos la variable para la salida HTML
    $salida .= '<div class="productos-container">';  // Iniciamos el contenedor de productos

    // Llamar al método del modelo para obtener productos según la búsqueda
    $consulta = Modelo::sqlMostrarPro($buscar);

    // Verificamos si hay resultados
    if ($consulta->num_rows > 0) {
        // Iteramos sobre los resultados
        while ($fila = $consulta->fetch_assoc()) {
            $salida .= '<div class="producto">';  // Contenedor para cada producto

            // Verificamos si el usuario tiene rol de administrador (rol 0)
            if (Loguin::verRol($_SESSION['id']) == 0 || Loguin::verRol($_SESSION['id']) == 1) {
                $salida .= "<span class='producto-id'>ID: " . $fila['id_producto'] . "</span>";  // Mostramos el ID del producto solo para administradores
            }

            // Mostrar los detalles del producto
            $salida .= "<h3 class='producto-nombre'>" . $fila['nombre_producto'] . "</h3>";
            $salida .= "<p class='producto-precio'>Precio: $" . number_format($fila['precio'], 2) . "</p>";
            $salida .= "<p class='producto-cantidad'>Cantidad: " . $fila['cantidad'] . "</p>";
            $salida .= "<p class='producto-detalles'>" . $fila['detalles'] . "</p>";

            // Verificamos si el producto tiene una imagen asociada
            if (!empty($fila['ruta_img'])) {
                $rutaImagen = "../img/" . $fila['ruta_img'];  // Ruta de la imagen
                // Verificamos que el archivo de imagen existe
                if (file_exists($rutaImagen)) {
                    $salida .= '<div class="imagen-container"><img src="' . $rutaImagen . '" alt="' . $fila['nombre_producto'] . '" class="producto-imagen"></div>';
                } else {
                    $salida .= "<p class='sin-imagen'>Imagen no disponible</p>";
                }
            } else {
                $salida .= "<p class='sin-imagen'>Imagen no disponible</p>";  // Mensaje en caso de no haber imagen
            }

            // Mostrar la cantidad de 'likes' que tiene el producto
            $idPro = $fila['id_producto'];
            $likeCantidad = Modelo::sqlConteoLikes($idPro);  // Contar los 'likes' del producto
            $salida .= "<p><strong class='likes-count' data-id_producto='" . $fila['id_producto'] . "'> Likes: " . $likeCantidad . "</strong></p>";

            $salida .= "<div class='producto-acciones'>";  // Contenedor para acciones (editar, 'like')

            // Verificamos si el usuario es administrador para mostrar opción de editar
            if (Loguin::verRol($_SESSION['id']) == 0 || Loguin::verRol($_SESSION['id']) == 1) {
                $salida .= "<a href='ctroBar.php?dato=" . $fila['id_producto'] . "&seccion=editarPro' class='btn btn-editar'>Editar</a>";
            }
        
            // Verificamos si el producto ha sido 'likeado' por el usuario
            $likeClass = self::verificLike($_SESSION['id'], $fila['id_producto']) ? 'fas fa-heart liked' : 'far fa-heart';
            $salida .= "<i class='$likeClass' data-id_producto='" . $fila['id_producto'] . "' onclick='likear(this)'></i>";  // Icono de 'like'

            $salida .= '</div>';  // Cierre del div .producto-acciones
            $salida .= '</div>';  // Cierre del div .producto
        }
    } else {
        $salida .= "<p>No se encontraron productos.</p>";  // Mensaje en caso de no haber productos
    }

    $salida .= '</div>';  // Cierre del div .productos-container

    return $salida;  // Retornamos la salida HTML generada
}

    
    

    


    /**
 * Método para mostrar las categorías disponibles en la interfaz de usuario.
 *
 * @return string Retorna la salida HTML generada con las categorías.
 */
public static function mostrarCate() {
    include_once("modelo.php");  // Incluir el modelo para manejar las consultas de categorías
    $salida = "";  // Inicializamos la variable para la salida HTML
    $consulta = Modelo::sqlVerCate();  // Llamamos al método del modelo que obtiene las categorías

    // Verificamos si hay resultados en la consulta
    if ($consulta->num_rows > 0) {
        // Iteramos sobre los resultados con un ciclo while
        while ($fila = $consulta->fetch_assoc()) {
            // Creamos un contenedor para cada categoría, posicionando los elementos de forma relativa
            $salida .=  "<div class='categoria-item' style='position: relative;'>";
            // Mostramos el ID de la categoría
            $salida .=  "<div class='categoria-id'>" . $fila['id_categoria'] . "</div>";
            // Mostramos el título o nombre de la categoría
            $salida .=  "<div class='categoria-titulo'>" . $fila['categoria'] . "</div>";
            // Enlace para editar la categoría, disponible para cada una
            $salida .=  "<a href='ctroBar.php?seccion=editarCate&dato=" .$fila['id_categoria']."' class='editar-btn top-left'>Editar</a>";
            $salida .=  "</div>";  // Cierre del contenedor de categoría
        }
    } else {
        // Si no hay resultados, mostramos un mensaje indicando que no se encontraron categorías
        $salida .=  "No se encontraron categorías.";
    }

    // Retornamos la salida HTML generada
    return $salida;

    
}
    // public static function buscarPro($nombre){
    //     include_once("modelo.php");
    //     $consulta = Modelo::sqlBuscarPro($nombre);
    //     return $consulta;
    // }
    /**
 * Método para eliminar un producto de la base de datos.
 *
 * @param int $id ID del producto a eliminar.
 * @return int Retorna 1 si la eliminación fue exitosa, 0 si falló.
 */
public static function eliminarPro($id) {
    $salida = 0;  // Inicializamos la variable de salida como 0 (fallo por defecto)
    include_once("modelo.php");  // Incluir el modelo donde está la consulta de eliminación
    
    // Llamamos a la función del modelo para eliminar el producto por su ID
    $consulta = Modelo::sqlEliminarPro($id);
    
    // Verificamos si la consulta de eliminación fue exitosa
    if ($consulta) {
        $salida = 1;  // Si la consulta fue exitosa, asignamos 1 (éxito) a la salida
    } else {
        $salida = 0;  // Si falló, la salida sigue siendo 0 (fallo)
    }
    
    return $salida;  // Retornamos el resultado de la operación: 1 si fue exitoso, 0 si falló
}
    /**
 * Método para eliminar una categoría
 * 
 * @param id {number} identificador de la categoría que se va a eliminar
 * @return salida {number} retorna 1 si la categoría fue eliminada exitosamente, o 0 si no lo fue
 */
public static function eliminarCate($id){
    $salida = 0;
    include_once("modelo.php");  // Incluye el modelo donde se encuentra la lógica de eliminación
    
    // Llama a la función para eliminar la categoría en la base de datos
    $consulta = Modelo::sqlEliminarCate($id);
    
    // Si la eliminación fue exitosa, cambia la salida a 1
    if($consulta){
        $salida = 1;
    } else {
        $salida = 0;
    }
    
    return $salida;  // Retorna el resultado de la operación
}
 /**
 * Método para agregar un nuevo producto
 * 
 * @param id_pro {number} identificador único del producto
 * @param nombre {texto} nombre del producto
 * @param precio {number} precio del producto
 * @param cantidad {number} cantidad disponible del producto
 * @param descripcion {texto} descripción detallada del producto
 * @param color {texto} color del producto
 * @param tallas {texto} tallas disponibles del producto
 * @param imagen {texto} nombre o ruta de la imagen del producto
 * @param id_categoria {number} identificador de la categoría a la que pertenece el producto
 * @return salida {number} retorna 1 si el producto fue agregado exitosamente, o 0 si hubo algún problema
 */
public static function agregarPro($nombre, $precio, $cantidad, $descripcion, $color, $tallas, $imagen, $id_categoria){
    include_once("modelo.php");  // Incluye el modelo para acceder a la lógica de base de datos
    $salida = 0;
    
    // Llama a la función que inserta el nuevo producto en la base de datos
    $consulta = Modelo::sqlAgregarPro($nombre, $precio, $cantidad, $descripcion, $color, $tallas, $imagen, $id_categoria);
    
    // Si la inserción fue exitosa, cambia la salida a 1
    if($consulta){ 
        $salida = 1;
    }
    
    return $salida;  // Retorna el resultado de la operación
}
/**
 * Método para agregar una nueva categoría
 * 
 * @param id_categoria {number} identificador único de la categoría
 * @param categoria {texto} nombre de la categoría
 * @return void redirige a la página de categorías si la operación fue exitosa
 */
public static function agregarCate($id_categoria, $categoria){
    include_once("modelo.php");  // Incluye el modelo para acceder a la lógica de base de datos

    // Llama a la función que inserta la nueva categoría en la base de datos
    $consulta = Modelo::sqlAgregarCate($id_categoria, $categoria);
    
    // Si la categoría se agregó correctamente, redirige a la página de ver categorías
    if($consulta){
        header("location:ctroBar.php?seccion=verCate");
    }
}

    /**
 * Método para editar el nombre de una categoría en la base de datos
 * 
 * @param des {texto} nueva descripción o nombre para la categoría
 * @param categoria {texto} nombre actual de la categoría a editar
 * @return salida {texto} el resultado de la operación, normalmente el nuevo nombre de la categoría
 */
public static function editarCate($des, $categoria){
    include_once("modelo.php");  // Incluye el modelo para acceder a la lógica de base de datos
    $salida = "";  // Variable para almacenar el resultado

    // Ejecuta la consulta para editar la categoría
    $consulta = Modelo::sqlCategorias($des, $categoria);

    // Itera sobre los resultados y guarda el primer valor encontrado en $salida
    while($fila = $consulta->fetch_array()){
        $salida .= $fila[0];
    }

    // Devuelve el resultado de la operación
    return $salida;
}

public static function editarCategoria($id_categoria, $categoria){ 
    include_once("modelo.php"); 
    $salida = 0; 
    $consulta = Modelo::sqlEditar($id_categoria, $categoria); 
    if($consulta){ 
        $salida = 1; 
    }
    return $salida; 
}
    /**
 * Método para eliminar un usuario de la base de datos
 * 
 * @param id {número} ID del usuario que se desea eliminar
 * @return salida {número} devuelve 1 si la operación fue exitosa, de lo contrario devuelve 0
 */
public static function EliminarUser($id){
    include_once("modelo.php");  // Incluye el modelo para acceder a la lógica de base de datos
    $salida = 0;  // Variable que almacenará el resultado de la operación

    // Ejecuta la consulta para eliminar el usuario de la base de datos
    $consulta = Modelo::sqlEliminarUser($id);

    // Si la consulta fue exitosa, actualiza el valor de salida
    if($consulta){
        $salida = 1;
    }

    // Devuelve el resultado de la operación
    return $salida;
}
/**
 * Método para obtener datos de un producto específico
 * 
 * @param des {número} Desición según el dato del producto que se desea
 * @param idPro {número} ID del producto del cual se desea obtener información
 * @return salida {texto} Devuelve los datos solicitados del producto
 */
public static function datoPro($des,$idPro){
    include_once("modelo.php");  // Incluye el modelo para acceder a la lógica de base de datos
    $salida = "";  // Variable que almacenará los datos del producto

    // Ejecuta la consulta para obtener los datos del producto
    $consulta = Modelo::sqlDatoPro($des,$idPro);

    // Recorre los resultados de la consulta y concatena los datos en la variable salida
    while($fila = $consulta->fetch_array()){
        $salida .= $fila[0];
    }

    // Devuelve los datos del producto
    return $salida; 
}


    /**
 * Método para editar un producto en la base de datos
 * 
 * @param id_producto {número} ID del producto que se desea editar
 * @param nombre {texto} Nuevo nombre del producto
 * @param precio {número} Nuevo precio del producto
 * @param cantidad {número} Nueva cantidad del producto
 * @param detalles {texto} Nuevos detalles o descripción del producto
 * @param color {texto} Nuevo color del producto
 * @param tallas {texto} Nuevas tallas del producto
 * @param imagen {texto} Nueva imagen del producto
 * @return salida {número} Devuelve 1 si la operación fue exitosa, de lo contrario devuelve 0
 */
public static function editarProducto($id_producto,$nombre,$precio,$cantidad,$detalles,$color,$tallas,$imagen){
    include_once("modelo.php");  // Incluye el modelo para acceder a la lógica de base de datos
    $salida = 0;  // Variable que almacenará el resultado de la operación

    // Ejecuta la consulta para editar el producto en la base de datos
    $consulta = Modelo::sqlEditarPro($id_producto,$nombre,$precio,$cantidad,$detalles,$color, $tallas,$imagen);

    // Si la consulta fue exitosa, actualiza el valor de salida
    if($consulta){
        $salida = 1;
    }

    // Devuelve el resultado de la operación
    return $salida;
}




    /**
 * Método para mostrar el conteo de usuarios eliminados
 * 
 * @return salida {texto} Devuelve una tabla HTML con los datos de usuarios eliminados
 */
public static function mostrarConteoUserEli() {
    include_once("modelo.php");  // Incluye el modelo para acceder a la lógica de base de datos
    $salida = "<h2>Información de usuarios eliminados.</h2><br><br>";
    $salida .= "<table class='conteo-table'>";  // Inicializa la variable de salida con la tabla HTML
    $consulta = Modelo::sqlConteoUserEli();  // Llama a la función del modelo para obtener el conteo de usuarios eliminados
    
    // Encabezados de la tabla
    $salida .= "<thead>";
    $salida .= "<tr>";
    $salida .= "<th>ID</th>";
    $salida .= "<th>Descripción</th>";
    $salida .= "<th>Conteo</th>";
    $salida .= "<th>Fecha de Eliminación</th>";
    $salida .= "</tr>";
    $salida .= "</thead>";
    
    // Recorre los resultados de la consulta y crea filas en la tabla
    while ($fila = $consulta->fetch_assoc()) {
        $salida .= "<tr>"; 
        $salida .= "<td>" . $fila['id_conteo'] . "</td>";  // Muestra el ID del conteo
        $salida .= "<td>" . $fila['descripcion'] . "</td>";  // Muestra la descripción
        $salida .= "<td>" . $fila['conteo'] . "</td>";  // Muestra el conteo de usuarios eliminados
        $salida .= "<td>" . $fila['fec_eli'] . "</td>";  // Muestra la fecha de eliminación
        $salida .= "</tr>";
    }
    
    $salida .= "</table>";  // Cierra la tabla HTML
    return $salida;  // Devuelve la tabla generada
}




    /**
 * Método para mostrar el conteo de usuarios registrados
 * 
 * @return salida {texto} Devuelve una tabla HTML con los datos de usuarios registrados
 */
public static function mostrarConteoUserReg() {
    include_once("modelo.php");  // Incluye el modelo para acceder a la lógica de base de datos
    $salida = "<h2>Información de usuarios registrados.</h2><br><br>";
    $salida .= "<table class='conteo-table'>";  // Inicializa la variable de salida con la tabla HTML
    $consulta = Modelo::sqlConteoUserReg();  // Llama a la función del modelo para obtener el conteo de usuarios registrados
    
    // Encabezados de la tabla
    $salida .= "<thead>";
    $salida .= "<tr>";
    $salida .= "<th>ID</th>";
    $salida .= "<th>Descripción</th>";
    $salida .= "<th>Conteo</th>";
    $salida .= "<th>Fecha de Registro</th>";
    $salida .= "</tr>";
    $salida .= "</thead>";
    
    // Recorre los resultados de la consulta y crea filas en la tabla
    while ($fila = $consulta->fetch_assoc()) {
        $salida .= "<tr>"; 
        $salida .= "<td>" . $fila['id_conteo'] . "</td>";  // Muestra el ID del conteo
        $salida .= "<td>" . $fila['descripcion'] . "</td>";  // Muestra la descripción
        $salida .= "<td>" . $fila['conteo'] . "</td>";  // Muestra el conteo de usuarios registrados
        $salida .= "<td>" . $fila['fec_reg'] . "</td>";  // Muestra la fecha de registro
        $salida .= "</tr>";
    }
    
    $salida .= "</table>";  // Cierra la tabla HTML
    return $salida;  // Devuelve la tabla generada
}

 /**
 * Método para mostrar el conteo de usuarios actualizados
 * 
 * @return salida {texto} Devuelve una tabla HTML con los datos de usuarios actualizados
 */
public static function mostrarConteoUserActu() {
    include_once("modelo.php");  // Incluye el modelo para acceder a la lógica de base de datos
    $salida = "<h2>Información de usuarios actualizados.</h2><br><br>";
    $salida .= "<table class='conteo-table'>";  // Inicializa la tabla HTML
    // Llama a la función del modelo para obtener el conteo de usuarios actualizados
    $consulta = Modelo::sqlConteoUserActu();

    // Encabezados de la tabla
    $salida .= "<thead>";
    $salida .= "<tr>";
    $salida .= "<th>ID</th>";
    $salida .= "<th>Descripción</th>";
    $salida .= "<th>Conteo</th>";
    $salida .= "<th>Fecha de Registro</th>";
    $salida .= "</tr>";
    $salida .= "</thead>";

    // Recorre los resultados de la consulta y crea filas en la tabla
    while ($fila = $consulta->fetch_assoc()) {
        $salida .= "<tr>"; 
        $salida .= "<td>" . $fila['id_conteo'] . "</td>";  // Muestra el ID del conteo
        $salida .= "<td>" . $fila['descripcion'] . "</td>";  // Muestra la descripción
        $salida .= "<td>" . $fila['conteo'] . "</td>";  // Muestra el conteo de usuarios actualizados
        $salida .= "<td>" . $fila['fec_reg'] . "</td>";  // Muestra la fecha de registro
        $salida .= "</tr>";
    }

    $salida .= "</table>";  // Cierra la tabla HTML
    return $salida;  // Devuelve la tabla generada
}

/**
 * Método para mostrar el conteo de productos eliminados
 * 
 * @return salida {texto} Devuelve una tabla HTML con los datos de productos eliminados
 */
public static function mostrarConteoProEli() {
    include_once("modelo.php");  // Incluye el modelo para acceder a la lógica de base de datos
    $salida = "<h2>Información de productos eliminados.</h2><br><br>";
    $salida .= "<table class='conteo-table'>";  // Inicializa la tabla HTML
    // Llama a la función del modelo para obtener el conteo de productos eliminados
    $consulta = Modelo::sqlConteoProEli();

    // Encabezados de la tabla
    $salida .= "<thead>";
    $salida .= "<tr>";
    $salida .= "<th>ID</th>";
    $salida .= "<th>Descripción</th>";
    $salida .= "<th>Conteo</th>";
    $salida .= "<th>Fecha de Eliminación</th>";
    $salida .= "</tr>";
    $salida .= "</thead>";

    // Recorre los resultados de la consulta y crea filas en la tabla
    while ($fila = $consulta->fetch_assoc()) {
        $salida .= "<tr>"; 
        $salida .= "<td>" . $fila['id_conteo'] . "</td>";  // Muestra el ID del conteo
        $salida .= "<td>" . $fila['descripcion'] . "</td>";  // Muestra la descripción
        $salida .= "<td>" . $fila['conteo'] . "</td>";  // Muestra el conteo de productos eliminados
        $salida .= "<td>" . $fila['fec_eli'] . "</td>";  // Muestra la fecha de eliminación
        $salida .= "</tr>";
    }

    $salida .= "</table>";  // Cierra la tabla HTML
    return $salida;  // Devuelve la tabla generada
}

 /**
 * Método para mostrar el conteo de productos registrados
 * 
 * @return salida {texto} Devuelve una tabla HTML con los datos de productos registrados
 */
public static function mostrarConteoProReg() {
    include_once("modelo.php");  // Incluye el modelo para acceder a la lógica de base de datos
    $salida = "<h2>Información de productos registrados.</h2><br><br>";
    $salida .= "<table class='conteo-table'>";  // Inicializa la tabla HTML
    // Llama a la función del modelo para obtener el conteo de productos registrados
    $consulta = Modelo::sqlConteoProReg();

    // Encabezados de la tabla
    $salida .= "<thead>";
    $salida .= "<tr>";
    $salida .= "<th>ID</th>";
    $salida .= "<th>Descripción</th>";
    $salida .= "<th>Conteo</th>";
    $salida .= "<th>Fecha de Registro</th>";
    $salida .= "</tr>";
    $salida .= "</thead>";

    // Recorre los resultados de la consulta y crea filas en la tabla
    while ($fila = $consulta->fetch_assoc()) {
        $salida .= "<tr>"; 
        $salida .= "<td>" . $fila['id_conteo'] . "</td>";  // Muestra el ID del conteo
        $salida .= "<td>" . $fila['descripcion'] . "</td>";  // Muestra la descripción
        $salida .= "<td>" . $fila['conteo'] . "</td>";  // Muestra el conteo de productos registrados
        $salida .= "<td>" . $fila['fec_reg'] . "</td>";  // Muestra la fecha de registro
        $salida .= "</tr>";
    }

    $salida .= "</table>";  // Cierra la tabla HTML
    return $salida;  // Devuelve la tabla generada
}

/**
 * Método para mostrar el conteo de productos actualizados
 * 
 * @return salida {texto} Devuelve una tabla HTML con los datos de productos actualizados
 */
public static function mostrarConteoProActu() {
    include_once("modelo.php");  // Incluye el modelo para acceder a la lógica de base de datos
    $salida = "<h2>Información de productos actualizados.</h2><br><br>";
    $salida .= "<table class='conteo-table'>";  // Inicializa la tabla HTML
    // Llama a la función del modelo para obtener el conteo de productos actualizados
    $consulta = Modelo::sqlConteoProActu();

    // Encabezados de la tabla
    $salida .= "<thead>";
    $salida .= "<tr>";
    $salida .= "<th>ID</th>";
    $salida .= "<th>Descripción</th>";
    $salida .= "<th>Conteo</th>";
    $salida .= "<th>Fecha de Actualización</th>";
    $salida .= "</tr>";
    $salida .= "</thead>";

    // Recorre los resultados de la consulta y crea filas en la tabla
    while ($fila = $consulta->fetch_assoc()) {
        $salida .= "<tr>"; 
        $salida .= "<td>" . $fila['id_conteo'] . "</td>";  // Muestra el ID del conteo
        $salida .= "<td>" . $fila['descripcion'] . "</td>";  // Muestra la descripción
        $salida .= "<td>" . $fila['conteo'] . "</td>";  // Muestra el conteo de productos actualizados
        $salida .= "<td>" . $fila['fec_reg'] . "</td>";  // Muestra la fecha de actualización
        $salida .= "</tr>";
    }

    $salida .= "</table>";  // Cierra la tabla HTML
    return $salida;  // Devuelve la tabla generada
}
/**
 * Método para buscar usuarios en la base de datos
 * 
 * @param des {texto} Descripción de la búsqueda
 * @param busqueda {texto} Término de búsqueda para encontrar usuarios
 * @return salida {texto} Devuelve los datos de los usuarios encontrados o un mensaje si no se encontraron
 */
public static function buscarUsuario($des, $busqueda) {
    include_once("modelo.php");  // Incluye el modelo para acceder a la lógica de base de datos
    $salida = "";  // Inicializa la variable de salida

    // Llama a la función del modelo para buscar usuarios
    $consulta = Modelo::sqlBuscarUser($des, $busqueda);

    // Verifica si se encontraron resultados
    if ($consulta->num_rows > 0) {
        // Recorre los resultados de la consulta y agrega los datos a la salida
        while ($fila = $consulta->fetch_assoc()) {
            $salida .= $fila['nombre'] . " ";  // Agrega el nombre del usuario
            $salida .= $fila['apellido'] . " ";  // Agrega el apellido del usuario
            $salida .= $fila['correo'] . " ";  // Agrega el correo del usuario
            $salida .= $fila['fecha'] . " ";  // Agrega la fecha relacionada con el usuario
        }
    } else {
        // Mensaje si no se encontró ningún usuario
        $salida .= "No se encontró ningún usuario con esta búsqueda";
    }

    return $salida;  // Devuelve la salida generada
}


    /**
 * Método para mostrar la lista de usuarios
 * 
 * @param buscaUser {texto|null} Término de búsqueda para filtrar los usuarios, si no se proporciona, se mostrarán todos
 * @return salida {texto} Devuelve el HTML con la lista de usuarios
 */
public static function mostrarUsuarios($buscaUser = Null) {
    include_once("modelo.php");  // Incluye el modelo para acceder a la lógica de base de datos
    include_once("login_class.php");  // Incluye la clase de login para verificar roles
    $salida = "";  // Inicializa la variable de salida

    // Llama a la función del modelo para obtener la lista de usuarios
    $consulta = Modelo::sqlMostrarUser($buscaUser);

    // Recorre los resultados de la consulta y construye el HTML de salida
    while ($fila = $consulta->fetch_assoc()) {
        $salida .= "<div class='usuario'>";  // Inicia un contenedor para cada usuario
        // Define la ruta de la foto del usuario, usa una foto por defecto si no hay
        $foto = !empty($fila['foto']) ? '../img/' . $fila['foto'] : '../img/perfil.jpg';
        $salida .= "<img src='" . $foto . "' alt='Imagen de " . $fila['nombre'] . "'>";  // Muestra la foto del usuario
        $salida .= "<div>";
        $salida .= "<p><strong>Documento:</strong> " . $fila['documento'] . "</p>";  // Muestra el documento del usuario
        $salida .= "<p><strong>Nombre:</strong> " . $fila['nombre'] . "</p>";  // Muestra el nombre del usuario
        $salida .= "<p><strong>Apellido:</strong> " . $fila['apellido'] . "</p>";  // Muestra el apellido del usuario
        $salida .= "<p><strong>Correo:</strong> " . $fila['correo'] . "</p>";  // Muestra el correo del usuario
        $salida .= "<p><strong>Fecha:</strong> " . $fila['fecha'] . "</p>";  // Muestra la fecha relacionada con el usuario
        $salida .= "<p><strong>Rol:</strong> " . $fila['rol'] . "</p>";  // Muestra el rol del usuario
        $id = $_SESSION['id'];  // Obtiene el ID de la sesión actual
        $idUser = $fila['documento'];  // Obtiene el ID del usuario actual

        // Verifica el rol del usuario en sesión para mostrar el botón de editar si corresponde
        if (Loguin::verRol($id) == 0) {
            $salida .= "<a class='btn btn-success' href='ctroBar.php?seccion=actuRol&&dato=" . $idUser . "' role='button'><i class='fa fa-pencil-alt'></i> Editar</a><br>";  // Botón de editar
        }
        $salida .= "</div>";  // Cierra el contenedor del usuario
        $salida .= "</div>";  // Cierra el div principal del usuario
    }

    return $salida;  // Devuelve el HTML generado
}

    

    /**
 * Método para actualizar los datos de un usuario
 * 
 * @param des {texto} Descripción o campo a actualizar
 * @param idUser {int} ID del usuario cuyos datos se van a actualizar
 * @return salida {mixed} Devuelve el dato solicitado del usuario
 */
public static function actualizaDatosUser($des, $idUser) {
    include_once("modelo.php");  // Incluye el modelo para acceder a la lógica de base de datos
    $salida = "";  // Inicializa la variable de salida

    // Llama a la función del modelo para obtener los datos del usuario
    $consulta = Modelo::sqlMostrarDaUser($des, $idUser);

    // Recorre los resultados de la consulta
    while ($fila = $consulta->fetch_array()) {
        $salida = $fila[0];  // Asigna el primer dato de la fila a la salida
    }

    return $salida;  // Devuelve el dato obtenido
}
/**
 * Método para actualizar el rol de un usuario
 * 
 * @param idUser {int} ID del usuario cuyo rol se desea actualizar
 * @param rol {string} Nuevo rol que se asignará al usuario
 * @return salida {int} Devuelve 1 si la operación fue exitosa, de lo contrario devuelve null
 */
public static function actuRol($idUser, $rol) {
    include_once("modelo.php");
    $consulta = Modelo::sqlActuRol($idUser, $rol);
    if ($consulta) {
        $salida = 1;
    }
    return $salida;
}

    
    /**
 * Método para actualizar los datos de un usuario
 * 
 * @param idUser {int} ID del usuario que se desea actualizar
 * @param nombre {string} Nuevo nombre del usuario
 * @param apellido {string} Nuevo apellido del usuario
 * @param correo {string} Nuevo correo del usuario
 * @return salida {int} Devuelve 1 si la operación fue exitosa, de lo contrario devuelve null
 */
public static function actualizarUser($idUser, $nombre, $apellido, $correo) {
    include_once("modelo.php");
    $consulta = Modelo::sqlActualizarUser($idUser, $nombre, $apellido, $correo);
    if ($consulta) {
        $salida = 1;
    }
    return $salida; 
}
/**
 * Método para verificar si un usuario ha dado 'like' a un producto
 * 
 * @param usuario_id {int} ID del usuario que se desea verificar
 * @param producto_id {int} ID del producto que se desea verificar
 * @return {int} Devuelve 1 si el usuario ha dado 'like', 0 si no lo ha hecho
 */
public static function verificLike($usuario_id, $producto_id) {
    include_once("modelo.php");
    $consulta = Modelo::sqlVerificLike($usuario_id, $producto_id);
    if ($consulta && $consulta->num_rows > 0) {
        $fila = $consulta->fetch_assoc();
        return $fila['count'] > 0 ? 1 : 0; // Devuelve 1 si hay al menos un 'like', de lo contrario 0
    }
    return 0; // Devuelve 0 si no hay resultados en la consulta
}
/**
 * Método para agregar un 'like' a un producto por parte de un usuario
 * 
 * @param usuario_id {int} ID del usuario que da el 'like'
 * @param producto_id {int} ID del producto que recibe el 'like'
 * @return {bool} Devuelve true si la operación fue exitosa, false de lo contrario
 */
public static function agregarLike($usuario_id, $producto_id) {
    include_once("modelo.php");
    return Modelo::sqlAgregarLike($usuario_id, $producto_id); // Llama al modelo para agregar el 'like' y devuelve el resultado
}





    /**
 * Método para mostrar todos los productos disponibles en la tienda
 * 
 * @return {string} Devuelve un bloque HTML con la información de los productos
 */
public static function mostrarTodosProductos() {
    include 'modelo.php'; // Incluye el modelo para acceder a la base de datos
    $salida = ""; // Inicializa la variable de salida
    $consulta = Modelo::sqlMostrarPro(); // Realiza la consulta para obtener todos los productos
    $salida .= "<div id='categorias'>"; // Comienza el contenedor de categorías

    while ($fila = $consulta->fetch_assoc()) { // Itera sobre cada producto obtenido
        // Crea un contenedor para el producto
        $salida .= "<div id='categoria' data-color='" . strtolower($fila['color']) . "' data-talla='" . strtolower($fila['tallas']) . "'>";
        $salida .= "<h5><p><li>" . $fila['nombre_producto'] . "; por solo: </h5></li></p>";
        $salida .= "<strong> $" . $fila['precio'] . "</strong>";

        // Verifica si hay una imagen disponible
        if (!empty($fila['ruta_img'])) {
            $rutaImagen = $fila['ruta_img'];
            $salida .= '<div id="imagen-container"><img src="' . $rutaImagen . '" alt="' . $fila['nombre_producto'] . '" id="img-thumbnail"></div>';
        } else {
            $salida .= "<p id='sin-imagen'>Imagen no disponible</p>"; // Mensaje si no hay imagen
        }

        // Obtiene el ID del producto y la cantidad de 'likes'
        $idPro = $fila['id_producto'];
        $likeCantidad = Modelo::sqlConteoLikes($idPro);
        $salida .= "<p><strong class='likes-count' data-id_producto='" . $fila['id_producto'] . "'> Likes: " . $likeCantidad . "</strong></p>";
        
        // Determina si el usuario ha dado 'like' al producto
        $likeClass = self::verificLike($_SESSION['id'], $fila['id_producto']) ? 'fas fa-heart liked' : 'far fa-heart';
        $salida .= "<i class='$likeClass' data-id_producto='" . $fila['id_producto'] . "' onclick='likear(this)'></i>";

        // Contenedor de botones de carrito y favoritos
        $salida .= "<div id='carfav'>";

        // Botón para agregar al carrito
        $salida .= "<button id='btn-agregar-carrito' 
                    onclick=\"agregarCarrito('{$fila['id_producto']}', '{$fila['nombre_producto']}', '{$fila['precio']}', '1')\">
                    <i class='fas fa-shopping-cart' style='color: #238a12; font-size: 18px;'></i> carrito</button>";

        // Botón para agregar a favoritos
        $salida .= "<button id='btn-favoritos' 
                    onclick=\"agregarFavo('{$fila['id_producto']}', '{$fila['nombre_producto']}')\">
                    <i class='fas fa-star' style='color: #f5ef24; font-size: 18px;'></i> Favoritos</button>";

        $salida .= "</div><br>"; // Cierra el contenedor de botones
        $salida .= "</div><br>"; // Cierra el contenedor del producto
    }
    $salida .= "</div>"; // Cierra el contenedor de categorías

    return $salida; // Devuelve el bloque HTML completo
}

    
    
           




    /**
 * Método para mostrar las categorías disponibles para el usuario
 * 
 * @return {string} Devuelve un bloque HTML con la lista de categorías
 */
public static function mostrarCategorias() {
    include_once("modelo.php"); // Incluye el modelo para acceder a la base de datos
    $categorias = Modelo::obtenerCategoriasUser(); // Llama a la función que obtiene las categorías
    $salida = '<div id="categorias-container">'; // Inicia un contenedor con ID específico

    if ($categorias) { // Verifica si se han obtenido categorías
        $salida .= '<ul class="lista-categorias">'; // Agrega la apertura de la lista
        while ($fila = $categorias->fetch_assoc()) { // Itera sobre las categorías correctamente
            $salida .= '<li>'; // Agrega el elemento de la lista
            $salida .= '<a href="conBaBus.php?seccion=verProUser&id_categoria=' . $fila['id_categoria'] . '" class="categoria-boton">';
            $salida .= htmlspecialchars($fila['categoria']); // Muestra el nombre de la categoría de forma segura
            $salida .= '</a>';
            $salida .= '</li>'; // Cierra el elemento de la lista
        }
        $salida .= '</ul>'; // Cierra la lista
    } else {
        $salida .= "<p>No hay categorías disponibles.</p>"; // Mensaje cuando no hay categorías
    }

    $salida .= '</div>'; // Cierra el contenedor
    return $salida; // Retorna la salida generada
}
/**
 * Método para mostrar productos de una categoría específica
 * 
 * @param {int} $id_categoria ID de la categoría para filtrar los productos
 * @return {string} Devuelve un bloque HTML con los productos de la categoría
 */
public static function mostrarProductosPorCategoria($id_categoria) {
    include 'modelo.php'; // Incluye el modelo para acceder a la base de datos
    $salida = ""; // Inicializa la salida HTML
    $consulta = Modelo::obtenerProductosPorCategoria($id_categoria); // Obtiene los productos de la categoría

    // Verifica si hay productos en la categoría
    if ($consulta->num_rows == 0) {
        $salida .= "<div id='alerta-categoria' class='alert alert-warning'>Aún no hay productos en esta categoría.</div>"; // Mensaje si no hay productos
    } else {
        $salida .= "<div id='categorias'>"; // Inicia el contenedor de categorías
        while ($fila = $consulta->fetch_assoc()) { // Itera sobre los productos
            $salida .= "<div id='categoria' data-color='" . strtolower($fila['color']) . "' data-talla='" . strtolower($fila['tallas']) . "'>";
            $salida .= "<h5><p><li>" . $fila['nombre_producto'] . "; por solo: </h5></li></p>";
            $salida .= "<strong> $" . $fila['precio'] . "</strong>";

            // Verifica si hay una imagen del producto
            if (!empty($fila['ruta_img'])) {
                $rutaImagen = $fila['ruta_img'];
                $salida .= '<div id="imagen-container"><img src="' . $rutaImagen . '" alt="' . $fila['nombre_producto'] . '" id="img-thumbnail"></div>'; // Muestra la imagen
            } else {
                $salida .= "<p id='sin-imagen'>Imagen no disponible</p>"; // Mensaje si no hay imagen
            }

            $idPro = $fila['id_producto']; // ID del producto
            $likeCantidad = Modelo::sqlConteoLikes($idPro); // Cuenta los likes del producto
            $salida .= "<p><strong class='likes-count' data-id_producto='" . $fila['id_producto'] . "'> Likes: " . $likeCantidad . "</strong></p>"; // Muestra la cantidad de likes
            
            // Verifica si el usuario ha dado 'like' al producto
            $likeClass = self::verificLike($_SESSION['id'], $fila['id_producto']) ? 'fas fa-heart liked' : 'far fa-heart';
            $salida .= "<i class='$likeClass' data-id_producto='" . $fila['id_producto'] . "' onclick='likear(this)'></i>"; // Ícono de 'like'

            // Contenedor de botones de carrito y favoritos
            $salida .= "<div id='carfav'>";

            // Botón para agregar al carrito
            $salida .= "<button id='btn-agregar-carrito' 
                        onclick=\"agregarCarrito('{$fila['id_producto']}', '{$fila['nombre_producto']}', '{$fila['precio']}', '1')\">
                        <i class='fas fa-shopping-cart' style='color: #238a12; font-size: 18px;'></i> carrito</button>";

            // Botón para agregar a favoritos
            $salida .= "<button id='btn-favoritos' 
                        onclick=\"agregarFavo('{$fila['id_producto']}', '{$fila['nombre_producto']}')\">
                        <i class='fas fa-star' style='color: #f5ef24; font-size: 18px;'></i> Favoritos</button>";

            $salida .= "</div><br>"; // Cierra el contenedor de botones
            $salida .= "</div><br>"; // Cierra el contenedor del producto
        }
        $salida .= "</div>"; // Cierre del div de categorías
    }

    return $salida; // Retorna la salida generada
}

    
    
    
                                    

    /**
 * Método para mostrar los productos favoritos de un usuario
 * 
 * @return {string} Devuelve un bloque HTML que representa una tabla con los productos favoritos
 */
public static function verFavoritos() {
    include 'modelo.php'; // Incluye el modelo para acceder a la base de datos
    $salida = ""; // Inicializa la salida HTML
    $consulta = Modelo::sqlVerFavoritos(); // Obtiene los productos favoritos del usuario
    $salida .= "<table class='table table-hover'>"; // Inicia la tabla de favoritos
    $salida .= "<thead><tr><th>Producto</th><th>Cantidad</th><th>Eliminar</th></tr></thead><tbody>"; // Encabezados de la tabla
    
    while ($fila = $consulta->fetch_assoc()) { // Itera sobre los productos favoritos
        $salida .= "
            <tr>
                <td data-label='Producto' class='product-name'>{$fila['nombre_produc']}</td> // Muestra el nombre del producto
                <td data-label='Cantidad'>
                    <div class='quantity-buttons'>
                        <input type='text' value='{$fila['cantidad_fav']}' class='quantity-input' readonly> // Muestra la cantidad
                    </div>
                </td>
                <td data-label='Eliminar'>
                    <a href='eliminarFavo.php?id={$fila['id_favo']}' class='btn btn-danger'><i class='fas fa-trash-alt'></i></a> // Botón para eliminar el producto de favoritos
                </td>
            </tr>";
    }
    $salida .= "</tbody></table>"; // Cierra el cuerpo y la tabla
    return $salida; // Retorna la salida generada
}

     
     
    /**
 * Método para mostrar los productos en el carrito de compras
 * 
 * @return {string} Devuelve un bloque HTML que representa una tabla con los productos en el carrito
 */
public static function verCarrito() {
    include 'modelo.php'; // Incluye el modelo para acceder a la base de datos
    $salida = ""; // Inicializa la salida HTML
    $consulta = Modelo::sqlverCarrito(); // Obtiene los productos en el carrito
    $salida .= "<table class='table table-hover'>"; // Inicia la tabla del carrito
    $salida .= "<thead><tr><th>Producto</th><th>Precio</th><th>Cantidad</th><th>Total</th><th>Eliminar</th></tr></thead><tbody>"; // Encabezados de la tabla
    $subtotal = 0; // Inicializa el subtotal
    
    while ($fila = $consulta->fetch_assoc()) { // Itera sobre los productos en el carrito
        $total_producto = $fila['precio_pro'] * $fila['cantidad_pro']; // Calcula el total del producto
        $subtotal += $total_producto; // Suma el total del producto al subtotal
        $salida .= "
            <tr>
                <td data-label='Producto' class='product-name'>{$fila['nombre_producto']}</td> // Muestra el nombre del producto
                <td data-label='Precio'>\${$fila['precio_pro']}</td> // Muestra el precio del producto
                <td data-label='Cantidad'>
                    <div class='quantity-buttons'>
                        <input type='text' value='{$fila['cantidad_pro']}' class='quantity-input' readonly> // Muestra la cantidad del producto
                    </div>
                </td>
                <td data-label='Total'>\${$total_producto}</td> // Muestra el total del producto
                <td data-label='Eliminar'>
                    <a href='eliminarCa.php?id={$fila['id_ca']}' class='btn btn-danger'><i class='fas fa-trash-alt'></i></a> // Botón para eliminar el producto del carrito
                </td>
            </tr>";
    }
    
    $salida .= "</tbody>"; // Cierra el cuerpo de la tabla
    $salida .= "<tfoot><tr class='total-row'><td colspan='3'>Subtotal</td><td>\${$subtotal}</td><td></td></tr></tfoot>"; // Muestra el subtotal
    $salida .= "</table>"; // Cierra la tabla
    
    return $salida; // Retorna la salida generada
}


    /**
 * Método para agregar un producto a los favoritos de un usuario.
 * 
 * @param {string} $documentoUsuario El documento del usuario que está agregando el favorito.
 * @param {int} $idPro El ID del producto que se va a agregar a favoritos.
 * @param {string} $nombrePro El nombre del producto que se va a agregar a favoritos.
 * @return {mixed} Retorna el resultado de la consulta para agregar el producto a favoritos.
 */
public static function agregarFavo($documentoUsuario, $idPro, $nombrePro) {
    include_once("modelo.php"); // Incluye el modelo para acceder a la base de datos
    $consulta = Modelo::sqlAgregarAFavoritos($documentoUsuario, $idPro, $nombrePro); // Llama a la función del modelo para agregar a favoritos

    return $consulta; // Devuelve directamente el resultado de la consulta
}
/**
 * Método para mostrar los productos favoritos de un usuario.
 * 
 * @param {string} $documentoUsuario El documento del usuario cuyos favoritos se mostrarán.
 * @return {string} Devuelve el HTML con los productos favoritos del usuario.
 */
public static function mostrarFavoritos($documentoUsuario) {
    include_once("modelo.php"); // Incluye el modelo para acceder a la base de datos
    $salida = "<div id='favoritos-container'>"; // Inicia el contenedor de favoritos
    $consulta = Modelo::sqlMostrarFavoritos($documentoUsuario); // Obtiene los favoritos del usuario

    // Itera sobre los favoritos obtenidos
    while ($fila = $consulta->fetch_assoc()) {
        $salida .= "<div id='favorito-item-{$fila['id_favo']}'>"; // Contenedor para cada favorito
        
        // Sección del título del producto
        $salida .= "<div id='favorito-header-{$fila['id_favo']}'>";
        $salida .= "<h5 id='favorito-titulo-{$fila['id_favo']}'>" . $fila['nombre_produc'] . "</h5>";
        $salida .= "</div>"; // Fin de favorito-header

        // Sección del precio
        $salida .= "<div id='favorito-precio-{$fila['id_favo']}'>";
        $salida .= "<p><strong>Precio:</strong> $" . $fila['precio'] . "</p>";
        $salida .= "</div>"; // Fin de favorito-precio

        // Sección de la imagen del producto
        $salida .= "<div id='favorito-imagen-{$fila['id_favo']}'>";
        if (!empty($fila['ruta_img'])) {
            $salida .= '<img id="img-fav-' . $fila['id_favo'] . '" src="' . $fila['ruta_img'] . '" alt="' . $fila['nombre_produc'] . '" class="img-thumbnail-fav">';
        } else {
            $salida .= "<p id='sin-imagen-{$fila['id_favo']}'>Imagen no disponible</p>";
        }
        $salida .= "</div>"; // Fin de favorito-imagen

        // Botón para eliminar de favoritos
        $salida .= "<div id='favorito-acciones-{$fila['id_favo']}'>";
        $salida .= "<button id='btn-eliminar-favorito-{$fila['id_favo']}' class='btn btn-danger btn-eliminar-favorito' 
                    onclick=\"eliminarFavorito('{$fila['id_favo']}')\">
                    <i class='fas fa-trash'></i> Eliminar</button>";
        $salida .= "</div>"; // Fin de favorito-acciones

        $salida .= "</div>"; // Fin de favorito-item
    }

    $salida .= "</div>"; // Fin de favoritos-container
    return $salida; // Devuelve el HTML generado
}
/**
 * Método para eliminar un producto de la lista de favoritos.
 * 
 * @param {int} $id_favo El ID del favorito que se desea eliminar.
 * @return {int} Devuelve 1 si se eliminó correctamente, o null si hubo un error.
 */
public static function eliminarFavo($id_favo) {
    include_once("modelo.php"); // Incluye el modelo para acceder a la base de datos
    $consulta = Modelo::sqlEliminarFavo($id_favo); // Ejecuta la consulta para eliminar el favorito

    // Verifica si la consulta se ejecutó correctamente
    if ($consulta) {
        $salida = 1; // Si se eliminó correctamente, se establece salida a 1
    }
    
    return $salida; // Devuelve el resultado (1 si se eliminó, null si no)
}
/**
 * Método para mostrar los comentarios en el foro.
 * 
 * @return {string} Devuelve el HTML generado para mostrar los comentarios y sus respuestas.
 */
public static function mostrarForo() {
    include_once("modelo.php"); // Incluye el modelo para acceder a la base de datos
    $salida = "<div id='foro-container' class='foro-container'>"; // Contenedor principal para los comentarios
    $consulta = Modelo::sqlMostrarComentarios(); // Llama a la consulta SQL desde el modelo
    
    // Itera sobre cada comentario obtenido de la base de datos
    while ($fila = $consulta->fetch_assoc()) {
        $salida .= "<div id='comentario-{$fila['id_comentario']}' class='comentario-item'>"; // Contenedor del comentario
        $foto = !empty($fila['foto']) ? '../img/' . $fila['foto'] : '../img/perfil.jpg'; // Establece la ruta de la foto de perfil
        $salida .= "<img src='" . $foto . "' alt='Foto de perfil' class='img-perfil'>"; // Muestra la imagen de perfil
        $salida .= "<div class='contenido-comentario'>"; // Contenedor del contenido del comentario
        $salida .= "<h5>" . $fila['nombre_usuario'] . "</h5>"; // Muestra el nombre del usuario
        $salida .= "<p>" . $fila['mensaje'] . "</p>"; // Muestra el mensaje del comentario
        $salida .= "<span class='fecha'>" . $fila['fecha_publicacion'] . "</span>"; // Muestra la fecha de publicación
        $salida .= "<button class='btn-responder' onclick=\"responderComentario('{$fila['id_comentario']}')\">Responder</button>"; // Botón para responder al comentario
        $id_user = $_SESSION['id']; // Obtiene el ID del usuario actual
        $eliminar = Modelo::verifiComentarios($id_user, $fila['id_comentario']); // Verifica si el usuario puede eliminar el comentario
        if ($eliminar) {
            $salida .= "<button class='btn-eliminar' onclick=\"eliminarComentario('{$fila['id_comentario']}')\">Eliminar</button>"; // Botón para eliminar el comentario
        }

        // Muestra las respuestas del comentario
        $salida .= self::mostrarRespuestas($fila['id_comentario']);
        
        $salida .= "</div></div>"; // Cierre de los contenedores
    }

    $salida .= "</div>"; // Cierre del contenedor principal
    return $salida; // Devuelve el HTML generado
}
/**
 * Método para mostrar las respuestas a un comentario específico.
 * 
 * @param int $idComentario El ID del comentario del cual se desean mostrar las respuestas.
 * @return {string} Devuelve el HTML generado para mostrar las respuestas.
 */
public static function mostrarRespuestas($idComentario) {
    $salida = ""; // Inicializa la variable de salida
    $consultaRespuestas = Modelo::sqlMostrarRespuestas($idComentario); // Llama a la consulta SQL desde el modelo

    // Itera sobre cada respuesta obtenida de la base de datos
    while ($filaRespuesta = $consultaRespuestas->fetch_assoc()) {
        $salida .= "<div class='respuesta-item'>"; // Contenedor para cada respuesta
        $foto = !empty($filaRespuesta['foto']) ? '../img/' . $filaRespuesta['foto'] : '../img/perfil.jpg'; // Establece la ruta de la foto de perfil
        $salida .= "<img src='" . $foto . "' alt='Foto de perfil' class='img-perfil'>"; // Muestra la imagen de perfil
        $salida .= "<div class='contenido-respuesta'>"; // Contenedor del contenido de la respuesta
        $salida .= "<h5>" . $filaRespuesta['nombre_usuario'] . "</h5>"; // Muestra el nombre del usuario que respondió
        $salida .= "<p>" . $filaRespuesta['mensaje'] . "</p>"; // Muestra el mensaje de la respuesta
        $salida .= "<span class='fecha'>" . $filaRespuesta['fecha_publicacion'] . "</span>"; // Muestra la fecha de publicación de la respuesta

        // ID del usuario logueado
        $id_user = $_SESSION['id']; 
        
        // Verifica si el usuario actual es el autor de esta respuesta
        $eliminar = Modelo::verifiRespuestas($id_user, $filaRespuesta['id_respuesta']);
        
        // Si el usuario es el autor de la respuesta, muestra el botón de eliminar
        if ($eliminar) {
            $salida .= "<button class='btn-eliminar' onclick=\"eliminarRespuesta('{$filaRespuesta['id_respuesta']}')\">Eliminar</button>";
        }
        
        $salida .= "</div></div>"; // Cierre de los contenedores de respuesta
    }

    return $salida; // Devuelve el HTML generado
}
/**
 * Método para agregar un comentario o una respuesta a un comentario existente.
 * 
 * @param string $documentoUsuario El documento del usuario que está agregando el comentario.
 * @param string $mensaje El contenido del comentario que se desea agregar.
 * @param int|null $idRespuestaA (Opcional) El ID de la respuesta a la cual se está respondiendo. 
 *                               Si es null, se considera que es un comentario directo.
 */
public static function agregarComentario($documentoUsuario, $mensaje, $idRespuestaA = null) {
    // Llama a la consulta SQL desde el modelo para agregar el comentario
    Modelo::sqlAgregarComentario($documentoUsuario, $mensaje, $idRespuestaA);
}
/**
 * Método para eliminar un comentario de la base de datos.
 * 
 * @param int $idComentario El ID del comentario que se desea eliminar.
 */
public static function eliminarComentario($idComentario) {
    // Llama a la consulta SQL desde el modelo para eliminar el comentario
    Modelo::sqlEliminarComentario($idComentario);
}
/**
 * Método para mostrar todos los deseos de los usuarios en un formato bonito.
 * 
 * @return string HTML generado con la lista de deseos.
 */
public static function mostrarTodosDeseosBonito() {
    include_once("modelo.php");
    
    // Llama a la consulta para obtener todos los deseos con los datos del usuario
    $deseos = Modelo::sqlTodosDeseosConUsuario();
    
    // Inicializa la variable $salida
    $salida = '';

    // Verifica si hay resultados
    if ($deseos->num_rows > 0) {
        // Genera el HTML para mostrar los deseos en un formato bonito
        $salida .= '<div class="contenedor-deseos-admin">';
        $salida .= '<h2>Lista de Deseos de los Usuarios</h2>';
        $salida .= '<div class="grid-deseos">';  // Asegúrate de que este contenedor tenga estilo para el diseño en cuadrícula

        // Recorre cada deseo obtenido de la consulta
        while ($deseo = $deseos->fetch_assoc()) {
            // Tarjeta del deseo
            $salida .= '<div class="deseo-card">';
            
            // Imagen de perfil redonda del usuario
            $salida .= '<div class="perfil-usuario">';
            if (!empty($deseo['foto'])) {
                // Si hay foto de perfil, la muestra
                $salida .= '<img src="../img/' . htmlspecialchars($deseo['foto']) . '" alt="Foto de perfil" class="imagen-perfil">';
            } else {
                // Imagen por defecto si no hay foto
                $salida .= '<img src="../img/perfil.jpg" alt="Foto de perfil" class="imagen-perfil">';
            }
            $salida .= '</div>';
            
            // Información del deseo
            $salida .= '<div class="info-deseo">';
            $salida .= '<h3>' . htmlspecialchars($deseo['nombre_producto']) . '</h3>';
            $salida .= '<p>Deseado por el usuario: ' . htmlspecialchars($deseo['documento_usuario']) . '</p>';
            $salida .= '<p>Fecha de creación: ' . htmlspecialchars($deseo['fecha_creacion']) . '</p>';
            $salida .= '</div>';

            // Imágenes de referencia con carrusel de Bootstrap
            if (!empty($deseo['foto_referencia'])) {
                $imagenes = explode(',', $deseo['foto_referencia']);
                
                $salida .= '<div id="carousel' . $deseo['id_deseo'] . '" class="carousel slide" data-bs-ride="carousel">';
                $salida .= '<div class="carousel-inner">';
                
                // Genera las imágenes del carrusel
                foreach ($imagenes as $index => $imagen) {
                    $activeClass = ($index === 0) ? 'active' : '';  // Clase 'active' para la primera imagen
                    $salida .= '<div class="carousel-item ' . $activeClass . '">';
                    $salida .= '<img src="../img/' . htmlspecialchars($imagen) . '" alt="Imagen de referencia" class="d-block w-100 imagen-deseo">';
                    $salida .= '</div>';
                }

                $salida .= '</div>'; // Fin carousel-inner
                // Controles del carrusel
                $salida .= '<button class="carousel-control-prev" type="button" data-bs-target="#carousel' . $deseo['id_deseo'] . '" data-bs-slide="prev">';
                $salida .= '<span class="carousel-control-prev-icon" aria-hidden="true"></span>';
                $salida .= '<span class="visually-hidden">Previous</span>';
                $salida .= '</button>';
                $salida .= '<button class="carousel-control-next" type="button" data-bs-target="#carousel' . $deseo['id_deseo'] . '" data-bs-slide="next">';
                $salida .= '<span class="carousel-control-next-icon" aria-hidden="true"></span>';
                $salida .= '<span class="visually-hidden">Next</span>';
                $salida .= '</button>';
                $salida .= '</div>'; // Fin del carrusel
            } else {
                // Mensaje si no hay imágenes de referencia
                $salida .= '<p>No hay imágenes de referencia.</p>';
            }

            $salida .= '</div>';  // Fin de la tarjeta del deseo
        }

        $salida .= '</div>';  // Fin del grid
        $salida .= '</div>';  // Fin del contenedor
    } else {
        // Mensaje si no hay deseos en la lista
        $salida .= '<p>No hay deseos en la lista actualmente.</p>';
    }

    // Retorna la salida generada
    return $salida;
}
public static function mostrarProductosCompradosPorUsuario($id_usuario) {
    // Incluir el modelo
    include_once("modelo.php");
    $productos = Modelo::sqlComprasUsuario($id_usuario);

    // Inicializar la salida HTML con identificadores únicos
    $salida = '<div id="productos-comprados" class="contenedor-productos">';
    $salida .= '<h2 id="titulo-productos">Productos Comprados</h2>';
    
    if (!empty($productos)) {
        foreach ($productos as $producto) {
            $salida .= '<div id="producto-' . $producto['id_producto'] . '" class="producto-card">';
            $salida .= '<img src="../img/' . htmlspecialchars($producto['ruta_img']) . '" alt="' . htmlspecialchars($producto['nombre_producto']) . '" class="imagen-producto">';
            $salida .= '<h3 class="nombre-producto">' . htmlspecialchars($producto['nombre_producto']) . '</h3>';
            $salida .= '<p class="cantidad-producto">Cantidad: ' . htmlspecialchars($producto['cantidad']) . '</p>';
            $salida .= '<p class="precio-unitario">Precio Unitario: $' . number_format($producto['precio_unitario'], 2) . '</p>';
            $salida .= '<p class="subtotal-producto">Subtotal: $' . number_format($producto['subtotal'], 2) . '</p>';
            $salida .= '</div>'; // Fin de producto-card
        }
    } else {
        $salida .= '<p id="mensaje-vacio">No se han encontrado productos comprados.</p>';
    }
    
    $salida .= '</div>'; // Fin del contenedor-productos

    return $salida; // Retorna el HTML generado
}
}

