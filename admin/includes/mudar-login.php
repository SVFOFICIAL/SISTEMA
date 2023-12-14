	
	<div style="background: #7233A1;margin-left:-10px" class="md:mx-auto flex-row justify-center flex lg:mx-0 text-white font-bold  py-4 px-10 shadow-lg focus:outline-none focus:shadow-outline">
					<div class="flex flex-row">			
						 		
								<div class="w-full self-center">
									<span style="font-size:23px;">Meus Dados</span>
								</div>
							</div>
		                </div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel">
					
		
				<div style="width: 95%;margin: 0 auto;">
				<div class="indent_title_in">
				</br>
                    <h3>Meus Dados:</h3>
                          <p>
                          Mude os dados de acesso do administrador.
                          </p>
                          
                  </div>
					<form data-url="<?=$site?>" id="updaSenhaAdmin" method="post" autocomplete="off">
						<div class="form-group">
							<label for="admin_email">Novo E-mail</label>
							<input type="text" name="admin_email" id="admin_email" class="form-control" placeholder="Digite seu novo e-mail">
						</div>

						<div class="form-group">
							<label for="admin_senha">Nova Senha</label>
							<input type="password" name="admin_senha" id="admin_senha" class="form-control" placeholder="Digite sua nova senha">
						</div>

						<div class="form-group">
							<label for="r_admin_senha">Repita a Nova Senha</label>
							<input type="password" name="r_admin_senha" id="r_admin_senha" class="form-control" placeholder="Confirme sua nova senha">
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

					<?php



				?>

			</div>
		</div>
	</div>
</div>
