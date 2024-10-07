<h2>Detalles de la Factura</h2>
<?php
include_once("../method/factura_class.php");

if (isset($_GET['idFactura'])) {
    $idFactura = $_GET['idFactura'];
    echo Factura::mostrarDetallesFactura($idFactura);
} else {
    echo "No se ha proporcionado el ID de la factura.";
}
?>
<br>
<a href='conBaBus.php?seccion=factura&id=<?php echo $idFactura; ?>' class='btn btn-primary'>Terminar</a>
