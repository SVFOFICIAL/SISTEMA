 
import {cardapio } from './cardapiofacil.js'



(function(){  
  cardapio.init();


$(window).on('hidden.bs.modal', function(){
    $('body').attr('style', 'overflow: visible !important');
})

$(window).on('shown.bs.modal', function(){
    $('body').attr('style', 'overflow: hidden !important');
})

$('.prod').click(function(e){

    var idProd = $(e.currentTarget).attr('data-iditem');
    
    $('.popuppedido').attr('data-iteidem', idProd);


})
 

$('#cart-modal').on("shown.bs.modal", function(){

    if(cardapio.tableItemsPedido.page.info().recordsDisplay >0){  
        cardapio.ajustCartHeight();
        $('#checkout').css('position', 'sticky');
    }else{
        cardapio.ajustCartHeight();
        $('#checkout').css('position', 'absolute');
    }
    

});

$(".popuppedido").on("show.bs.modal", function(e){
   
   
    $('.input-total').val(0);
    $('.plus').attr('disabled', false);
    var parent = $('.plus').parent();
    $(parent).css('background', "#46DC4C");
    
    let idModal =  $(e.currentTarget).attr('data-iteidem');
    let flagTp = $('#check-tp_'+idModal).attr('data-flagtp');
    let valorItem = $('#valorItem_'+idModal).text();
    console.log(valorItem)
    $('#valorItem_'+idModal).text(parseFloat(valorItem).toFixed(2));
    $('#valorItem_'+idModal).attr('data-valoratual', parseFloat(valorItem).toFixed(2));
    
  
    var resolution = window.matchMedia("(min-height: 830px)");

    if(resolution.matches && flagTp && parseInt(flagTp)==0){ 
       
        $('#popuppedido_'+idModal+' .btn-modal-footer').removeClass('btn-adicionar-item');
        $('#popuppedido_'+idModal+' .btn-modal-footer').addClass('btn-adicionar-item-no-tp');
        $('#popuppedido_'+idModal+' .btn-modal-footer').css('opacity', '1');
   
      
    }else if(!resolution.matches && flagTp && parseInt(flagTp)==0){
        $('#popuppedido_'+idModal+' .btn-modal-footer').removeClass('btn-adicionar-item');
        $('#popuppedido_'+idModal+' .btn-modal-footer').addClass('btn-adicionar-item-no-tp');
        $('#popuppedido_'+idModal+' .btn-modal-footer').css('opacity', '1');
    }

})

$("#limparcarrinho").click(function(){	
   	
    $('#limparcarrinho').prop('disabled', true);

    $.ajax({
        url: 'includes/processalimparcarrinho.php',
        method: 'get',        
        success: function(data){
            var  j = JSON.parse(data);

            if(j.success && !j.error){
                
                $('#limparcarrinho').prop('disabled', false);


                var dt = $('#pedido tbody').children();
              
               
                for(let i=0; i<dt.length;i++){
                    var rowTable = $(dt[i]);
                  
                    rowTable.fadeOut(400, function(e){
                        cardapio.tableItemsPedido.row(rowTable).remove();

                    })

                }

                cardapio.tableItemsPedido.draw();
                $('#limpaCarrinho').hide();
                setTimeout(function(){
                    cardapio.tableItemsPedido.ajax.reload();
                },500)
            
                $('#cart-modal .modal-content').css('height', '100dvh');                
                $('#checkout').css('position', 'absolute');
            }
        }
    });

});




})();