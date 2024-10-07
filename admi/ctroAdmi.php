<?php
include_once("../method/productos_class.php");
include_once('../method/usuarios_class.php');
include_once('../method/login_class.php');
include_once('../method/modelo.php');
include_once('../method/funcionPro.php');
if(!isset($_SESSION))session_start();

//esto es para crear un producto
if(isset($_POST['crear'])){
    $id_categoria = $_POST['id_categoria'];
    $nombre = FuncionPro::vacunaXxs($_POST['nombre']);
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];
    $descripcion =  FuncionPro::vacunaXxs($_POST['descripcion']);
    $color = $_POST['color'];
    $tallas =  FuncionPro::vacunaXxs($_POST['tallas']);
    $imagen = $_FILES['imagen'];
    

    if (!empty($_FILES['imagen']['name'])) {
        $imagen = "../img/" . basename($_FILES['imagen']['name']);
        move_uploaded_file($_FILES['imagen']['tmp_name'], $imagen);
    }

    if(Productos::agregarPro($nombre, $precio, $cantidad, $descripcion, $color, $tallas, $imagen, $id_categoria) == 1){
        header("location:ctroBar.php?seccion=verPro");
    }

}



//esto es para agregar una categoria
if(isset($_GET['agreCate'])){
    $id_categoria = $_POST['id_categoria'];
    $categoria =  FuncionPro::vacunaXxs($_POST['categoria']);
    Productos::agregarCate($id_categoria,$categoria);
} 

//esto es para eliminar categoria
if(isset($_GET['idCateEliminar'])){
    if(Productos::eliminarCate($_GET['idCateEliminar'])==1){
        echo Productos::mostrarCate(); 
    }else{
        echo 0;
    }
}

//Elimina producto
if(isset($_GET['idProEliminar'])){
    // echo $_GET['idProEliminar'];
    if(Productos::eliminarPro($_GET['idProEliminar'])==1){
        echo Productos::mostrarPro(); 
    }else{
        echo 0;
    }
}

//Actualizar categoria
if(isset($_GET['ediCate'])){
    $categoria =  FuncionPro::vacunaXxs($_POST['categoria']);
    $id_categoria = $_GET['dato'];
    if(Productos::editarCategoria($id_categoria,$categoria)==1){
        header("location:ctroBar.php?seccion=verCate");
    }
}

if(isset($_GET['bou'])){
    $id = $_POST['documento'];
    if(Productos::eliminarUser($id)==1){
        header("location:login.php");
    }
}

if (isset($_GET['ediPro'])) {
    $id_producto = $_GET['dato'];
    $nombre =  FuncionPro::vacunaXxs($_POST['nombre']);
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];
    $detalles =  FuncionPro::vacunaXxs($_POST['detalles']);
    $color = $_POST['color'];
    $tallas =  FuncionPro::vacunaXxs($_POST['tallas']);
    
    // Manejo de la imagen
    if (!empty($_FILES['imagen']['name'])) {
        $imagen_nombre = $_FILES['imagen']['name'];
        $imagen_tmp = $_FILES['imagen']['tmp_name'];
        $ruta_imagen = '../img/' . $imagen_nombre;

        // Subir la nueva imagen
        move_uploaded_file($imagen_tmp, $ruta_imagen);
    } else {
        // Si no se sube nueva imagen, usar la actual
        $ruta_imagen = Productos::datoPro(7, $id_producto);
    }

    // Actualizar producto en la base de datos
    if (Productos::editarProducto($id_producto, $nombre, $precio, $cantidad, $detalles, $color, $tallas, $ruta_imagen) == 1) {
        header("Location: ctroBar.php?seccion=verPro");
        exit();
    } else {
        echo 'Error al actualizar el producto.';
    }
}


if(isset($_GET['eli']) && $_GET['eli'] == 'true'){
    header("location:ctroBar.php?seccion=verConteoUserEli");
        
}

if(isset($_GET['reg'])){
    header("location:ctroBar.php?seccion=verConteoUserReg");
}
if(isset($_GET['actu'])){
    header("location:ctroBar.php?seccion=verConteoUserActu");
}

if(isset($_GET['eliPro'])){
    header("location:ctroBar.php?seccion=verConteoProEli");
        
}

if(isset($_GET['regPro'])){
    header("location:ctroBar.php?seccion=verConteoProReg");
}
if(isset($_GET['actuPro'])){
    header("location:ctroBar.php?seccion=verConteoProActu");
}

if (isset($_GET['buscarU']) && $_GET['buscarU'] == 'true') {
    if (isset($_POST['busqueda'])) {
        $busqueda = $_POST['busqueda'];
        echo Productos::buscarUsuario(1, $busqueda);
    } else {
        echo "Parámetro de búsqueda no proporcionado.";
    }
}

if(isset($_GET['IDbuscar'])){
    echo Productos::mostrarUsuarios($_GET['IDbuscar']);
    
}

if(isset($_GET['eliCuenta'])){
    if(Usuarios::eliminarCuentaUser($_SESSION['id'])){
        header("location:../index.php");
    }
}

if(isset($_GET['ediUser'])) {
    if(isset($_GET['dato'])) {
        $idUser = $_GET['dato'];
        $nombre =  FuncionPro::vacunaXxs($_POST['nombre']);
        $apellido =  FuncionPro::vacunaXxs($_POST['apellido']);
        $correo =  FuncionPro::vacunaXxs($_POST['correo']);
        if(Productos::actualizarUser($idUser, $nombre, $apellido, $correo)==1) {
            header("location: ctroBar.php?seccion=perfilAdmi");
        }
    }
}

if(isset($_GET['ediRol'])) {
    if(isset($_GET['dato'])) {
        $idUser = $_GET['dato'];
        $rol = $_POST['rol'];
        if(Productos::actuRol($idUser,$rol)==1) {
            header("location: ctroBar.php?seccion=mostrarUser");
        }
    }
}


if (isset($_POST['cambiarfoto']) && $_POST['cambiarfoto'] === 'true') {
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['foto']['tmp_name'];
        $fileName = $_FILES['foto']['name'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $newFileName = uniqid() . '.' . $fileExtension; // Genera un nombre único para evitar conflictos
        $uploadFileDir = '../img/';
        $dest_path = $uploadFileDir . $newFileName;

        $id_admin = $_SESSION['id'];

        // Obtener la foto actual del usuario
        $consulta = Modelo::sqlPerfil($id_admin);
        $fila = $consulta->fetch_assoc();
        $fotoAnterior = $fila['foto'];

        // Eliminar la imagen anterior si existe
        if (!empty($fotoAnterior) && file_exists($uploadFileDir . $fotoAnterior)) {
            unlink($uploadFileDir . $fotoAnterior);
        }

        // Mover la nueva imagen al servidor
        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            // Actualizar la base de datos con la nueva imagen
            if (Modelo::sqlActuFoto($newFileName, $id_admin)) {
                // Devuelve la ruta completa para actualizar la imagen en la interfaz
                echo $uploadFileDir . $newFileName;  
            } else {
                echo 'Error al actualizar la base de datos';
            }
        } else {
            echo 'Error al mover el archivo';
        }
    } else {
        echo 'Error en la carga del archivo';
    }
}
   


   