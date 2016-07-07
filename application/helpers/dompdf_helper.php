<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
function pdf_create($html, $filename='', $stream=TRUE) 
{
    require_once ("dompdf/dompdf_config.inc.php");
	date_default_timezone_set('America/Sao_Paulo');
	//$html = utf8_decode($html);
    $paper['size'] = 'A4';
    $paper['orientation'] = 'landscape';
    $dompdf = new DOMPDF();
    $dompdf->load_html($html);
    $dompdf->render();
    $dompdf->set_paper($paper);
    if ($stream) {
        $dompdf->stream($filename.".pdf");
    } else {
        return $dompdf->output();
    }
}
?>
