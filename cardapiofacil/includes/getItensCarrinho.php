<?php

ob_start();
session_start();
require('../_app/Config.inc.php');
 
$site = HOME;



try{


    $res = new stdClass();
 
    $res->data = array();
 
    $idcarrinho = !empty(($_COOKIE["idcar"])) ? (int)($_COOKIE["idcar"]) : false;

    $cart = new Cart([
        //Total de item que pode ser adicionado ao carrinho 0 = Ilimitado
            'cartMaxItem' => 0,
    
        // A quantidade máxima de um item que pode ser adicionada ao carrinho, 0 = Ilimitado
            'itemMaxQuantity' => 0,
    
        // Não usar cookies, os itens do carrinho desaparecerão depois que o navegador for fechado
            'useCookie' => false,
        ]);
    

        $adicionais = "";
        $pedidos = '';
        if(!empty($idcarrinho) && (int)$idcarrinho){


            $lerbanco->ExeRead('ws_carrinho_items', "where id_carrinho= :idcarrinho", "idcarrinho={$idcarrinho}");


            if($lerbanco->getResult()){
                $totalCarrinho = (float)$cart->getAttributeTotal('preco');
                 $res->draw = 1;
                $res->recordsTotal =   $lerbanco->getRowCount();
                $res->recordsFiltered =  $lerbanco->getRowCount();
                foreach($lerbanco->getResult() as $item){
                  
             
                    if(!empty(json_decode($item['detalhes_pedido'])->adicionais) && count((array)json_decode($item['detalhes_pedido'])->adicionais)>0){
                        foreach (json_decode($item['detalhes_pedido'])->adicionais as $adicional) {
                            $adicional->valor_total = str_replace(".", ",",  $adicional->valor_total);
                            $adicionais .= "<div  class=\"w-full flex\"><div class=\"ml-2 mr-2\"><span>{$adicional->qt_adicional}</span></div>";
                            $adicionais .= "<div class=\"ml-2 mr-2\"><span>{$adicional->nome_adicional}</span></div>";
                            $adicionais .= "<div class=\"ml-2 mr-2\"><span>{$adicional->valor_total}</span></div></div>";
                    };


                }
                $hashItem = $item['hash_item'];
                $idProduto = json_decode($item['detalhes_pedido'])->id_produto;
                $nomeProduto = json_decode($item['detalhes_pedido'])->nome; 
                $observacao = json_decode($item['detalhes_pedido'])->observacao;
                $preco = json_decode($item['detalhes_pedido'])->preco;
                $qtItem = json_decode($item['detalhes_pedido'])->quantidade;
                $preco = str_replace(".", ",", $preco);
                $imgProd = json_decode($item['detalhes_pedido'])->img_prod;
                array_push($res->data, array("item" => "<td><div style=\"font-size:12px\" class=\"w-full bg-white justify-between flex flex-row\">           
                     
                    <div class=\"flex ml-3 flex-col\">            
                        <div class=\"mr-2 ml-2 text-left\"><span>$nomeProduto</span></div>
                        <div style=\"color:#545353\" class=\"w-full flex-col\">{$adicionais}</div>
                        <div style=\"color:#545353\" class=\"mr-2 ml-2 text-left\">Observação: {$observacao}</div>
                        <div class=\"mr-2 ml-2 text-left\">R$: {$preco}</div>   
                        <div style=\"width:180px;height:60%\" class=\"flex items-center flex-row\">
                            <button style=\"padding: 2px; height:50%;background:#E70D0D;font-size:12px;border-radius:5px;color:white;cursor:pointer;\" data-url=\"$site\" data-idcart=\"{$item['id_carrinho']}\" data-iditem=\"{$idProduto}\" data-id=\"{$item['id']}\" data-item_hash=\"$hashItem\" class=\"m-2 remove_item w-full justify-center flex flex-row\">
                               
                                <div class=\"mr-2\"> <img src=\"{$site}img/lixeira_excluir.png\"></div>
                                <div class=\"p-1 mr-2\"><span>Excluir</span> </div>
                            </button>
                         <div style=\"height:50%;border: 1px solid #A1A1A1;border-radius: 5px;\" class=\"m-2 flex items-center flex-row w-full\">
		
	<div class=\"p-1 mt-1 mr-2\"> 
		<div style=\"padding:2px; color:#E70D0D;\" class=\"flex justify-center w-full\">
			<button type=\"button\" class=\"btn-number_qt_prod-cart\" data-idcart=\"{$item['id_carrinho']}\" data-iditem=\"{$idProduto}\" data-id=\"{$item['id']}\" data-url=\"$site\" data-item_hash=\"$hashItem\"  data-type=\"minus\" data-field=\"quantidade\">
				<span class=\"glyphicon glyphicon-minus\"></span>
			</button>
		</div>
		</div>
		<div class=\"p-1 mt-1 mr-2\"> 
			<input  readonly style=\"height:20px; width:35px; font-size:15px; border-color: white;\" class=\"w-1/2 text-center\" type=\"text\" name=\"quantidade-cart\" class=\"input-number qtdpedido-cart\" value=\"{$qtItem}\" min=\"1\" max=\"100\">
		</div>
		<div class=\"p-1 mt-1 mr-2\"> 
		<div style=\"color:#46DC4C;\" class=\"flex justify-center w-full\">
			<button  type=\"button\" class=\"btn-number_qt_prod-cart\" data-idcart=\"{$item['id_carrinho']}\" data-iditem=\"{$idProduto}\" data-id=\"{$item['id']}\" data-url=\"$site\" data-item_hash=\"$hashItem\"  data-type=\"plus\" data-field=\"quantidade\">
				<span class=\"glyphicon glyphicon-plus\"></span>
			</button>
		</div>
		</div>
		</div>
                        

                    </div>
                    </div>
                    <div class=\"flex\"><figure class=\"thumb_menu_list\"><img style=\"width:100px;height:100px\" src=\"{$imgProd}\"></figure></div>
               
                     
         
            "));


            }
            echo json_encode($res);

        }else{
            $res->draw = 1;
            $res->recordsTotal =   0;
            $res->recordsFiltered =  0;
            $res->data  = array();

            echo json_encode($res);exit;
        }


     

  
    }else{
        $res->draw = 1;
        $res->recordsTotal =   0;
        $res->recordsFiltered =  0;
        $res->data  = array();

        echo json_encode($res);
    }

 
    


}catch (PDOException $e) {
	echo "Ocorreu um erro em sua solicitação. Por favor tentar novamente " . $e->getMessage();
  }

	ob_end_flush();









?>