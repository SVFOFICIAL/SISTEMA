	<?php

	$site = ADMIN_URL;
	$lerbanco->ExeRead("configuracoes_site");
	if($lerbanco->getResult()):
		$getEmpresa = $lerbanco->getResult();
	endif;
	?>
	<div style="background: #7233A1;margin-left:-10px" class="md:mx-auto flex-row justify-center flex lg:mx-0 text-white font-bold  py-4 px-10 shadow-lg focus:outline-none focus:shadow-outline">
					<div class="flex flex-row">			

								<div class="w-full self-center">
									<span style="font-size:23px;">Configurações</span>
								</div>
							</div>
		                </div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel">
		

			 
			<div style="width: 95%;margin: 0 auto;">
			<div class="flex flex-col"> 
			<form data-url="<?=$site?>" method="post" id="updateDadosAdmin" autocomplete="off">
			<div class="indent_title_in">
				</br>
                    <h3>Configurações de Suporte:</h3>
                          <p>
                          Utilize os campos abaixo para configurar o setor de suporte do sistema.
                          </p>
                          
                  </div>
		
 
 

					<div class="form-group">
						<label for="tel_adm">Telefone Suporte:</label> 
						<input type="tel" name="tel_adm" value="<?=(!empty($getEmpresa[0]['tel_adm']) ? $getEmpresa[0]['tel_adm'] : "")?>" id="descricao_site" class="form-control telefone" placeholder="Digite o telefone de suporte">
					</div>
				 
					<div class="form-group">
						<label for="email_suporte">E-mail de suporte:</label> 
						<input type="tel" name="email_suporte" value="<?=(!empty($getEmpresa[0]['email_suporte']) ? $getEmpresa[0]['email_suporte'] : "")?>" id="email_suporte" class="form-control" placeholder="Digite o email de suporte">
					</div>
					<div class="form-group">
						<label for="h_suporte">Horário de suporte:</label>
						<input type="text" name="h_suporte" value="<?=(!empty($getEmpresa[0]['h_suporte']) ? $getEmpresa[0]['h_suporte'] : "")?>" id="h_suporte" class="form-control" placeholder="Digite o horário de atendimento de suporte">
					</div>
		 
					</br>

					<hr class="line-hr"/>
					</br>

					<div class="flex flex-col"> 
                       
						<div class="indent_title_in">
							<h3>Configurações de Redes Sociais:</h3>
								<p>
								Utilize os campos abaixo para configurar as redes sociais.
								</p>
                          
                  		</div>
					<div class="form-group">
						<label for="link_do_face">Facebook:</label>
						<input type="text" name="link_do_face" value="<?=(!empty($getEmpresa[0]['link_do_face']) ? $getEmpresa[0]['link_do_face'] : "")?>" id="link_do_face" class="form-control" placeholder="www.facebook.com.br/SVF">
					</div>
					<div class="form-group">
						<label for="link_do_insta">Instagram:</label>
						<input type="text" name="link_do_insta" value="<?=(!empty($getEmpresa[0]['link_do_insta']) ? $getEmpresa[0]['link_do_insta'] : "")?>" id="link_do_insta" class="form-control" placeholder="www.instagram.com.br/SVF">
					</div>
					<div class="form-group">
						<label for="link_do_youtube">Youtube:</label>
						<input type="text" name="link_do_youtube" value="<?=(!empty($getEmpresa[0]['link_do_youtube']) ? $getEmpresa[0]['link_do_youtube'] : "")?>" id="link_do_youtube" class="form-control" placeholder="www.youtube.com.br/SVF">
					</div>
					</br>
		</div>
<hr class="line-hr"/>



	</br>
	<div class="flex flex-col"> 
	<div class="indent_title_in">
		<h3>Configurações de Planos de Assinatura</h3>
			<p>
			Utilize os campos abaixo para configurar os planos de assinatura.
			</p>
	  
	  </div>
				 
					<div class="flex flex-row">
						<div class="w-full mr-4 form-group"> 
							<label>Primeiro Plano:</label>
						<input type="text" name="nome_plano_um" id="nome_plano_um" value="<?=(!empty($getEmpresa[0]['nome_plano_um']) ? $getEmpresa[0]['nome_plano_um'] : "")?>" class="form-control" placeholder="Digite o nome do plano">
							</div>
							<div class="w-full mr-4 form-group"> 
							<label>Dias do plano:</label>
						<input type="text" name="dias_plano_um" value="<?=(!empty($getEmpresa[0]['dias_plano_um']) ? $getEmpresa[0]['dias_plano_um'] : "")?>" id="dias_plano_um" class="form-control" placeholder="Digite os dias do plano">
						</div>
						<div class="w-full mr-4 form-group">
						<label>Valor do Plano:</label>
						<input type="text" name="v_plano_um" value="<?=(!empty($getEmpresa[0]['v_plano_um']) ? $getEmpresa[0]['v_plano_um'] : "")?>" id="v_plano_um" class="form-control numero" placeholder="Digite o valor do plano">
						</div>
						
					</div>
					<div class="flex flex-row">
				 
					<div class="w-full mr-4 form-group"> 
						<label>Segundo plano</label>
						

						<input type="text" name="nome_plano_dois" id="nome_plano_dois" value="<?=(!empty($getEmpresa[0]['nome_plano_dois']) ? $getEmpresa[0]['nome_plano_dois'] : "")?>" class="form-control" placeholder="Digite o nome do plano">
						</div>
						<div class="w-full mr-4 form-group"> 
						<label>Dias do plano:</label>
						<input type="text" name="dias_plano_dois" value="<?=(!empty($getEmpresa[0]['dias_plano_dois']) ? $getEmpresa[0]['dias_plano_dois'] : "")?>" id="dias_plano_dois" class="form-control" placeholder="Digite os dias do plano">
						</div>
						<div class="w-full mr-4 form-group"> 
						<label>Valor do Plano:</label>
						<input type="text" name="v_plano_dois" id="v_plano_dois" value="<?=(!empty($getEmpresa[0]['v_plano_dois']) ? $getEmpresa[0]['v_plano_dois'] : "")?>" class="form-control numero" placeholder="Digite o valor do plano">
						</div>
						
					</div>
	 
						<div class="flex flex-row">
							<div class="w-full mr-4 form-group"> 
								<label>Terceiro Plano</label>
								<input type="text" name="nome_plano_tres" id="nome_plano_tres" value="<?=(!empty($getEmpresa[0]['nome_plano_tres']) ? $getEmpresa[0]['nome_plano_tres'] : "")?>"  class="form-control" placeholder="Digite os dias do plano">
							</div>
						<div class="w-full mr-4 form-group"> 
							<label>Dias do plano:</label>
							<input type="text" name="dias_plano_tres" value="<?=(!empty($getEmpresa[0]['dias_plano_tres']) ? $getEmpresa[0]['dias_plano_tres'] : "")?>" id="dias_plano_tres" class="form-control" placeholder="DIAS DO TERCEIRO PLANO">
						</div>
						<div class="w-full mr-4 form-group"> 
								<label>Valor do Plano:</label>
								<input type="text" name="v_plano_tres" id="v_plano_tres" value="<?=(!empty($getEmpresa[0]['v_plano_tres']) ? $getEmpresa[0]['v_plano_tres'] : "")?>" class="form-control numero" placeholder="Digite o valor do plano">
						</div>
						
					</div>
		</div>
					</br>

<hr class="line-hr"/>



	</br>
			<div class="flex flex-col"> 
					<div class="indent_title_in">
		<h3>Configurações de Recebimento</h3>
			<p>
			Utilize os campos abaixo para configurar qual conta cairá o recebimento dos planos.
			</p>
	  
	  			</div>

					 
				 
				  <div class="flex flex-col">
						 
				  <div class="w-full mr-4 form-group"> 
						<label>Public Key:
						</label>
						<input type="text" name="public_key_mp" value="<?=(!empty($getEmpresa[0]['public_key_mp']) ? $getEmpresa[0]['public_key_mp'] : "")?>" id="public_key_mp" class="form-control" placeholder="Digite sua Public Key do Mercado Pago">
					</div>
					<div class="w-full mr-4 form-group"> 
					<label>Access Token:
					</label>
					<input type="text" name="access_token_mp" value="<?=(!empty($getEmpresa[0]['access_token_mp']) ? $getEmpresa[0]['access_token_mp'] : "")?>" id="access_token_mp" class="form-control" placeholder="Digite seu Access Token do Mercado Pago">
					</div>
				
		</div>
		</div>
		<div class="flex flex-row">	
		<div class="flex mr-5 ">	
					<button style="background-color: #00BB07;width: 114px;"class="aceita_entrega "  type="submit">Salvar</button>						
					</div>	
					<div class="flex">	
					<a href="<?=$site?>"><button style="background-color: #A70000;width: 114px;"class="aceita_entrega"  type="button" class="close" data-dismiss="modal">Voltar</button></a>
			</div>	 
			</div>	
					</form>
</div>
</div>
				</div>


		

		</div>
	</div>
</div>
</div>
