<?php

class Usuarios{

       /**
 * Método para eliminar una cuenta de usuario de la base de datos.
 *
 * Este método elimina la cuenta de un usuario con un ID específico de la base de datos.
 *
 * @param int $id El ID del usuario que se desea eliminar.
 * @return int Retorna 1 si la eliminación fue exitosa, o 0 si falló.
 */
public static function eliminarCuentaUser($id) {
    include_once("modelo.php");  // Incluir el archivo del modelo que contiene las consultas SQL
    
    $salida = 0;  // Inicializamos la variable de salida como 0 (fallo por defecto)
    
    // Llamamos a la función del modelo para eliminar el usuario por su ID
    $consulta = Modelo::sqlEliminarUser($id);
    
    // Verificamos si la consulta de eliminación fue exitosa
    if ($consulta) {
        $salida = 1;  // Si la consulta fue exitosa, asignamos 1 (éxito) a la salida
    }
    
    return $salida;  // Retornamos el resultado de la operación: 1 si fue exitoso, 0 si falló
    $conexion->close();
}

    /**
 * Método para buscar el ID de un usuario utilizando su correo electrónico.
 *
 * Este método consulta la base de datos para obtener el ID asociado a un correo electrónico específico.
 *
 * @param string $email El correo electrónico del usuario que se desea buscar.
 * @return string Retorna el ID del usuario si se encuentra, o una cadena vacía si no se encuentra.
 */
public static function buscarId($email) {
    include_once("modelo.php");  // Incluir el archivo del modelo que contiene las consultas SQL
    
    $salida = "";  // Inicializamos la variable de salida como una cadena vacía (por defecto, no encontrado)
    
    // Llamamos a la función del modelo para buscar el ID del usuario basado en el correo electrónico
    $consulta = Modelo::sqlBuscarId($email);
    
    // Iteramos sobre los resultados de la consulta
    while ($fila = $consulta->fetch_array()) {
        $salida = $fila[0];  // Asignamos el ID del usuario a la variable $salida
    }
    
    // Retornamos el ID encontrado o una cadena vacía si no se encontró
    return $salida;
    $conexion->close();
}


    /**
 * Método para verificar si una contraseña coincide con un documento de usuario.
 *
 * Este método consulta la base de datos para verificar si la contraseña proporcionada coincide con la asociada a un documento de usuario específico.
 *
 * @param string $contraseñaN La contraseña nueva que se desea verificar.
 * @param int $doc El documento de identidad del usuario.
 * @return string Retorna el valor asociado (por ejemplo, un ID o un indicador de verificación) si la contraseña es válida, o una cadena vacía si no coincide.
 */
public static function verificaCon($contraseñaN, $doc) {
    include_once("modelo.php");  // Incluir el archivo del modelo que contiene las consultas SQL
    
    // Realizamos la consulta para verificar si la contraseña coincide con el documento del usuario
    $consulta = Modelo::verficaClave($contraseñaN, $doc);
    
    // Iteramos sobre los resultados de la consulta
    while ($fila = $consulta->fetch_array()) {
        $salida = $fila[0];  // Asignamos el valor devuelto (ID o indicador) a la variable $salida
    }
    
    // Retornamos el resultado de la verificación
    return $salida;
    $conexion->close();
}

    
    

    /**
 * Método para generar el perfil de un usuario, mostrando sus datos y foto de perfil.
 *
 * Este método consulta la base de datos para obtener la información del usuario, incluido su rol, y genera el HTML correspondiente para mostrar su perfil. También permite que los usuarios puedan cambiar su foto de perfil y editar o eliminar su cuenta.
 *
 * @param int $id El ID del usuario cuyo perfil se va a mostrar.
 * @return string Retorna una cadena de texto con el HTML del perfil del usuario.
 */
public static function perfilUsuario($id) {
    include_once("modelo.php");  // Incluir el archivo del modelo con las consultas SQL
    include_once("login_class.php");  // Incluir la clase de login para verificar el rol del usuario
    
    // Realizamos la consulta para obtener la información del perfil del usuario
    $consulta = Modelo::sqlPerfil($id);
    
    // Iniciamos la cadena de salida con el contenedor del perfil
    $salida = "<div class='perfil-container'>";
    
    // Iteramos sobre los resultados de la consulta
    while ($fila = $consulta->fetch_assoc()) {
        // Definir la ruta de la foto de perfil o usar una predeterminada si no hay foto
        $foto = !empty($fila['foto']) ? '../img/' . $fila['foto'] : '../img/perfil.jpg';
        
        // Verificamos el rol del usuario usando el método verRol()
        $rol = Loguin::verRol($id); 
        
        // Añadimos el contenedor de la foto de perfil
        $salida .= "<div class='perfil-foto-container'>";

        if ($rol == 0) {
            echo "<h1><center>Perfil de Super Administrador</center></h1>";
            // Añadimos la foto de perfil con un input oculto para cambiar la foto
            $salida .= "<img id='perfilFoto' src='" . $foto . "' alt='Foto de perfil' class='perfil-foto' onclick='document.getElementById(\"inputFoto\").click();'>";
            $salida .= "<input type='file' id='inputFoto' style='display: none;' onchange='cambiarFotoAdmi()'>";
        }
        // Si el usuario es administrador, mostramos el título "Perfil de Administrador"
        else if ($rol == 1) {
            echo "<h1><center>Perfil de Administrador</center></h1>";
            // Añadimos la foto de perfil con un input oculto para cambiar la foto
            $salida .= "<img id='perfilFoto' src='" . $foto . "' alt='Foto de perfil' class='perfil-foto' onclick='document.getElementById(\"inputFoto\").click();'>";
            $salida .= "<input type='file' id='inputFoto' style='display: none;' onchange='cambiarFotoAdmi()'>";
        }
        // Si no es administrador ni superadministrador, mostramos la opción sin título de administrador
        else {
            $salida .= "<img id='perfilFoto' src='" . $foto . "' alt='Foto de perfil' class='perfil-foto' onclick='document.getElementById(\"inputFoto\").click();'>";
            $salida .= "<input type='file' id='inputFoto' style='display: none;' onchange='cambiarFoto()'>";
        }
        
        // Cerramos el contenedor de la foto de perfil
        $salida .= "</div>";
        
        // Añadimos los datos personales del usuario
        $salida .= "<div class='perfil-datos'>";
        $salida .= "<div class='perfil-item'><span>Documento:</span> " . $fila['documento'] . "</div>";
        $salida .= "<div class='perfil-item'><span>Nombre:</span> " . $fila['nombre'] . "</div>";
        $salida .= "<div class='perfil-item'><span>Apellido:</span> " . $fila['apellido'] . "</div>";
        $salida .= "<div class='perfil-item'><span>Correo:</span> " . $fila['correo'] . "</div>";
        $salida .= "<div class='perfil-item'><span>Fecha de nacimiento:</span> " . $fila['fecha'] . "</div>";
        
        // Si el usuario tiene un rol de administrador (0) o usuario (1), mostramos opciones para editar o eliminar la cuenta
        if (Loguin::verRol($id) == 0 or Loguin::verRol($id) == 1) {
            $salida .= "<a class='btn btn-success' href='../admi/ctroBar.php?seccion=actuUser' role='button'><i class='fa fa-pencil-alt'></i> Editar</a><br>";
            $salida .= "<a class='btn btn-danger' href='../usuarios/ctroBar.php?seccion=ctroAdmi&eliCuenta=true'><i class='fas fa-trash-alt'></i> Eliminar cuenta</a>";
        } else {
            // Si no es administrador, muestra las opciones de usuario regular
            $salida .= "<a class='btn btn-success' href='../usuarios/conBaBus.php?seccion=actuUser' role='button'><i class='fa fa-pencil-alt'></i> Editar</a><br>";
            $salida .= "<a class='btn btn-danger' href='../usuarios/conBaBus.php?seccion=ctroUser&eliCuenta=true'><i class='fas fa-trash-alt'></i> Eliminar cuenta</a>";
        }
        
        // Cerramos el contenedor de los datos del perfil
        $salida .= "</div>";
    }
    
    // Cerramos el contenedor principal del perfil
    $salida .= "</div>";
    
    // Retornamos el HTML del perfil del usuario
    return $salida;
    $conexion->close();
}

    /**
 * Función para mostrar los deseos de un usuario con la opción de eliminarlos.
 *
 * Esta función recupera los deseos almacenados de un usuario en la base de datos 
 * y genera el HTML correspondiente para mostrar una lista de deseos, 
 * cada uno con su imagen de referencia y la opción para eliminarlo.
 *
 * @param int $documento_usuario El documento de identificación del usuario.
 * @return string Retorna el HTML generado con la lista de deseos del usuario.
 */
public static function mostrarDeseosConEliminar($documento_usuario) {
    include_once("modelo.php"); // Incluir el archivo del modelo para las consultas a la base de datos

    // Obtener los deseos del usuario a partir de su documento
    $deseos = Modelo::obtenerDeseosUsuario($documento_usuario);
    
    // Inicializar la variable de salida donde se almacenará el HTML resultante
    $salida = ""; 
    
    // Verificar si el usuario tiene deseos guardados
    if ($deseos) {
        // Iniciar el contenedor principal para la lista de deseos
        $salida .= "<div class='lista-deseos'>";
        
        // Iterar sobre cada deseo recuperado de la base de datos
        while ($deseo = mysqli_fetch_assoc($deseos)) {
            // Iniciar el contenedor para cada deseo
            $salida .= "<div class='deseo'>";
            
            // Mostrar el nombre del producto en un título
            $salida .= "<h3>" . $deseo['nombre_producto'] . "</h3>";
            
            // Mostrar la fecha de creación del deseo
            $salida .= "<p>Fecha de creación: " . $deseo['fecha_creacion'] . "</p>";
            
            // Obtener las imágenes de referencia (separadas por comas) y almacenarlas en un arreglo
            $imagenes = explode(',', $deseo['foto_referencia']);
            
            // Iniciar el contenedor para mostrar las imágenes del deseo
            $salida .= "<div class='imagenes-deseo'>";
            
            // Iterar sobre cada imagen y generar la etiqueta <img> correspondiente
            foreach ($imagenes as $imagen) {
                $salida .= "<img src='../img/$imagen' alt='Imagen de referencia'>";
            }
            
            // Cerrar el contenedor de las imágenes
            $salida .= "</div>";
            
            // Añadir un enlace para eliminar el deseo, pasando el ID del deseo como parámetro en la URL
            $salida .= "<a class='btn-eliminar' href='../method/controladorDeseo.php?accion=eliminar&id_deseo=" . $deseo['id_deseo'] . "'>Eliminar</a>";
            
            // Cerrar el contenedor del deseo
            $salida .= "</div>";
        }
        
        // Cerrar el contenedor principal de la lista de deseos
        $salida .= "</div>";
    }
    
    // Retornar la salida con el HTML generado
    return $salida; 
    $conexion->close();
}
}
