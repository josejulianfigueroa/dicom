<?php
$html = '<table style="padding: 1px">
  <tr><td colspan="3" style="text-align: left ; margin-left: 30;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img style="height: 61px;
    width: 100px;" src="imgs/logo.png" /></td></tr>
        <tr><td colspan="3" style="text-align: left; font-weight: bold"></td></tr>
  <tr><td colspan="3" style="text-align: left; font-weight: bold">Fecha: '.  date("d-m-Y",strtotime($fecha)) .'&nbsp;&nbsp;&nbsp;Hora: ' . date("h:i:s",strtotime($fecha)) .'</td></tr>
    <tr><td colspan="3" style="text-align: left; font-weight: bold">Usuario: '.$nombre_usuario.'</td></tr>
    <tr><td colspan="3" style="text-align: left; font-weight: bold"></td></tr>
    <tr><td colspan="3"  style="font-weight: bold">--COMPROBANTE DE PAGO N°'.$control.'-'. date("Y",strtotime($fecha)).'--</td></tr>
    <tr><td colspan="3" style="text-align: left; font-weight: bold"></td></tr>
    <tr><td colspan="3" style="text-align: left; font-weight: bold">Sr.(a):'. $nombre.'</td></tr>
    <tr><td colspan="3" style="text-align: left; font-weight: bold">R.U.T.:'.number_format(ltrim($rut, "0"), 0, ",", ".") . "-" . $dv.'</td></tr>
      <tr><td colspan="3" style="text-align: left; font-weight: bold">Tipo Cartera: '.$idcliente.' </td> </tr>
    <tr><td colspan="3" style="text-align: left; font-weight: bold">Cuenta: '.$cuenta.', &nbsp;'.$banco.'</td>
     </tr>
    <tr><td colspan="3" style="text-align: left; font-weight: bold"></td></tr>
    <tr><td colspan="3"  style="font-weight: bold">--------------DETALLE DEL PAGO--------------</td></tr>
    <tr><td colspan="3" style="text-align: left; font-weight: bold"></td></tr>
    <tr><td colspan="3" style="text-align: left; font-weight: bold">Monto Pago: $ '. number_format($otro_monto1, 0, ",", ".") . " .-".'</td></tr>

     <tr><td colspan="3" style="text-align: left; font-weight: bold">'.$tipo.': $ '. number_format($otro_monto2, 0, ",", ".") . " .-".'</td></tr>
     <tr><td colspan="3" style="text-align: left; font-weight: bold">Vuelto:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$ '. number_format($otro_monto3, 0, ",", ".") . " .-".'</td></tr>
    <tr><td colspan="3" style="text-align: left; font-weight: bold">Fecha Pago: '.$fecha.'</td></tr>
     <tr><td colspan="3" style="text-align: left; font-weight: bold"></td></tr>
     <tr><td colspan="3" style="text-align: left; font-weight: bold"></td></tr>
     <tr><td colspan="3" style="text-align: left; font-weight: bold"></td></tr>
     <tr><td colspan="3" style="text-align: left; font-weight: bold"></td></tr>
    <tr><td colspan="3" style="text-align: left; font-weight: bold">'.str_pad(".", 78, ".").'</td></tr>
    <tr><td colspan="3" style="text-align: left; font-weight: bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Firma y Timbre Caja&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
<tr><td colspan="3" style="text-align: left; font-weight: bold"><p>Este comprobante sólo es válido con timbre y</p></td></tr>
    <tr><td colspan="3" style="text-align: left; font-weight: bold"><p>firma de caja</p></td></tr>
     <tr><td colspan="3" style="text-align: left; font-weight: bold"></td></tr>
       <tr><td colspan="3" style="text-align: left; font-weight: bold">COPIA ARCHIVO</td></tr>
        <tr><td colspan="3" style="text-align: left; font-weight: bold">.</td></tr>
</table>';

$html2 = '<table style="padding: 1px">
  <tr><td colspan="3" style="text-align: left ; margin-left: 30;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img style="height: 61px;
    width: 100px;" src="imgs/logo.png" /></td></tr>
        <tr><td colspan="3" style="text-align: left; font-weight: bold"></td></tr>
  <tr><td colspan="3" style="text-align: left; font-weight: bold">Fecha: '.  date("d-m-Y",strtotime($fecha)) .'&nbsp;&nbsp;&nbsp;Hora: ' . date("h:i:s",strtotime($fecha)) .'</td></tr>
    <tr><td colspan="3" style="text-align: left; font-weight: bold">Usuario: '.$nombre_usuario.'</td></tr>
    <tr><td colspan="3" style="text-align: left; font-weight: bold"></td></tr>
    <tr><td colspan="3"  style="font-weight: bold">--COMPROBANTE DE PAGO N°'.$control.'-'. date("Y",strtotime($fecha)).'--</td></tr>
    <tr><td colspan="3" style="text-align: left; font-weight: bold"></td></tr>
    <tr><td colspan="3" style="text-align: left; font-weight: bold">Sr.(a):'. $nombre.'</td></tr>
    <tr><td colspan="3" style="text-align: left; font-weight: bold">R.U.T.:'.number_format(ltrim($rut, "0"), 0, ",", ".") . "-" . $dv.'</td></tr>
      <tr><td colspan="3" style="text-align: left; font-weight: bold">Tipo Cartera: '.$idcliente.' </td> </tr>
    <tr><td colspan="3" style="text-align: left; font-weight: bold">Cuenta: '.$cuenta.', &nbsp;'.$banco.'</td>
     </tr>
    <tr><td colspan="3" style="text-align: left; font-weight: bold"></td></tr>
    <tr><td colspan="3"  style="font-weight: bold">--------------DETALLE DEL PAGO--------------</td></tr>
    <tr><td colspan="3" style="text-align: left; font-weight: bold"></td></tr>
    <tr><td colspan="3" style="text-align: left; font-weight: bold">Monto Pago: $ '. number_format($otro_monto1, 0, ",", ".") . " .-".'</td></tr>

     <tr><td colspan="3" style="text-align: left; font-weight: bold">'.$tipo.': $ '. number_format($otro_monto2, 0, ",", ".") . " .-".'</td></tr>
     <tr><td colspan="3" style="text-align: left; font-weight: bold">Vuelto:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$ '. number_format($otro_monto3, 0, ",", ".") . " .-".'</td></tr>
    <tr><td colspan="3" style="text-align: left; font-weight: bold">Fecha Pago: '.$fecha.'</td></tr>
     <tr><td colspan="3" style="text-align: left; font-weight: bold"></td></tr>
     <tr><td colspan="3" style="text-align: left; font-weight: bold"></td></tr>
     <tr><td colspan="3" style="text-align: left; font-weight: bold"></td></tr>
     <tr><td colspan="3" style="text-align: left; font-weight: bold"></td></tr>
    <tr><td colspan="3" style="text-align: left; font-weight: bold">'.str_pad(".", 78, ".").'</td></tr>
    <tr><td colspan="3" style="text-align: left; font-weight: bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Firma y Timbre Caja&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
    <tr><td colspan="3" style="text-align: left; font-weight: bold"><p>Este comprobante sólo es válido con timbre y</p></td></tr>
    <tr><td colspan="3" style="text-align: left; font-weight: bold"><p>firma de caja</p></td></tr>
     <tr><td colspan="3" style="text-align: left; font-weight: bold"></td></tr>
     <tr><td colspan="3" style="text-align: left; font-weight: bold">COPIA CLIENTE</td></tr>
        <tr><td colspan="3" style="text-align: left; font-weight: bold">.</td></tr>
</table>';


  require_once "lib/tcpdf/tcpdf.php"; 
  //$html = ob_get_contents();
  ob_end_clean();

  $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

  // set document information
  $pdf->SetCreator(PDF_CREATOR);
  $pdf->SetAuthor("Eficaz S.A.");
  $pdf->SetTitle("Comprobante de Pago");
  $pdf->SetSubject("Comprobante de Pago");

  // set default monospaced font
  //$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

  // set margins
  //$pdf->SetMargins(PDF_MARGIN_LEFT, 0, PDF_MARGIN_RIGHT);
  $pdf->SetMargins(5, 5, PDF_MARGIN_RIGHT);
  $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
  $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
  $pdf->SetPrintHeader(false);
  $pdf->SetPrintFooter(false);

  // set auto page breaks
  $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

  // ---------------------------------------------------------

  // set font
  $pdf->SetFont('times', '', 10);

  // add a page
  $pdf->AddPage();

  //$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
  $pdf->writeHTML($html, true, false, true, false, '');

  $pdf->lastPage();

  $pdf->AddPage();

  $pdf->writeHTML($html2, true, false, true, false, '');

  $pdf->lastPage();

  // ---------------------------------------------------------

  //Close and output PDF document
 // $pdf->Output("certificado_termino_deuda_" . $convenio["rut"] . ".pdf", "D");
  $pdf->Output("comprobante_pago_".$rut.".pdf", "D");
?>