<?php

$login = new Login(3);

if(!$login->CheckLogin()):
  unset($_SESSION['userlogin']);
  header("Location: {$site}");
else:
  $userlogin = $_SESSION['userlogin'];
endif;

$logoff = filter_input(INPUT_GET, 'logoff', FILTER_VALIDATE_BOOLEAN);

if(!empty($logoff) && $logoff == true):
  $updateacesso = new Update;
  $dataEhora    = date('d/m/Y H:i');
  $ip           = get_client_ip();
  $string_last = array("user_ultimoacesso" => " Último acesso em: {$dataEhora} IP: {$ip} ");
  $updateacesso->ExeUpdate("ws_users", $string_last, "WHERE user_id = :uselast", "uselast={$userlogin['user_id']}");

  unset($_SESSION['userlogin']);
  header("Location: {$site}");
endif;

$meses = array(
  '01'=>'Janeiro',
  '02'=>'Fevereiro',
  '03'=>'Março',
  '04'=>'Abril',
  '05'=>'Maio',
  '06'=>'Junho',
  '07'=>'Julho',
  '08'=>'Agosto',
  '09'=>'Setembro',
  '10'=>'Outubro',
  '11'=>'Novembro',
  '12'=>'Dezembro'
);


$pegaMesGet = filter_input(INPUT_GET, 'm', FILTER_VALIDATE_INT);
$mesgett = '';
if(!empty($pegaMesGet) && ($pegaMesGet == '01' || $pegaMesGet == '02' || $pegaMesGet == '03' || $pegaMesGet == '04' || $pegaMesGet == '05' || $pegaMesGet == '06' || $pegaMesGet == '07' || $pegaMesGet == '08' || $pegaMesGet == '09' || $pegaMesGet == '10' || $pegaMesGet == '11' || $pegaMesGet == '12')):
  $mesgett = $pegaMesGet;
else:
 $mesgett = date('m');
endif;
?>
<div class="container margin_60"> 

<div class="flex row">
<button type="button" class="px-6 py-3.5 text-base font-medium text-white inline-flex items-center bg-gray-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
  <svg class="w-4 h-4 text-white mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
    <path d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z"/>
    <path d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z"/>
  </svg>
  Configurações
</button>
<div>
</div>


<?php
require('configchart.php');
?>
