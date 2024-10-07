
<?php
include_once("modelo.php"); // Incluir el archivo con las funciones
include_once('funcionPro.php');

session_start(); // Asegúrate de iniciar la sesión

if (isset($_GET['accion'])) {
    $accion = $_GET['accion'];

    if ($accion == "agregar") {
        $nombre_deseo = FuncionPro::vacunaXxs($_POST['nombre_deseo']); // Cambiar de $_GET a $_POST
        $documento_usuario = $_SESSION['id'];
        $foto_referencia = '';

        // Manejar la subida de imágenes
        if (isset($_FILES['foto_referencia'])) {
            $total_imagenes = count($_FILES['foto_referencia']['name']);
            for ($i = 0; $i < $total_imagenes; $i++) {
                $nombre_imagen = $_FILES['foto_referencia']['name'][$i];
                $ruta_imagen = "../img/" . $nombre_imagen;
                move_uploaded_file($_FILES['foto_referencia']['tmp_name'][$i], $ruta_imagen);
                $foto_referencia .= $nombre_imagen . ","; // Almacenar las imágenes separadas por comas
            }
            $foto_referencia = rtrim($foto_referencia, ','); // Quitar la coma final
        }

        Modelo::agregarDeseo($documento_usuario, $nombre_deseo, $foto_referencia);
        header("Location: ../usuarios/conBaBus.php?seccion=lista_deseos");
    }

    if ($accion == "eliminar") {
        if (isset($_GET['id_deseo'])) {
            $id_deseo = $_GET['id_deseo'];
            var_dump($id_deseo); // Depuración
            Modelo::eliminarDeseo($id_deseo);
            header("Location: ../usuarios/conBaBus.php?seccion=lista_deseos");
        } else {
            echo "Error: No se recibió un ID válido.";
        }
    }
    
}


?>


