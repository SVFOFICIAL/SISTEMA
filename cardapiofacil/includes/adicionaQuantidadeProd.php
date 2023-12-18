<?php

ob_start();
session_start();
require('../_app/Config.inc.php');
 
$site = HOME;


try{


  $cart = new Cart([
    //Total de item que pode ser adicionado ao carrinho 0 = Ilimitado
        'cartMaxItem' => 0,

    // A quantidade máxima de um item que pode ser adicionada ao carrinho, 0 = Ilimitado
        'itemMaxQuantity' => 0,

    // Não usar cookies, os itens do carrinho desaparecerão depois que o navegador for fechado
        'useCookie' => false,
    ]);


    $res['success'] = false;
    $res['error'] = false;
 
    $itemObj = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    
 
    if(!empty($itemObj['iditem']) && (int)$itemObj['iditem'] && !empty($itemObj['id']) && (int)$itemObj['id'] && !empty($itemObj['idcart']) && (int)$itemObj['idcart']){
      
      $itemCart = $cart->getItems()[$itemObj['iditem']];
      $detalhes_pedido['adicionais'] = array();

      $detalhes_pedido = array(
        'id_produto' => $itemCart[0]['attributes']['id_produto'],
        'preco'  =>  $itemCart[0]['attributes']['preco'],
        'quantidade' =>  $itemCart[0]['attributes']['quantidade'],
        'nome'  => $itemCart[0]['attributes']['nome'],
        'img_prod'=>  $itemCart[0]['attributes']['img_prod'],
        'observacao'  => $itemCart[0]['attributes']['observacao'],
        'adicionais' =>  $itemCart[0]['attributes']['adicionais']
      );
   
     
     $resUpdate =  $cart->update($itemObj['iditem'], (int)$itemObj['qtItem'],$detalhes_pedido);
    
     if($resUpdate){
    
      $detalhes_pedido['quantidade'] = (int)$itemObj['qtItem'];
      $detalhes_pedido['preco'] =  (float)$detalhes_pedido['preco'] * (int)$detalhes_pedido['quantidade'];

  
      $carrinho['total_carrinho'] = (float)$cart->getAttributeTotal('preco');

      $updatebanco->ExeUpdate("ws_carrinho", $carrinho, "WHERE id_carrinho= :idCarrinho", "idCarrinho={$itemObj['idcart']}");

      if($updatebanco->getResult()){
 
        $carrinhoItemsObj['detalhes_pedido'] = json_encode($detalhes_pedido);

        $updatebanco->ExeUpdate("ws_carrinho_items", $carrinhoItemsObj, "WHERE id_carrinho= :idCarrinho and id= :idItemCart and hash_item= :hashItem", "hashItem={$itemObj['itemhash']}&idItemCart={$itemObj['id']}&idCarrinho={$itemObj['idcart']}");

        if($updatebanco->getResult()){
            $res['success'] = true;
            $res['error'] = false;
            $res['msg'] = "Quantidade atualizada!";
            echo json_encode($res);
        }else{
          $res['success'] = false;
          $res['error'] = true;
          $res['msg'] = "Ocorreu um erro ao atualizar a quantidade!";
          echo json_encode($res);
        }


      }else{

        $res['success'] = false;
        $res['error'] = true;
        $res['msg'] = "Ocorreu um erro ao atualizar a quantidade!";
        echo json_encode($res);
      }


     }else{
      $res['success'] = false;
      $res['error'] = true;
      $res['msg'] = "Ocorreu um erro ao atualizar a quantidade!";

     }

  




    }else{
      $res['success'] = false;
      $res['error'] = true;
      $res['msg'] = "Ocorreu um erro ao atualizar a quantidade";

      echo json_encode($res);

   

    }

    //$idcarrinho = !empty(($_COOKIE["idcar"])) ? (int)($_COOKIE["idcar"]) : false;
 
   
 
    //     if(!empty($idcarrinho) && (int)$idcarrinho && !empty($idUser) && (int)$idUser){

    //         $lerbanco->FullRead('select minimo_delivery from ws_empresa where user_id= :userId', "userId={$idUser}");
    //         $valorMinimo =  $lerbanco->getResult()[0] ? $lerbanco->getResult()[0]['minimo_delivery'] : 0;
            
    //         $lerbanco->ExeRead('ws_carrinho', "where id_carrinho= :idcarrinho", "idcarrinho={$idcarrinho}");

    //         if($lerbanco->getResult()){

    //             $res['total_carrinho'] = (float)$lerbanco->getResult()[0] ? (float)$lerbanco->getResult()[0]['total_carrinho'] : 0;
    //             $res['valor_minimo'] = (float)$valorMinimo;
    //             $res['success'] = true;
    //             $res['error'] = false;                
       
    //            echo json_encode($res);
    //         }else{
    //             $res['success'] = false;
    //             $res['error'] = true;
      
    //            echo json_encode($res);
    //         }
        

  
    // }else{
    //     $lerbanco->FullRead('select minimo_delivery from ws_empresa where user_id= :userId', "userId={$idUser}");
    //     $valorMinimo =  $lerbanco->getResult()[0] ? $lerbanco->getResult()[0]['minimo_delivery'] : 0;
    //     $res['total_carrinho'] = 0;
    //     $res['valor_minimo'] = (float)$valorMinimo;
    //     $res['success'] = true;
    //     $res['error'] = false;                

    //    echo json_encode($res);
    // }
 

}catch (PDOException $e) {
	echo "Ocorreu um erro em sua solicitação. Por favor tentar novamente " . $e->getMessage();
  }


ob_end_flush();

?>