<?php
include_once("login_class.php");
include_once('funcionPro.php');
if(!isset($_SESSION))session_start();
if(!isset($_SESSION['id']))$_SESSION['id'] = 0;



// Inicializar variables de sesión para manejo de intentos fallidos y bloqueo
if (!isset($_SESSION['intentos_fallidos'])) {
    $_SESSION['intentos_fallidos'] = array();
}
if (!isset($_SESSION['bloqueado_hasta'])) {
    $_SESSION['bloqueado_hasta'] = array();
}

if (isset($_GET['recorrido'])) {
    $recorrido = intval($_GET['recorrido']);
    $documento = isset($_POST['documento']) ? $_POST['documento'] : '';
    $contraseña = isset($_POST['contraseña']) ? FuncionPro::vacunaXxs($_POST['contraseña']) : '';

    // Verificar si la cuenta está bloqueada
    if ($documento && isset($_SESSION['bloqueado_hasta'][$documento])) {
        if ($_SESSION['bloqueado_hasta'][$documento] > time()) {
            $tiempo_restante = $_SESSION['bloqueado_hasta'][$documento] - time();
            header("Location: ../login.php?error=blocked&tiempo=$tiempo_restante");
            exit();
        } else {
            // Si el tiempo de bloqueo ha pasado, desbloquear la cuenta
            unset($_SESSION['bloqueado_hasta'][$documento]);
        }
    }

    if ($recorrido == 1) {
        if ($_POST['captcha'] !== $_SESSION['captcha_text']) {
            header("location:../login.php?error=captcha");
            exit;
            }
        if (Loguin::verificaUsuarios($documento, $contraseña)) {
            // Reiniciar los intentos fallidos en caso de inicio de sesión exitoso
            unset($_SESSION['intentos_fallidos'][$documento]);
            $_SESSION['id'] = $documento;

            // Redirigir según el rol del usuario
            if (Loguin::verRol($_SESSION['id']) == 2) {
                header("Location: ../usuarios/conBaBus.php");
                exit(); // Asegúrate de llamar a exit() después de redirigir
            } elseif (Loguin::verRol($_SESSION['id']) == 0 or Loguin::verRol($_SESSION['id']) == 1) {
                header("Location: ../admi/ctroBar.php");
                exit(); // Asegúrate de llamar a exit() después de redirigir
            }
        } else {
            // Incrementar los intentos fallidos solo si el usuario no está bloqueado
            if (!isset($_SESSION['bloqueado_hasta'][$documento]) || $_SESSION['bloqueado_hasta'][$documento] <= time()) {
                if (!isset($_SESSION['intentos_fallidos'][$documento])) {
                    $_SESSION['intentos_fallidos'][$documento] = 0;
                }
                $_SESSION['intentos_fallidos'][$documento] += 1;

                // Bloquear la cuenta si se alcanzan 3 intentos fallidos
                if ($_SESSION['intentos_fallidos'][$documento] >= 3) {
                    $_SESSION['bloqueado_hasta'][$documento] = time() + 180; // Bloquear por 3 minutos (180 segundos)
                    unset($_SESSION['intentos_fallidos'][$documento]); // Reiniciar el conteo de intentos fallidos
                    $tiempo_restante = $_SESSION['bloqueado_hasta'][$documento] - time();
                    header("Location: ../login.php?error=blocked&tiempo=$tiempo_restante");
                    exit(); // Asegúrate de llamar a exit() después de redirigir
                } else {
                    header("Location: ../login.php?error=1");
                    exit(); // Asegúrate de llamar a exit() después de redirigir
                }
            }
        }
    }

    


    if ($recorrido == 2) {
        $nombre = isset($_POST['nombre']) ? FuncionPro::vacunaXxs($_POST['nombre']) : '';
        $apellido = isset($_POST['apellido']) ? FuncionPro::vacunaXxs($_POST['apellido']) : '';
        $correo = isset($_POST['correo']) ? FuncionPro::vacunaXxs($_POST['correo']) : '';
        $fecha = isset($_POST['fecha']) ? $_POST['fecha'] : '';
        $contraseña = isset($_POST['contraseña']) ? FuncionPro::vacunaXxs($_POST['contraseña']) : '';
    

        $registro = Loguin::registraUsuarios($documento, $nombre, $apellido, $correo, $contraseña, $fecha);
        if($registro == false){
            header("location: ../registrar.php?error=usuario_existente");
            exit();
        }else{
            $_SESSION['id'] = $documento;
            header("location:../usuarios/conBaBus.php");
            exit(); // Asegúrate de llamar a exit() después de redirigir
        }
    }
    
}

// if($registro ==2){
//     $_SESSION['id'] = $documento;
//     header("location:../usuarios/conBaBus.php");
//     exit(); // Asegúrate de llamar a exit() después de redirigir
// }else{
//     echo "No se ha registrado"; // Solo muestra esto si la inserción en la base de datos falla
// }



// if ($recorrido == 2) {
//     $nombre = $_POST['nombre'];
//     $apellido = $_POST['apellido'];
//     $correo = $_POST['correo'];
//     $fecha = $_POST['fecha'];
//     $contraseña = $_POST['contraseña']; // Asegúrate de que esta variable esté definida

//     if (Loguin::registraUsuarios($documento, $nombre, $apellido, $correo, $contraseña, $fecha) == 2) {
//         $_SESSION['id'] = $documento;
//         header("location:../usuarios/conBaBus.php");
//         exit();
//     } else {
//         echo "No se ha registrado";
//     }
// }


// include_once("login_class.php");
// if(!isset($_SESSION))session_start();
// if(!isset($_SESSION['id']))$_SESSION['id'] = 0;


// if (isset($_GET['recorrido'])) {
//     $documento = $_POST['documento'];
//     $contraseña = $_POST['contraseña'];

//     if ($_GET['recorrido'] == 1) {
//         if (Loguin::verificaUsuarios($documento, $contraseña)) {
//             $_SESSION['id'] = $documento;

//             // Redirigir según el rol del usuario
//             if (Loguin::verRol($_SESSION['id']) == 1) {
//                 header("Location: ../usuarios/conBaBus.php");
//                 exit(); // Asegúrate de llamar a exit() después de redirigir
//             } if(Loguin::verRol($_SESSION['id']) == 0) {
//                 header("Location: ../admi/ctroBar.php");
//                 exit(); // Asegúrate de llamar a exit() después de redirigir
//             }
//         } else {
//             // Contraseña incorrecta o usuario no encontrado
//             header("Location: ../login.php?error=1");
//             exit(); // Asegúrate de llamar a exit() después de redirigir
//         }
//     }
    

//     if ($_GET['recorrido'] == 2) {
//         $documento = $_POST['documento'];
//         $nombre = $_POST['nombre'];
//         $apellido = $_POST['apellido'];
//         $correo = $_POST['correo'];
//         $fecha = $_POST['fecha'];
//         $contraseña = $_POST['contraseña']; // Asegúrate de que esta variable esté definida
    
//         if (Loguin::registraUsuarios($documento, $nombre, $apellido, $correo, $contraseña, $fecha) == 2) {
//             $_SESSION['id'] = $documento;
//             header("location:../usuarios/conBaBus.php");
//         } else {
//             echo "no se ha registrado";
//         }
//     }

// }



   