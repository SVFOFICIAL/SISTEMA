<?php 
ob_start();
session_start();
require('../_app/Config.inc.php');



try{

	$site = HOME;
 
	$res['success'] = false;
	$res['error'] = true;
 

	$idcarrinho = !empty(($_COOKIE["idcar"])) ? (int)($_COOKIE["idcar"]) : false;
	
	$cart = new Cart([
		//Total de item que pode ser adicionado ao carrinho 0 = Ilimitado
		'cartMaxItem' => 0,
	
		// A quantidade máxima de um item que pode ser adicionada ao carrinho, 0 = Ilimitado
		'itemMaxQuantity' => 0,
	
		// Não usar cookies, os itens do carrinho desaparecerão depois que o navegador for fechado
		'useCookie' => false,
	]);
	
	
	// limpa o carrinho
	if(!empty($idcarrinho) && (int)$idcarrinho){
		$lerbanco->ExeRead('ws_carrinho', "where id_carrinho= :idcarrinho", "idcarrinho={$idcarrinho}");
		if(	$lerbanco->getResult()){


			$deletbanco->ExeDelete("ws_carrinho", "WHERE id_carrinho = :idCarrinho", "idCarrinho={$idcarrinho}");
		
			if($deletbanco->getResult()){
				if (isset($_COOKIE['idcar'])) {				 
					unset($_COOKIE['idcar']);
					setcookie("idcar", "", time() - 88600, '/');  
				}
				
				
				$cart->clear();
				$res['success'] = true;
				$res['error'] = false;

				echo json_encode($res);

			}else{

			
				$res['success'] = false;
				$res['error'] = true;

				echo json_encode($res);
		}

		
 }else{

$res['success'] = false;
				$res['error'] = true;

				echo json_encode($res);
 }
	
	}else{
		
$res['success'] = false;
$res['error'] = true;

echo json_encode($res);
	}

}catch (PDOException $e) {
	echo "Ocorreu um erro em sua solicitação. Por favor tentar novamente " . $e->getMessage();
  }



// limpa a lista do carrinho
ob_end_flush();

?>