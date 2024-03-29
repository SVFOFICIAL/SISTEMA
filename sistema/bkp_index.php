<?php
ob_start();
session_cache_expire(60);
session_start();

require('_app/Config.inc.php');
 
if(empty($_SESSION['hasShowed'])){
	require('_app/status_plano.php');
}

require('_app/Mobile_Detect.php');
$detect = new Mobile_Detect;

$loginUrl = LOGIN;

$linkLoja = LINK_LOJA;
 



$Url[1] = (empty($Url[1]) ? null : $Url[1]);

$site = HOME;
$img_log_dir = 'configuracoes/uploads/';
 
if(empty($_SESSION['userlogin'])){
	header("Location: {$loginUrl}");
} 

if(empty($Url[0]) || $Url[0] == 'index'):
	require('landingpage.php');	 
 
else:
	 
	$nemprise = $Url[0];	 

	$lerbanco->FullRead("select * from ws_empresa WHERE binary nome_empresa_link = :lemprise", "lemprise={$nemprise}");
	if (!$lerbanco->getResult()):
		header("Location: {$site}");
	else:
		foreach ($lerbanco->getResult() as $i):
			extract($i);
		endforeach;

		$getu = $user_id;	
		 
		$lerbanco->FullRead("select * from ws_users WHERE user_id = :user", "user={$getu}");
		if (!$lerbanco->getResult()){
		 
		}else{
			foreach ($lerbanco->getResult() as $j):
				extract($j);
			endforeach;	
		}
		$linkLoja = $linkLoja.$nome_empresa_link;
	endif;


	$lerbanco->FullRead("select * from configuracoes_site");
	if (!$lerbanco->getResult()):		 
	else:
		foreach ($lerbanco->getResult() as $k):
			extract($k);
		endforeach;
	endif;

	$cart = new Cart([
	//Total de item que pode ser adicionado ao carrinho 0 = Ilimitado
		'cartMaxItem' => 0,

	// A quantidade máxima de um item que pode ser adicionada ao carrinho, 0 = Ilimitado
		'itemMaxQuantity' => 0,

	// Não usar cookies, os itens do carrinho desaparecerão depois que o navegador for fechado
		'useCookie' => false,
	]);

	// if(!empty($_SESSION['userlogin']) && $_SESSION['userlogin']['user_id'] != $getu):
	// 	header("Location: {$site}Demo");
	// endif;

	$logoff = filter_input(INPUT_GET, 'logoff', FILTER_VALIDATE_BOOLEAN);
 
	
	if(!empty($logoff) && $logoff == true):
		 
	$updateacesso = new Update;
	$dataEhora    = date('d/m/Y H:i');
	$ip           = get_client_ip();
	$string_last = array("user_ultimoacesso" => " Último acesso em: {$dataEhora} IP: {$ip} ");
	$updateacesso->ExeUpdate("ws_users", $string_last, "WHERE user_id = :uselast", "uselast={$userlogin['user_id']}");
	unset($_SESSION['hasShowed']);	
	unset($_SESSION['userlogin']);
	unset($_SESSION['qr_code_base64']);
    unset($_SESSION['qr_code']);
    unset($_SESSION['id_payment']);
    unset($_SESSION['status']);
    unset($_SESSION['paymentScreen']);
    unset($_SESSION['plano']);
    unset($_SESSION['amount']);
  


	header("Location: {$loginUrl}");
endif;

	?>

	


	<!DOCTYPE id="main"html>
	<!--[if IE 9]><html class="ie ie9"> <![endif]-->
	<html lang="pt-br" style="heigth:100%; scroll-behavior: smooth;">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="keywords" content="pizza, delivery food, fast food, sushi, take away, chinese, italian food">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

		<meta name="robots" content="index, fallow" />
		<link rel="canonical" href="<?=$site.$Url[0];?>">
		<meta name="author" content="Alex Silva">
		<meta name="og:title" content="<?=(!empty($nome_empresa) ? 'Cardápio Fácil | '.$nome_empresa : 'Nome_do_seu_negócio');?>" />
		<meta name="og:type" content="website">
		<meta property="og:site_name" content="<?=$texto['nome_site_landing'];?>"/>
		<meta property="og:url" content="<?$site.$nome_empresa_link?>"/>
		<meta property="og:description" content="<?=(!empty($descricao_empresa) ? $descricao_empresa : '');?>" />
		<meta name="description" content="<?=(!empty($descricao_empresa) ? $descricao_empresa : '');?>">
		<meta property="og:image"content="<?=(!empty($img_logo) ? $site.'uploads/'.$img_logo : '')?>"/>

		<meta content="width=device-width, initial-scale=1" name="viewport" />
		<title><?=(!empty($nome_empresa) ? 'Sistema Venda Fácil | '.$nome_empresa : 'Nome_do_seu_negócio');?></title>

		<!-- Favicons-->
		<link rel="shortcut icon" href="../../Imagens/LOGO.ico" type="image/x-icon">
		<!-- GOOGLE WEB FONT -->
		<link href="<?= $site; ?>css/fonts-google.css" rel="stylesheet">

		<!-- BASE CSS -->
		<link href="<?= $site; ?>css/base.css" rel="stylesheet">
		<link href="<?= $site; ?>css/custom.css" rel="stylesheet">
		<link href="<?= $site; ?>css/reset.css" rel="stylesheet">
		<link href="<?= $site; ?>css/datepicker.css" rel="stylesheet">
		<link href="<?= $site; ?>css/style-bt-file.css" rel="stylesheet">
	 
		
		<link href="<?=$site;?>css/icheck/icheck-material.css" rel="stylesheet">
		<link href="<?=$site;?>css/flowbite.min.css" rel="stylesheet">
		<link href="<?= $site; ?>css/style.css" rel="stylesheet">	 
		<link href="<?= $site; ?>css/tailwind.min.css" rel="stylesheet">

		<style type="text/css">
		 


			#img-head-loja{
				background-image:url(<?=(!empty($img_header) ? $site."uploads/".$img_header : '');?>);
				background-attachment:fixed;
				background-size:100%;
				background-repeat:no-repeat;
				background-color:#000;
			}
		</style>

		<style type="text/css">

			.switch {
				position: relative;
				margin: 5px auto;
				width: 95%;
				height: 40px;
				border: 3px solid #34AF23;
				color: #ffffff;
				font-size: 15px;
				border-radius: 10px;
			}

			.quality {
				position: relative;
				display: inline-block;
				width: 50%;
				height: 100%;
				line-height: 40px;
			}
			.quality:first-child label {
				border-radius: 5px 0 0 5px;
			}
			.quality:last-child label {
				border-radius: 0 5px 5px 0;
			}
			.quality label {
				position: absolute;
				top: 0;
				left: 0;
				width: 100%;
				height: 100%;
				cursor: pointer;
				font-style: italic;
				text-align: center;
				transition: transform 0.4s, color 0.4s, background-color 0.4s;
			},

					
    
			.quality input[type="radio"] {
				appearance: none;
				width: 0;
				height: 0;
				opacity: 0;
			}
			.quality input[type="radio"]:focus {
				outline: 0;
				outline-offset: 0;
			}
			.quality input[type="radio"]:checked ~ label {
				background-color: #34AF23;
				color: #ffffff;
			}
			.quality input[type="radio"]:active ~ label {
				transform: scale(1.05);
			}

		</style>


 


		<!-- Radio and check inputs -->
		<link href="<?= $site; ?>css/skins/square/grey.css" rel="stylesheet">
		



		<?php
		if(!empty($_SESSION['userlogin'])):
			?>
			<link href="<?= $site; ?>css/skins/square/green.css" rel="stylesheet">
			<link href="<?= $site; ?>css/admin.css" rel="stylesheet">
			<link href="<?= $site; ?>css/bootstrap3-wysihtml5.min.css" rel="stylesheet">
			<link href="<?= $site; ?>css/dropzone.css" rel="stylesheet">
			<link href="<?= $site; ?>css/tailwind.min.css" rel="stylesheet">


			<link rel="stylesheet" type="text/css" href="<?= $site; ?>css/uploads/normalize.css" />
			 
			<link rel="stylesheet" type="text/css" href="<?= $site; ?>css/uploads/component.css" />
			<?php
		else:
		endif;
		?>

		<!-- <link rel="stylesheet" type="text/css" href="<?= $site; ?>css/modal/frappuccino-modal.css" /> -->
		<link rel="stylesheet" href="css/font-awesome.css">
		<!-- <link rel="stylesheet" type="text/css" href="<?= $site; ?>css/modal/popupmodal.css" /> -->

		<script src="<?= $site; ?>js/jquery-2.2.4.min.js"></script>

		
<!-- 
		<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script> -->


		<script>(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);</script>

	 
 

		<!--https://gao-sun.github.io/x0popup/-->
		<link href="<?= $site; ?>css/x0popup-master/dist/x0popup.min.css" rel="stylesheet">
		<script src="<?= $site; ?>css/x0popup-master/dist/x0popup.min.js"></script>

		<script src="<?= $site; ?>js/jquery.gotop.js"></script>
		
		<script src="<?= $site; ?>js/player.js"></script>
		<script src="<?= $site; ?>js/howler.js"></script>

		<link href="<?= $site; ?>notificacao/light-theme.min.css" rel="stylesheet">

		<script type="text/javascript" src="<?= $site; ?>notificacao/growl-notification.min.js"></script> 


		<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/JNKKKK/MoreToggles.css@0.2.1/output/moretoggles.min.css"> -->

		<!-- Select da pagina carrinho -->
		<link href="<?=$site?>css/selectcarrinho/dist/css/select2.min.css" rel="stylesheet" />
		<script src="<?=$site?>css/selectcarrinho/dist/js/select2.min.js"></script>
		<!-- Select da pagina carrinho -->


		<!-- Radio and check inputs -->
		<link href="<?= $site; ?>css/radio-check.css" rel="stylesheet">
		<!-- <link href="<?= $site; ?>css/modal.css" rel="stylesheet"> -->
		<script type="text/javascript" src="<?= $site; ?>js/modalhorarios.js"></script> 
		<!-- https://www.cssscript.com/pure-css-checkbox-radio-button-replacement-bootstrap-icheck/ -->
		<!-- <script defer src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script> -->
		<link href="<?= $site; ?>css/chackbox/dist/css/checkboxes.css" rel="stylesheet">

		<script type="text/javascript">
			$(document).ready(function(){

			 


				$('.remove_item').click(function(){
					$('.remove_item').prop('disabled', true);

					var id_item = $(this).data('id_item');
					var rash_item = $(this).data('item_hash');

					$.ajax({
						url: '<?= $site; ?>includes/processaremovercart.php',
						method: 'post',
						data: {'iditem':id_item,'itemrash':rash_item, 'getpegaloja' : '<?=$Url[0];?>'},

						success: function(data){
							$('.remove_item').prop('disabled', false);
							$('#updatesidebar').html(data);
						}
					});
				});
			});
		</script>

		
		<script src="<?= $site; ?>css/multiselect/dist/bundle.min.js"></script>


		<!-- MUDAR CORES DO TEMPLATE -->
		<!--<link href="css/color_scheme.css" rel="stylesheet">-->
	</head>

	<body class="leading-normal tracking-normal  overflow-hidden text-white" style="background-image: url('<?=$site.'/img/bg_1.png'?>'); background-repeat:no-repeat;background-size: cover;">
			
	<!-- inicio do loader 
		<div id="preloader">
			<div class="sk-spinner sk-spinner-wave" id="status">
				<div class="sk-rect1"></div>
				<div class="sk-rect2"></div>
				<div class="sk-rect3"></div>
				<div class="sk-rect4"></div>
				<div class="sk-rect5"></div>
			</div>
		</div> -->


<!--[if lte IE 8]>
    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a>.</p>
<![endif]-->



<!-- Header ================================================== -->
<header >
	
	</header>
<div class="container-login">
 
	
	<div  id="main-container" class="container-fuild  overflow-hidden">
		<!-- First Row -->
	<div class="container-menu">
		<div class="row ">				 
			<div class="col-md-4 col-xs-12">		
					<div  class="height-container new-menu-first-row hover:bg-sky-700">
						<div class="container">
							<div class="container-items" >
								<div class="row">
									<div class="col-md-12 col-xs-12">
										<div class="row">
											<div class="col-md-12">
											<a  class="text-values">
												<div class="object-fit img-container">													
													<img style="margin:10px" src="<?=URL_IMAGE.$img_logo?>"  height="200" width="200" alt="" data-retina="true" class="img-fluid">	 
												</div>
											</div>
											</a>	
										</div>
			 
								<div class="row">
									<div class="col-md-12 col-xs-12">
										<div class="flex text-info-menu flex-col w-full content-center justify-start ">
										
												<div style="font-size:20px;font-weight: bolder;" class='text-bold'>
													<span> INFORMAÇÕES</span>
												</div>	
												<div class="w-1/2 w-full flex flex-row content-center">	
												
														<div class="ellipse p-2"></div>						 
														<div class="p-2"><span>Nome da Loja: <a href="<?= $linkLoja ?>" target="_blank" class="text-values"><span class="text-values"> <?= $nome_empresa ?></span><span></div>
											</div>
										<div hidden class="w-1/2 w-full flex flex-row content-center">	
											
										<div class="ellipse p-2"></div>		
												<div class="p-2"><span>Link da Loja:  <a href="<?= $linkLoja ?>" class="text-values"><?= $linkLoja ?></a><span></div>
										</div>
										<div class="w-1/2 w-full flex flex-row content-center">	
											
												<div class="ellipse p-2"></div>		
												<div class="p-2"><span>Plano: <span class="text-values"><?= $user_nome_plano ?></span><span></div>
												</div>
											<div class="w-1/2 w-full flex flex-row content-center">	
											
												<div class="ellipse p-2"></div>		
														<div class="p-2"><span>Email:   <span class="text-values" ><?= $user_email ?></span> </span></div>
												</div>
												<div class="w-1/2 w-full flex flex-row content-center">	
													<div class="ellipse p-2"></div>		
												
													<div class="p-2"><span>Data de Validade:  <span class="text-values" ><?= date('d/m/Y', strtotime($empresa_data_renovacao)) ?></span><span>
														
													</div>
												</div>
											</div>
										</div>
								</div>
								<div class="row">
									<div class="col-md-12 pb-1 col-xs-12">
										<div class="flex text-info-menu flex-col w-full content-center justify-start ">
												
										<div style="font-size:20px;font-weight: bolder;">
													<span> ATENDIMENTO	</span>
												</div>	
										
												<div hidden class="w-1/2 w-full flex flex-row justify-center">	
												
														 					 
														<div class="p-2 text-center"><span>Horário de atendimento: </div>
											</div>
												<div class="w-1/2 w-full flex flex-col content-center">											
									 
												<div class="p-2"><span>Segunda à Segunda:  <span class="text-values"><?= $h_suporte?></span><span></div>
							 
													</div>
													<div class="w-1/2 w-full flex flex-col content-center">											
													<?php 

														$today = getdate();
													 	$time = date('H:i:s');
													 
													
														 if((($today['wday']>='1' && $today['wday']<='5')  && (strtotime($time) >= strtotime('08:00:00')) && (strtotime($time) <= strtotime('18:00:00'))   )
														 || (($today['wday']=='6' || $today['wday']=='0') && (strtotime($time) >= strtotime('08:00:00')) && (strtotime($time) <= strtotime('18:00:00'))  )
														 ){
														 

															$status = "ONLINE";
															$class = "status-on";
															 
														}else{
																$status = "OFFLINE";
																$class = "status-off";
																 
														}														
														
														 
														?>
													<div><span id="tel_suporte" style="font-size:20px;font-weight: bolder;" class=""><?= $tel_adm?></div>
													<div><span style="font-size:25px;font-weight: bolder;" class="<?= $class ?>"><?= $status ?></div>
													</div>
										 
											</div>
										</div>
								</div>
								<div class="row">
									<div class="col-md-12 col-xs-12">

								<div hidden class="row">
									<div class="col-md-12 col-xs-12">
										<div style="margin-top:5px" id="social_footer">
													<ul>
													<li><a target="_blank" href="<?=(!empty($texto['link_do_face']) ? $texto['link_do_face'] : "");?>"><i class="fa fa-facebook-square" aria-hidden="true"></i></a></li>
													<!--<li><a href="#0"><i class="icon-twitter"></i></a></li>-->
													<!--<li><a href="#0"><i class="icon-google"></i></a></li>-->
													<li><a target="_blank" href="<?=(!empty($texto['link_do_insta']) ? $texto['link_do_insta'] : "");?>"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
													<!--<li><a href="#0"><i class="icon-pinterest"></i></a></li>-->
													<!--<li><a href="#0"><i class="icon-vimeo"></i></a></li>-->
													<li><a target="_blank" href="<?=(!empty($texto['link_do_insta']) ? $texto['link_do_insta'] : "");?>"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
													</ul>    
											</div>
										</div>
									</div>
									</div>
									</div>
							</div>
						</div>
					</div>
				</div> 		
			</div>
			


			</div>
			<!--End Row -->
	 
			<div class="col-md-8 col-xs-12" >	
				<div class="height-container container-buttons"> 	
				<div class="row">
					<div class="col-md-12 col-xs-12">	
					<a  href="<?=$site.'cadastros/'?>">	
					<div class="col-md-6">
							<div  class="new-menu mt-5 p-5">
			
								<div class="flex w-full flex-row p-4 justify-center">
									<div class="icon-new-menu">
										<img src="<?=$site ?>img/lista-de-controle_1.png">
									</div>

									<div class="p-4 text-menu font-medium leading-tight">
										<span>Cadastros</span>
									</div>
								</div>			
							</div>
						</div>
													</a>
						<div class="col-md-6">
						<a  href="<?=$linkLoja?>" target="_blank">
								<div  class="new-menu mt-5 p-5">
							
								<div class="flex w-full flex-row p-4 justify-center">
									<div class="icon-new-menu">
										<img src="<?=$site ?>img/pedido_1.png">
									</div>

									<div class="p-4 text-menu font-medium leading-tight">
										<span>Cardápio Fácil</span>
									</div>
							</div>
						</div>
						</div>
						</a>
					</div>		

					<div class="col-md-12 col-xs-12">	
		
						<div class="col-md-6">
							<a  href="<?=$site.'configuracoes/'?>">
									<div  class="new-menu mt-5 p-5">
						
										<div class="flex w-full flex-row p-4 justify-center">
												<div class="icon-new-menu">
														<img src="<?=$site ?>img/configuracao _1.png">
													</div>
													
												<div class="p-4 text-menu font-medium leading-tight">
													<span>Configurações</span>
												</div>
										</div>					
									</div>
								</a>
						</div>

						<div class="col-md-6">
							<div  disabled class="button-disabled new-menu mt-5 p-5 bg-gray-300">
						
									<div class="flex w-full flex-row p-4 justify-center">
										<div class="icon-new-menu">
											<img src="<?=$site ?>img/curso-online_1.png">
										</div>

										<div class="p-4 text-menu font-medium leading-tight">
											<span>Escola Fácil <br> <span style="font-size: 10px">(Em construção)</span></span>
										</div>
									</div>			
							</div>
						</div>			
			
					</div>

					<div class="col-md-12 col-xs-12">	
		
						<div class="col-md-6">
							<div  disabled class="button-disabled new-menu mt-5 p-5 bg-gray-300">						
								<div class="flex w-full flex-row p-4 justify-center">
										<div class="icon-new-menu">
											<img src="<?=$site ?>img/gestao _1.png">
										</div>
										<div class="p-4 text-menu font-medium leading-tight">
											<span>Gestão Fácil <br> <span style="font-size: 10px">(Em construção)</span></span>
										</div>
								</div>
							</div>
						</div>		
			
						<div class="col-md-6">
								<div  disabled class="button-disabled new-menu mt-5 p-5 bg-gray-300">
									<div class="flex w-full flex-row p-4 justify-center">
											<div class="icon-new-menu">
													<img src="<?=$site ?>img/salario_1.png">
											</div>
											<div class="p-4 text-menu font-medium leading-tight">
												<span>Mensalidades <br> <span style="font-size: 10px">(Em construção)</span></span>
											</div>
									</div>					
								</div>
						</div>
					</div>	

					<div class="col-md-12 col-xs-12">	
		
						<div class="col-md-6">
							<div  disabled class="button-disabled new-menu mt-5 p-5 bg-gray-300">			 
								<div class="flex w-full flex-row p-4  justify-center">
										<div class="icon-new-menu">
												<img src="<?=$site ?>img/caixa-eletronico_1.png">
										</div>
										<div class="p-4 text-menu font-medium leading-tight">					
												<span>PDV Fácil <br> <span style="font-size: 10px">(Em construção)</span></span>
												 								
										</div>
								</div>			
							</div>			 
						</div>	 
						<div class="col-md-6">
							
						<?php 

$today = getdate();
$time = date('H:i:s');

if((($today['wday']>='1' && $today['wday']<='5')  && (strtotime($time) >= strtotime('08:00:00')) && (strtotime($time) <= strtotime('18:00:00'))   )
|| (($today['wday']=='6' || $today['wday']=='0') && (strtotime($time) >= strtotime('08:00:00')) && (strtotime($time) <= strtotime('18:00:00'))  )
){

			$class = "suporte_btn new-menu mt-5 p-5";
														
}else{
		$class = "button-disabled new-menu mt-5 p-5 bg-gray-300";	 	 
	}  
?><a target="_blank" href="https://api.whatsapp.com/send?1=pt_BR&phone=55<?=$tel_adm?>">
							<div id="suporte_button" class="<?= $class ?>">				
								<div class="flex w-full flex-row p-4 justify-center">
									<div class="icon-new-menu">
											<img width="50" height="50" src="<?=$site?>img/aperto-de-mao.png">
									</div>
									<div  class="p-4 text-menu font-medium text-white leading-tight">
										<span>Suporte</span>
									</div>
								</div>
							</div>		 
						</div>
					</div>
</a>
					<!-- Third Row -->
		
					<div class="col-md-12 col-xs-12">	
		 
						<div class="col-md-6">

						</div>	
						<div class="col-md-6">
						<a href="<?=$site.$Url[0].'/';?>&logoff=true">
							<div id="sair_button" style="background-color: #A70000" class="new-menu mt-5 p-5">				
								<div class="flex w-full flex-row p-4 justify-center">
										<div class="icon-new-menu" style="left:30px">
										<img width="60" height="60" src="<?=$site?>img/icon _add_circled outline_.png">
										</div>		
										<div class="p-4 text-menu text-white font-bold leading-tight">
											
												<span>Sair</span>
											 
										</div>
								</div>				
							</div>
						</div>
						</a>
					</div>
			
		 
				</div>
 
		 
		<!-- End Fist Row -->
				</div>
		</div>
	 


	  


			
	
				


		</div>


		</div>
 
		</div><!-- End row -->
	</div><!-- End container -->

<!-- End Header =============================================== -->

<!-- SubHeader =============================================== -->


<script>
	//  $(document).ready(function(){
	// 	var container_info_height = $('.container-items').innerHeight();
	// 	$('.container-buttons').innerHeight(container_info_height);


	//  })
</script>
<!-- COMMON SCRIPTS -->

<script src="<?= $site; ?>js/common_scripts_min.js"></script>
<script src="<?= $site; ?>js/functions.js"></script>
<script src="<?= $site; ?>assets/validate.js"></script>
<script src="<?= $site; ?>js/jquery.mask.js"></script>
<script src="<?= $site; ?>js/index-btn-file.js"></script>
<script src="<?= $site; ?>js/funcoesjs.js"></script>
<script src="<?= $site; ?>js/custom-file-input.js"></script>
<script src="<?= $site; ?>js/bootstrap-datepicker.js"></script>
<!-- <script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script> -->
 
<script src="<?= $site; ?>js/printThis.js"></script>
 

 
<script>
	// jQuery(document).ready(function($){
	// 	$('a').not('[href*="'+document.domain+'"]').attr('target', '_blank');
	// 	$('a').not('[href*="'+document.domain+'"]').attr('rel', 'external nofollow');
	// });

	$('#tel_suporte').mask('(00) 0 0000-0000');
</script>
 

<?php				

if(file_exists('includes/'.$Url[1] . '.php')):
	require 'includes/'.$Url[1] . '.php';

endif;
?> 



 





<!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.14.1/moment.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js'></script> -->


<!-- SPECIFIC SCRIPTS -->
 




	<!-- <script type="text/javascript">
//plugin bootstrap minus and plus
//http://jsfiddle.net/laelitenetwork/puJ6G/
$('.btn-number').click(function(e){
	e.preventDefault();

	fieldName = $(this).attr('data-field');
	type      = $(this).attr('data-type');
	var input = $("input[name='"+fieldName+"']");
	var currentVal = parseInt(input.val());
	if (!isNaN(currentVal)) {
		if(type == 'minus') {

			if(currentVal > input.attr('min')) {
				input.val(currentVal - 1).change();
			} 
			if(parseInt(input.val()) == input.attr('min')) {
				$(this).attr('disabled', true);
			}

		} else if(type == 'plus') {

			if(currentVal < input.attr('max')) {
				input.val(currentVal + 1).change();
			}
			if(parseInt(input.val()) == input.attr('max')) {
				$(this).attr('disabled', true);
			}

		}
	} else {
		input.val(0);
	}
});
$('.input-number').focusin(function(){
	$(this).data('oldValue', $(this).val());
});
$('.input-number').change(function() {

	minValue =  parseInt($(this).attr('min'));
	maxValue =  parseInt($(this).attr('max'));
	valueCurrent = parseInt($(this).val());

	name = $(this).attr('name');
	if(valueCurrent >= minValue) {
		$(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
	} else {
		alert('Desculpe, o valor mínimo foi atingido');
		$(this).val($(this).data('oldValue'));
	}
	if(valueCurrent <= maxValue) {
		$(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
	} else {
		alert('Desculpe, o valor máximo foi atingido');
		$(this).val($(this).data('oldValue'));
	}


}); -->



<script language="JavaScript">
	/*
	window.onload = function() {
		document.addEventListener("contextmenu", function(e){
			e.preventDefault();
		}, false);
		document.addEventListener("keydown", function(e) {
            //document.onkeydown = function(e) {
              // "I" key
              if (e.ctrlKey && e.shiftKey && e.keyCode == 73) {
              	disabledEvent(e);
              }
              // "J" key
              if (e.ctrlKey && e.shiftKey && e.keyCode == 74) {
              	disabledEvent(e);
              }
              // "S" key + macOS
              if (e.keyCode == 83 && (navigator.platform.match("Mac") ? e.metaKey : e.ctrlKey)) {
              	disabledEvent(e);
              }
              // "U" key
              if (e.ctrlKey && e.keyCode == 85) {
              	disabledEvent(e);
              }
              // "F12" key
              if (event.keyCode == 123) {
              	disabledEvent(e);
              }
          }, false);
		function disabledEvent(e){
			if (e.stopPropagation){
				e.stopPropagation();
			} else if (window.event){
				window.event.cancelBubble = true;
			}
			e.preventDefault();
			return false;
		}
	}; */
</script>

// <!-- <script type="text/javascript">
// 	const selected = document.querySelector(".selected");
// 	const optionsContainer = document.querySelector(".options-container");
// 	const searchBox = document.querySelector(".search-box input");

// 	const optionsList = document.querySelectorAll(".option");

// 	selected.addEventListener("click", () => {
// 		optionsContainer.classList.toggle("active");

// 		searchBox.value = "";
// 		filterList("");

// 		if (optionsContainer.classList.contains("active")) {
// 			searchBox.focus();
// 		}
// 	});

// 	optionsList.forEach(o => {
// 		o.addEventListener("click", () => {
// 			selected.innerHTML = o.querySelector("label").innerHTML;
// 			optionsContainer.classList.remove("active");
// 		});
// 	});

// 	searchBox.addEventListener("keyup", function(e) {
// 		filterList(e.target.value);
// 	});

// 	const filterList = searchTerm => {
// 		searchTerm = searchTerm.toLowerCase();
// 		optionsList.forEach(option => {
// 			let label = option.firstElementChild.nextElementSibling.innerText.toLowerCase();
// 			if (label.indexOf(searchTerm) != -1) {
// 				option.style.display = "block";
// 			} else {
// 				option.style.display = "none";
// 			}
// 		});
// 	};

// </script>



</body>
</html>
<?php


endif;
ob_end_flush();
?>
