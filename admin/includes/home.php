
<!-- ============================================================== -->
<!-- Other sales widgets -->
<!-- ============================================================== -->
<!-- .row -->


<div style="background: #7233A1;margin-left:-10px" class="md:mx-auto flex-row justify-center flex lg:mx-0 text-white font-bold  py-4 px-10 shadow-lg focus:outline-none focus:shadow-outline">
					<div class="flex flex-row">			
						 		
								<div class="w-full self-center">
									<span style="font-size:23px;">Início</span>
								</div>
							</div>
		                </div>
<div class="flex md:flex-row flex-col m-9">
    <?php
    $lerbanco->ExeRead("ws_users");
    $totalclientes = 0;
    if ($lerbanco->getResult()):
        $totalclientes = $lerbanco->getRowCount();
    endif;
    ?>
    <div class="col-lg-3 col-sm-6 col-xs-12">
        <div class="white-box">
            <h3 class="box-title">TOTAL CLIENTES</h3>
            <ul class="list-inline two-part">
                <li><i class="icon-people text-info"></i></li>
                <li class="text-right"><span class="counter"><?=$totalclientes;?></span></li>
            </ul>
        </div>
    </div>
    <?php
    $lerbanco->ExeRead("ws_empresa");
    $totalempresas = 0;
    if ($lerbanco->getResult()):
        $totalempresas = $lerbanco->getRowCount();
    endif;
    ?>
    <div class="col-lg-3 col-sm-6 col-xs-12">
        <div class="white-box">
            <h3 class="box-title">LOJAS CADASTRADAS</h3>
            <ul class="list-inline two-part">
                <li><i class="icon-folder text-purple"></i></li>
                <li class="text-right"><span class="counter"><?= $totalempresas;?></span></li>
            </ul>
        </div>
    </div>
    <?php
    $lerbanco->ExeRead("ws_itens");
    $totaitens = 0;
    if ($lerbanco->getResult()):
        $totaitens = $lerbanco->getRowCount();
    endif;
    ?>
    <div class="col-lg-3 col-sm-6 col-xs-12">
        <div class="white-box">
            <h3 class="box-title">PRODUTOS CADASTRADOS</h3>
            <ul class="list-inline two-part">
                <li><i class="icon-folder-alt text-danger"></i></li>
                <li class="text-right"><span class=""><?=$totaitens?></span></li>
            </ul>
        </div>
    </div>
    <?php
    $lerbanco->ExeRead("ws_pedidos");
    $totalpedidos = 0;
    if ($lerbanco->getResult()):
        $totalpedidos = $lerbanco->getRowCount();
    endif;
    ?>
    <div class="col-lg-3 col-sm-6 col-xs-12">
        <div class="white-box">
            <h3 class="box-title">PEDIDOS REALIZADOS</h3>
            <ul class="list-inline two-part">
                <li><i class="ti-wallet text-success"></i></li>
                <li class="text-right"><span class=""><?=$totalpedidos;?></span></li>
            </ul>
        </div>
    </div>
</div>
<!-- /.row -->

<!-- ============================================================== -->
<!-- Demo table -->
<!-- ============================================================== -->
 
        
    <div class="row m-9">
   
        <div class="col-md-4">
        <div class="form-group">
        <label for="search_cliente">Procure seu Cliente:</label>						
            <input oninput="this.value = this.value.replace(/[^a-z-A-Z-0-9]/g, '')"  type="text" id="search_cliente"  class="form-control" placeholder="Digite o nome da loja">
    
                    </div>
                </div>
              
        <div class="col-md-4">
        <div class="form-group">
        <label for="search_cidade">Cidade:</label>						
            <input oninput="this.value = this.value.replace(/[^a-z-A-Z-0-9]/g, '')"  type="text" id="search_cidade"  class="form-control" placeholder="Digite o nome da cidade">
    
                    </div>
                </div>

                <div class="col-md-2">
                <div class="form-group">
                     <label for="search_cupom">Data Inicial:</label>						
                      
                      <input  type="text" class="search_date_from dateinput form-control" name='search_data_cadastro_from' id="datepicker-from" data-mask="00/00/0000" placeholder="00/00/0000" />
                    </div>
                </div>
                <div class="col-md-2">
                <div class="form-group">
                     <label for="search_cupom">Data Final:</label>					
                      
                      <input  type="text" class="search_date_to dateinput form-control" name='search_data_cadastro_to' id="datepicker-to" data-mask="00/00/0000" placeholder="00/00/0000" />
                    </div>
                </div>

                <div class="col-md-6">
                <div class="icheck-material-green">	        
                      <input type="checkbox" id="clientes_inativos" name="check_clientes_inativos" class="form-control">
                      <label for="clientes_inativos">Apenas Clientes Inativos</label>	
                </div>

             </div>
</div>
       
       
        
            <div style="padding-left:35px;padding-right:35px" class="overflow-x-auto">
            <div><span style="position:relative; float: right;right:5px">Total Encontrado: <span id="count-rows" >0</span> </span>
                <table id="adminTable" class="table border w-full text-left text-gray-500 dark:text-gray-400">
                <thead style="background:#7232A0;" class="text-white md:text-md\[20px]  text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr class="admin-table text-center">

                            <th scope="col" class="text-center px-6 py-3">Nome da Loja</th>                            
                            <th class="text-center px-6 py-3" scope="col">Cidade</th>
                            <th  class="text-center px-6 py-3" scope="col">Produtos</th>
                            <th class="text-center px-6 py-3" scope="col">Pedidos</th>
                            <th class="text-center px-6 py-3"scope="col">Renovação</th>
                            <th class="text-center px-6 py-3"scope="col">Cadastro</th>
                            <th class="text-center px-6 py-3"scope="col">Status</th>
                            <th class="text-center px-6 py-3" scope="col">Disponível</th>                         
                            <th  class="text-center px-6 py-3" scope="col">Comandos</th>
                        </tr>
                    </thead>
                    </table>
 
           
                            <!-- MODAL ALTERAR SENHA -->
                            <div style="border-radius: 10px; "class="modal fade" style=""id="modalSenha" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                            
                                <div style="background: #7233A1;box-shadow: 0px 2px 3px black" class="md:mx-auto flex-row justify-center flex lg:mx-0 text-white font-bold  py-4 px-10 shadow-lg focus:outline-none focus:shadow-outline">
					<div class="flex flex-row">			
						 		
								<div class="w-full self-center">
									<span style="font-size:23px;">Senha do  Cliente</span>
								</div>
							</div>
		                </div>
                              <div class="modal-body">
                                 
                                   <div class="form-group">

                                   <div class="row">
		    <div class="col-md-12">
			<div class="">
            <div class="indent_title_in">
                    <h3>Senha do cliente:</h3>
                          <p>
                          Altere a senha do Cliente.
                          </p>
                          <p>Cliente: <span id="nome_empresa" style="font-weight: bold; color: #7233A1;"></span></p>
                  </div>
				 
				<div style="margin: 0 auto;">

					<form method="post" data-userid="" data-nomeempresa="" id="updateSenhaCliente" utocomplete="off">
						<div class="form-group">
							<label for="pass">Nova Senha</label>
							<input type="password" name="pass" id="pass" class="form-control" placeholder="Digite uma nova senha">
						</div>

						<div class="form-group">
							<label for="r_pass">Repita a Nova Senha</label>
							<input type="password" name="r_pass" id="r_pass" class="form-control" placeholder="Digite sua nova senha novamente">
						</div>
						<button style="background-color: #00BB07;width: 114px;"class="aceita_entrega "  type="submit">Salvar</button>						
                        <button style="background-color: #A70000;width: 114px;"class="aceita_entrega"  type="button" class="close" data-dismiss="modal">Voltar</button>
						 
					</form>
					

				 


			</div>
		</div>
	</div>
</div>

                                </div>

                            </div>
                           
                    </div>
                </div>
            </div>
            <!-- FIM DO MODAL --> 

 
                            <!-- MODAL DADOS CLIENTE -->
                            <div style="border-radius: 10px;" class="modal fade" id="modalDadosCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                               
                                   
                                  <div style="background: #7233A1;box-shadow: 0px 2px 3px black" class="md:mx-auto flex-row justify-center flex lg:mx-0 text-white font-bold  py-4 px-10 shadow-lg focus:outline-none focus:shadow-outline">
					<div class="flex flex-row">			
						 		
								<div class="w-full self-center">
									<span style="font-size:23px;">Dados do Cliente</span>
								</div>
							</div>
		                </div>
</br>
                             
                              <div style="height: 550px;
    overflow-y: auto;"class="modal-body">
                                 
                                   <div class="form-group">

                                   <div class="row">
		    <div class="col-md-12">
			<div class="">
           
				<div style="margin: 0 auto;">
                <div class="indent_title_in">
                    <h3>Dados do cliente:</h3>
                          <p>
                          Dados cadastrais dos clientes.
                          </p>
                       
                  </div>
					<form method="post" data-userid="" data-nomeempresa="" id="updateDadosCliente" utocomplete="off">
						<div class="form-group">
							<label for="user_name">Nome:</label>
							<input type="text" name="user_name" id="nome" class="form-control" placeholder="">
						</div>

						<div class="form-group">
							<label for="user_lastname">Sobrenome:</label>
							<input type="text" name="user_lastname" id="sobrenome" class="form-control" placeholder="">
						</div>

                        <div class="form-group">
							<label for="user_cpf">CPF:</label>
							<input type="text" name="user_cpf" id="user_cpf" class="form-control" placeholder="">
						</div>

                        <div class="form-group">
							<label for="user_email">Email:</label>
							<input type="text" name="user_email" id="email" class="form-control" placeholder="">
						</div>
 

                        <div class="form-group">
							<label for="user_telefone">Telefone:</label>
							<input type="text" name="user_telefone" id="telefone" class="form-control" placeholder="">
						</div>
</br>

                        <hr class="line-hr"/>
                        </br>
                        <div class="indent_title_in">
                    <h3>Endereço do cliente:</h3>
                          <p>
                          Dados do endereço do cliente.
                          </p>
                        
                  </div>


                        <div class="form-group">
							<label for="cep_empresa">Cep:</label>
							<input type="text" name="cep_empresa" id="cep_empresa" class="form-control" placeholder="">
						</div>

						<div class="form-group">
							<label for="end_uf_empresa">Estado:</label>
							<input type="text" name="end_uf_empresa" id="estado" class="form-control" placeholder="">
						</div>

                        <div class="form-group">
							<label for="cidade_empresa">Cidade:</label>
							<input type="text" name="cidade_empresa" id="cidade" class="form-control" placeholder="">
						</div>

                        <div class="form-group">
							<label for="end_bairro_empresa">Bairro:</label>
							<input type="text" name="end_bairro_empresa" id="bairro" class="form-control" placeholder="">
						</div>

                          <div class="form-group">
							<label for="end_rua_n_empresa">Rua e Número:</label>
							<input type="text" name="end_rua_n_empresa" id="end_rua_n_empresa" class="form-control" placeholder="">
						</div>

                        <div class="form-group">
							<label for="telefone_empresa">Telefone:</label>
							<input type="text" name="telefone_empresa" id="telefone" class="form-control" placeholder="">
						</div>



                        </br>

<hr class="line-hr"/>
</br>
<div class="indent_title_in">
<h3>Dados da loja:</h3>
  <p>
  Dados da loja do cliente.
  </p>
 
</div>


<div class="form-group">
    <label for="nome_empresa">Nome empresa:</label>
    <input type="text" name="nome_empresa" id="nome_empresa" class="form-control" placeholder="">
</div>

<div class="form-group">
    <label for="nome_empresa_link">Site:</label>
    <input type="text" name="nome_empresa_link" id="link_loja" class="form-control" placeholder="">
</div>

<div class="form-group">
    <label for="user_nome_plano">Plano:</label>
    <input type="text" name="user_nome_plano" id="plano_user" class="form-control" placeholder="">
</div>
 


<button style="background-color: #00BB07;width: 114px;"class="aceita_entrega "  type="submit">Salvar</button>						
                        <button style="background-color: #A70000;width: 114px;"class="aceita_entrega"  type="button" class="close" data-dismiss="modal">Voltar</button>
					</form>
					

				 


			</div>
		</div>
	</div>
</div>

                                </div>

                            </div>
                           
                    </div>
                </div>
            </div>
            <!-- FIM DO MODAL --> 


 

</div>
</div>
</div>
</div>
 
 