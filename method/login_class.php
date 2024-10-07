<?php

class Loguin{

    /**
 * Método para verificar las credenciales de un usuario
 *
 * @param string $documento Documento del usuario que intenta iniciar sesión.
 * @param string $contraseña Contraseña ingresada por el usuario.
 * @return bool Verdadero si las credenciales son correctas, falso en caso contrario.
 */
public static function verificaUsuarios($documento, $contraseña) {
    // Incluir la conexión o modelo
    include_once("modelo.php");

    // Recuperar el hash de la contraseña almacenada en la base de datos
    $consulta = Modelo::sqlLoguin($documento);

    if ($consulta) {
        $hashAlmacenado = $consulta['contraseña'];

        // Verificar si la contraseña ingresada coincide con el hash almacenado
        if (password_verify($contraseña, $hashAlmacenado)) {
            return true; // Contraseña correcta
        } else {
            return false; // Contraseña incorrecta
        }
    } else {
        return false; // Usuario no encontrado
    }
}
/**
 * Método para registrar un nuevo usuario en el sistema
 *
 * @param string $documento Documento del usuario que se va a registrar.
 * @param string $nombre Nombre del usuario que se va a registrar.
 * @param string $apellido Apellido del usuario que se va a registrar.
 * @param string $correo Correo electrónico del usuario que se va a registrar.
 * @param string $contraseña Contraseña elegida por el usuario, que será encriptada.
 * @param string $fecha Fecha de registro del usuario.
 * @return int 2 si el registro fue exitoso, 0 si hubo un error.
 */
public static function registraUsuarios($documento, $nombre, $apellido, $correo, $contraseña, $fecha) {
    include_once("modelo.php");
    $salida = 0;

    // Configuración para password_hash (nota: el tercer parámetro es ignorado para PASSWORD_DEFAULT)
    $cont = [
        "cost" => 12
    ];

    // Encriptar la contraseña utilizando password_hash
    $contraEncrip = password_hash($contraseña, PASSWORD_DEFAULT, $cont);

    // Registrar al usuario en la base de datos
    $consulta = Modelo::sqlRegistar($documento, $nombre, $apellido, $correo, $contraEncrip, $fecha);
    
    if ($consulta) {
        $salida = 2; // Registro exitoso
    } else {
        echo "Error en el registro"; // Mensaje de error en caso de fallo
    }
    return $salida; // Retornar el estado del registro
}
/**
 * Método para obtener el rol de un usuario a partir de su ID
 *
 * @param int $id ID del usuario del cual se desea obtener el rol.
 * @return int ID del rol asociado al usuario, o 0 si no se encuentra.
 */
public static function verRol($id) {
    include_once("modelo.php");
    $salida = 0; // Variable para almacenar el rol del usuario
    $consulta = Modelo::sqlRol($id); // Ejecuta la consulta para obtener el rol del usuario

    while ($fila = $consulta->fetch_array()) {
        $salida = $fila[0]; // Asigna el rol encontrado a la variable salida
    }
    
    return $salida; // Retorna el rol del usuario o 0 si no se encontró
}
}