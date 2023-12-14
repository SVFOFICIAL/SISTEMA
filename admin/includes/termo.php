<?php

$site = ADMIN_URL;
$lerbanco->ExeRead("configuracoes_site");
if($lerbanco->getResult()):
    $getEmpresa = $lerbanco->getResult();
endif;
?>

<div style="background: #7233A1;margin-left:-10px" class="md:mx-auto flex-row justify-center flex lg:mx-0 text-white font-bold  py-4 px-10 shadow-lg focus:outline-none focus:shadow-outline">
					<div class="flex flex-row">			
						 		
								<div id="termo"   class="w-full self-center">
									<span style="font-size:23px;">Termo</span>
								</div>
							</div>
		                </div>
                        <div style="width: 95%;margin: 0 auto;">
<div class="flex flex-col">
    <form id="termoCliente" action="" data-url="<?=$site?>">
                        <div class="indent_title_in">
				</br>
                    <h3>Termo de Uso:</h3>
                          <p>
                          Digite o termo de uso para o cliente final.
                          </p>
                          
                  </div>

                  <div class="flex">

                    <div class="flex flex-row w-full">

                    <textarea name="termo_cliente" class="content" cols="150" rows="20" ></textarea>
                    </div>

                    </div>
</br>
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