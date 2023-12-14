<?php 
ob_start();
session_start();
require('../_app/Config.inc.php');
require('../_app/Mobile_Detect.php');
$detect = new Mobile_Detect;
$site = HOME;



try{

	

	$res['success'] = false;
	$res['error'] = false;
	$carrinhoItemObj = filter_input_array(INPUT_POST, FILTER_DEFAULT);
 

$cart = new Cart([
	//Total de item que pode ser adicionado ao carrinho 0 = Ilimitado
	'cartMaxItem' => 0,

	// A quantidade máxima de um item que pode ser adicionada ao carrinho, 0 = Ilimitado
	'itemMaxQuantity' => 0,

	// Não usar cookies, os itens do carrinho desaparecerão depois que o navegador for fechado
	'useCookie' => false,
]);


if(!empty($carrinhoItemObj['iditem']) && !empty($carrinhoItemObj['id']) && !empty($carrinhoItemObj['idcart']) && !empty($carrinhoItemObj['itemhash'])){
	
	 
	$lerbanco->ExeRead("ws_carrinho_items", "where id_carrinho= :idCarrinho", "idCarrinho={$carrinhoItemObj['idcart']}");

	if($lerbanco->getResult()){

		if($lerbanco->getRowCount()==1 && $lerbanco->getRowCount()!=0){
			
			$cart->remove($carrinhoItemObj['iditem'], $carrinhoItemObj['itemhash']);
			$cart->destroy();

			$deletbanco->ExeDelete("ws_carrinho_items", "WHERE id_carrinho= :idCarrinho and id= :idItem", "idItem={$carrinhoItemObj['id']}&idCarrinho={$carrinhoItemObj['idcart']}");
		
			if($deletbanco->getResult()){
				$deletbanco->ExeDelete("ws_carrinho", "WHERE id_carrinho= :idCarrinho", "idCarrinho={$carrinhoItemObj['idcart']}");
				$carrinhoObj['total_carrinho']  = 0;
				if($deletbanco->getResult()){

					if (isset($_COOKIE['idcar'])) {				 
						unset($_COOKIE['idcar']);
						setcookie("idcar", "", time() - 88600, '/');  
					}

					$res['msg'] = "Item exclúido com sucesso!";
					$res['success'] = true;
					$res['error'] = false;
					echo json_encode($res);
				}else{
					$res['msg'] = "Ocorreu um erro ao processar sua solicitação.";
					$res['success'] = false;
					$res['error'] = true;
					echo json_encode($res);
				
				}
			}else{

				$res['msg'] = "Ocorreu um erro ao processar sua solicitação.";
				$res['success'] = false;
				$res['error'] = true;
				echo json_encode($res);
			
			}
	 
	}else{
	
	$cart->remove($carrinhoItemObj['iditem'], $carrinhoItemObj['itemhash']);

	$deletbanco->ExeDelete("ws_carrinho_items", "WHERE id_carrinho = :idCarrinho and id= :idItem", "idItem={$carrinhoItemObj['id']}&idCarrinho={$carrinhoItemObj['idcart']}");

	$carrinhoObj['total_carrinho']  = $cart->getAttributeTotal('preco');

	 
	if($deletbanco->getResult()){
		
		$updatebanco->ExeUpdate("ws_carrinho", $carrinhoObj, "WHERE id_carrinho= :idCarrinho", "idCarrinho={$carrinhoItemObj['idcart']}");
		
		if($updatebanco->getResult()){
			$res['msg'] = "Item exclúido com sucesso!";
			$res['success'] = true;
			$res['error'] = false;
			echo json_encode($res);
		}else{
			$res['success'] = false;
			$res['error'] = true;
			echo json_encode($res);
		}
	
		}else{
			$res['msg'] = "Ocorreu um erro ao processar sua solicitação.";
			$res['success'] = false;
			$res['error'] = true;
			echo json_encode($res);

		}
	}
}else{
	$res['msg'] = "Ocorreu um erro ao processar sua solicitação.";
	$res['success'] = false;
	$res['error'] = true;
	echo json_encode($res);

}

}else{
	$res['msg'] = "Ocorreu um erro ao processar sua solicitação.";
	$res['success'] = false;
	$res['error'] = true;
	echo json_encode($res);

}


}catch (PDOException $e) {
	echo "Ocorreu um erro em sua solicitação. Por favor tentar novamente " . $e->getMessage();
  }

	ob_end_flush();

 