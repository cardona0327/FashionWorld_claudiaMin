
<?php
session_start();
include '../method/db_fashion/cb.php';


if (isset($_GET['mensaje'])) {
    echo "<p>" . htmlspecialchars($_GET['mensaje']) . "</p>";
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_producto = intval($_GET['id']);
    
    // Consulta para eliminar el producto de la tabla de favoritos
    $sql = "DELETE FROM tb_favoritos WHERE id_favo = ?";
    
    if ($fila = $conexion->prepare($sql)) {
        $fila->bind_param('i', $id_producto);
        $fila->execute();
        
        if ($fila->affected_rows > 0) {
            echo "<script>
                    localStorage.setItem('mensaje', 'Producto eliminado de favoritos');
                    window.location.href = 'conBaBus.php?seccion=favoritos';
                  </script>";       
        } else {
            echo "<script>a
                    localStorage.setItem('mensaje', 'Error al eliminar producto');
                    window.location.href = 'conBaBus.php?seccion=favoritos';
                  </script>";

        }
    }
}
?>
