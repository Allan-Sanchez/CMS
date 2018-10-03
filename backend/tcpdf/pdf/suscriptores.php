<?php

require_once "../../controllers/gestorSuscriptores.php";
require_once "../../models/gestorSuscriptores.php";

class ImpresionSuscriptores{

public function imprimirSuscriptores(){

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->AddPage();

$html = <<<EOF

<table>
        <tr>
            <td style="width:540px"><img src="images/back.jpg"></td>
        </tr>
        <tr>
            <td style="width:200px"></td>
            <td style="width:140px"><img src="images/logotipo.jpg"></td>
            <td style="width:200px"></td>
        </tr>
</table>
<table style="border:1px solid #333; text-align:center; line-height:20px; font-size:10px">
        <tr>
            <td style="border: 1px solid #666; background-color:#333; color:#fff">Nombre</td>
            <td style="border: 1px solid #666; background-color:#333; color:#fff">Correo</td>
        </tr>
    </table>

EOF;

$pdf->writeHTML($html, false, false, false, false, '');

$respuesta = SuscriptoresController::imprimirSuscriptoresController("suscriptores");

foreach ($respuesta as $row => $item) {

$html2 = <<<EOF
<table style="border:1px solid #333; text-align:center; line-height:20px; font-size:10px">
        <tr>
            <td style="border: 1px solid #666; ">$item[nombre]</td>
            <td style="border: 1px solid #666; ">$item[correo]</td>
        </tr>
    </table>

EOF;

$pdf->writeHTML($html2, false, false, false, false, '');
}

$pdf->Output('suscriptores.pdf');


}


}

$impresion = new ImpresionSuscriptores();
$impresion -> imprimirSuscriptores();


?>