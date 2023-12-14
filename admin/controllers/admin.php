<?php

ob_start();
 
session_start();
require('../../sistema/_app/Config.inc.php');




function carregaTabelaAdmin(){


  try{
    $site = ADMIN_URL;
    $sistema = HOME;
    $linkLoja = LINK_LOJA;
    global $lerbanco;

    $userlogin = $_SESSION['administrador']['admin_id'];
 
    $res = new stdClass();
   
    $res->data = array();
    $linkWhastapp = "";

    $lerbanco->ExeRead("ws_empresa", "ORDER BY id_empresa DESC");
    if($lerbanco->getResult()){
    
          
        $res->draw = 1;
        $res->recordsTotal =  $lerbanco->getRowCount();
        $res->recordsFiltered = $lerbanco->getRowCount();;
 
            foreach ($lerbanco->getResult() as $getempresa){
                extract($getempresa);
                     $nome_empresa = (!empty($nome_empresa) ? $nome_empresa: "");
                
                  
                     $cidade_empresa =  !empty($cidade_empresa) ? $cidade_empresa : "";

                     $gettotaldositenscliente = 0;
                     $lerbanco->ExeRead("ws_itens", "WHERE user_id = :userid", "userid={$user_id}");
                     if ($lerbanco->getResult()){
                         $gettotaldositenscliente = $lerbanco->getRowCount();
                     };
                       

                     $gettotaldospedidoscliente = 0;
                     $lerbanco->ExeRead("ws_pedidos", "WHERE user_id = :userid", "userid={$user_id}");
                     if ($lerbanco->getResult()){
                         $gettotaldospedidoscliente = $lerbanco->getRowCount();
                     };
                     
                     $empresa_data_renovacao_formatar = explode("-", $empresa_data_renovacao);
                     $empresa_data_renovacao_formatar = array_reverse($empresa_data_renovacao_formatar);
                     $empresa_data_renovacao_formatar = implode("/", $empresa_data_renovacao_formatar);
               


                     $lerbanco->ExeRead("ws_users", "where user_id= :userId", "userId={$user_id}");
                   
                    
                     $userDataRegistro =!empty($lerbanco->getResult()) ? $lerbanco->getResult()[0]['user_registration'] : "01/01/1989";
                     $userDateFull = !empty($lerbanco->getResult()) ? $lerbanco->getResult()[0]['user_registration'] : "01/01/1989";
                     $userDataRegistro = explode(" ", $userDataRegistro);    
                                
                     $user_data_registro = explode("-", $userDataRegistro[0]);       
                                
                     $user_data_registro = array_reverse($user_data_registro);
                    
                     $user_data_registro = implode("/", $user_data_registro);
                       

                
                     if(!isDateExpired($empresa_data_renovacao, 1)){
                   
                      $styleRenovacao = "style='color: #ff7676;'";
                      $statusRenovacao =  "<span {$styleRenovacao} >Vencido</span>";
                     }else{
                      $styleRenovacao = "style='color: #00BB07;'";
                      $statusRenovacao =  "<span {$styleRenovacao}>Pago</span>";
                     
                     };
               
                $statusCliente =  $lerbanco->getResult() ? $lerbanco->getResult()[0]['user_status'] : false;
            if($statusCliente) { 
                $idButton = "btn_s";
                $classButton = "aceita_entrega atualiza_cliente";
                $style= "width:62px; height:38px;background-color: #00BB07";
                $value = "Sim";
                }else{
                $idButton = "btn_n";
                $classButton = "aceita_entrega atualiza_cliente";
                $style= "width:62px; height:38px;background-color: #A70000";
                $value = "Não";
                  }

                  
                  if(!empty($telefone_empresa)){
                    $linkWhatsapp = "<a href=\"https://api.whatsapp.com/send?1=pt_BR&phone=55{$telefone_empresa}\" target=\"_blank\">
                         <button style=\"border-radius: 5px;\" type=\"button\" class=\"btn btn-info\"><i class=\"fa fa-whatsapp\" aria-hidden=\"true\"></i></button></a>";
               
                  }
                  //Link da loja deve ser a URL /cardapiofacil 
                  $linkLojaUrl = $linkLoja.$nome_empresa_link;
                    array_push($res->data, array("nomeEmpresa" => "<td style=\"text-align: left;\"> <a href=\"$linkLojaUrl\" target=\"_blank\"><span class=\"font-medium\" style=\"cursor: pointer;\">{$nome_empresa}</span>
                </a></td>","cidadeEmpresa" => "<td><span>{$cidade_empresa}</span></td>", "totalItems"=> "<td><span>{$gettotaldositenscliente}</span></td>",
                 "totalPedidos" => "<td><span>{$gettotaldospedidoscliente}</span></td>", "dataRenovacao" => "<td><input readonly style=\"width:150px\" data-url=\"{$site}\" data-iduser=\"{$user_id}\" type=\"text\" class=\"form-control text-center atualiza_renovacao\" name=\"data_cadastro\" id=\"datepicker\" data-mask=\"00/00/0000\" placeholder=\"00/00/0000\" value=\"{$empresa_data_renovacao_formatar}\"/><span hidden>{$user_data_registro}</span></td>","dataCadastro" => "<td><span>{$user_data_registro}</span></td>",
                "statusRenovacao"=>"<td>{$statusRenovacao}</td>", "disponivel" => "<td class=\"col-md-3 col-sm-2  px-6 py-4\"><button  data-url=\"{$site}\" id=\"{$idButton}\" style=\"{$style}\" value=\"{$value}\" class=\"$classButton\" data-iduser=\"{$user_id}\">$value</button><span hidden>{$value}</span></td>",
                "comandos"=> "<td><div class=\"flex flex-row justify-evenly\">{$linkWhatsapp}<button data-target=\"#modalSenha\" data-url=\"{$site}\" data-nomeEmpresa=\"{$nome_empresa}\" data-iduser=\"{$user_id}\" data-toggle=\"modal\" style=\"background: rgb(68, 98, 255);border-radius: 5px;border: 1px solid rgb(68, 98, 255)\"class=\"altera_senha btn btn-success\"><i class=\"fa fa-unlock-alt\" aria-hidden=\"true\"></i></button><button data-target=\"#modalDadosCliente\" data-url=\"{$site}\" data-iduser=\"{$user_id}\" data-toggle=\"modal\" style=\"border-radius: 5px;background: rgb(114, 50, 160);border: 1px solid rgb(114, 50, 160)\" class=\"dados_cliente btn btn-success\"><i class=\"fa fa-user\" aria-hidden=\"true\"></i></button></a></div></td>",));
                 
                    }
                  
                    echo json_encode($res);
                }else{
                  $res->draw = 1;
                  $res->recordsTotal =  0;
                  $res->recordsFiltered = 0;
                  $res->data = array();
              
                  echo json_encode($res);
                }

   
              }catch (PDOException $e) {
                echo "Ocorreu um erro em sua solicitação. Por favor tentar novamente " . $e->getMessage();
              }
               
            }

function alteraSenhaCliente($payLoad){

 try{
  
  global $lerbanco;
  global $updatebanco;

  $res = new stdClass();
     
   

  if(!empty($payLoad)){	
    // LIMPA OS CAMPOS RETIRANDO TAGS E ESPAÇOS DESNECESSÁRIOS
    $payLoad = array_map('strip_tags', $payLoad);
    $payLoad = array_map('trim', $payLoad);

    if(in_array('', $payLoad) || in_array('null', $payLoad)){
      $res->msg ="Preencha todos os campos obrigatórios!";
      $res->success = false;
      $res->error = true;
      echo json_encode($res);
    }elseif ($payLoad['pass'] != $payLoad['r_pass']){
    $res->msg ="As senhas informadas não são iguais!";
      $res->success = false;
      $res->error = true;
      echo json_encode($res);
  }elseif(strlen($payLoad['pass']) <= 7){
    $res->msg ="A senha deve conter o mínimo de 8 caracteres!";
    $res->success = false;
    $res->error = true;
    echo json_encode($res);
  }else{

     


    $novosdados = array();
		$novosdados['user_password'] = md5($payLoad['pass']);
    $updatebanco->ExeUpdate("ws_users", $novosdados, "WHERE user_id = :uid", "uid={$payLoad['user_id']}");
    if ($updatebanco->getResult()){
      $res->msg ="Atualizado com sucesso!";
      $res->success = true;
      $res->error = false;
      echo json_encode($res);				
    }else{
      $res->msg ="Ocorreu um erro no processamento. Por favor tente novamente!";
      $res->success = false;
      $res->error = true;
      echo json_encode($res);			
    };
  };			
};

 
}catch (PDOException $e) {
  echo "Ocorreu um erro em sua solicitação. Por favor tentar novamente " . $e->getMessage();
}

}

function dadosCliente($payLoad){

  try{
  
  global $lerbanco;
  global $updatebanco;

  $res = new stdClass();
  $res->user = array();
  $res->empresa = array();
     

  if(!empty($payLoad) && (int)$payLoad['user_id']){


    $lerbanco->FullRead("select user_name, user_nome_plano, user_lastname, user_email, user_telefone, user_cpf, user_registration from ws_users where user_id ={$payLoad['user_id']}");

    if($lerbanco->getResult()){
      foreach($lerbanco->getResult() as $user){
        extract($user);
          array_push($res->user, $user);

      }
   
      $lerbanco->FullRead("select nome_empresa, nome_empresa_link, email_empresa, telefone_empresa, end_rua_n_empresa, end_bairro_empresa, cidade_empresa, end_uf_empresa, cep_empresa, id_empresa from ws_empresa where user_id ={$payLoad['user_id']}");

      if($lerbanco->getResult()){
        foreach($lerbanco->getResult() as $empresa){
          extract($empresa);
            array_push($res->empresa, $empresa);
  
        }
  
    }

  }else{
    $res->msg = "Ocorreu um erro no processamento. Por favor tente novamente.";
    $res->success = false;
    $res->error = true;
    echo json_encode($res);

  }
      $res->success = true;
      $res->error = false;
      echo json_encode($res);
  }else{
    $res->msg = "Ocorreu um erro no processamento. Por favor tente novamente.";
    $res->success = false;
    $res->error = true;
    echo json_encode($res);

  }
}catch (PDOException $e) {
  echo "Ocorreu um erro em sua solicitação. Por favor tentar novamente " . $e->getMessage();
}



}


function atualizaDataRenovacao($payLoad){

try{
  global $lerbanco;
  global $updatebanco;
  $res = new stdClass();

  if(!empty($payLoad)){
  
    $payLoad = array_map("trim", $payLoad);
    $payLoad = array_map("strip_tags", $payLoad);
  
    if(in_array("", $payLoad)){
      $res->msg = "Por favor selecione uma data.";
      $res->success = false;
      $res->error = true;
    echo json_encode($res);
    }elseif(strlen($payLoad['empresa_data_renovacao']) != 10){
      $res->msg = "Data inválida. Por favor selecione uma data válida.";
      $res->success = false;
      $res->error = true;
    echo json_encode($res);
    }else{
     $payLoad['empresa_data_renovacao'] = explode("/", $payLoad['empresa_data_renovacao']);
     $payLoad['empresa_data_renovacao'] = array_reverse($payLoad['empresa_data_renovacao']);
     $payLoad['empresa_data_renovacao'] = implode("-", $payLoad['empresa_data_renovacao']);
  
    
     $updatebanco->ExeUpdate("ws_empresa", $payLoad, "WHERE user_id = :userid", "userid={$payLoad['user_id']}");
     if($updatebanco->getResult()){
      $res->msg = "Atualizado com sucesso.";
      $res->success = true;
      $res->error = false;
     echo json_encode($res);
     }else{
      $res->msg = "Ocorreu um erro no processamento. Por favor tente novamente";
      $res->success = false;
      $res->error = true;
       echo json_encode($res);
     };
  
    }
    
  }
  }catch (PDOException $e) {
    echo "Ocorreu um erro em sua solicitação. Por favor tentar novamente " . $e->getMessage();
  }
  
 

}
  

  function atualizaStatusCliente($payLoad){

    try{
    global $lerbanco;
    global $updatebanco;
    $res = new stdClass();


    if(!empty($payLoad) && !empty($payLoad['user_id'] && (int)$payLoad['user_id'])){

      $lerbanco->ExeRead("ws_users", "where user_id= :userId", "userId={$payLoad['user_id']}");

      $statusCliente = "";
      $newStatusCliente['user_status'] = 0;
      if($lerbanco->getResult()){
        $statusCliente = $lerbanco->getResult()[0]['user_status'];

        if(!$statusCliente){
          $newStatusCliente['user_status'] = 1;

        }else{
          $newStatusCliente['user_status'] = 0;
        }

        $updatebanco->ExeUpdate('ws_users', $newStatusCliente, "where user_id= :userId","userId={$payLoad['user_id']}");

        if($updatebanco->getResult()){
          $res->msg = "Atualizado com sucesso!";
          $res->success = true;
          $res->error = false;
           echo json_encode($res);
  
        }else{
          $res->msg = "Ocorreu um erro no processamento. Por favor tente novamente";
          $res->success = false;
          $res->error = true;
           echo json_encode($res);
        }
      }else{
        $res->msg = "Ocorreu um erro no processamento. Por favor tente novamente";
        $res->success = false;
        $res->error = true;
         echo json_encode($res);
      }
   

    }else{
      $res->msg = "Ocorreu um erro no processamento. Por favor tente novamente";
      $res->success = false;
      $res->error = true;
       echo json_encode($res);
    }


  
  

}catch (PDOException $e) {
  echo "Ocorreu um erro em sua solicitação. Por favor tentar novamente " . $e->getMessage();
}

}


function atualizaDadosAdmin($payLoad){

try{

    global $lerbanco;
    global $updatebanco;
    $res = new stdClass();
  
    if(!empty($payLoad)){

      $payLoad = array_map('strip_tags', $payLoad);
      $payLoad = array_map('trim', $payLoad);

      if(in_array('', $payLoad) || in_array('null', $payLoad)){
     
      $res->msg = "Preencha todos os campos obrigatórios!";
      $res->success = false;
      $res->error = true;
       echo json_encode($res);
      }elseif(strlen(preg_replace("/[^0-9]/", "", $payLoad['tel_adm'])) < 11){
      
      $res->msg = "O telefone de administração esta em formato inválido!";
      $res->success = false;
      $res->error = true;
       echo json_encode($res);
      
    }elseif(!Check::Email($payLoad['email_suporte'])){
     

      $res->msg = "O email informado e inválido!";
      $res->success = false;
      $res->error = true;
       echo json_encode($res);
    }else{

      $payLoad['tel_adm'] = preg_replace("/[^0-9]/", "", $payLoad['tel_adm']);
       

      $updatebanco->ExeUpdate("configuracoes_site", $payLoad, "WHERE id_config = :up", "up=1");
      if ($updatebanco->getResult()){
        $res->msg = "Atualizado com sucesso!";
        $res->success = true;
        $res->error = false;
         echo json_encode($res);
    }else{
      $res->msg = "Ocorreu um erro no processamento. Por favor tente novamente";
      $res->success = false;
      $res->error = true;
       echo json_encode($res);
      };

    };
  };


}catch (PDOException $e) {
  echo "Ocorreu um erro em sua solicitação. Por favor tentar novamente " . $e->getMessage();
}

}


function atualizaSenhaAdmin($payLoad){


  try{


    global $lerbanco;
    global $updatebanco;
    $res = new stdClass();
  
 

    if(!empty($payLoad)){
      // LIMPA OS CAMPOS RETIRANDO TAGS E ESPAÇOS DESNECESSÁRIOS
      $payLoad = array_map('strip_tags', $payLoad);
      $payLoad = array_map('trim', $payLoad);

      if(in_array('', $payLoad) || in_array('null', $payLoad)){
 
      $res->msg = "Preencha todos os campos obrigatórios";
      $res->success = false;
      $res->error = true;
       echo json_encode($res);
      }elseif ($payLoad['admin_senha'] != $payLoad['r_admin_senha']){
  
      $res->msg = "Senhas não coincidem!";
      $res->success = false;
      $res->error = true;
    }elseif(strlen($payLoad['admin_senha']) <= 7){
 
      $res->msg = "A senha informada deve ter no mínimo 8 caracteres!";
      $res->success = false;
      $res->error = true;
}else{

      unset($payLoad['r_admin_senha']);


      $payLoad['admin_senha'] = md5($payLoad['admin_senha']);
      $updatebanco->ExeUpdate("ws_admin", $payLoad, "WHERE admin_email = :admail", "admail={$_SESSION['administrador']['admin_email']}");
      if ($updatebanco->getResult()){
    
        $res->msg = "Atualizado com sucesso!";
        $res->success = true;
        $res->error = false;
         echo json_encode($res);							
      }else{
        $res->msg = "Ocorreu um erro no processamento. Por favor tente novamente";
        $res->success = false;
        $res->error = true;
         echo json_encode($res);
      };
    };			
  };

  }catch (PDOException $e) {
    echo "Ocorreu um erro em sua solicitação. Por favor tentar novamente " . $e->getMessage();
  }
  

}

function criaTermoCliente($payLoad){


  try{


    global $lerbanco;
    global $updatebanco;
    $res = new stdClass();

    if(!empty($payLoad['termo_cliente'])){

      $updatebanco->ExeUpdate("configuracoes_site", $payLoad, "WHERE id_config = :up", "up=1");
    
      if ($updatebanco->getResult()){
        $res->msg = "Atualizado com sucesso!";
        $res->success = true;
        $res->error = false;
         echo json_encode($res);
    }else{
      $res->msg = "Ocorreu um erro no processamento. Por favor tente novamente";
      $res->success = false;
      $res->error = true;
       echo json_encode($res);
      };

    }else{
        $res->msg = "Ocorreu um erro no processamento. Por favor tente novamente";
        $res->success = false;
        $res->error = true;
         echo json_encode($res);
      };
     


  }catch (PDOException $e) {
    echo "Ocorreu um erro em sua solicitação. Por favor tentar novamente " . $e->getMessage();
  }

}

function carregaTermoCliente(){
  try{


    global $lerbanco;
 
    $res = new stdClass();

    $lerbanco->ExeRead("configuracoes_site");
    if($lerbanco->getResult()){
        $getEmpresa = $lerbanco->getResult();
        $res->data = $getEmpresa[0]['termo_cliente'];
        $res->success = true;
        $res->error = false;
         echo json_encode($res);

    }else{
      $res->msg = "Ocorreu um erro no processamento. Por favor tente novamente";
        $res->success = false;
        $res->error = true;
         echo json_encode($res);
    }
}catch (PDOException $e) {
  echo "Ocorreu um erro em sua solicitação. Por favor tentar novamente " . $e->getMessage();
}


}

$action =  filter_input(INPUT_GET,'action', FILTER_DEFAULT);
$adminObj = filter_input_array(INPUT_POST, FILTER_DEFAULT);
 //Carrega Tabela Admin - GET
  //body - action = al
  if(!empty($action) && (string)$action && $action =='al'){

    carregaTabelaAdmin();

 } 

 if(!empty($action) && (string)$action && $action == "auc" && !empty($adminObj['user_id']) && (int)$adminObj['user_id']){

    alteraSenhaCliente($adminObj);
 }


 if(!empty($action) && (string)$action && $action == "adc" && !empty($adminObj['user_id']) && (int)$adminObj['user_id']){
 
  dadosCliente($adminObj);
}

if(!empty($action) && (string)$action && $action == "adr" && !empty($adminObj['user_id']) && (int)$adminObj['user_id']){
 
  atualizaDataRenovacao($adminObj);
}


if(!empty($action) && (string)$action && $action == "asc" && !empty($adminObj['user_id']) && (int)$adminObj['user_id']){
 
  atualizaStatusCliente($adminObj);
}


if(!empty($action) && (string)$action && $action == "aud" && !empty($adminObj)){
 
  atualizaDadosAdmin($adminObj);
}


if(!empty($action) && (string)$action && $action == "ausa" && !empty($adminObj)){
 
  atualizaSenhaAdmin($adminObj);
}



if(!empty($action) && (string)$action && $action == "aut" && !empty($adminObj)){
 
  criaTermoCliente($adminObj);
}



if(!empty($action) && (string)$action && $action == "agt"){
 
  carregaTermoCliente();
}



ob_end_flush();


?>