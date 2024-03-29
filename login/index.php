<?php
ob_start();
session_cache_expire(60);
session_start();
require('../sistema/_app/Config.inc.php');
 
require('../sistema/_app/Mobile_Detect.php');
$detect = new Mobile_Detect;
$site = HOME;
 

$login = new Login(3);
 
if($login->CheckLogin()):
	$idusuar = $_SESSION['userlogin']['user_id'];
	$lerbanco->ExeRead('ws_empresa', "WHERE user_id = :idcliente", "idcliente={$idusuar}");
	if (!$lerbanco->getResult()):       
	else:
		foreach ($lerbanco->getResult() as $i):
			extract($i);			
		endforeach;


	
		

		header("Location: {$site}{$nome_empresa_link}/");
	endif;
else:
endif;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>S.V.F - Fazer login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="../Imagens/FAVICON.PNG"/>
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">

	<!--===============================================================================================-->
	<link href="<?=$site;?>css/suportewats.css" type="text/css" rel="stylesheet">
	<link href="<?=$site;?>css/flowbite.min.css" type="text/css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body style="background-image: url('<?=$site.'/img/bg_1.png'?>'); background-repeat:no-repeat;background-size: cover;" >
    
	<div class="limiter">
		<div  class="container-login100">
			<div class="md:w-5/6 wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
			<?php
						
						$dataLogin = filter_input_array(INPUT_POST, FILTER_DEFAULT);
	
						if(!empty($_GET['register']) && $_GET['register'] == 'true' && empty($dataLogin)):
							echo "<p class=\"login100-form-title p-b-32\" style='color: green;font-size:25px;'><b>Sucesso!</b> Agora você pode fazer login.</p>";
					endif;
	
					if(!empty($dataLogin)):
						if(in_array("", $dataLogin)):
							echo "
							<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">
							<strong>Opss... </strong>Preencha os Campos Login e Senha!
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
							<span aria-hidden=\"true\">&times;</span>
							</button>
							</div>";
						else:
							$login = new Login(3);
							$login->ExeLogin($dataLogin);
							if (!$login->getResult()):								
								echo "
								<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">
								<strong>Opss... </strong>{$login->getError()[0]}
								<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
								<span aria-hidden=\"true\">&times;</span>
								</button>
								</div>";
							else:
								if($login->CheckLogin()):
									$idusuar = $_SESSION['userlogin']['user_id'];
									$lerbanco->ExeRead('ws_empresa', "WHERE user_id = :idcliente", "idcliente={$idusuar}");
									if (!$lerbanco->getResult()):
	
										echo "
										<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">
										<strong>Opss... </strong>Ocorreu um erro entre em contato conosco!
										<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
										<span aria-hidden=\"true\">&times;</span>
										</button>
										</div>";
									else:
										foreach ($lerbanco->getResult() as $i):
											extract($i);
										endforeach;
										
	
										header("Location: {$site}");
									endif;
								endif;	
							endif;
						endif;
					endif;
					?>
				<form method="post" class="login100-form validate-form flex md:flex-row flex-col">
				
				<div class="flex spacing-margin justify-center flex-col">
					<img class="img-log-login relative"style="margin:0 auto; max-width: 70%;" src="../Imagens/INICIO.png"/>
					 
				</div>
					
				<div class="flex spacing-margin flex-col">
				
				<span class="txt1 p-b-11">
					E-mail
				</span>
				<div class="wrap-input100 validate-input m-b-15" data-validate = "O e-mail e obrigatório">
					<input class="input100" type="text" name="user" >
					<span class="focus-input100"></span>
				</div>

				<span class="txt1 p-b-11">
					Senha
				</span>
				<div class="wrap-input100 validate-input m-b-15" data-validate = "A senha e obrigatória">
					<span class="btn-show-pass">
						<i class="fa fa-eye"></i>
					</span>
					<input class="input100" type="password" name="pass" >
					<span class="focus-input100"></span>
				</div>

				<div class="flex-row flex-sb-m justify-center w-full p-b-20">
					<!-- <div class="contact100-form-checkbox">
						<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
						<label class="label-checkbox100" for="ckb1">
							Lembrar senha
						</label>
					</div>		 -->
					<div class="contact100-form-checkbox">
						<label data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="label-recover-password">
							Esqueceu a senha? Clique aqui!
						</label>						
					</div>	
			</div>
 			<div class="container-login100-form-btn">
					<button class="w-full login100-form-btn" style="background-color: #7233a1;">
						Entrar
					</button>
				</div>
			</div>
			</form>

			<div id="popup-modal" tabindex="-1" data-modal-backdrop="static" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    			<div class="relative w-full max-w-md max-h-full">
				<div id="modal-recover" class="relative bg-white rounded-lg shadow dark:bg-gray-700">
					<button id="close_modal" type="button" class="absolute top-1 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
						<svg  class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
							<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
						</svg>
						<span class="sr-only">Close modal</span>
					</button>
					<div class="p-6 text-center">      
							<h3 id="msg_recover_1" class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Digite seu e-mail ou CPF cadastrados<br>(somente números):</h3>
							<form method="post" class="login100-form validate-form-2 flex-sb flex-w">
									<div id="validate-input" class="wrap-input100 validate-input m-b-36">
										<input id="input_recover" class="input100" type="text" name="email" >
										<span class="focus-input100"></span>
									</div>				 
							<button id="recover-100" type="submit" style="background-color:#7233a1" type="button" class="login100-form-btn">
                    		Recuperar Senha
               				</button>				 
                			</form>
			
            </div>
			
        </div>
    </div>
</div>
		



 
		



		<style type="text/css">
				#social_footer{
	text-align:center;
	border-top:1px solid #ededed;
	padding-top:30px;
	margin-top:30px;
}
#social_footer p{
	font-size:12px;
	color:#8c8c8c;
}
#social_footer ul{
	margin:0;
	padding:0 0 10px 0;
	text-align:center;
}
#social_footer ul li{
	display:inline-block;
	margin:0 5px 10px 5px;
}
#social_footer ul li a{
	color:white;
	text-align:center;
	line-height:34px;
	display:block;
	font-size:16px;
	width:35px;
	height:35px;
	background-color:#7233a1;
	-webkit-border-radius: 50%;
	-moz-border-radius: 50%;
	border-radius: 50%;
}
#social_footer ul li a:hover{
	background:#fff;
	color:#111;
}
			</style>
			 
		</div>
	</div>

</div>


<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/bootstrap/js/popper.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/daterangepicker/moment.min.js"></script>
<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
<script src="js/main.js"></script>
<script src="<?=$site;?>js/suportewats.js"></script>
<script src="<?=$site;?>js/jquery.mask.js"></script>






				<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/flowbite.min.js"></script>

</body>
</html>

<?php
ob_end_flush();
?>