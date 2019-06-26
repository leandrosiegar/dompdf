<?php
require_once 'dompdf-master/lib/html5lib/Parser.php';
require_once 'dompdf-master/src/Autoloader.php';

Dompdf\Autoloader::register();

use Dompdf\Dompdf;

$html = file_get_contents("invoice_header.html");
$table_head = true;

for($i=1;$i<100;$i++) {
    if($table_head) {
        $html .= file_get_contents("invoice_table_head.html"); // la cabecera de las columnas para cada pag
        $table_head = false;
    }

    $html .= "
        <tr>
            <td class='service'>aaa ".$i."</td>
            <td class='desc'>bbb ".$i."</td>
            <td class='unit'>ccc ".$i."</td>
        </tr>";
}

$html .= "
        <tr>
            <td style='background: #9c6c38;' class='service'>Total: ".$i." Registros</td>
            <td style='background: #9c6c38;' class='desc'>-----</td>
            <td style='background: #9c6c38;' class='unit'>----</td>
        </tr>";
		
  
$dompdf = new Dompdf();
$dompdf->loadHtml($html);

$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream();