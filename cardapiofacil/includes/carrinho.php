<!-- Content ================================================== -->

<?php
// if(!isset($_POST['opcao_delivery']) || $cart->isEmpty()):
// 	header("Location: {$site}{$Url[0]}");
// endif;
$_POST['opcao_delivery'] = "true";
$bairrosstatus = 'false';
$pedidos = '';
$allItems = $cart->getItems();
foreach ($allItems as $items) {
	foreach ($items as $item) {
		if(!empty($item['attributes']['totalAdicionais'])):
			$todosOsAdicionais = '';
			$todosOsAdicionaisSoma = 0;
			for($i=0; $i < $item['attributes']['totalAdicionais']; $i++):
				$todosOsAdicionais = $todosOsAdicionais.$item['attributes']['adicional_nome'.$i].', ';
				$todosOsAdicionaisSoma = ($todosOsAdicionaisSoma + $item['attributes']['adicional_valor'.$i]);
			endfor;
		endif;							

		$pedidos = $pedidos.'<b>'.$texto['msg_qtd'].'</b> '
		.$item['quantity'].'x '
		.$item['attributes']['nome']
		.'<br /><b>'.$texto['msg_adicionais'].'</b> '.
		(!empty($item['attributes']['totalAdicionais']) ? $todosOsAdicionais : $texto['msg_sem_adicionais'])
		.'<br />'

		.'<b>'.$texto['msg_valor'].'</b> R$ '.Check::Real(($item['attributes']['preco'] * $item['quantity']) + (!empty($item['attributes']['totalAdicionais']) ? ($todosOsAdicionaisSoma * $item['quantity']) : 0) )
		.'<br /><b>OBS:</b> '.$item['attributes']['observacao']

		.'<br /><br />';
	}
}

function tirarAcentos($string){
	$formato = array();
	$formato['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr';
	$formato['b'] = 'AAAAAAAcEEEEIIIIDNOOOOOOUUUUuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
	$string = strtr(utf8_decode($string), utf8_decode($formato['a']), $formato['b']);

	return utf8_encode($string);
}
?>
<html>
	<head>

	<style>

		body{
			background:white;
		}
#img-head-loja{
	display:none;
}

.parallax-window{
	display:none !important;
}
.checkout-container{
	padding:20px;

}



.tab-link{
	border-top:  1px solid transparent;
  border-left:1px solid transparent;
  border-right:1px solid transparent;
  background: #F0F0F0;
  font-size:20px
}

.tab-link-active{
	border-top: 1px solid black;
  border-left: 1px solid black;
  border-right: 1px solid black;
   background:white;
  font-size:20px
}

a:hover,a:link,a:visited{
					color:black !important;
				}
		</style>
	

</head>
		<body>

		<div class="w-full">

		
	

		<div  class="config-header w-full text-bold text-center text-white">
											<p>MODO DE ENTREGA</p>
									</div>	
							<ul style="color:black" class="w-full">
						 			<div class="bg-white w-full flex flex-row">
									<div class="w-full tab-link-active text-center">
											<button id="tipo_0" class="nav-link" data-tipo="0" aria-current="page" >Delivery</button>
									</div>
								<div class="w-full tab-link text-center">
									<button id="tipo_1" class="nav-link" data-tipo="1" >Retirada na Loja</button>
									</div>
								</div>
						 
			</ul>
	<div id="detalhes_pedido"></div>
			<section>
	<div id="delivery" class="checkout-container flex flex-col">
		 
	<div class="flex w-full">
			<img  class="w-full" src="<?=$site;?>img/entrega_1.png" style="max-width: 100%;height: auto;" />
			</div>
		<form style="margin-top: 20px" id="getDadosPedidoCompleto" method="post">

		<input hidden name="opcao_delivery" value="true">
			<div class="w-full">
			 				
						<div class="w-full" id="order_process">				
						<div style="margin-bottom: 20px;" class="w-full">

						<div class="indent_title_in">
  
						<h3 style="font-size:24px" class="text-bolder" >Endereço:</h3>
								 
								<span style="font-size:12px">Preencha todos os campos corretamente</span>

							 
								</div>
							
								
							</div>
							<div class="form-group">
								<label for="cep">Cep:</label>
								<input required type="text" id="cep" name="cep" class="form-control" placeholder="Digite seu cep ex: 00.000-00" data-mask="00.000-00" maxlength="7">
							</div>

							<div class="form-group"> 
									<div class="flex flex-col">
									<label class="w-full ">UF:</label>       
									<div class="w-full">
										<select class="form-control" name="uf" id="estados2">     
										</select>
									</div>
									</div>
									</div>
									<div class="form-group"> 
									<label class="w-full">Cidade:</label>       
									<div class="w-full">
										<select class="form-control" name="cidade" id="cidades2">    
										</select>
									</div>
									</div>
									<div class="form-group">
									<label class="w-full">Bairro:</label>
									<div class="w-full">
										
										<input type="text" name="bairro" class="form-control" placeholder="Selecione seu Bairro">
									
									</div>
									</div>
		
							<?php if($_POST['opcao_delivery'] == 'false2'):?>						
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label class="form-control-label"><span style="color: red;">*</span> <?=$texto['msg_msg_Nmesa'];?></label>
											<input type="number" name="mesa" class="form-control numero" maxlength="2" required>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label class="form-control-label"><span style="color: red;">*</span> <?=$texto['msg_msg_qtdpessoas'];?></label>
											<input type="number" name="pessoas" class="form-control numero" maxlength="2" required>
										</div>
									</div>
								</div> 
							<?php endif; ?>
 
								 

								<div class="row">
									<div class="col-md-6 col-sm-6">
										<div class="form-group">
											<label for="rua"><span style="color: red;">* </span><?=$texto['msg_sua_rua'];?></label>
											<input type="text" required id="rua" name="rua" size="60" class="form-control" placeholder="Digite o nome da sua rua ex: Rua jose">
										</div>
									</div>
									<div class="col-md-6 col-sm-6">
										<div class="form-group">
											<label for="unidade"><span style="color: red;">* </span><?=$texto['msg_seu_n'];?></label>
											<input type="text" required id="unidade" data-mask="#########0" name="unidade" size="60" class="form-control" placeholder="Digite o numero de sua residência ex: 100">
										</div>
									</div>

								</div>

								<div class="form-group">
									<label for="complemento"><?=$texto['msg_complemento'];?></label>
									<input type="text" size="150" id="complemento" name="complemento"  class="form-control" placeholder="Digite um complemento ex: bloco 00 ap 100">
								</div>
								<div class="form-group">
									<label for="observacao"><?=$texto['msg_obs_endereco'];?></label>
									<input type="text" id="observacao" name="observacao" id="observacao" class="form-control" placeholder="Digite uma observação ex: perto da delegacia">
								</div>	
								
								


								<?php

								$lerbanco->ExeRead('bairros_delivery', 'WHERE user_id = :birros', "birros={$getu}");
								if($lerbanco->getResult()):
									$bairrosstatus = 'true';
									?>
									<!-- INICIO DO LOOP DOS BAIRROS -->	
									<input type="hidden" required name="bairro2" id="bairro2" value="">	
									<div class="form-group">
										<label for="bairro">Taxa de Entrega:</label>
										<select name="bairro" id="framework" class="form-control js-example-basic-single getBairro" required data-live-search="true">
											<option value=""><?=$texto['msg_sel_bairro'];?></option>								
											<?php	
											$lerbanco->ExeRead('bairros_delivery', 'WHERE user_id = :birrosss', "birrosss={$getu}");
											if($lerbanco->getResult()):
												foreach ($lerbanco->getResult() as $getBancoBairros):
													extract($getBancoBairros);
													?>
													<option value="<?=$id;?>"><?=$bairro.' (R$ '.Check::real($taxa).')';?></option>
													<?php
												endforeach;
											endif;

											?>
										</select>
									</div>
									<!-- FINAL DO LOOP DOS BAIRROS -->	
									<?php 
						 
						endif;?>
								 <div class="w-full flex flex-col">
									 <div class="indent_title_in">
  
  									<h3 style="font-size:24px" class="text-bolder" >Seus dados:</h3>
		   
		 						 	<span style="font-size:12px">Preencha todos os campos corretamente</span>

	   
		 							 </div>

									 <div class="w-full">
									 <div style="margin-top:20px" class="form-group">
									<label for="complemento">Nome:</label>
									<input type="text" size="150" id="nome_dados" name="nome_cliente"  class="form-control" placeholder="Digite seu nome ex: João da Silva">
								</div>
								<div class="form-group">
									<label for="observacao">Telefone:</label>
									<input type="text" id="telefone_dados" name="telefone_cliente" class="form-control" placeholder="Digite seu telefone ex: (12) 98282-3210">
								</div>
										</div>

								</div>
					</section>

							
							<div class="w-full totalizador_title">
							<div  class="config-header w-full text-bold text-center text-white">
											<p>TOTALIZADOR DO PEDIDO</p>
									</div>


					<div class="col-md-3" id="sidebar">

<div class="w-full">
	<div id="w-full" >
		 		
	 
		
	 



	<?php
	if($_POST['opcao_delivery'] == 'true'):
		echo "<input type=\"hidden\" name=\"opcao_delivery\" value=\"true\" />";
	else:
		echo "<input type=\"hidden\" name=\"opcao_delivery\" value=\"false\" />";
	endif;
	?>

	<table class="table table_summary">
		<tbody>
			
			<tr>
				<td>
					<?=$texto['msg_adicionais'];?> <span class="pull-right">
						R$ <?php				

		// Get all items in the cart

						$allItems = $cart->getItems();

						$totaldeadicionais = 0;
 
						foreach ($allItems as $items):
						 
							foreach ($items as $item):
							 
								$todosOsAdicionaisSoma2 = 0;
								if(!empty($item['attributes']['adicionais'])):
									foreach ($item['attributes']['adicionais'] as $adicionais):	
										 								 
										$todosOsAdicionaisSoma2 = ($todosOsAdicionaisSoma2 + $adicionais['valor_total']);
									endforeach;
									//$todosOsAdicionaisSoma2 = ($todosOsAdicionaisSoma2 * $item['quantity']);
								endif;

								$totaldeadicionais = $totaldeadicionais + $todosOsAdicionaisSoma2;


							endforeach;
						endforeach;

						echo Check::Real($totaldeadicionais);

						$total_do_pedido =  $cart->getAttributeTotal('preco') + $totaldeadicionais;

						$total_g = ($bairrosstatus == 'false' && $_POST['opcao_delivery'] == 'true' ? $total_do_pedido + $config_delivery : $total_do_pedido);

						$porcentagem = 0;
						if(!empty($_SESSION['desconto_cupom']) && $_SESSION['desconto_cupom']['user_id'] == $getu):
							$porcentagem = Check::porcentagem($_SESSION['desconto_cupom']['desconto'], $total_g);				
						endif;
						$total_g = $total_g - $porcentagem;	
						?>											
					</span>
				</td>
			</tr>
		
			<tr>
				<?php
				if(!empty($_SESSION['desconto_cupom']) && $_SESSION['desconto_cupom']['user_id'] == $getu):
					?>
					<tr>
						<td>
							<a style="color: green;">
								Desconto
								<span class="pull-right">
									<?=$_SESSION['desconto_cupom']['desconto'];?> %
								</span>
							</a>
						</td>
					</tr>
					<?php
				endif;

				?>
				<td class="total">

					<?=$texto['msg_total_valor'];?> <span class="pull-right"><b  id="v-total-p"><?=$total_g;?></span>
						<script type="text/javascript">
							var totalSemFormatacao = <?=$total_g;?>;
							var pegaTaxa = $('#taxaDelivery').text();
						</script>
					</td>
				</tr>
				<?php if($_POST['opcao_delivery'] == 'true'):?>
				<tr>
					<td>
						Delivery <span id="taxaDelivery" style="color: red;" class="pull-right"><?=($bairrosstatus == 'false' ? $config_delivery : '0.00');?></span>
					</td>
				</tr>
			<?php endif;?>
				<tr>
				<td>
					<span>Subtotal:<?php echo str_repeat('.', 67) ?><span> <span class="pull-right">R$ <?=(!empty($cart->getAttributeTotal('preco')) ? Check::Real($cart->getAttributeTotal('preco')) : '0,00');?></span>
				</td>
			</tr>
			</tbody>
		</table>
		<hr>
		<input type="hidden" name="enviar_pedido" value="enviar_agora" />
		<input type="hidden" name="user_id" value="<?=$getu;?>" />
		<input type="hidden" name="sub_total" value="<?=$total_do_pedido;?>" />
	
		<script type="text/javascript">
			$(document).ready(function(){
				$('.enviarpedido').click(function(){
					$('.enviarpedido').html('AGUARDE...');
					$('.enviarpedido').prop('disabled', true);

					$.ajax({
						url: '<?=$site;?>includes/processaenviarpedido.php',
						method: "post",
						data: $('#getDadosPedidoCompleto').serialize(),

						success: function(data){				
							$('#resultadoEnviarPedido').html(data);
							$('.enviarpedido').html('<?=$texto['msg_pedir_agora'];?>');
							$('.enviarpedido').prop('disabled', false);
						}
					});

				}); 
			});
		</script>
		
							 
									 <div class="w-full flex flex-col">
										<div class="w-full">
												<label for="cupom">Cupom de desconto?</label>
										</div>
										<div class="w-full flex flex-row">
										<div class="w-full">	
										<input type="text" size="150" id="cupom" name="cupom_cliente"  class="form-control" placeholder="Digite seu Cupom de desconto aqui">
										</div>	
										<div class="w-full">
									 
									 <button type="text" id="valida_cupom" class="form-control">APLICAR</button>
										 </div>
										</div>
								</div>
								
									 
</div><!-- End cart_box -->
</div><!-- End theiaStickySidebar -->
								<div class="w-full flex flex-col">
									<div class="fw-full">
										<label for="forma_pagamento"><span></span><?=$texto['msg_f_pagamento'];?></label>
										<select class="form-control" required name="forma_pagamento" id="forma_pagamento">	
											<?php	
											$lerbanco->ExeRead('ws_formas_pagamento', 'WHERE user_id = :idus', "idus={$getu}");
											if($lerbanco->getResult()):
												foreach ($lerbanco->getResult() as $getBancoBairros):
													extract($getBancoBairros);
													?>
													<option value="<?=$f_pagamento;?>"><?=$f_pagamento;?></option>
													<?php
												endforeach;
											endif;

											?>
										</select>
									</div>
								</div>
								<div class="w-full flex flex-col">
									<div class="w-full">
										<label for="valor_troco"><span> </span><?=$texto['msg_troco'];?></label>
										<input required type="tel" maxlength="11" data-mask="#.##0,00" data-mask-reverse="true" name="valor_troco" id="valor_troco" class="form-control" placeholder="0,00" />
									</div>
								</div>
					 
						 
					<div class="w-full">
					<a class="btn_full enviarpedido"><?=$texto['msg_pedir_agora'];?></a>
										</div>
			 
								<!-- <div class="col-md-12">
									<div class="form-group">								
										<div class="icheck-material-green">
											<input checked type="checkbox" name="confirm_whatsapp" value="true" id="green" />
											<label for="green"><strong><?=$texto['msg_msg_enviarzap'];?></strong></label>
										</div>
									</div>
								</div> -->
								<input type="hidden" required name="valor_taxa" id="valor_taxa" value="<?=($bairrosstatus == 'false' && $_POST['opcao_delivery'] == 'true' ? $config_delivery : '0.00');?>">

								
							</div>
						 
						</div><!-- End box_style_1 -->

					</div><!-- End col-md-6 -->


				</div><!-- End col-md-3 -->

				<div style="display:none" id="retirada_loja" class="w-full">
									teste
								</div>

			</div><!-- End row -->
		</div><!-- End container -->
		<div id="resultadoGetcliente"></div>
		<div id="resultadoEnviarPedido"></div>
		</form>
		<!-- End Content =============================================== -->
		<script type="text/javascript" >		
			var iduserr = <?=$getu;?>;
			var s = 0.00;

			$(document).ready(function() {	
				$("#v-total-p").text(totalSemFormatacao.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' }));
				$("#taxaDelivery").text(parseFloat(pegaTaxa).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' }));		


				$('.getBairro').change(function(){

					var idDoLocal = $(this).val();

					$.ajax({
						url: '<?=$site;?>includes/processaGetLocal.php',
						method: "post",
						dataType: 'json',
						data: {'idLocal' : idDoLocal, 'iduserrr' : <?=$getu;?>},

						success: function(data){  


                  //Atualiza os campos com os valores da consulta.
                  $("#cidade").val(data.cidade);
                  $("#uf").val(data.uf);
                  $("#valor_taxa").val(data.taxa); 
                  $("#bairro2").val(data.bairro);                  
                  $('#taxaDelivery').text(data.taxa);     

                  s = parseFloat(data.taxa);
                  soma = parseFloat(totalSemFormatacao) + parseFloat(s);

                  $("#v-total-p").text(soma.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' }));
                  $("#taxaDelivery").text(s.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' }));

              }
          });

				});

		//Recupera o valor para validar o campo troco.
		$('#forma_pagamento').change(function (){
			
			var tell = $(this).val();
			
			if (tell == "Dinheiro" || tell == "DINHEIRO" || tell == "dinheiro") {
				$('#valor_troco').prop('disabled', false);
			}
			else {
				$('#valor_troco').val('0,00');
				$('#valor_troco').prop('disabled', true);
			}
		});

		//Quando o campo telefone perde o foco.
		$("#telefone").blur(function() {

                //Nova variável "numerowhats" somente com dígitos.
                var numerowhats = $(this).val().replace(/\D/g, '');

                $.ajax({
                	url: '<?=$site;?>includes/processagetdadoscliente.php',
                	method: "post",
                	data: {'numerocliente' : numerowhats, 'iduser' : iduserr},

                	success: function(data){        
                		$('#resultadoGetcliente').html(data);
                	}
                });
            });

	});

</script>



<script type="module" src="<?= $site;?>/js/carrinho.js"></script>
</body>
</html>
 
		