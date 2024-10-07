
<?php
include_once("../method/factura_class.php");

if (isset($_GET['id'])) {
    $idFactura = $_GET['id'];
    echo Factura::mostrarFactura($idFactura);
} else {
    echo "No se ha proporcionado el ID de la factura.";
}
?>
