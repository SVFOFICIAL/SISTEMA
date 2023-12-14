<?php

require_once('../dompdf/vendor/autoload.php');

use Dompdf\Dompdf;
function criaContrato($termo){

  
  $dompdf = new Dompdf();
  $dompdf->loadHtml($termo);
  $dompdf->setPaper('A4', 'portrait');
  $dompdf->render();
  $output = $dompdf->output();
  file_put_contents('contrato.pdf', $output);  
  if(file_get_contents('contrato.pdf')){
    return true;
  }else{
    return false;
  }
}

?>