'use-strict';

const url  = $('body').attr("data-url");

 export const cardapio = {

    

        tableItemsPedido: 
            
            $('#pedido').DataTable({
                    "dom":'Blrtip',
                    "bPaginate": false,
                    "bLengthChange": false,
                    "bFilter": true,
                    "bInfo": false,    
                    
                    "bAutoWidth": false,
                    
                    "search" : {
                        "caseInsensitive": true,
                            
                    },
                    
                    
                    "language": {          
                        "zeroRecords": "<div id=div-img-fome><figure><img id=img-fome src='img/imgfome.png' title=img-fome alt=img-fome /></figure></div>",
                        "infoEmpty": "<div id=div-img-fome><figure><img id=img-fome src='img/imgfome.png' title=img-fome alt=img-fome /></figure></div>"
                    }, 
                    
                    "ajax" : {
                        url :url+'includes/getItensCarrinho.php'
                    },
                    "order": [],
                    columns: [
                        {data:'item'}, 
                      
                        
                            
                
                
                    ],
                    createdRow: (row) => {            
                            $(row).addClass('text-center');
                    },
                    columnDefs: [
                        { orderable: true, targets: 0 },
                        
                    ],
                   

       
       }),

  

       delete : () => {

        $('#pedido').on('click', '.remove_item', function(e){

            let id = $(e.currentTarget).attr('data-id');
            let hashItem = $(e.currentTarget).attr('data-item_hash');
            let idCart = $(e.currentTarget).attr('data-idcart');
            let idItem = $(e.currentTarget).attr('data-iditem');
            let url = $(e.currentTarget).attr('data-url')

          
                $(e.currentTarget).prop('disabled', true);

             

                $.ajax({
                    url: url + 'includes/processaremovercart.php',
                    method: 'post',
                    data: {'iditem':idItem,'itemhash':hashItem, 'id' : id, 'idcart': idCart},

                    success: function(data){
                        var j = JSON.parse(data);

                        if(j.success && !j.error){
                             var row =  $(e.currentTarget).parents('tr');
                          
                            row.fadeOut(400, function(e){

                                cardapio.tableItemsPedido.row(row).remove().draw()

                            })                           
                            cardapio.ajustCartHeight();           
                        }
                       

                    }
                });
            
        });






 




       },


       ajustCartHeight : () => {
        
        let modalContentHeight = $("#cart-modal .modal-content").height();
        let cartBoxHeight = $('.theiaStickySidebar').height();
        let viewPort = $(window).height();
        
        if(cartBoxHeight > modalContentHeight){       
            $('#cart-modal .modal-content').css('height', cartBoxHeight);

        }else if(cartBoxHeight < viewPort){           
            $('#cart-modal .modal-content').css('height', '100dvh');
        }       
       },

       loadTable : () => {

        cardapio.tableItemsPedido.on('draw', function (data) {
                  
            if(cardapio.tableItemsPedido.page.info().recordsDisplay >0){                        
                cardapio.getTotalCarrinho();
           
             
                $('#limpaCarrinho').show();
            }else if (cardapio.tableItemsPedido.page.info().recordsDisplay ==0){
                cardapio.getTotalCarrinho();
                
                $('#limpaCarrinho').hide();
            } 
        });
       },

       adicionaQuantidadeProd : () =>{

        $('#pedido').on('click', '.btn-number_qt_prod-cart', function(e){

          
            e.preventDefault();
            let idItem = $(e.currentTarget).attr('data-iditem');
            let idCart = $(e.currentTarget).attr('data-idcart');
            let idItemCart = $(e.currentTarget).attr('data-id');
            let url = $(e.currentTarget).attr('data-url');
            let item_hash = $(e.currentTarget).attr('data-item_hash');
            var inputQt = $(`input[name="quantidade-cart_${idItem}"]`);
        
            var qtCurrent = parseInt($(inputQt).val());
            let typeAction = $(e.currentTarget).attr('data-type');
            if (!isNaN(qtCurrent)) {
                        if(typeAction == 'plus'){               
                            qtCurrent = qtCurrent +1 
                         
                            $(inputQt).val(qtCurrent).change();          
                           

                        }else if(typeAction=='minus'){
                                qtCurrent =  inputQt.val()==1 ? 1 : qtCurrent -1 
                                inputQt.val(qtCurrent).change();
                                
                            }
            }else{
                inputQt.val(0)
            }
                    $.ajax({
                        url: url + 'includes/adicionaQuantidadeProd.php',
                        method: 'post',
                        data: {'iditem':idItem,'itemhash':item_hash, 'type': typeAction, 'id' : idItemCart, qtItem: inputQt.val(),'idcart': idCart},

                        success: function(data){
                        var j = JSON.parse(data);
                        
                            if(j.success && !j.error){                       
                                
                                cardapio.tableItemsPedido.ajax.reload();               
                                cardapio.ajustCartHeight();           
                            }
                        

                        }
                    });
                
        })


       },

       getTotalCarrinho  : () => {


        let userId = $('#totalizador').attr('data-userid');
        $.ajax({
            url: url+'includes/getTotalCart.php?id='+userId,
            method: "get",
      

            success: function(data){	
                var j = JSON.parse(data);                
                if(j.success && !j.error){     
                     if(parseInt(j.total_carrinho)== 0){
                        
                        $('#pagar').css('background', '#C9C9C9');
                        $('#text-checkout').text('Pedido Mínimo');
                        $('#checkout-btn').prop('disabled', true);
                        $('#total_carrinho').text(parseFloat(j.valor_minimo).toFixed(2));
                        $('#total_pedido').text(parseFloat(j.total_carrinho).toFixed(2));
                    }else if(parseFloat(j.total_carrinho) < parseFloat(j.valor_minimo)){                      
                        $('#total_pedido').text(parseFloat(j.total_carrinho).toFixed(2));
                        $('#pagar').css('background', '#C9C9C9');
                        $('#checkout-btn').prop('disabled', true);
                        $('#text-checkout').text('Pedido Mínimo');
                        $('#total_carrinho').text(parseFloat(j.valor_minimo).toFixed(2));
                    }else{
                        
                        $('#pagar').css('background', '#46DC4C');
                        $('#text-checkout').text('Pagar');
                        $('#checkout-btn').prop('disabled', false);
                        $('#total_pedido').text(parseFloat(j.total_carrinho).toFixed(2));
                        $('#total_carrinho').text(parseFloat(j.total_carrinho).toFixed(2));
                         
                    }

                
                   
                }
                
            }
        });

    
 


     },
     
     

    carregaItemsPedidos : () =>{
 

        
   
        
            $("#cart-modal").on("show.bs.modal" , function(){
               
            
                cardapio.tableItemsPedido.ajax.reload();
             
             
        })

 
     
    
      
       
        
    },


    init : () =>{


        cardapio.carregaItemsPedidos();
        cardapio.delete();
        cardapio.loadTable();
        cardapio.adicionaQuantidadeProd();
    },

    fn : () =>{
        return init();
    }
 }