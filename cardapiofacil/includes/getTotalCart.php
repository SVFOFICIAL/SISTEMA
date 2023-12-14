<?php

ob_start();
session_start();
require('../_app/Config.inc.php');
 
$site = HOME;


try{


    $res['success'] = false;
    $res['error'] = false;
 
    $idUser = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
 
    $idcarrinho = !empty(($_COOKIE["idcar"])) ? (int)($_COOKIE["idcar"]) : false;
 
 
        if(!empty($idcarrinho) && (int)$idcarrinho && !empty($idUser) && (int)$idUser){

            $lerbanco->FullRead('select minimo_delivery from ws_empresa where user_id= :userId', "userId={$idUser}");
            $valorMinimo =  $lerbanco->getResult()[0] ? $lerbanco->getResult()[0]['minimo_delivery'] : 0;
            
            $lerbanco->ExeRead('ws_carrinho', "where id_carrinho= :idcarrinho", "idcarrinho={$idcarrinho}");

            if($lerbanco->getResult()){

                $res['total_carrinho'] = (float)$lerbanco->getResult()[0] ? (float)$lerbanco->getResult()[0]['total_carrinho'] : 0;
                $res['valor_minimo'] = (float)$valorMinimo;
                $res['success'] = true;
                $res['error'] = false;                
       
               echo json_encode($res);
            }else{
                $res['success'] = false;
                $res['error'] = true;
      
               echo json_encode($res);
            }
        

  
    }else{
        $lerbanco->FullRead('select minimo_delivery from ws_empresa where user_id= :userId', "userId={$idUser}");
        $valorMinimo =  $lerbanco->getResult()[0] ? $lerbanco->getResult()[0]['minimo_delivery'] : 0;
        $res['total_carrinho'] = 0;
        $res['valor_minimo'] = (float)$valorMinimo;
        $res['success'] = true;
        $res['error'] = false;                

       echo json_encode($res);
    }
 

}catch (PDOException $e) {
	echo "Ocorreu um erro em sua solicitação. Por favor tentar novamente " . $e->getMessage();
  }


ob_end_flush();

?>