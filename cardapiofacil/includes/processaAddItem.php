<?php 
ob_start();
session_start();
require('../_app/Config.inc.php');
require('../_app/Mobile_Detect.php');
$detect = new Mobile_Detect;
$site = HOME;


try{

	$res['msg'] = "";
	$res['success'] = false;
$getnomeloja = $_POST['nomeloja'];

$cart = new Cart([
	//Total de item que pode ser adicionado ao carrinho 0 = Ilimitado
	'cartMaxItem' => 0,

	// A quantidade máxima de um item que pode ser adicionada ao carrinho, 0 = Ilimitado
	'itemMaxQuantity' => 0,

	// Não usar cookies, os itens do carrinho desaparecerão depois que o navegador for fechado
	'useCookie' => false,
]);


$carrinhoObj = filter_input_array(INPUT_POST, FILTER_DEFAULT);
// adiciona ao carrinho:
if(isset($carrinhoObj)){
	 
	$adicionaisKey = array_filter(
		// the array you wanna search in
		$carrinhoObj, 
		// callback function to search for certain sting
		function ($key){ 
			return(strpos($key,'quantidade_') !== false);
		}, 
		// flag to let the array_filter(); know that you deal with array keys
		ARRAY_FILTER_USE_KEY
	);

	
	$detalhes_pedido = array(
		'id_produto' => $carrinhoObj['id-item'],
		'preco'  => $carrinhoObj['valor'],
		'valor_unitario'  => $carrinhoObj['valor'],
		'quantidade' => $carrinhoObj['quantidade'],
		'nome'  => $carrinhoObj['nome_item'],  
		'img_prod'=>  $carrinhoObj['img_prod'],
		'observacao'  => (!empty($carrinhoObj['observacao']) ? $carrinhoObj['observacao'] : 'Não'),  
	);
	$detalhes_pedido['adicionais'] = array();
 
	$adicionais = array();

	if(!empty($adicionaisKey) && count($adicionaisKey)>0 ){
	 foreach($adicionaisKey as $key => $value){
		 
		if($value > 0){
		array_push($adicionais, array("id_adicional" => explode("_", $key)[1], "qt_adicional" => $value));
		}
	 }
	 foreach($adicionais as $add){
		$lerbanco->ExeRead('ws_adicionais_itens', "where id_adicionais = :idAdicional and user_id =:userId", "idAdicional={$add['id_adicional']}&userId={$_POST['userid']}");
 
		if($lerbanco->getResult()){			

			array_push($detalhes_pedido['adicionais'], array("qt_adicional" => $add['qt_adicional'], "nome_adicional" => $lerbanco->getResult()[0]['nome_adicional'], "valor_total" => number_format((float)$lerbanco->getResult()[0]['valor_adicional'] * $add['qt_adicional'],2)));
			
		}
	 }

			foreach($detalhes_pedido['adicionais'] as $itemAdd){

			$detalhes_pedido['preco'] = (float)$detalhes_pedido['preco'] + (float)$itemAdd['valor_total'];
			}
		} 
	 
		$detalhes_pedido['adicionais'] = !empty($detalhes_pedido['adicionais']) && count($detalhes_pedido['adicionais']) > 0 ? $detalhes_pedido['adicionais'] : array();
		$cart->add($carrinhoObj['id-item'], $carrinhoObj['quantidade'], $detalhes_pedido);
		$detalhes_pedido['preco'] =  (float)$detalhes_pedido['preco'] * (int)$detalhes_pedido['quantidade'];
		$carrinho['total_carrinho'] = (float)$cart->getAttributeTotal('preco');	   
	 	$carrinho['status'] = 1;
	 	$itemsCarrinho['hash_item'] = $cart->getItems()[$carrinhoObj['id-item']][0]['hash'];
		 $itemsCarrinho['id_item'] = $carrinhoObj['id-item'];
		$idcarrinho = !empty(($_COOKIE["idcar"])) ? (int)($_COOKIE["idcar"]) : false;
	 	if(!empty($idcarrinho)){
			
			$lerbanco->ExeRead('ws_carrinho_items', "where id_carrinho= :idcarrinho and id_item= :idItem", "idItem={$carrinhoObj['id-item']}&idcarrinho={$idcarrinho}");
			if($lerbanco->getResult()){

				$res['success'] = false;
	 
				$res['error'] = true;
				$res['msg'] = "Já existe um produto adicionado no carrinho!";
				echo json_encode($res);
			}else{

				$itemsCarrinho['id_carrinho'] = $idcarrinho;
		
				$itemsCarrinho['detalhes_pedido'] = json_encode($detalhes_pedido);
				$addbanco->ExeCreate("ws_carrinho_items", $itemsCarrinho);
				$carrinho['total_carrinho'] = (float)$cart->getAttributeTotal('preco');
				if($addbanco->getResult()){

					$updatebanco->ExeUpdate("ws_carrinho", $carrinho, "WHERE id_carrinho= :idCarrinho", "idCarrinho={$idcarrinho}");
					$res['success'] = true;
	 
					$res['error'] = false;
					$res['total_pedido'] = $cart->getAttributeTotal('preco');
					echo json_encode($res);
				
				}
			}
		}else{
			$addbanco->ExeCreate("ws_carrinho", $carrinho);

			$idCarrinho = $addbanco->getResult();
	 
			if($idCarrinho){
				$itemsCarrinho['id_carrinho'] = $idCarrinho;
				$itemsCarrinho['detalhes_pedido'] = json_encode($detalhes_pedido);
				$addbanco->ExeCreate("ws_carrinho_items", $itemsCarrinho);
	
	
			}
			$cookie_name = "idcar";
		
			$cookie_value = !empty($idCarrinho) ? $idCarrinho : $idcarrinho;
			 
			setcookie($cookie_name, $cookie_value, time() + (86400 * 30), '/');  
		 
			 $res['success'] = true;
		 
			$res['error'] = false;
			$res['total_pedido'] = $cart->getAttributeTotal('preco');
	
	
			echo json_encode($res);

		}
	 


	};


}catch (PDOException $e) {
	echo "Ocorreu um erro em sua solicitação. Por favor tentar novamente " . $e->getMessage();
  }

	ob_end_flush();
