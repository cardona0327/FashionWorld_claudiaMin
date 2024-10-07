<?php
session_start();
include '../method/db_fashion/cb.php';

if (isset($_POST['id']) && is_numeric($_POST['id'])) {
    $id_producto = intval($_POST['id']);
    
    // Consulta para obtener el producto de la base de datos
    $sql = "SELECT nombre_producto FROM tb_productos WHERE id_producto = ?";
    if ($stmt = $conexion->prepare($sql)) {
        $stmt->bind_param('i', $id_producto);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($producto = $resultado->fetch_assoc()) {
            $nombre_producto = $producto['nombre_producto'];

            // Consulta para verificar si el producto ya está en favoritos
            $sql_check = "SELECT id_favo, cantidad_fav FROM tb_favoritos WHERE nombre_produc = ?";
            if ($stmt_check = $conexion->prepare($sql_check)) {
                $stmt_check->bind_param('s', $nombre_producto);
                $stmt_check->execute();
                $result_check = $stmt_check->get_result(); 

                if ($favorito_item = $result_check->fetch_assoc()) {
                    $nueva_cantidad = $favorito_item['cantidad_fav'] + 1;
                    $sql_update = "UPDATE tb_favoritos SET cantidad_fav = ? WHERE id_favo = ?";
                    if ($stmt_update = $conexion->prepare($sql_update)) {
                        $stmt_update->bind_param('ii', $nueva_cantidad, $favorito_item['id_favo']);
                        $stmt_update->execute();
                        echo json_encode(['status' => 'success', 'message' => 'Cantidad del producto actualizada en favoritos']);
                    }
                } else {
                    // Si el producto no está en favoritos, insertarlo
                    $sql_insert = "INSERT INTO tb_favoritos (nombre_produc, cantidad_fav) VALUES (?, 1)";
                    if ($stmt_insert = $conexion->prepare($sql_insert)) {
                        $stmt_insert->bind_param('s', $nombre_producto);
                        $stmt_insert->execute();
                        echo json_encode(['status' => 'success', 'message' => 'Producto añadido a favoritos']);
                    }
                }
            }
        }   
    }
}
?>
