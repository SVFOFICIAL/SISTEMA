<?php
if(!isDateExpired($empresa_data_renovacao, 1)):
	header("Location: {$site}");
endif;
 
?>
<?php
$newnumer = 1;
if(!isset($_SESSION['userlogin'])):
	?>
	<script type="text/javascript">

		$.ajax({
			url: '<?=$site;?>includes/processaviews.php',
			method: 'post',
			data: {'maisum' : '<?=$newnumer;?>', 'userid' : '<?=$getu;?>'},	
			success: function(data){		
			}		
		});

	</script>
	<?php
endif;
?>
 <html>


 <head>


</head>
<!-- End col-md-3 -->
<div class="flex w-full" <?=($detect->isMobile() ? "style=\"padding-left: 2px;padding-right: 2px;\"" : "");?>>
	<?php
	$diasemana = array('Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado');
	$data = date('Y-m-d');
	$diasemana_numero = date('w', strtotime($data));
	$diadehoje   = $diasemana[$diasemana_numero];
	//$todososdias = 'null';
	
	?>

	<div class="flex flex-col w-full"  style="color:black" <?=($detect->isMobile() ? "style=\"padding-left: 2px;\"" : "");?>>

		<div style="position:sticky;top:0;z-index:99999;height: 100%;background:white"class="flex w-full flex-col">		 
		<div style="margin:5px;">	
		<input style="border:0; background:#F0F0F0;height: 49px;padding: 10px;border-radius: 10px;" class="bg-gray  w-full" type="text" id="search_products" placeholder="Busque por um produto">
			</div>
		<div class="">
		<div  class="slick-cat flex flex-row">
 
		<?php
		$lerbanco->FullRead("select * 
			from ws_cat  where id in(select id_cat from ws_itens) and user_id={$getu}");
		if (!$lerbanco->getResult()){
			echo "<li><a><span>VOCÊ AINDA NÃO CADASTROU NENHUM ITEM!</span></a></li>";
		}else{
			foreach ($lerbanco->getResult() as $iiii){
				extract($iiii);
				$iddacategoria = $id;

	    ?>
			<a  id="link_cat" class="btn-cat-link" target="_self" href="#<?=$id?>"> <div style="margin:10px; color: #7233A1;"  class="btn-cat"><?=$nome_cat?></div></a>
		<?php
			}
		}
		?>
</div>

	</div>
	
	 
	</div>

	<div style="color: #7233A1;border-bottom:1px solid #E9E8E6"  class="w-full bg-white flex p-5">				
				<span>Destaques</span>
			</div>
<div  class="w-full bg-white">

<div class="slick bg-white">
<?php 

$lerbanco->ExeRead('ws_itens', "WHERE user_id = :useridr AND prod_destaque = 1", "useridr={$getu}}");
if(!$lerbanco->getResult()){
 
}else{
 
	foreach ($lerbanco->getResult() as $itemDes){
		extract($itemDes);
		$nomeItem = limitarTexto($nome_item, 40);
		 
	if (!empty($img_item) && $img_item != "null" && file_exists(UPLOAD_PATH.$img_item) && !is_dir(UPLOAD_PATH.$img_item)){									
		if($detect->isMobile()){
			echo "<div   data-target=\"#popuppedido_$id\" data-iditem=\"$id\" data-toggle=\"modal\" class=\"prod bg-white\"><figure style=\"margin:5px\" class=\"destaque_prod\">".Check::Image($img_item, 'Imagem-item', 150, 150)."</figure><div   class=\"flex flex-col\"> <div class=\"w-full\"><span style=\"margin:5px; cursor:pointer;\">R$ ".Check::real($preco_item)."</span></div><div style=\"width:170px;line-break:anywhere\" class=\"w-full\"><p style=\"margin:05px; cursor:pointer;\">$nomeItem</p></div></div></div>";

		}else{
			echo "<div   data-target=\"#popuppedido_$id\"  data-iditem=\"$id\" data-toggle=\"modal\" class=\"prod bg-white\"><figure style=\"margin:5px\" class=\"destaque_prod\">".Check::Image($img_item, 'Imagem-item', 150, 150)."</figure><div   class=\"flex flex-col\"><div class=\"w-full\"><span style=\"margin:5px; cursor:pointer;\">R$ ".Check::real($preco_item)."</span></div> <div  style=\"width:170px;line-break:anywhere\" class=\"w-full\"><p style=\"margin:05px;cursor:pointer;\">$nomeItem</p></div></div></div>";
		};
	}else{
//echo "<figure class=\"thumb_menu_list\"><img src=\"img/menu-thumb-1.jpg\" alt=\"thumb\"></figure>";
	};
	?>	
	

	<?php
	 
}
?>

<?php
 
}
?>

 </div>
</div>
 
 

 
		<?php
		$lerbanco->FullRead("select * 
		from ws_cat  where id in(select id_cat from ws_itens) and user_id={$getu}");
		if (!$lerbanco->getResult()):
			echo "<li><a><span>VOCÊ AINDA NÃO CADASTROU NENHUM ITEM!</span></a></li>";
		else:
			foreach ($lerbanco->getResult() as $iiii):
				extract($iiii);
				$iddacategoria = $id;
		 
				?>
				
				<?php
				$idCat = $iddacategoria;
				$nomeCat = $nome_cat;
				$lerbanco->ExeRead('ws_itens', "WHERE user_id = :useridr AND id_cat = :nnn", "useridr={$getu}&nnn={$id}");
				if(!$lerbanco->getResult()):
					 
				else:

					?>
					<table    id="<?=$iddacategoria?>" data-idcat="<?=$id?>" style="display:table" class="box-prod flex w-full cart-list">
					 

						<thead >
							 <th    class="bg-white" class="<?=$iddacategoria?>">
							 
							 <div   class="p-5 bg-gray">								 
								<span  data-idcat="<?=$idCat?>" style="font-size: 12px;color: #7233A1" class="nomargin_top" <?php if($detect->isMobile()): echo "style='font-size:15px;'"; endif; ?> ><?=$nomeCat;?></span>
								
							
								</div>							 
								<hr style="padding:5px; color:#E9E8E6"></hr>
							</th>
							
						</thead>
					
						<tbody>											

							<?php							
							foreach($lerbanco->getResult() as $itemm):
								extract($itemm);
								$ido_DoItem = $id;
								$nome_do_item = $nome_item;
							 

								$exp = explode(',', $dia_semana);
							 
						 
							 
								if(in_array($diadehoje, $exp)):
								 
									?>		
							 					 
									<tr style="border-bottom: 1px solid #E9E8E6" class="bg-white">
									
										<td data-toggle="modal" data-iditem="<?=$ido_DoItem ?>" class="prod p-5 bg-white flex flex-col mb-5" data-target="#popuppedido_<?=$ido_DoItem;?>">
										<h5 class="name" style="font-size: 12px; margin-top: 3px;"><?=$nome_do_item;?></h5>
											<?php
											if (!empty($img_item) && $img_item != "null" && file_exists(UPLOAD_PATH.$img_item) && !is_dir(UPLOAD_PATH.$img_item)):										
												if($detect->isMobile()): 
													$descProduto = limitarTexto($descricao_item, 200);
													echo "<div class=\"flex justify-between w-full flex-row\"><div  style=\"font-size: 12px;margin-right: 10px;margin-bottom: 10px;margin-top: 5px;\" class=\"flex\"><p style=\"text-align: justify;color:#545353\">{$descProduto}</p></div><div style=\"margin-right:10px\" class=\"flex\"><figure class=\"thumb_menu_list\">".Check::Image($img_item, 'Imagem-item', 100, 100)."</figure></div>";

												else:
													$descProduto = limitarTexto($descricao_item, 200);
													echo "<div class=\"flex justify-between  w-full flex-row\"><div style=\"font-size: 12px;margin-right: 10px;margin-bottom: 10px;margin-top: 5px;\" class=\"flex w-full \"><p <p style=\"text-align: justify;color:#545353;\">{$descProduto}</p></div><div style=\"margin-right:10px\" class=\"flex\"><figure class=\"thumb_menu_list\">".Check::Image($img_item, 'Imagem-item', 100, 100)."</figure></div>";
												endif;
											else:
										//echo "<figure class=\"thumb_menu_list\"><img src=\"img/menu-thumb-1.jpg\" alt=\"thumb\"></figure>";
											endif;
											?>									
										 
											</div>
											<div style="float: right;"><?php
											$lerbanco->ExeRead("ws_relacao_tamanho", "WHERE id_user = :useriid AND id_item = :idiitem", "useriid={$getu}&idiitem={$ido_DoItem}");
											if(!$lerbanco->getResult()):
												echo "<span style='cursor:pointer;'>R$ ".Check::real($preco_item)."</span>";
											else:
												$total = $lerbanco->getRowCount();

												echo "<span style='cursor:pointer;'>Ver Valores<span>";
											endif;


											?></div>
											 
										</td>
										
										 
<script>

$(document).ready(function(){
   
    var $search = $("#search_products").on('input',function(){
        // $btns.removeClass('active');
        var matcher = new RegExp($(this).val(), 'gi');
		
 
        $('.box-prod td').show().not(function(){	 
				
				return matcher.test($(this).find('.name').text())
				 
           
        }).hide();
    })
})
</script>

										<form data-url="<?=$site?>" id="addItemPost_<?=$ido_DoItem;?>" name="addItemPost_<?=$ido_DoItem;?>" method="post">
											<td class="options">
												<div class="dropdown dropdown-options">
													
													<!-- Modal -->
													<div class="modal fade popuppedido" id="popuppedido_<?=$ido_DoItem;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
														<div class="modal-dialog">
															<div style="height:100dvh;" class="modal-content">	
															<div class="modal-body">												
																<div style="padding: 0px !important" id="cart_box">
																	<div style="margin-top:0px !important"class="w-full flex flex-col dropdown-menupop">
																		<a hidden data-dismiss="modal"  style="float: right;cursor: pointer;"id="fecharmodallogin" class="close-link"><i class="icon_close_alt2"></i></a>										
																		<?php
																			if (!empty($img_item) && $img_item != "null" && file_exists(UPLOAD_PATH.$img_item) && !is_dir(UPLOAD_PATH.$img_item)):										
																				 $urlImage = URL_IMAGE.$img_item;
																				echo "<div class=\"flex w-full\"><figure class=\"w-full flex img_table\">".Check::Image($img_item, 'Imagem-item', 411, 312)."</figure></div>";
																		endif;
																		?>


																		<div style="padding:5px;text-align:justify" class="flex flex-col w-full">
																			<div style="margin-top:10px;"class="w-full">
																			<span><?=$nome_item;?></span> 
																			</div>
																			<div class="w-full">
																				<span style="color:#545353"><?=$descricao_item;?></span> 
																			</div>
																			"<input id="valor_item" type="hidden" name="valor" value="<?=$preco_item?>">
																	</div>
																
<?php 

	$lerbanco->FullRead('select distinct t.id_tipo, t.nome_adicional "tipo_adicional", t.quantidade 
	from ws_tipo_adicional as t
	join ws_produto_adicionais as  pa on t.id_tipo = pa.id_tipo_adicional 	
	where pa.id_produto = :idprod and pa.user_id = :idUser', "idprod={$id}&idUser={$getu}");


	// $lerbanco->FullRead('select distinct ai.desc_adicional,t.id_tipo, pa.user_id, pa.id_produto, t.nome_adicional "tipo_adicional", ai.nome_adicional, ai.valor_adicional, t.quantidade from ws_tipo_adicional as t
	// join ws_produto_adicionais as pa on t.id_tipo = pa.id_tipo_adicional
	// join ws_adicionais_itens as ai on t.id_tipo = ai.id_tipo_adicional
	// where pa.id_produto = :idprod and pa.user_id = :idUser', "idprod={$id}&idUser={$getu}");

	if($lerbanco->getResult()){
	 
		foreach($lerbanco->getResult() as $tipos_adicionais){
			extract($tipos_adicionais);
		?>
<!--INICIO DA QUANTIDADE-->
<div style="display:none" id="check-tp_<?=$id?>" data-iditem=<?=$id;?> data-flagtp="1"></div>
<div style="background-color: #F0F0F0;
    padding: 5px;" class="flex flex-row w-full">
	<div class="w-full">
			<span style="color: #7232A0"><?=$tipo_adicional?></span>	
</div>

<div style="background-color: #7232A0;color:white;border-radius: 5px;
    width: 70%;text-align: center;" class="w-full">

			<?php

			if($quantidade==1){
				$textoTipoAdcional = " opção";
			}else{
				$textoTipoAdcional = " opções";
			}

?>

			<span>Escolha até <?=$quantidade. $textoTipoAdcional?> </span>	
</div>	
</div>

<?php 

	

	$lerbanco->FullRead('select distinct ai.id_adicionais, ai.desc_adicional,t.id_tipo, pa.user_id, pa.id_produto, t.nome_adicional "tipo_adicional", ai.nome_adicional, ai.valor_adicional, t.quantidade from ws_tipo_adicional as t
	join ws_produto_adicionais as pa on t.id_tipo = pa.id_tipo_adicional
	join ws_adicionais_itens as ai on t.id_tipo = ai.id_tipo_adicional
	where pa.id_produto = :idprod and t.id_tipo = :idTipo and pa.user_id = :idUser', "idTipo={$id_tipo}&idprod={$id}&idUser={$getu}");

	if($lerbanco->getResult()){
	 
		foreach($lerbanco->getResult() as $adicionais){
			extract($adicionais);
		?>
<div class="flex flex-col w-full">
	<div class="flex flex-row w-full">
		<div style="padding:5px" class="flex flex-col w-full">
			<div class="w-full">
					<span> <?=$nome_adicional?></span>	
			</div>	
			<div class="w-full">
					<span>+ <?=Check::real($valor_adicional)?></span>	
			</div>	
			<div style="color: #545353; font-size:10px" class="w-full">
					<span><?=$desc_adicional?></span>	
			</div>	
		</div>

	<div style="padding:5px" class="flex items-center flex-row w-full">
		
	<div style="height: 50%;" class="w-full "> 
		<div style="color:white;background: #E70D0D;height: 26px" class="flex justify-center w-full">
			<button data-vladicional="<?=$valor_adicional?>" data-idtipo="<?=$id_tipo?>" data-iditem="<?=$ido_DoItem;?>" type="button" class="btn-number"  data-maxadcionais="<?=$quantidade?>" data-idadicional="<?=$id_adicionais?>"  data-type="minus" data-field="quantidade">
				<span class="glyphicon glyphicon-minus"></span>
			</button>
		</div>
		</div>
		<div style="height: 50%;" class="w-full"> 
		    
			<input  readonly style="width: inherit;background-color:#F0F0F0;border-color: #F0F0F0;" class="w-1/2 text-center input-total input-count_<?=$id_tipo?>"  type="text" name="quantidade_<?=$id_adicionais?>" class="input-number qtdpedido" value="0" min="0" max="<?=$quantidade?>">
		</div>
		<div style="height: 50%;" class="w-full"> 
		<div style="color:white;background: #46DC4C;height: 26px" class="flex justify-center w-full">
			<button data-vladicional="<?=$valor_adicional?>" data-idtipo="<?=$id_tipo?>" data-iditem="<?=$ido_DoItem;?>" type="button" class="btn-number plus btn-plus_<?=$id_tipo?>"  data-maxadcionais="<?=$quantidade?>" data-idadicional="<?=$id_adicionais?>" data-type="plus" data-field="quantidade">
				<span class="glyphicon glyphicon-plus"></span>
			</button>
		</div>
		</div>
		</div>
	</div>
		</div>
		<hr style="padding:5px; color:#E9E8E6"></hr>

<?php }
	}
?>

<?php }
	}else{
?>
<div style="display:none" id="check-tp_<?=$id?>" data-iditem=<?=$id;?> data-flagtp="0"></div>

<?php 
	}
?>



<!--FIM DA QUANTIDADE-->
<br />
<div style="padding-top:40px" class="flex flex-col w-full">
<div class="flex flex-row w-full">
<div style="margin:2px" class="w-ful">
	<img width="20" src="img/comentario_pedido_1.png">
</div> 
	<div style="color: #7232A0;margin:2px" class="w-ful">
	<span>Alguma observação?</span>
</div>

</div>
	<div style="padding: 5px;" class="w-full">
		<input style="padding: 5px; border-radius: 2px;background-color: #F0F0F0;border-color: #F0F0F0;" type="text" class="form-control obsitem" value="" placeholder="Exemplo tirar cebola, sem alface, etc.." name="observacao">
		</div>
		<div class="flex items-center flex-row w-full">
		<div style="padding: 5px;" class="w-full">
		<span>Quantidade do produto</span>
		</div>
		<div style="padding: 5px;" class="w-full">
		<div style="padding:5px" class="flex items-center flex-row w-full">
		
	<div style="height: 50%;" class="w-full "> 
		<div style="color:white;background: #E70D0D;height: 26px" class="flex justify-center w-full">
			<button type="button" class="btn-number_qt_prod"  data-iditem="<?=$ido_DoItem;?>" data-type="minus" data-field="quantidade">
				<span class="glyphicon glyphicon-minus"></span>
			</button>
		</div>
		</div>
		<div style="height: 50%;" class="w-full"> 
			<input  readonly style="width: inherit;background-color:#F0F0F0;border-color: #F0F0F0;" class="w-1/2 text-center" type="text" name="quantidade" class="input-number qtdpedido" value="1" min="1" max="100">
		</div>
		<div style="height: 50%;" class="w-full"> 
		<div style="color:white;background: #46DC4C;height: 26px" class="flex justify-center w-full">
			<button  type="button" class="btn-number_qt_prod"  data-iditem="<?=$ido_DoItem;?>"  data-type="plus" data-field="quantidade">
				<span class="glyphicon glyphicon-plus"></span>
			</button>
		</div>
		</div>
		</div>
		</div>
</div>
</div>
 

<input type="hidden" name="img_prod" value="<?= $urlImage;?>">
<input type="hidden" name="id-item" value="<?=$ido_DoItem;?>">
<input type="hidden" name="add-Item" value="true">
<input type="hidden" name="userid" value="<?=$getu;?>">
<input type="hidden" name="idcarrinho" value="">
<input type="hidden" name="nome_item" value="<?=$nome_do_item;?>">
<input type="hidden" name="nomeloja" value="<?=$Url[0];?>">
<br />
<br />
<br />

<script>

$("#popuppedido_"+"<?=$ido_DoItem;?>").on('hidden.bs.modal', function(e){

	$('input[name="quantidade"]').val('1');
 
	let valorItem = $("#valorItem_<?=$ido_DoItem;?>").attr("data-valoritem");
	 
	$("#valorItem_<?=$ido_DoItem;?>").text(valorItem);





})


</script>

	<script type="text/javascript">
		$(document).ready(function(){

			$('.adicionarItemPedido_<?=$ido_DoItem;?>').click(function(e){
				e.preventDefault();			 
				 
			    var table = $('#pedido').DataTable();
			 
				$.ajax({
					url: '<?= $site; ?>includes/processaAddItem.php',
					method: "post",
					data: $('#addItemPost_<?=$ido_DoItem;?>').serialize(),

					success: function(data){	
						var j = JSON.parse(data);
						 
						if(j.success && !j.errror){
							x0p('Sucesso!', 
								'Seu Pedido foi Adicionado!', 
								'ok', false);

								var sound = new Howl({
									src: ["<?=$site;?>"+'addcarrinho.mp3'],
									volume: 1.0,
									autoplay: true,
									});
									sound.play();
									$("#popuppedido_"+<?=$ido_DoItem;?>).modal('hide');
									$(".obsitem").val("");
									 
									 
									if(!$('#totalizador').is(":visible")){
										$("#totalizador").css("display", "block")
									}
								 
									table.ajax.reload();	
									
								 
						}else{
							x0p('Falha!', 
								j.msg, 
								'ok', false);

								var sound = new Howl({
									src: ["<?=$site;?>"+'addcarrinho.mp3'],
									volume: 1.0,
									autoplay: true,
									});
									sound.play();
									$("#popuppedido_"+<?=$ido_DoItem;?>).modal('hide');
									$(".obsitem").val("");
									 
									 
									if(!$('#totalizador').is(":visible")){
										$("#totalizador").css("display", "block")
									}
						}
						 
					}
				});

			}); 
		});
	</script>


</div>
</div>







</div>

<?php
if(!empty($disponivel) && $disponivel == 1):
	?>	
	<div style="" class="btn-adicionar-item btn-modal-footer">
	<div  class="flex flex-row w-full" style="height: 100%;">
	<div style="background: #FF0000" class="w-1/6 items-center lex-row flex">
			<a data-iditem="<?=$ido_DoItem;?>" data-dismiss="modal" style="padding: 10px; cursor: pointer;"id="fecharmodallogin" class="close-link">
			
			
			<img src="img/voltar_1.png" class="icon_close_alt2"></a>										
			
		</div>
		<button style="cursor: pointer;" class="adicionarItemPedido_<?=$ido_DoItem;?>" id="btn-adicionar-item">
		<div style="background: #46DC4C;padding:10px;height:100%" class="w-full items-center flex flex-row">
			<div style="font-size: 25px;" class="text-left w-full">
				
				Adicionar 
				 
				
				</div>
				<div style="font-size: 25px;" class="text-right w-full">
				<span>R$: </span>
				<span data-add="false" data-valoratual="<?=Check::real($preco_item)?>" data-valoritem="<?=Check::real($preco_item)?>" id="valorItem_<?=$ido_DoItem;?>"><?=Check::real($preco_item)?></span>	
				</div>
		
			
		</div>
		</button>
	</div>
</div>
	<?php
else:
	?>
	<a style="background-color: #ff6247;" id="btn-adicionar-item"><?=$texto['msg_indisponivel'];?></a>
	<?php
endif;
?>
</div>


</div>




</div>

</div>


</div>

</div>

</td>


</form>

</tr>
 
 
<?php
endif;
endforeach;
endif;
?>

</tbody>

</table>

<?php 
endforeach;
endif;
?>
</div>

</div>




<div style="margin-top: 50px;" class="flex" id="">
<div class="modal fade cart-modal" id="cart-modal"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
														<div  class="modal-dialog">
															<div style="height:100dvh;border-radius:unset !important" class="modal-content">	
	<div class="theiaStickySidebar">
		<div id="cart_box" >
		<div  class="config-header w-full text-bold text-center text-white">
											<p>SEU PEDIDO</p>
									</div>					
			 
				
			

		 
			 
			 
				<table id="pedido" class="table table_summary">
			 
				 	<thead>
					
							<tr>
							<th scope="col">
							
							</th>
						</tr>
				 
					
					</thead>
				 
				</table>
				<div class="mr-3 ml-3 flex flex-col">
				<div id="limpaCarrinho" style="margin-bottom:50px;padding-bottom:50px; display:none" class="w-full mt-3">
           				 			<button style="background:#E70D0D;font-size:15px;font-weight: bold;" type="submit" id="limparcarrinho" class="btn btn-danger btn-block"><?=$texto['msg_limpar_pedido']?></button>
            				</div>
				<?php	

			 
			 
			?>
			<div style="" class="w-full">
			<form class="w-full" data-toggle="validator" action="<?=$site.$Url[0].'/';?>carrinho" method="post">
			 
				<div style="display:none" class="row" id="options_2" style="padding-left: 12px;">
					<?php if(!empty($confirm_delivery) && $confirm_delivery == "true"): ?>
						<div style="width: 100%;">
							<div class="radio icheck-success">					
								<input type="radio" required value='true' checked="" id="enterega" name="opcao_delivery" 
								required />
								<label for="enterega">
									<span style="color:#444;">
										<p style="font-size: 14px;"><?=$texto['msg_delivery'];?></p>
									</span>
								</label>
							</div>
						</div>
					<?php endif; ?>
					<?php if(!empty($confirm_balcao) && $confirm_balcao == "true"): ?>
						<div style="width: 100%;">
							<div class="radio icheck-success">					
								<input type="radio" required value='false' id="buscar" name="opcao_delivery" 
								required />
								<label for="buscar">
									<span style="color:#444;">
										<p style="font-size: 14px;"><?=$texto['msg_Buscar_pedido'];?></p>
									</span>
								</label>
							</div>
						</div>
					<?php endif; ?>
					<?php if(!empty($confirm_mesa) && $confirm_mesa == "true"): ?>
						<div style="width: 100%;">
							<div class="radio icheck-success">					
								<input type="radio" required value='false2' id="mesa" name="opcao_delivery" 
								required />
								<label for="mesa">
									<span style="color:#444;">
										<p style="font-size: 14px;"><?=$texto['msg_pedido_mesa'];?></p>
									</span>
								</label>
							</div>
						</div>
					<?php endif; ?>
				</div><!-- Edn options 2 -->	
		 
				<table style="display: none" class="table table_summary">
					<tbody>
						<tr>
							<td>
								Pedido 
								<span class="pull-right">
									R$ <?=(!empty($cart->getAttributeTotal('preco')) ? Check::Real($cart->getAttributeTotal('preco')) : '0,00');?>

								</span>
							</td>
						</tr>
						<tr>
							<td>
								<?=$texto['msg_adicionais'];?> <span class="pull-right">
									R$ 
									<?php

							// Get all items in the cart

									$allItems = $cart->getItems();

									$totaldeadicionais = 0;

									foreach ($allItems as $items):

										foreach ($items as $item):

											$todosOsAdicionaisSoma2 = 0;
											if(!empty($item['attributes']['totalAdicionais'])):

												for($i=0; $i < $item['attributes']['totalAdicionais']; $i++):
													$todosOsAdicionaisSoma2 = ($todosOsAdicionaisSoma2 + $item['attributes']['adicional_valor'.$i]);
												endfor;
												$todosOsAdicionaisSoma2 = ($todosOsAdicionaisSoma2 * $item['quantity']);
											endif;

											$totaldeadicionais = $totaldeadicionais + $todosOsAdicionaisSoma2;


										endforeach;
									endforeach;

									echo Check::Real($totaldeadicionais);	

									?></span>
								</td>
							</tr>
							<?php
							if(!empty($_SESSION['desconto_cupom']) && $_SESSION['desconto_cupom']['user_id'] == $getu):
								?>
								<tr>
									<td>
										<a style="color: green">
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
							<tr>
								<td class="total">
									<?php $total_do_pedido = $cart->getAttributeTotal('preco') + $totaldeadicionais; ?>
									Subtotal
									<span class="pull-right">
										R$ <b id="v-total-p">
											<?php
											if(!empty($_SESSION['desconto_cupom']) && $_SESSION['desconto_cupom']['user_id'] == $getu):
												$valordesconto = Check::porcentagem($_SESSION['desconto_cupom']['desconto'], $total_do_pedido);
												echo Check::Real($total_do_pedido - $valordesconto);
											else:
												echo Check::Real($total_do_pedido);
											endif;
											?>
										</b>
									</span>
								</td>

							</tr>
						</tbody>
					</table>	


		


					<a style="display:none; color:#ffffff;background-color:#34af23;" class="btn_full validarCupom"><?=$texto['msg_btn_cupom'];?> </a>
				
					<script type="text/javascript">
						$(document).ready(function(){
							$('.validarCupom').click(function(){
								x0p('Coloque seu código', null, 'input',
									function(button, text) {
										if(button == 'info'){
											$.ajax({
												url: '<?=$site;?>includes/processaativacupom.php',
												method: 'post',
												data: {'codigocupom' : text, 'iduser' : '<?=$getu;?>'},
												success: function(data){											
													if(data == 'erro0'){
														x0p('Opss...', 
															'Cupom inválido!',
															'error', false);
													}else if(data == 'erro1'){
														x0p('Opss...', 
															'Cupom vencido!',
															'error', false);
													}else if(data == 'erro2'){
														x0p('Opss...', 
															'Esse cupom expirou!',
															'error', false);
													}else if(data == 'erro3'){
														x0p('Opss...', 
															'Ocorreu um arro ao validdar!',
															'error', false);
													}else if(data == 'erro4'){
														x0p('Opss...', 
															'Você já tem um desconto Ativo!',
															'error', false);
													}else if(data == 'true'){
														x0p('Parabéns!', 
															'Desconto aplicado!', 
															'ok', false);
														$('#sidebar').load('<?=$site;?>includes/sidebar.php', {"getloja" : "<?=$Url[0];?>"});
													}

												}
											});
										}
										if(button == 'cancel') {
											x0p('Cancelado', 
												'Quer ganhar um desconto? Entre em contato.',
												'error', false);
										}
									});
							});
						});
					</script>	

					</div>
				</form>
					</div>
					</div>
			 

			</div><!-- End cart_box -->
		
		</div><!-- End theiaStickySidebar -->
	<div id="checkout" style="border-radius: 0;z-index:999999; padding:unset; bottom:0; position:sticky; border-top:unset;width:100%;">
<div  class="flex flex-row w-full" style="height: 100%;">
<?php $total_do_pedido = $cart->getAttributeTotal('preco') + $totaldeadicionais; ?>
	<div style="background: #FF0000" class="w-1/6 items-center lex-row flex">
			<a data-iditem="<?=$ido_DoItem;?>" data-dismiss="modal" style="padding: 10px; cursor: pointer;"id="fecharmodallogin" class="close-link">
			
			
			<img src="img/voltar_1.png" class="icon_close_alt2"></a>										
			
		</div>
		<button type="submit" style="cursor: pointer;" id="checkout-btn">
		<div id="pagar" style="background: #46DC4C;padding:10px;height:100%" class="w-full items-center flex flex-row">
			<div id="text-checkout" style="font-size: 20px;" class="text-left w-full">
			 
				Pagar
				 
				
				</div>
				<div style="font-size: 25px;" class="text-right w-full">
				<span>R$: </span>
				<span data-valoritem="<?=Check::real($total_do_pedido)?>" id="total_carrinho"></span>	
				</div>
		
			
		</div>
		</button>
	</div>
				</div>
		
				</div>
	
		

			
				</div>







		
		
			 
		 
			 
			<div style="display:none" data-toggle="modal" data-userid="<?=$getu;?>" data-target="#cart-modal"class="w-full flex cursor-pointer" id="totalizador"  >
					<?php $total_do_pedido = $cart->getAttributeTotal('preco') + $totaldeadicionais; ?>
					<div class="flex flex-row justify-between w-full">				
								<div style="padding:5px" class="">
									<span style="color:white" >Meu Carrinho</span>
							</div>
					<div  style="padding:5px" class="text-right text-white">
									<span>R$:  </span>
									<span id="total_pedido" style="color:white">
									
											<?php
											if(!empty($_SESSION['desconto_cupom']) && $_SESSION['desconto_cupom']['user_id'] == $getu):
												$valordesconto = Check::porcentagem($_SESSION['desconto_cupom']['desconto'], $total_do_pedido);
												echo Check::Real($total_do_pedido - $valordesconto);
											else:
												echo Check::Real($total_do_pedido);
											endif;
											?>
										<!-- </span> -->
									</span>
										</div>
				<a style="display:none" href="#sidebar" title="<?=$texto['msg_seu_pedido'];?>"> <span style="opacity: 0.9;" class="cart-count"><?=($cart->getTotalItem() > 0 ? (int)$cart->getTotalItem() : 0);?></span><i style="opacity: 0.6;font-size:45px;color:#27771b;" class="icon-bag"></i>
				</a>
				
			</div>
							 
										</div>


	 
		 
			<script>

 


$(window).scroll(function(){
    'use strict';
 
		if ($(this).scrollTop() > 1){  
        $("#totalizador").css("display", "block");
    }
    else{
        $("#totalizador").css("display", "none");
    }
 
	 
   
});

</script>
		<script type="text/javascript">
			$("#whatsapp a").click(function(event){
				event.preventDefault();
				var dest=0;
				if($(this.hash).offset().top > $(document).height()-$(window).height()){
					dest=$(document).height()-$(window).height();
				}else{
					dest=$(this.hash).offset().top;
				}
				$('html,body').animate({scrollTop:dest}, 1000,'swing');
			});
		</script>

	</div><!-- End col-md-3 -->

</div><!-- End row -->

<div id="resultadoAddItem"></div>
<div id="updatesidebar"></div>
<div id="divlimparcarrinho"></div>



 




<?php 

$lerbanco->ExeRead("cupom_desconto", "WHERE user_id = :iduser AND mostrar_site = :mostrarcupom", "iduser={$getu}&mostrarcupom=1");
if($lerbanco->getResult()):

	$getcupommostrar = $lerbanco->getResult();

	if($getcupommostrar[0]['total_vezes'] <= 0):
	elseif(!isDateExpired($getcupommostrar[0]['data_validade'], 1)):
	else:


		if((!empty($_COOKIE['popupcupom']) && $_COOKIE['popupcupom'] == $getcupommostrar[0]['id_cupom']) || !empty($_SESSION['desconto_cupom'])):
	else:
		?>

		<script type="text/javascript">
			x0p({
				title: '',
				text: 'Parabéns! Você ganhou um desconto de <?=$getcupommostrar[0]['porcentagem'];?>%. Ativar cupom?',
				animationType: 'slideUp',
				icon: 'custom',
				iconURL: '<?=$site?>img/cupomsdesconto.png',
				buttons: [
				{
					type: 'error',
					key: 49,
					text: 'Não Obrigado',

				},
				{
					type: 'info',
					key: 50,
					text: 'Ativar Desconto'
				}
				]
			}).then(function(data) {
				if(data.button == 'error'){
					$.ajax({
						method: 'post',
						data: {'user_id' : '<?=$getu;?>', 'idcupom' : '<?=$getcupommostrar[0]['id_cupom'];?>'},
						success: function(data){
						}
					});

				}else if(data.button == 'info'){
					$.ajax({
						method: 'post',
						data: {'codigodocupom' : '<?=$getcupommostrar[0]['ativacao'];?>', 'user_id' : '<?=$getu;?>'},
						success: function(data){
							if(data == 'erro0'){
								x0p('Opss...', 
									'Cupom inválido!',
									'error', false);
							}else if(data == 'erro1'){
								x0p('Opss...', 
									'Cupom vencido!',
									'error', false);
							}else if(data == 'erro2'){
								x0p('Opss...', 
									'Esse cupom expirou!',
									'error', false);
							}else if(data == 'erro3'){
								x0p('Opss...', 
									'Ocorreu um arro ao validdar!',
									'error', false);
							}else if(data == 'erro4'){
								x0p('Opss...', 
									'Você já tem um desconto Ativo!',
									'error', false);
							}else{
								x0p('Parabéns!', 
									'Desconto aplicado!', 
									'ok', false);
								$('#sidebar').load('<?=$site;?>includes/sidebar.php', {"getloja" : "<?=$Url[0];?>"});
							}
						}
					});
				}

			});
		</script>

		<?php
	endif;
endif;
endif;
?>
<style type="text/css">
	.tremer{
		animation: treme 0.1s;
		animation-iteration-count: 3;
	}

	@keyframes treme {
		0% {margin-left: 0;}
		25% {margin-left: 5px;}
		50% {margin-left: 0;}
		75% {margin-left: -5px;}
		100% {margin-left: 0;}
	}
</style>
<script type="text/javascript">
	$(document).ready(function(){
		$('.ocultarmeioameio').hide();
	});
</script>

<div id="resultadogetmeioameio"></div>

<script type="text/javascript">
	

	$('.tamanho_item').click(function (){
		var vaaloridtamahoclick = $(this).data('idtaamanho');
		var iddoitem = $(this).data('iddoitem');
		var iddacategoria = $(this).data('iddacategoria');

		$('input:checkbox').prop("checked", false);

		$('#id_checkbox'+iddoitem).prop("checked", true);
		$('#id_checkbox'+iddoitem).prop("readonly", true);

		$.ajax({
			url: '<?=$site;?>controlers/mostrar-meioameio.php',
			method: 'post',
			data: {'iditem' : iddoitem, 'idcat' : iddacategoria, 'idoption' : vaaloridtamahoclick, 'userid' : '<?=$getu;?>'},
			success:function(data){

				if(data == 0){

					$("#mostrarmeioameio_"+iddoitem).hide();
					$('#resultadogetmeioameio').html();
					
				}else{

					$('#resultadogetmeioameio').html(data);				
				}

			}
		});


		$.ajax({
			url: '<?=$site;?>controlers/alterar-tipo-meioameio.php',
			method: 'post',
			data: {'iditem' : iddoitem, 'idcat' : iddacategoria, 'idoption' : vaaloridtamahoclick, 'userid' : '<?=$getu;?>'},
			success:function(data){		

				  document.getElementById('alterarmeioameio_'+iddoitem).value=data;	
				  if(data == 1){
				  	$('#infomeioameio_'+iddoitem).text('* Será cobrado pelo sabor de maior valor');
				  }else{
				  	$('#infomeioameio_'+iddoitem).text('');
				  }				

			}
		});





	});


</script>
<script src="<?= $site;?>/js/datatables.min.js"></script>
<script type="module" src="<?= $site;?>/js/main.js"></script>
</body>

</html>