<?php
require_once '../vendor/autoload.php';
require_once '../models/Producto.php';

use Spipu\Html2Pdf\Html2Pdf; 
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

try {
    $productos = new Productos();

    $data = $productos->productos_listar();    


    ob_start();


    //Archivos que componen el PDF
    include './estilosInventario.html';
    include './inventario.data.php';

    $content = ob_get_clean();

    $html2pdf = new Html2Pdf('P', 'A4', 'es');
    $html2pdf->writeHTML($content);
    $html2pdf->output('Reporte-Inventario.pdf');
} catch (Html2PdfException $e) {
    $html2pdf->clean();

    $formatter = new ExceptionFormatter($e);
    echo $formatter->getHtmlMessage();
}   