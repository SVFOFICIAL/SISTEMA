<?php
ob_start();
session_start();
require('../sistema/_app/Config.inc.php');
 
require('../sistema/_app/Mobile_Detect.php');
$detect = new Mobile_Detect;

$site = ADMIN_URL;
$sistema = HOME;

$login = new AdministradorLogin(1);

$logoff = filter_input(INPUT_GET, 'logoff', FILTER_VALIDATE_BOOLEAN);

if(!$login->CheckLogin()):
    unset($dataLogin['administrador']);
    header("Location: {$site}");
else:
    $adminlogin =  $_SESSION['administrador'];
endif;

if(!empty($logoff) && $logoff == 'true'):
    unset($_SESSION['administrador']);
    header("Location: {$site}admin");
endif;

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
    <title><?=$texto['nome_site_landing'];?> - Administrar</title>
    <!-- Bootstrap Core CSS -->
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Menu CSS -->
 
    <!-- animation CSS -->
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="<?= $sistema; ?>css/datepicker.css" rel="stylesheet">
    <link href="<?=$sistema;?>css/flowbite.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/richtext.min.css">
    <link href="<?= $sistema; ?>css/tailwind.min.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="css/colors/blue-dark.css" id="theme" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

<link href="<?= $sistema; ?>css/jquery.peekabar.min.css" rel="stylesheet">


<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"> -->
<link href="<?=$sistema;?>css/icheck/icheck-material.css" rel="stylesheet">
<link href="<?=$sistema;?>css/style-configuracao.css" rel="stylesheet">


<style>

   
.btn-info, .btn-info.disabled {
  background: rgb(70, 220, 76) !important;
  border: 1px solid rgb(70, 220, 76) !important;
}
.modal-dialog{
    overflow-y: initial !important
}
 
 
.btn-info:hover {
    background: rgb(70, 220, 76) !important;
 opacity: 0.7 !important;
}
.white-box{
    background:#7232A0 !important;
}

.notification-msg{
    z-index: 10000000 !important;
}
.white-box span,h3{
    color:white;
 
}

.modal-content{
    border-radius:10px !important
}
.white-box .box-title {
 
  font-size: 15px !important;
}
.indent_title_in{
	position:relative;
	padding-left:60px;
	margin-bottom:20px;
}
.admin-table > th{
    color:white;
}
.datepicker {
   
 
}

  

.indent_title_in p{
	color:#777;
	margin:0;
	padding:0;
}

label {
    color:black;
}

.indent_title_in h3{
	color:black;
	margin:0;
	padding:0;
    font-size:20px !important;
}


table.dataTable thead .sorting::after {
  content: "";
  float: unset;
  font-family: unset;
  color: unset;
}
#adminTable>thead>tr>th {
 
    border-bottom: unset;
}

#adminTable tbody > tr > td {
  border-top: unset !important;
}
    </style>

</head>

<body style="background:white" class="fix-header">
    
        <div class="flex flex-col">
             <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar" type="button"  class="inline-flex items-center p-2 mt-2 ml-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
					<span class="sr-only">Open sidebar</span>
					<svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
						<path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
					</svg>
		    </button>
            <div class="flex">
					<aside style="background:#7233A1;width: 211.33px; box-shadow: 2px 2px 2px 2px gray" id="default-sidebar" class="fixed top-0 left-0 z-40 w-90 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
				 
					<div style="background: #7233A1;" class="mx-auto flex-row justify-center flex lg:mx-0 text-white font-bold  py-4 px-10 shadow-lg focus:outline-none focus:shadow-outline">
					<div class="flex flex-row">			
						 		
								<div class="w-full self-center">
									<span style="font-size:23px;">Painel ADM</span>
								</div>
							</div>
		                </div>
 	
			<div  style="background: #7233A1" class="h-full overflow-y-auto bg-gray-50 dark:bg-gray-800">
						
			<ul id="side-bar-menu" class="space-y-2 font-medium text-white">
          
         <li style="border-color: #837979" class="w-full border-t">
		 
            <a href="<?=$site?>" target="_parent" class="flex mb-2 mt-2 panel-title items-center p-2 rounded-lg text-white  group">
			<img src="<?=URL_IMAGE.'img/casa_1.png'?>"/>
               <span class="flex-1 ml-3  ">Início</span>
		
            </a>
		 
         </li>
         <li style="border-color: #837979" class="w-full  border-t">
		 <a href="<?=$site.'configuracoes'?>" target="_parent" class="flex mb-2 mt-2 panel-title items-center p-2 rounded-lg text-white  group">
		 <img src="<?=URL_IMAGE.'img/config_1.png'?>"/>
               <span class="flex-1 ml-3 whitespace-nowrap">Configurações</span>
             
            </a>
         </li>
		 <li style="border-color: #837979" class="w-full   border-b border-t">
		 <a href="<?=$site.'mudar-login'?>"  class="flex panel-title mb-2 mt-2 items-center p-2 rounded-lg text-white  group">
		 <img src="<?=URL_IMAGE.'img/conta_confi.png'?>"/>
               <span class="flex-1 ml-3 whitespace-nowrap">Meus Dados</span>
            </a>
         </li>
         <li style="border-color: #837979" class="w-full   border-b">
		 <a href="<?=$site.'termo'?>"  class="flex panel-title mb-2 mt-2 items-center p-2 rounded-lg text-white  group">
		 <img src="<?=URL_IMAGE.'img/CONTRATO_1.png'?>"/>
               <span class="flex-1 ml-3 whitespace-nowrap">Termos de Uso</span>
            </a>
         </li>
         
      </ul>
	  <ul  class="fixed w-full bottom-0 pt-4 mt-4 dark:border-gray-700">
        
       
         <li class="w-full">

		 <a class="w-full" href="<?=$site.'painel.php'?>?logoff=true">
					<div style="background: #A70000; height:64px" id="voltar_button" class="items-center mx-auto cursor-pointer flex-row justify-center flex lg:mx-0 hover:underline w-full text-white font-bold  shadow-lg focus:outline-none focus:shadow-outline">
								<div class="w-40">
									<svg width="50" height="40" viewBox="0 0 37 39" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M14.8721 15.2735L18.4834 19.0918M18.4834 19.0918L22.0947 22.9102M18.4834 19.0918L22.0947 15.2735M18.4834 19.0918L14.8721 22.9102" stroke="white" stroke-width="2.98525" stroke-linecap="round" stroke-linejoin="round"/>
										<path d="M9.4552 28.6378C14.4413 33.9099 22.5255 33.9099 27.5116 28.6378C32.4977 23.3657 32.4977 14.818 27.5116 9.54594C22.5255 4.27386 14.4413 4.27386 9.4552 9.54594C4.46911 14.818 4.46907 23.3657 9.4552 28.6378Z" stroke="white" stroke-width="2.98525" stroke-linecap="round" stroke-linejoin="round"/>
									</svg>	
								</div>			
								<div class="w-full ml-2">
									<span style="font-size:23px;">Sair</span>
								</div>
							</div>
		</a>	
            
         </li>
      </ul>
 
    </div>
        </aside>
</div>
 
 
         <div class="md:ml-[204px] flex flex-col">
            
                <?php
                $getexe = filter_input(INPUT_GET, 'exe', FILTER_DEFAULT);
                $url = (isset($getexe) ? strip_tags(trim($getexe)) : 'home');
                $url = ($url == null ? 'home' : $url);  
                 
                if(file_exists('includes/'.$Url[0].'.php')):
                    require_once('includes/'.$Url[0].'.php');
                else:
                    require_once('includes/home.php');
                endif;
                ?>
         </div>
       
            </div>
            <!-- /.container-fluid -->
          
     
        <!-- /#page-wrapper -->
   
  
    <script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
   
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= $sistema; ?>js/bootstrap-datepicker.js"></script>
 
    <!--Counter js -->
    <script src="plugins/bower_components/waypoints/lib/jquery.waypoints.js"></script>
    <script src="plugins/bower_components/counterup/jquery.counterup.min.js"></script>
 
    <script src="js/jquery.slimscroll.js"></script>
    <script src="<?= $sistema; ?>js/flowbite.min.js"></script>
  
    
 
    <script src="js/jquery.richtext.min.js"></script>
 
  
    <!-- Custom Theme JavaScript -->
 
    <script src="js/dashboard3.js"></script>
    
 
    <script src="js/datatables.min.js"></script>
    <script type="module" src="js/main.js"></script>
    <script src="js/jquery.mask.js"></script>
    <script src="<?=$sistema;?>js/jquery.peekabar.min.js"></script>
    
 

    <script>
    $(document).ready(function(){

   
        $( "#datepicker" ).datepicker();
        $( "#datepicker-from" ).datepicker({autoclose: true,});
        $( "#datepicker-to" ).datepicker({autoclose: true,});
    })


   </script>
</body>

</html>
