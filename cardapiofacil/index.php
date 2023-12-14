	<?php
ob_start();
session_cache_expire(60);
session_start();
require('_app/Config.inc.php');
require('_app/Mobile_Detect.php');
$detect = new Mobile_Detect;

$Url[1] = (empty($Url[1]) ? null : $Url[1]);

$site = HOME;
 

 
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

	endif;

	$cart = new Cart([
	//Total de item que pode ser adicionado ao carrinho 0 = Ilimitado
		'cartMaxItem' => 0,

	// A quantidade máxima de um item que pode ser adicionada ao carrinho, 0 = Ilimitado
		'itemMaxQuantity' => 0,

	// Não usar cookies, os itens do carrinho desaparecerão depois que o navegador for fechado
		'useCookie' => false,
	]);

	if(!empty($_SESSION['userlogin']) && $_SESSION['userlogin']['user_id'] != $getu):
		header("Location: {$site}Demo");
	endif;

	?>

	<!DOCTYPE html>
	<!--[if IE 9]><html class="ie ie9"> <![endif]-->
	<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="keywords" content="pizza, delivery food, fast food, sushi, take away, chinese, italian food">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

		<meta name="robots" content="index, fallow" />
		<link rel="canonical" href="<?=$site.$Url[0];?>">
		<meta name="author" content="Alex Silva">
		<meta name="og:title" content="<?=(!empty($nome_empresa) ? 'Pedido Fácil | '.$nome_empresa : 'Nome_do_seu_negócio');?>" />
		<meta name="og:type" content="website">
		<meta property="og:site_name" content="<?=$texto['nome_site_landing'];?>"/>
		<meta property="og:url" content="<?$site.$nome_empresa_link?>"/>
		<meta property="og:description" content="<?=(!empty($descricao_empresa) ? $descricao_empresa : '');?>" />
		<meta name="description" content="<?=(!empty($descricao_empresa) ? $descricao_empresa : '');?>">
		<meta property="og:image"content="<?=(!empty($img_logo) ? $site.'uploads/'.$img_logo : '')?>"/>

		<meta content="width=device-width, initial-scale=1" name="viewport" />
		<title><?=(!empty($nome_empresa) ? 'Pedido Fácil | '.$nome_empresa : 'Nome_do_seu_negócio');?></title>
 
		<!-- Favicons-->
		<link rel="shortcut icon" href="<?= $site; ?>img/favicon.png" type="image/x-icon">
		<!-- GOOGLE WEB FONT -->
		<link href='https://fonts.googleapis.com/css?family=Lato:400,700,900,400italic,700italic,300,300italic' rel='stylesheet' type='text/css'>

		<!-- BASE CSS -->
		<link href="<?= $site; ?>css/base.css" rel="stylesheet">
		 
		<link href="<?= $site; ?>css/datepicker.css" rel="stylesheet">
		<link href="<?= $site; ?>css/style-bt-file.css" rel="stylesheet">
		<link href="<?=$site;?>css/suportewats.css" rel="stylesheet">
		<link href="<?=$site;?>css/slick.css" rel="stylesheet">
		<link href="<?=$site;?>css/slick-theme.css" rel="stylesheet">
		<link href="<?=$site;?>css/lightslider.css" rel="stylesheet">
		 
		
		<link href="<?=$site;?>css/icheck/icheck-material.css" rel="stylesheet">
		<link href="<?=$site;?>css/flowbite.min.css" rel="stylesheet">
		
<!--[if (lt IE 9)]><script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/min/tiny-slider.helper.ie8.js"></script><![endif]-->
		


		<style type="text/css">
			@media (min-width: 768px) {
				.omb_row-sm-offset-3 div:first-child[class*="col-"] {
					margin-left: 25%;
				}
			}

			@media (min-width: 1366px) {
				.btn-adicionar-item-no-tp{
					bottom: unset !important;
				}
			}

		 .img_table > img{
			width:100%;
		 }
 
.modal-body{
	padding:unset !important;
}
 

 
.btn-adicionar-item{
	border-radius: 0;
	padding: unset;
	z-index:9999999; 
	border-top: unset;
	bottom:0px;
	position: sticky;
	width: 100%;
	 
}

 
.btn-adicionar-item-no-tp{
	 
	opacity: 0;
    transition: opacity 1s ease;
    -webkit-transition: opacity 1s ease;
	border-radius: 0;
	padding: unset;
	z-index:9999999; 
	border-top: unset;
	bottom:0px;
	position: absolute;
	width: 100%;
	 
}


#btn-adicionar-item, #checkout-btn{
    display: flex;
  flex-direction: row;
    border-radius:3px;
   
    font-weight:500;
    text-align:center;
    
    color:#fff;
    width: 100%;
    margin: 0 auto;
    box-shadow: 0 0 0 0;
    border: 0 none;
    outline: 0;
}
 


			.omb_login .omb_authTitle {
				text-align: center;
				line-height: 300%;
			}

			.gradient {
       				 background: linear-gradient(90deg, #7233A1 0%, #8c52ff 100%);
      		}

			.omb_login .omb_socialButtons a {
				color: white; // In yourUse @body-bg 
				opacity:0.9;
			}
			.omb_login .omb_socialButtons a:hover {
				color: white;
				opacity:1;    	
			}

			.omb_login .omb_loginOr {
				position: relative;
				font-size: 1.5em;
				color: #aaa;
				margin-top: 1em;
				margin-bottom: 1em;
				padding-top: 0.5em;
				padding-bottom: 0.5em;
			}
 
 
			html {
    scroll-behavior: smooth;
}

#link_cat {
  scroll-margin-top: 100px;
}
.lightbox{
	max-width: unset; 
}

#totalizador{
	border-radius: 5px;
  background: rgb(70, 220, 76);
  font-size: 25px;
  bottom: -10px;
  width: 100%;
  display: block;
  position: fixed;
  height: 60px;
  z-index: 1000000
}

.slick, .slick-cat{
    opacity: 0;
    visibility: hidden;
    transition: opacity 1s ease;
    -webkit-transition: opacity 1s ease;
}

.slide-slide{
	width: 50vw;
  
    box-sizing: border-box;
}

.btn-cat-link.slick-slide{
	width:auto !important;
}
.slick.slick-initialized, .slick-cat.slick-initialized  {
    visibility: visible;
    opacity: 1;    
}
 .btn-cat-link:focus{
	font-weight: bolder;
	text-decoration-line: underline;
   
    text-decoration-color: black;
    text-decoration-style: solid;
}
 
 
.slick-prev, .slick-arrow, .slick-disabled{
	display:none !important;
}
 
			.omb_login .omb_loginOr .omb_hrOr {
				background-color: #cdcdcd;
				height: 1px;
				margin-top: 0px !important;
				margin-bottom: 0px !important;
			}
			.omb_login .omb_loginOr .omb_spanOr {
				display: block;
				position: absolute;
				left: 50%;
				top: -0.6em;
				margin-left: -1.5em;
				background-color: white;
				width: 3em;
				text-align: center;
			}			

			.omb_login .omb_loginForm .input-group.i {
				width: 2em;
			}
			.omb_login .omb_loginForm  .help-block {
				color: red;
			}


			@media (min-width: 768px) {
				.omb_login .omb_forgotPwd {
					text-align: right;
					margin-top:10px;
				}		
			}
			.icons-header{
				width: 15px;
  				height: 15px;
			}
			#whatsapp{
				position:fixed;
				width:60px;
				height:60px;
				right:10px;
				bottom:10px;
				display:block;
				z-index:1000000;
			}
			.cart-count{
				display: inline-block;
				position: absolute;
				top: 0;
				right: 0;
				background: #ff2646;
				color: #fff;
				padding: 4px 10px;
				border-radius: 100px;
				font-size: 10px;
				text-shadow: 0 1px 2px rgba(0,0,0,.1);
				box-shadow: 0 2px 4px rgba(0,0,0,.1);
				z-index: 10;
				text-align: center;
				opacity: 1;
				transition: .33s cubic-bezier(0.34, 0.13, 0.34, 1.43);
			}


			/*--thank you pop starts here--*/
			.thank-you-pop{
				width:100%;
				padding:20px;
				text-align:center;
			}
			.thank-you-pop img{
				width:76px;
				height:auto;
				margin:0 auto;
				display:block;
				margin-bottom:25px;
			}

			.thank-you-pop h1{
				font-size: 42px;
				margin-bottom: 25px;
				color:#5C5C5C;
			}
			.thank-you-pop p{
				font-size: 20px;
				margin-bottom: 27px;
				color:#5C5C5C;
			}
			.thank-you-pop h3.cupon-pop{
				font-size: 25px;
				margin-bottom: 40px;
				color:#222;
				display:inline-block;
				text-align:center;
				padding:10px 20px;
				border:2px dashed #222;
				clear:both;
				font-weight:normal;
			}
			.thank-you-pop h3.cupon-pop span{
				color:#03A9F4;
			}
			.thank-you-pop a{
				display: inline-block;
				margin: 0 auto;
				padding: 9px 20px;
				color: #fff;
				text-transform: uppercase;
				font-size: 14px;
				background-color: #8BC34A;
				border-radius: 17px;
			}
			.thank-you-pop a i{
				margin-right:5px;
				color:#fff;
			}
			#ignismyModal .modal-header{
				border:0px;
			}
			/*--thank you pop ends here--*/



			#img-head-loja{
				background-image:url(<?=(!empty($img_header) ? URL_IMAGE.$img_header : URL_IMAGE.'default/FUNDOLOJAPADRAO.png');?>);
				background-attachment:fixed;
				background-size:cover;
				background-repeat:no-repeat;
		 
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
			}

			.config-header{
				background: #7233A1; 
				padding:10px;
				border:5px solid transparent; 
						 
			 
}

				.box-modal{
			   background:#7232A0;
			    width: 130px;
				border-radius: 15px;
				margin: 10px;
				padding: 10px;
				height:130px;
				}
    
				a:hover,a:link,a:visited{
					color:white !important;
				}
			.quality input[type="radio"] {
				appearance: none;
				width: 0;
				height: 0;
				opacity: 0;
			}
			.table > thead > tr > th {
  vertical-align: bottom;
  border-bottom: unset !important;
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



		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">



		<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css'>
		


		<!-- Radio and check inputs -->
		<link href="<?= $site; ?>css/skins/square/grey.css" rel="stylesheet">
		



		<?php
		if(!empty($_SESSION['userlogin'])):
			?>
			<link href="<?= $site; ?>css/skins/square/green.css" rel="stylesheet">
			<!-- <link href="<?= $site; ?>css/admin.css" rel="stylesheet"> -->
			<link href="<?= $site; ?>css/bootstrap3-wysihtml5.min.css" rel="stylesheet">
			<link href="<?= $site; ?>css/dropzone.css" rel="stylesheet">


			<!-- <link rel="stylesheet" type="text/css" href="<?= $site; ?>css/uploads/normalize.css" /> -->
			<!-- <link rel="stylesheet" type="text/css" href="<?= $site; ?>css/uploads/demo.css" /> -->
			<!-- <link rel="stylesheet" type="text/css" href="<?= $site; ?>css/uploads/component.css" /> -->
			<?php
		else:
		endif;
		?>

		<link rel="stylesheet" type="text/css" href="<?= $site; ?>css/modal/frappuccino-modal.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
		<link rel="stylesheet" type="text/css" href="<?= $site; ?>css/modal/popupmodal.css" />

		<script src="<?= $site; ?>js/jquery-2.2.4.min.js"></script>

		

		<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>


		<script>(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);</script>



		<!--https://gao-sun.github.io/x0popup/-->
		<link href="<?= $site; ?>css/x0popup-master/dist/x0popup.min.css" rel="stylesheet">
		<script src="<?= $site; ?>css/x0popup-master/dist/x0popup.min.js"></script>

		<script src="<?= $site; ?>js/jquery.gotop.js"></script>
		<script type="text/javascript">	

			$(document).ready(function () {

				$.getJSON('<?=$site;?>estados_cidades.json', function (data) {

					var items = [];
					var options = '<option value="<?=(!empty($end_uf_empresa) ? $end_uf_empresa : "");?>"><?=(!empty($end_uf_empresa) ? $end_uf_empresa : "Escolha um estado");?></option>';	

					$.each(data, function (key, val) {
						options += '<option value="' + val.sigla + '">' + val.sigla + '</option>';
					});					
					$("#estados").html(options);				

					$("#estados").change(function () {				

						var options_cidades = '<option value="<?=(!empty($cidade_empresa) ? $cidade_empresa : "");?>"><?=(!empty($cidade_empresa) ? $cidade_empresa : "Escolha uma Cidade");?></option>';
						var str = "";					

						$("#estados option:selected").each(function () {
							str += $(this).text();
						});

						$.each(data, function (key, val) {
							if(val.sigla == str) {							
								$.each(val.cidades, function (key_city, val_city) {
									options_cidades += '<option value="' + val_city + '">' + val_city + '</option>';
								});							
							}
						});

						$("#cidades").html(options_cidades);

					}).change();		

				});

			});

		</script>

		<script type="text/javascript">	

			$(document).ready(function () {

				$.getJSON('<?=$site;?>estados_cidades.json', function (data) {

					var items = [];
					var options = '<option value="">Selecione o Estado</option>';	

					$.each(data, function (key, val) {
						options += '<option value="' + val.sigla + '">' + val.sigla + '</option>';
					});					
					$("#estados2").html(options);				

					$("#estados2").change(function () {				

						var options_cidades = '';
						var str = "";					

						$("#estados2 option:selected").each(function () {
							str += $(this).text();
						});

						$.each(data, function (key, val) {
							if(val.sigla == str) {							
								$.each(val.cidades, function (key_city, val_city) {
									options_cidades += '<option value="' + val_city + '">' + val_city + '</option>';
								});							
							}
						});

						$("#cidades2").html(options_cidades);

					}).change();		

				});

			});

		</script>
		<script src="<?= $site; ?>js/player.js"></script>
		<script src="<?= $site; ?>js/howler.js"></script>

		<link href="<?= $site; ?>notificacao/light-theme.min.css" rel="stylesheet">

		<script type="text/javascript" src="<?= $site; ?>notificacao/growl-notification.min.js"></script> 


		<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/JNKKKK/MoreToggles.css@0.2.1/output/moretoggles.min.css">

		<!-- Select da pagina carrinho -->
		<link href="<?=$site?>css/selectcarrinho/dist/css/select2.min.css" rel="stylesheet" />
		<script src="<?=$site?>css/selectcarrinho/dist/js/select2.min.js"></script>
		<!-- Select da pagina carrinho -->


		<!-- Radio and check inputs -->
		<link href="<?= $site; ?>css/radio-check.css" rel="stylesheet">
		<link href="<?= $site; ?>css/modal.css" rel="stylesheet">
		<script type="text/javascript" src="<?= $site; ?>js/modalhorarios.js"></script> 
		<!-- https://www.cssscript.com/pure-css-checkbox-radio-button-replacement-bootstrap-icheck/ -->
		<script defer src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
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

	<body class="leading-normal tracking-normal">
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

	
 
</header>
<!-- End Header =============================================== -->

<!-- SubHeader =============================================== -->

<?php
if(!empty($Url[1]) && $Url[1] != 'carrinho' && $Url[1] != 'home' && $Url[1] != 'contato' && file_exists('includes/'.$Url[1] . '.php')):
else:
	?>
	<?php
	if(!$detect->isMobile()):	
		?><section class="flex flex-col" id="img-head-loja">
			<?php else:?>

				<section class="parallax-window" data-parallax="scroll" data-image-src="<?=(!empty($img_header) ? URL_IMAGE.$img_header : $site.'img/sub_header.jpg');?>" data-natural-width="1400" data-natural-height="470" style="background-image: url(<?=(!empty($img_header) ? URL_IMAGE.$img_header : $site.'img/sub_header.jpg');?>); background-size: cover; background-position: center center;">
				<?php endif; ?>
				<div   id="subheader">
					<div class="flex flex-col" id="sub_content">

						<?php
						if(!empty($img_logo)):
							 
							echo "<div style=\"border-radius:100px; box-shadow: 2px 2px 2px 2px white;\" id=\"thumb\">".Check::Image("{$img_logo}", "Logo", 240, 240)."</div>";
						else:
							echo "<div style=\"border-radius:100px; box-shadow: 2px 2px 2px 2px white;\"id=\"thumb\"><img src=\"{$site}img/thumb_restaurant.jpg\" alt=\"\"></div>";
						endif;
						?>
						<div class="flex justify-center">
							<h1><?=(!empty($nome_empresa) ? $nome_empresa : 'Nome_do_seu_negócio');?></h1>
						</div>
						<?php

						 // REQUERIDOS
    // Definir horário de funcionamento diário
    // Deve estar no formato de 24 horas, separado por traço
    // Se fechado para o dia, deixe em branco (por exemplo, domingo) ou não adicione linha
    // Se aberto várias vezes em um dia, insira intervalos de tempo separados por vírgula
    


    $hours = array();      



         //CONFIGURAÇÃO DE SEGUNDA FEIRA
        if(!empty($config_segunda) && $config_segunda == "false" && !empty($config_segundaa) && $config_segundaa == "false"):
            	 $hours['mon'] = array();
        elseif(!empty($config_segunda) && $config_segunda == "true" && !empty($config_segundaa) && $config_segundaa == "true"):
            $hours['mon'] = array($segunda_manha_de.'-'.$segunda_manha_ate, $segunda_tarde_de.'-'.$segunda_tarde_ate);
        
        elseif(!empty($config_segunda) && $config_segunda == "true" && !empty($config_segundaa) && $config_segundaa == "false"):
        	  $hours['mon'] = array($segunda_manha_de.'-'.$segunda_manha_ate);
       	elseif(!empty($config_segunda) && $config_segunda == "false" && !empty($config_segundaa) && $config_segundaa == "true"):
       		$hours['mon'] = array($segunda_tarde_de.'-'.$segunda_tarde_ate);
        endif;
        //CONFIGURAÇÃO DE SEGUNDA FEIRA

        //CONFIGURAÇÃO DE TERÇA FEIRA
        if(!empty($config_terca) && $config_terca == "false" && !empty($config_tercaa) && $config_tercaa == "false"):
            	 $hours['tue'] = array();
        elseif(!empty($config_terca) && $config_terca == "true" && !empty($config_tercaa) && $config_tercaa == "true"):
            $hours['tue'] = array($terca_manha_de.'-'.$terca_manha_ate, $terca_tarde_de.'-'.$terca_tarde_ate);
        
        elseif(!empty($config_terca) && $config_terca == "true" && !empty($config_tercaa) && $config_tercaa == "false"):
        	  $hours['tue'] = array($terca_manha_de.'-'.$terca_manha_ate);
       	elseif(!empty($config_terca) && $config_terca == "false" && !empty($config_tercaa) && $config_tercaa == "true"):
       		$hours['tue'] = array($terca_tarde_de.'-'.$terca_tarde_ate);
        endif;
        //CONFIGURAÇÃO DE TERÇA FEIRA

         //CONFIGURAÇÃO DE QUARTA FEIRA
        if(!empty($config_quarta) && $config_quarta == "false" && !empty($config_quartaa) && $config_quartaa == "false"):
            	 $hours['wed'] = array();
        elseif(!empty($config_quarta) && $config_quarta == "true" && !empty($config_quartaa) && $config_quartaa == "true"):
            $hours['wed'] = array($quarta_manha_de.'-'.$quarta_manha_ate, $quarta_tarde_de.'-'.$quarta_tarde_ate);
        
        elseif(!empty($config_quarta) && $config_quarta == "true" && !empty($config_quartaa) && $config_quartaa == "false"):
        	  $hours['wed'] = array($quarta_manha_de.'-'.$quarta_manha_ate);
       	elseif(!empty($config_quarta) && $config_quarta == "false" && !empty($config_quartaa) && $config_quartaa == "true"):
       		$hours['wed'] = array($quarta_tarde_de.'-'.$quarta_tarde_ate);
        endif;
        //CONFIGURAÇÃO DE QUARTA FEIRA

         //CONFIGURAÇÃO DE QUINTA FEIRA
        if(!empty($config_quinta) && $config_quinta == "false" && !empty($config_quintaa) && $config_quintaa == "false"):
            	 $hours['thu'] = array();
        elseif(!empty($config_quinta) && $config_quinta == "true" && !empty($config_quintaa) && $config_quintaa == "true"):
            $hours['thu'] = array($quinta_manha_de.'-'.$quinta_manha_ate, $quinta_tarde_de.'-'.$quinta_tarde_ate);
        
        elseif(!empty($config_quinta) && $config_quinta == "true" && !empty($config_quintaa) && $config_quintaa == "false"):
        	  $hours['thu'] = array($quinta_manha_de.'-'.$quinta_manha_ate);
       	elseif(!empty($config_quinta) && $config_quinta == "false" && !empty($config_quintaa) && $config_quintaa == "true"):
       		$hours['thu'] = array($quinta_tarde_de.'-'.$quinta_tarde_ate);
        endif;
        //CONFIGURAÇÃO DE QUINTA FEIRA

        //CONFIGURAÇÃO DE SEXTA FEIRA
        if(!empty($config_sexta) && $config_sexta == "false" && !empty($config_sextaa) && $config_sextaa == "false"):
            	 $hours['fri'] = array();
        elseif(!empty($config_sexta) && $config_sexta == "true" && !empty($config_sextaa) && $config_sextaa == "true"):
            $hours['fri'] = array($sexta_manha_de.'-'.$sexta_manha_ate, $sexta_tarde_de.'-'.$sexta_tarde_ate);
        
        elseif(!empty($config_sexta) && $config_sexta == "true" && !empty($config_sextaa) && $config_sextaa == "false"):
        	  $hours['fri'] = array($sexta_manha_de.'-'.$sexta_manha_ate);
       	elseif(!empty($config_sexta) && $config_sexta == "false" && !empty($config_sextaa) && $config_sextaa == "true"):
       		$hours['fri'] = array($sexta_tarde_de.'-'.$sexta_tarde_ate);
        endif;
        //CONFIGURAÇÃO DE SEXTA FEIRA

         //CONFIGURAÇÃO DE SABADO
        if(!empty($config_sabado) && $config_sabado == "false" && !empty($config_sabadoo) && $config_sabadoo == "false"):
            	 $hours['sat'] = array();
        elseif(!empty($config_sabado) && $config_sabado == "true" && !empty($config_sabadoo) && $config_sabadoo == "true"):
            $hours['sat'] = array($sabado_manha_de.'-'.$sabado_manha_ate, $sabado_tarde_de.'-'.$sabado_tarde_ate);
        
        elseif(!empty($config_sabado) && $config_sabado == "true" && !empty($config_sabadoo) && $config_sabadoo == "false"):
        	  $hours['sat'] = array($sabado_manha_de.'-'.$sabado_manha_ate);
       	elseif(!empty($config_sabado) && $config_sabado == "false" && !empty($config_sabadoo) && $config_sabadoo == "true"):
       		$hours['sat'] = array($sabado_tarde_de.'-'.$sabado_tarde_ate);
        endif;
        //CONFIGURAÇÃO DE SABADO

        //CONFIGURAÇÃO DE DOMINGO
        if(!empty($config_domingo) && $config_domingo == "false" && !empty($config_domingoo) && $config_domingoo == "false"):
            	 $hours['sun'] = array();
        elseif(!empty($config_domingo) && $config_domingo == "true" && !empty($config_domingoo) && $config_domingoo == "true"):
            $hours['sun'] = array($domingo_manha_de.'-'.$domingo_manha_ate, $domingo_tarde_de.'-'.$domingo_tarde_ate);
        
        elseif(!empty($config_domingo) && $config_domingo == "true" && !empty($config_domingoo) && $config_domingoo == "false"):
        	  $hours['sun'] = array($domingo_manha_de.'-'.$domingo_manha_ate);
       	elseif(!empty($config_domingo) && $config_domingo == "false" && !empty($config_domingoo) && $config_domingoo == "true"):
       		$hours['sun'] = array($domingo_tarde_de.'-'.$domingo_tarde_ate);
        endif;
        //CONFIGURAÇÃO DE DOMINGO
						
						$lerbanco->ExeRead("ws_datas_close", "WHERE user_id = :delivdata", "delivdata={$getu}");
						$exceptions = array();
						if($lerbanco->getResult()):
							foreach($lerbanco->getResult() as $dadosC):
								extract($dadosC);
								$i = explode('/', $data);
								$i = array_reverse($i);
								$i = implode("-", $i);							

								if(isDateExpired($i, 1)):
									$exceptions["{$i}"] = array();							
								endif;
							endforeach;
						endif;

					
					// Iniciando a classe
						$store_hours = new StoreHours($hours, $exceptions);

					
					 // Display open / closed menssagem

					
					if($store_hours->is_open()) {
						echo "<div class=\"flex justify-center\"><div style=\"border: 2px solid #86c953;background-color:#86c953;color:#ffffff;font-size:15px;font-weight:bold;border-radius:5px;\">{$texto['msg_aberto']}</div></div>";
					} else {
						echo "<div class=\"flex justify-center\"> <div style=\"border: 2px solid red;padding:2px;background-color:red;color: #ffffff;font-size:15px;font-weight:bold;border-radius:5px;\">{$texto['msg_fechado']}</div></div>";
					}?>
						<div class="mt-5 flex justify-center flex-row">
						<svg width="30" height="30" viewBox="0 0 52 48" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M25.9321 0L31.9912 17.9656H51.599L35.736 29.0689L41.7951 47.0344L25.9321 35.9311L10.0691 47.0344L16.1282 29.0689L0.265211 17.9656H19.873L25.9321 0Z" fill="#FFC000"/>
					</svg>	
					<svg width="30" height="30" viewBox="0 0 52 48" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M25.9321 0L31.9912 17.9656H51.599L35.736 29.0689L41.7951 47.0344L25.9321 35.9311L10.0691 47.0344L16.1282 29.0689L0.265211 17.9656H19.873L25.9321 0Z" fill="#FFC000"/>
					</svg>	
					<svg width="30" height="30" viewBox="0 0 52 48" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M25.9321 0L31.9912 17.9656H51.599L35.736 29.0689L41.7951 47.0344L25.9321 35.9311L10.0691 47.0344L16.1282 29.0689L0.265211 17.9656H19.873L25.9321 0Z" fill="#FFC000"/>
					</svg>	
					<svg width="30" height="30" viewBox="0 0 52 48" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M25.9321 0L31.9912 17.9656H51.599L35.736 29.0689L41.7951 47.0344L25.9321 35.9311L10.0691 47.0344L16.1282 29.0689L0.265211 17.9656H19.873L25.9321 0Z" fill="#FFC000"/>
					</svg>		
					<svg width="30" height="30" viewBox="0 0 52 48" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M25.9321 0L31.9912 17.9656H51.599L35.736 29.0689L41.7951 47.0344L25.9321 35.9311L10.0691 47.0344L16.1282 29.0689L0.265211 17.9656H19.873L25.9321 0Z" fill="#FFC000"/>
					</svg>	
				</div>

				</div>
				</div>
				</div><!-- End sub_content -->
				<div style="padding:15px; justify-content: space-evenly; background: linear-gradient(90deg, #7233A1 0%, #8c52ff 100%);" class="flex flex-row w-full justify-evenly">
					<div class="flex  mr-2 flex-row justify-evenly"> 
						<div class="flex mr-2">
							<img class="icons-header" src="<?=$site?>img/aberto_1.png">
						</div>
						<div class="flex">
								<a class="header-info" data-toggle="modal" data-target=".bd-example-modal-sm" style="color: #ffffff;cursor: pointer; text-decoration: none;">Aberto até 21h</a>
							</div>
					</div>
					<div class="flex  mr-2 flex-row justify-evenly"> 
					<div class="flex mr-2">
						<img class="icons-header" src="<?=$site?>img/telefone_11.png">
						</div>
						<div class="flex">
					<a class="header-info" data-toggle="modal" data-target=".bd-example-modal-sm" style="color: #ffffff;cursor: pointer; text-decoration: none;">Ligar</a>
					</div>	
				</div>
				<div class="flex  mr-2 flex-row justify-evenly"> 
					<div class="flex mr-2">
					<img class="icons-header" src="<?=$site?>img/minimo_1.png">
						
					</div>
					<div class="flex">
					<a class="header-info" data-toggle="modal" data-target=".bd-example-modal-sm" style="color: #ffffff;cursor: pointer; text-decoration: none;"> P.mínimo: <span>R$: <?=$minimo_delivery?><span></i></a>
					</div>
					</div>
					<div class="flex  mr-2 flex-row justify-evenly"> 
					<div class="flex mr-2">
					<img class="icons-header" src="<?=$site?>img/info_1.png">
					</div>	
					<div class="flex">
					<a class="header-info" data-toggle="modal" data-target=".modal-horarios" style="color: #ffffff;cursor: pointer; text-decoration: none;">Informações</a>
						</div>
						</div>
				</div>
				</div>
				</section><!-- End section -->
			 
		 
				
	
		
			

			

		<!-- End SubHeader ============================================ -->
 
		<?php endif; ?>

		<!-- Content ================================================== -->
	 

<?php				

if(file_exists('includes/'.$Url[1] . '.php')):
	require 'includes/'.$Url[1] . '.php';
else:
	require 'includes/home.php';
endif;
?>
</div><!-- End container -->
<!-- End Content =============================================== -->

<!-- Footer ================================================== -->
<div   class="modal fade modal-horarios" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="flex flex-col w-full">
				<div  class="config-header w-full text-bold text-center text-white">
											<p>INFORMAÇÕES</p>
									</div>	
				<br />
				
					 
						<div style="padding: 8px;" class="flex items-end flex-row w-full">
							<img src="<?= $site ?>/img/entrega_1.png">
							<div class="w-full">
							<p style="width:80px;position: relative;
  right: 70px;font-size:12px" ><?=$msg_tempo_delivery?></p>
</div>
							</div> 
					 
					 
		 
				<div style="padding: 8px;" class="flex items-end flex-row w-full">
					<img src="<?= $site ?>/img/mesa_1.png">
					<div class="w-full">
							<p style="width:80px;position: relative;
  right: 70px;font-size:12px" ><?=$msg_tempo_delivery?></p>
</div>
					
				</div>

				<div style="padding: 8px;" class="flex items-end flex-row w-full">
					<img src="<?= $site ?>/img/balcao_1.png">
					<div class="w-full">
							<p style="width:80px;position: relative;
				right: 70px;font-size:12px" ><?=$msg_tempo_buscar?></p>
				</div>
				</div>
				<div style="color: black;
  justify-content: center;
  text-align: center" class="flex flex-col w-full">
					<h3 style="font-size:15px">Endereço para retirada:</h3>
					<p style="font-size:10px">Cidade:<?=$cidade_empresa?> - Bairro:  <?=$end_bairro_empresa?> Rua: <?= $end_rua_n_empresa?> Cep: <?=$cep_empresa?></p>
				</div>
				 
				<iframe class="w-full" style="padding:15px; height:500px" src="http://maps.google.com/maps?q=-16.370029217343763,-46.885539728241014&z=16&output=embed" height="450" width="600"></iframe>
				 
				 
			 

	</div>
	<div class="w-full">
	 
		<button style="height:30px;background-color: #E70D0D;"class="w-full aceita_entrega"  type="button" class="close" data-dismiss="modal">Voltar</button>
	</div>
</div>

</div>


</div><!-- FINAL DO MODAL QUE APRESENHA OS HORÁRIOS -->


<!-- INICIO DO MODAL QUE APRESENtA OS HORÁRIOS -->
<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div style="width: 300px;position: absolute;top: 50%;left: 0;right: 0;margin: 0 auto"class="modal-dialog modal-sm">
	<div  class="config-header w-full text-bold text-center text-white">
				<p>ENTRAR EM CONTATO</p>
			</div>	
		<div class="bg-white flex flex-col w-full">
		
		<div style="margin-top: 10px; margin-bottom: 10px;" class="flex flex-row w-full">
		<a href="https://api.whatsapp.com/send?1=pt_BR&phone=<?=$telefone_empresa?>">	
		<div  class="box-modal flex justify-center flex-col w-full">			
		
			<div style="justify-content: center; padding: 10px;" class="flex w-full">	
			<img style="width:100px;heigth:100px" src="<?= $site ?>/img/whatsapp-11.png">
				
				</div>
				<div class="flex justify-center w-full">	
				<p style="font-size:12px" >Whatsapp</p>
				 			
				</div>
				</div>
				</a>
				<a href="tel:<?=$telefone_empresa?>">
				<div class=" box-modal flex justify-center flex-col w-full">			
					<div style="justify-content: center;padding: 10px;" class="flex w-full">	
			<img style="width:100px;heigth:100px" src="<?= $site ?>/img/chamada-telefonica_1.png">
				
				</div>
				<div class="flex justify-center w-full">	
				<p style="font-size:12px" >Telefone</p>
				 			
				</div>
				</div>
				</div>
				</div>
				<div class="w-full">
	 
	 <button style="height:30px;background-color: #E70D0D;"class="w-full aceita_entrega"  type="button" class="close" data-dismiss="modal">Voltar</button>
 		</div>
				
			</div>

			 
			
		
	</div>


</div><!-- FINAL DO MODAL QUE APRESENHA OS HORÁRIOS -->

<!-- <footer>		
	<div id="social_footer">
		<ul>
			<?php echo ($facebook_status == 2 && !empty($facebook_empresa) ? "<li><a target=\"_blank\" href=\"{$facebook_empresa}\"><i class=\"icon-facebook\"></i></a></li>" : "");?>
			<?php echo ($instagram_status == 2 && !empty($instagram_empresa) ? "<li><a target=\"_blank\" href=\"{$instagram_empresa}\"><i class=\"icon-instagram\"></i></a></li>" : "");?>
			<?php echo ($twitter_status == 2 && !empty($twitter_empresa) ? "<li><a target=\"_blank\" href=\"{$twitter_empresa}\"><i class=\"icon-twitter\"></i></a></li>" : "");?>
		</ul>
		<p>© <?=(!empty($nome_empresa) ? $nome_empresa : 'Nome_do_seu_negócio').' - '.date('Y');?></p>
	</div>		
</footer> -->
<!-- End Footer =============================================== -->

<div class="layer"></div><!-- Mobile menu overlay mask -->



<!-- COMMON SCRIPTS -->


<script src="<?= $site; ?>js/functions.js"></script>
<script src="<?= $site; ?>assets/validate.js"></script>
<script src="<?= $site; ?>js/jquery.mask.js"></script>
<script src="<?= $site; ?>js/index-btn-file.js"></script>
<script src="<?= $site; ?>js/funcoesjs.js"></script>
<script src="<?= $site; ?>js/custom-file-input.js"></script>
<script src="<?= $site; ?>js/bootstrap-datepicker.js"></script>
<script src="<?= $site; ?>js/parallax.js"></script>
<script src="<?= $site; ?>js/parallax.min.js"></script>
<script src="<?= $site; ?>js/printThis.js"></script>
<script src="<?=$site;?>js/suportewats.js"></script>
<script src="<?=$site;?>js/slick.min.js"></script>
<script src="<?=$site;?>js/lightslider.min.js"></script>
<script src="<?=$site;?>js/bootstrap.min.js"></script>

<script>
	jQuery(document).ready(function($){
		$('a').not('[href*="'+document.domain+'"]').attr('target', '_blank');
		$('a').not('[href*="'+document.domain+'"]').attr('rel', 'external nofollow');
	});
</script>

<script>
	$( function() {
		 
		$(document).on('click', 'a[href^="#"]', function (event) {
    event.preventDefault();

    $('html, body').animate({
        scrollTop: $($.attr(this, 'href')).offset().top - 100
    }, 600);
});
		 
        $('a[href]').attr('target', '_self'); 
 

  $('.slick').slick({
	 
  
  variableWidth: true,
  infinite: false,
  slidesToShow: 1,
  slidesToScroll: 1,
  touchThreshold:50,
  useCSS : false,
  edgeFriction : 0.05,
    mobileFirst : true,
	speed : 50,
  swipeToSlide : true,
  touchMove : true,
  
});
	
$('.slick-cat').slick({
	 
  
	 variableWidth: true,
	  infinite: false,
	  
	  slidesToScroll: 4,
	 
	 
	});
		


 
		$( "#datepicker" ).datepicker();
	} );
</script>


<!-- NOTE: prior to v2.2.1 tiny-slider.js need to be in <body> -->


<!-- SPECIFIC SCRIPTS -->
<script  src="<?= $site; ?>js/cat_nav_mobile.js"></script>
<script>$('#cat_nav').mobileMenu();</script>
 
<script>
	$('#cat_nav a[href^="#"]').on('click', function (e) {
		e.preventDefault();
		var target = this.hash;
		var $target = $(target);
		$('html, body').stop().animate({
			'scrollTop': $target.offset().top - 70
		}, 900, 'swing', function () {
			window.location.hash = target;
		});
	});
</script>
 
 

<?php
if(!empty($_SESSION['userlogin'])):
	?>
	<!-- Specific scripts -->
	<script src="<?= $site; ?>js/tabs.js"></script>

	<script type="text/javascript">
		$('#delete').on('show.bs.modal', function (event) {
			  var button = $(event.relatedTarget) // Button that triggered the modal
			  var recipient = button.data('whatever') // Extract info from data-* attributes
			  var recipientnome = button.data('whatevernome') // Extract info from data-* attributes
			  var recipientimg = button.data('whateverimg') // Extract info from data-* attributes
			  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
			  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
			  var modal = $(this)
			  modal.find('.modal-title').text(recipientnome)
			  modal.find('#campo_id').val(recipient)
			  modal.find('#campo_img').val(recipientimg)
			})
		</script>

		<script>

			$('#dinheiro').mask('#.##0,00', {reverse: true});
			$('.telefone').mask('(00) 0 0000-0000');
			$('.estado').mask('AA');
			$('.cpf').mask('000-000.000-00');
			$('.cnpj').mask('00.000.000/0000-00');
			$('.rg').mask('00.000.000-0');
			$('.cep').mask('00000-000');
			$('.dataNascimento').mask('00/00/0000');
			$('.placaCarro').mask('AAA-0000');
			$('.horasMinutos').mask('00:00');
			$('.cartaoCredito').mask('0000 0000 0000 0000');
			$('.numero').mask('#########0');
			$('.descontoporcentagem').mask('##0');



		</script>
		<?php
	else:
	endif;
	?>


	<script type="text/javascript">
//plugin bootstrap minus and plus
//http://jsfiddle.net/laelitenetwork/puJ6G/
$('.btn-number').click(function(e){
	e.preventDefault();

	fieldName = $(e.currentTarget).attr('data-field');
	type      = $(e.currentTarget).attr('data-type');
	adicional = $(e.currentTarget).attr('data-idadicional') ? $(e.currentTarget).attr('data-idadicional') : ""
	var input = adicional ? $("input[name='"+fieldName+"_"+adicional+"']") : $("input[name='"+fieldName+"']")
	var valorAdicional = $(e.currentTarget).attr('data-vladicional');
	var idItem = $(e.currentTarget).attr('data-iditem');
	var currentVal = parseInt(input.val());
	var idTipo =  $(e.currentTarget).attr('data-idtipo');
	var qtItem = parseFloat($("input[name='quantidade']").val());

	var qtMaxTiposAdicionais = $(e.currentTarget).data('maxadcionais') ? parseFloat($(e.currentTarget).data('maxadcionais')) : "";
	$("#valorItem_"+idItem).attr('data-add', false);
	var adicionais = $("#valorItem_"+idItem).attr('data-add');
	if (!isNaN(currentVal)) {
		if(type == 'minus') {

			if(currentVal > input.attr('min')) {
				input.val(currentVal - 1).change();
				if(adicional && valorAdicional && idItem && parseFloat(valorAdicional)>0){
				
					var inputsAdicionais = $('.input-count_'+idTipo);
					var valInputsAdicionais = [];
					var sumValorAdicionais = 0;

					for(let i=0;i<inputsAdicionais.length;i++){
						sumValorAdicionais += parseFloat($(inputsAdicionais[i]).val());

					}

					var inputsAdicionaisTotal = $('.input-total');
					 
					 var sumValorAdicionaisTotal = 0;
 
					 for(let i=0;i<inputsAdicionaisTotal.length;i++){
						 sumValorAdicionaisTotal += parseFloat($(inputsAdicionaisTotal[i]).val());
 
					 }
				
					if(sumValorAdicionais==0 && sumValorAdicionaisTotal==0 && adicionais=='false'){
						let valorItem = parseFloat($("#valorItem_"+idItem).attr('data-valoritem'));
						let valorAtualizado = parseFloat(valorItem*qtItem).toFixed(2);
						$('#valorItem_'+idItem).text(valorAtualizado);
						$("#valorItem_"+idItem).attr('data-valoratual', valorAtualizado)
						$("#valor_item").val((valorAtualizado));
						$("#valorItem_"+idItem).attr('data-add', false);

						 
					if(qtMaxTiposAdicionais && sumValorAdicionais == qtMaxTiposAdicionais){
						$('.btn-plus_'+idTipo).attr('disabled', true);
						var parent = $('.btn-plus_'+idTipo).parent();
						$(parent).css('background', "grey");
					}else{
						$('.btn-plus_'+idTipo).attr('disabled', false);
						var parent = $('.btn-plus_'+idTipo).parent();
						$(parent).css('background', "#46DC4C");
					}
						 
					}else{
					let valorAtual = parseFloat($("#valorItem_"+idItem).attr('data-valoratual'));
					valorAdicional = parseFloat(valorAdicional);
					
					
					let valorAtualizadoItem = valorAtual-valorAdicional;


					$('#valorItem_'+idItem).text(parseFloat(valorAtualizadoItem).toFixed(2));
					 
					$("#valorItem_"+idItem).attr('data-valoratual', valorAtualizadoItem)
					$("#valor_item").val(parseFloat(valorAtualizadoItem).toFixed(2))
						console.log("QtMaxTiposAdicionais:" + qtMaxTiposAdicionais)
						console.log("SumAdicionais:" + sumValorAdicionais)
					if(qtMaxTiposAdicionais && sumValorAdicionais == qtMaxTiposAdicionais){
						$('.btn-plus_'+idTipo).attr('disabled', true);
						var parent = $('.btn-plus_'+idTipo).parent();
						$(parent).css('background', "grey");
					}else{
						$('.btn-plus_'+idTipo).attr('disabled', false);
						var parent = $('.btn-plus_'+idTipo).parent();
						$(parent).css('background', "#46DC4C");
					}

					}
				     
 

				
				}
			} 
		 
		} else if(type == 'plus') {

			if(currentVal < input.attr('max')) {
				input.val(currentVal + 1).change();
				if(adicional && valorAdicional && idItem &&parseFloat(valorAdicional)>0){
					

					var inputsAdicionais = $('.input-count_'+idTipo);
					var valInputsAdicionais = [];
					var sumValorAdicionais = 0;


					var inputsAdicionaisTotal = $('.input-total');
					 
					var sumValorAdicionaisTotal = 0;

					for(let i=0;i<inputsAdicionaisTotal.length;i++){
						sumValorAdicionaisTotal += parseFloat($(inputsAdicionaisTotal[i]).val());

					}
					if(sumValorAdicionais==0 && sumValorAdicionaisTotal==0 && adicionais=='false'){
						let valorItem = parseFloat($("#valorItem_"+idItem).attr('data-valoritem'));
						let valorAtualizado = parseFloat(valorItem*qtItem).toFixed(2);
						$('#valorItem_'+idItem).text(valorAtualizado);
						$("#valorItem_"+idItem).attr('data-valoratual', valorAtualizado)
						// $("#valor_item").val((valorAtualizado));
						$("#valorItem_"+idItem).attr('data-add', false);
						
						
						if(qtMaxTiposAdicionais && sumValorAdicionais == qtMaxTiposAdicionais){
						$('.btn-plus_'+idTipo).attr('disabled', true);
						var parent = $('.btn-plus_'+idTipo).parent();
						$(parent).css('background', "grey");
					}else{
						$('.btn-plus_'+idTipo).attr('disabled', false);
						var parent = $('.btn-plus_'+idTipo).parent();
						$(parent).css('background', "#46DC4C");
					}
						 
					}else{

						$("#valorItem_"+idItem).attr('data-add', true);
						let valorAtual = parseFloat($("#valorItem_"+idItem).attr('data-valoratual'));
		 
					valorAdicional = parseFloat(valorAdicional);
					let valorAtualizadoItem = valorAtual+valorAdicional;
					$("#valorItem_"+idItem).attr('data-valoratual', valorAtualizadoItem)

					$('#valorItem_'+idItem).text(parseFloat(valorAtualizadoItem).toFixed(2));
					let valorPedidoAtualizado = $('#valorItem_'+idItem).text();
					$("#valorItem_"+idItem).attr('data-valoratual', valorAtualizadoItem)
					// $("#popuppedido_"+idItem+" #valor_item").val(parseFloat(valorAtualizadoItem).toFixed(2));
					
					if(qtMaxTiposAdicionais && sumValorAdicionais == qtMaxTiposAdicionais){
						$('.btn-plus_'+idTipo).attr('disabled', true);
						var parent = $('.btn-plus_'+idTipo).parent();
						$(parent).css('background', "grey");
					}else{
						$('.btn-plus_'+idTipo).attr('disabled', false);
						var parent = $('.btn-plus_'+idTipo).parent();
						$(parent).css('background', "#46DC4C");
					}

				}
		 
				     
 

					
				}
			}
			 
		}
	} else {
		input.val(0);
	}
});




$('.btn-number_qt_prod').click(function(e){
	e.preventDefault();

	fieldName = $(e.currentTarget).attr('data-field');
	type      = $(e.currentTarget).attr('data-type');
	var idItem = $(e.currentTarget).attr('data-iditem');
	var valorItem = parseFloat($('#valorItem_'+idItem).data('valoritem')).toFixed(2);
	var input = $("input[name='"+fieldName+"']");
	   
	var currentVal = parseInt(input.val());

	var adicionais = $("#valorItem_"+idItem).attr('data-add');
	var qtItem = parseFloat($(input).val());
	if (!isNaN(currentVal)) {
		if(type == 'minus') {

			if(currentVal > input.attr('min')) {
				input.val(currentVal - 1).change();
				if(input){
					
				
			 				 
				
					
					var inputsAdicionais = $('.input-total');
					var valInputsAdicionais = [];
					var sumValorAdicionais = 0;

					for(let i=0;i<inputsAdicionais.length;i++){
						sumValorAdicionais += parseInt($(inputsAdicionais[i]).val());

					}

					var inputsAdicionaisTotal = $('.input-total');
					 
					 var sumValorAdicionaisTotal = 0;
 
					 for(let i=0;i<inputsAdicionaisTotal.length;i++){
						 sumValorAdicionaisTotal += parseFloat($(inputsAdicionaisTotal[i]).val());
 
					 }
					 
					if(sumValorAdicionais==0 && sumValorAdicionaisTotal==0 && adicionais=='false'){
						qtItem = qtItem - 1;
						 
				 
						let valorItem = parseFloat($("#valorItem_"+idItem).attr('data-valoritem'));
						let valorAtualizado = parseFloat(valorItem*qtItem).toFixed(2);
					 
						$("#valorItem_"+idItem).attr('data-valoratual', valorAtualizado)
						$('#valorItem_'+idItem).text(parseFloat(valorAtualizado).toFixed(2));
						// $("#popuppedido_"+idItem+" #valor_item").val((valorAtualizado));
						 
						 
						
						 
						
						
						
					 
					}else if(adicionais=='true'){
					 

						let valorItem = parseFloat($("#valorItem_"+idItem).attr('data-valoritem'));
						let valorAtual =parseFloat($("#valorItem_"+idItem).attr('data-valoratual'));
						let valorAtualizado = valorAtual - valorAtual;
			
						$("#valorItem_"+idItem).attr('data-valoratual', valorAtualizado);
						$('#valorItem_'+idItem).text(parseFloat(valorAtualizado).toFixed(2));
						// $("#popuppedido_"+idItem+" #valor_item").val((valorAtualizado).toFixed(2))

						
					
					}
					 
					
		 
 
		 
				     
 
 
				}
			} 
		 
		} else if(type == 'plus') {

			if(currentVal < input.attr('max')) {
				input.val(currentVal + 1).change();
				if(input){
					var qtItem = parseFloat($(input).val());
					var adicionais = $("#valorItem_"+idItem).attr('data-add');
					var inputsAdicionais = $('.input-total');
					var valInputsAdicionais = [];
					var sumValorAdicionais = 0;

					for(let i=0;i<inputsAdicionais.length;i++){
						sumValorAdicionais += parseFloat($(inputsAdicionais[i]).val());

					}
					var inputsAdicionaisTotal = $('.input-total');
					 
					 var sumValorAdicionaisTotal = 0;
 
					 for(let i=0;i<inputsAdicionaisTotal.length;i++){
						 sumValorAdicionaisTotal += parseFloat($(inputsAdicionaisTotal[i]).val());
 
					 }
					 console.log("SumTotalAdiconais: " + sumValorAdicionaisTotal )
			 
					if(sumValorAdicionais==0 && sumValorAdicionaisTotal==0 && adicionais=='false'){
						 qtItem = qtItem;
						 console.log("Quantidade plus button: " + qtItem);
						let valorItem = parseFloat($("#valorItem_"+idItem).attr('data-valoritem'));
						let valorAtualizado = parseFloat(valorItem*qtItem).toFixed(2);
						$('#valorItem_'+idItem).text(valorAtualizado);
						$("#valorItem_"+idItem).attr('data-valoratual', valorAtualizado)
						// $("#valor_item").val((valorAtualizado));
						$("#valorItem_"+idItem).attr('data-add', false);
						 
					}else if(adicionais=='true'){
						
						let valorItem = parseFloat($("#valorItem_"+idItem).attr('data-valoritem'));
						let valorAtual =parseFloat($("#valorItem_"+idItem).attr('data-valoratual'));
						let valorAtualizado = valorAtual + valorAtual;
						 
						$("#valorItem_"+idItem).attr('data-valoratual', valorAtualizado);
					
						// $("#valor_item").val((valorAtualizado).toFixed(2))

						$('#valorItem_'+idItem).text(parseFloat(valorAtualizado).toFixed(2));
					


					}
					 
					  
					 
					 
					
		 
		 
				     
 
 

				}
			}
			 
		}
	} else {
		input.val(0);
	}
});










$('.input-number').focusin(function(){
	$(this).data('oldValue', $(this).val());
});
$('.input-number').change(function(e) {

	

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


});
$(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
             // Allow: Ctrl+A
             (e.keyCode == 65 && e.ctrlKey === true) || 
             // Allow: home, end, left, right
             (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
             return;
         }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
        	e.preventDefault();
        }
    });






	//if ($("#soma-delivery").prop("checked", true)){
		
	//}
</script>



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

<script type="text/javascript">
	const selected = document.querySelector(".selected");
	const optionsContainer = document.querySelector(".options-container");
	const searchBox = document.querySelector(".search-box input");

	const optionsList = document.querySelectorAll(".option");

	selected.addEventListener("click", () => {
		optionsContainer.classList.toggle("active");

		searchBox.value = "";
		filterList("");

		if (optionsContainer.classList.contains("active")) {
			searchBox.focus();
		}
	});

	optionsList.forEach(o => {
		o.addEventListener("click", () => {
			selected.innerHTML = o.querySelector("label").innerHTML;
			optionsContainer.classList.remove("active");
		});
	});

	searchBox.addEventListener("keyup", function(e) {
		filterList(e.target.value);
	});

	const filterList = searchTerm => {
		searchTerm = searchTerm.toLowerCase();
		optionsList.forEach(option => {
			let label = option.firstElementChild.nextElementSibling.innerText.toLowerCase();
			if (label.indexOf(searchTerm) != -1) {
				option.style.display = "block";
			} else {
				option.style.display = "none";
			}
		});
	};

</script>



<?php
if(!empty($Url[1]) && $Url[1] != 'carrinho' && $Url[1] != 'home' && $Url[1] != 'contato' && file_exists('includes/'.$Url[1] . '.php')):
	?>
<div id='whatsapp-chat' class='hide'>
	<div class='header-chat'>
		<div class='head-home'>
			<h3 style="color: #ffffff;">    
				<?php
				$hr = date(" H ");
				if($hr >= 12 && $hr<18) {
					$resp = "Boa tarde!";}
					else if ($hr >= 0 && $hr <12 ){
						$resp = "Bom dia!";}
						else {
							$resp = "Boa noite!";}
							echo "$resp";
							?>
						</h3>
						<p>Clique em um de nossos representantes abaixo para conversar no WhatsApp ou envie um email para <?=$texto['emailSuporteSite'];?></p></div>
						<div class='get-new hide'><div id='get-label'></div><div id='get-nama'></div></div></div>
						<div class='home-chat'>
							<!-- Info Contact Start -->
							<a class='informasi' style="cursor: pointer;"  title='Chat Whatsapp'>
								<div class='info-avatar'><img src='<?=$site?>img/supportmale.png'/></div>
								<div class='info-chat'>
									<span class='chat-label'>Suporte Técnico</span>
									<span class='chat-nama'>Atendimento ao Cliente 1</span>
								</div><span class='my-number'><?=$texto['telefoneAdministracaoTecnica'];?></span>
							</a>
							<!-- Info Contact End -->
							<!-- Info Contact Start -->
							<a class='informasi' style="cursor: pointer;" title='Chat Whatsapp'>
								<div class='info-avatar'><img src='<?=$site?>img/supportfemale.png'/></div>
								<div class='info-chat'>
									<span class='chat-label'>Suporte Vendas</span>
									<span class='chat-nama'>Atendimento ao Cliente 2</span>
								</div><span class='my-number'><?=$texto['telefoneAdministracaoVendas'];?></span>
							</a>
							<!-- Info Contact End -->
							<div class='blanter-msg'><b>HORÁRIOS: </b> de <i><?=$texto['horariosSuporteSite']?></i></div></div>
							<div class='start-chat hide'>
								<div class='first-msg'><span>Olá, Como posso te ajudar?</span></div>
								<div class='blanter-msg'>
									<input type="text" id='chat-input2' maxlength='120' class="form-control" placeholder='Escreva uma pergunta...' />
									<a style="cursor: pointer;" id='send-it'><i class="fa fa-paper-plane" aria-hidden="true"></i></a></div></div>
									<div id='get-number'></div><a style="cursor: pointer;" class='close-chat'>×</a>
								</div>
								<a style="cursor: pointer;" class='blantershow-chat' title='Show Chat'><i class='fa fa-whatsapp'></i>Ajuda?</a>
								<!-- partial -->
								<?php
							endif;
							?>


							<?php

							$idcupom = (!empty($_POST['idcupom']) ? $_POST['idcupom'] : '');
							$useridum   = (!empty($_POST['user_id']) ? $_POST['user_id'] : '');

							$getCupom = (!empty($_POST['codigodocupom']) ? $_POST['codigodocupom'] : '');
							$userid   = (!empty($_POST['user_id']) ? $_POST['user_id'] : '');



							if(!empty($idcupom) && !empty($useridum)):

								$lerbanco->ExeRead("cupom_desconto", "WHERE user_id = :iduser AND id_cupom = :idcupomm", "iduser={$useridum}&idcupomm={$idcupom}");
							if($lerbanco->getResult()):
								$getdbcupomm = $lerbanco->getResult();
	setcookie("popupcupom", $getdbcupomm[0]['id_cupom'], time() + (86400 * 1)); // 86400 = 1 dia
endif;	

elseif(!empty($getCupom) && !empty($userid)):

	$lerbanco->ExeRead("cupom_desconto", "WHERE user_id = :iduser AND ativacao = :ativacupom", "iduser={$userid}&ativacupom={$getCupom}");
if($lerbanco->getResult()):
	$getdbcupom = $lerbanco->getResult();

	if($getdbcupom[0]['total_vezes'] <= 0):
		echo "erro1";
	elseif(!isDateExpired($getdbcupom[0]['data_validade'], 1)):
		echo "erro2";
	elseif(!empty($_SESSION['desconto_cupom'])):
		echo "erro4";
	else:
		$subtraicupom = array();
		$subtraicupom['total_vezes'] = $getdbcupom[0]['total_vezes'] - 1;
		$updatebanco->ExeUpdate("cupom_desconto", $subtraicupom, "WHERE user_id = :userid AND ativacao = :upp", "userid={$userid}&upp={$getCupom}");
		if(!$updatebanco->getResult()): 
			echo "erro3";
		else:		

			//CRIA A ATIVAÇÃO DO CUPOM ATRAVES DA SESSION
			$_SESSION['desconto_cupom'] = array();
			$_SESSION['desconto_cupom']['desconto'] = $getdbcupom[0]['porcentagem'];
			$_SESSION['desconto_cupom']['user_id']  = $user_id;

			// CRIA A VALIDAÇÃO DO POP UP VIA COOCKIE
			setcookie("popupcupom", $getdbcupom[0]['id_cupom'], time() + (86400 * 1000)); // 86400 = 1 dia

			//MANDA EXIBIR A MENSAGEM DE ATIVAÇÃO
			echo "true";						


		endif;

	endif;
else:
	echo "erro0";
endif;


endif;
?>
</body>
</html>
<?php


endif;
ob_end_flush();
?>