<?php
require_once 'dompdf-master/lib/html5lib/Parser.php';
require_once 'dompdf-master/src/Autoloader.php';


function getRemoteFile($url, $timeout = 10) {
  $ch = curl_init();
  curl_setopt ($ch, CURLOPT_URL, $url);
  curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
  $file_contents = curl_exec($ch);
  curl_close($ch);
  return ($file_contents) ? $file_contents : FALSE;
}

Dompdf\Autoloader::register();
use Dompdf\Dompdf;
use Dompdf\Options;

$dompdf = new Dompdf();
$options = new Options();

$options->set('isRemoteEnabled', TRUE);
$dompdf = new Dompdf($options);
$html = getRemoteFile("http://localhost/pruebas/pdf/htmltopdf/pagina_html3.php");

$dompdf->loadHtml($html);

$dompdf->setPaper('A4', '');
$dompdf->render();
$dompdf->stream();