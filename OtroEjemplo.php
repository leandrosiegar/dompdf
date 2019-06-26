<?php
require_once 'dompdf-master/lib/html5lib/Parser.php';
require_once 'dompdf-master/src/Autoloader.php';

Dompdf\Autoloader::register();
use Dompdf\Dompdf;
use Dompdf\Options;

$dompdf = new Dompdf();
$options = new Options();

$options->set('isRemoteEnabled', TRUE);
$dompdf = new Dompdf($options);
// las imágenes en prueba.html deben ser rutas absolutas
$html = file_get_contents("pagPrueba.html");

$dompdf->loadHtml($html);

$dompdf->setPaper('A4', '');
$dompdf->render();
$dompdf->stream();