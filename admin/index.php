<?php
ob_start();
session_start();

require('../sistema/_app/Config.inc.php');
 
require('../sistema/_app/Mobile_Detect.php');
$detect = new Mobile_Detect;

$site = ADMIN_URL;
$sistema = HOME;
$loginURl = LOGIN;

?>
<!DOCTYPE html>  
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" type="image/png" sizes="16x16" href="../Imagens/FAVICON.PNG">
  <title><?=$texto['nome_site_landing'];?> - Login</title>
  <!-- Bootstrap Core CSS -->
  <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- animation CSS -->
  <link href="css/animate.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link href="css/style.css" rel="stylesheet">
  <link href="<?=$sistema;?>css/style-configuracao.css" rel="stylesheet">
  <link href="<?=$loginURl;?>css/main.css" rel="stylesheet">
  <link href="<?= $sistema; ?>css/tailwind.min.css" rel="stylesheet">
  <!-- color CSS -->
  <link href="css/colors/default.css" id="theme"  rel="stylesheet">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>
<body>
  
  <section id="wrapper" class="flex md:flex-row flex-col new-login-register">
    
      
      <div  id="img-container" style="background-color: #7233a1" class="col-md-6 flex h-screen justify-center items-center p-4">
				
				
				<div  class="flex h-full w-full items-center justify-center container-items" >
					<img style="width:350px;" src="../Imagens/INICIO.png"/>	

						</div>
				</div>
     
     <div class="flex w-full flex-col justify-center">
    <div style="align-self: center;" class=" col-md-6 items-center justify-center container-items">
      <div class="white-box">
        <h3 class="box-title m-b-0">Login do Administrador</h3>
        <small>Preencha os campos abaixo:</small>
        <form class="form-horizontal new-lg-form" method="post">
          <div class="form-group">
           <div class="col-xs-12">
            <?php
           
            $dataLogin = filter_input_array(INPUT_POST, FILTER_DEFAULT);


            if(isset($_SESSION['userlogin'])):
              header("Location: {$site}");
            endif;

            if(isset($_SESSION['administrador'])):
              header("Location: {$site}painel.php");
            endif;
            
            if (!empty($dataLogin) && empty($_SESSION['administrador'])):
              $login = new AdministradorLogin(1);
              $login->ExeLogin($dataLogin);
              if (!$login->getResult()):                                  
                echo "<div class=\"alert alert-info alert-dismissable\">
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">X</button>
                <center>{$login->getError()[0]}</center>
                </div>";
              else:
               header("Location: {$site}painel.php");
             endif;
           endif;

           $get = filter_input(INPUT_GET, 'exe', FILTER_DEFAULT);

           if (!empty($get)):
            if ($get == 'restrito'):
             echo "<div class=\"alert alert-info alert-dismissable\">
             <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">X</button>
             <center><b>OOOPS!</b> Acesso Negado, favor efetue login para acessar o painel.</center>
             </div>";
             header("Refresh: 5; url={$site}");
           elseif ($get == 'logoff'):              
             echo "<div class=\"alert alert-info alert-dismissable\">
             <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">X</button>
             <center><b>DESLOGADO:</b> Você saiu de sua conta!</center>
             </div>";
             header("Refresh: 5; url={$site}");
           endif;
         endif;

         ?>
       </div>
     </div>
     <div class="form-group  m-t-20">
      <div class="col-xs-12">
        <label>Seu E-mail</label>
        <input class="form-control" type="text" name="admin_email" required placeholder="E-mail">
      </div>
    </div>
    <div class="form-group">
      <div class="col-xs-12">
        <label>Sua Senha</label>
        <input class="form-control" type="password" name="admin_senha" required placeholder="********">
      </div>
    </div>
    <div class="form-group text-center m-t-20">
    
      <div class="col-xs-12">
					<button class="w-full login100-form-btn" style="background-color: #7233a1;">
						Entrar
					</button>
				</div>
      
    </div>
  </form>
</div>
</div>            
        </div>

</section>
<!-- jQuery -->
<script src="js/jquery-3.2.1.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Menu Plugin JavaScript -->
<script src="plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>

<!--slimscroll JavaScript -->

<script src="js/jquery.slimscroll.js"></script>

<!--Wave Effects -->
<script src="js/waves.js"></script>
<!-- Custom Theme JavaScript -->
 
<!--Style Switcher -->
 
<script src="plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
</body>
</html>
