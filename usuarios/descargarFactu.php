<?php
require 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;

$idFactura = $_GET['idFactura'];

// Generar el contenido HTML de la factura
include_once("../method/factura_class.php");
$html = Factura::mostrarFactura($idFactura);

// Crear una instancia de Dompdf
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// Enviar el PDF al navegador para descarga
$dompdf->stream("factura_$idFactura.pdf", array("Attachment" => true));
?>
