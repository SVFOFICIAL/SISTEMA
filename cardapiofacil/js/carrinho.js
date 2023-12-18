 
 
 

(function(){  
 

  const url  = $('body').attr("data-url");

 $(".nav-link").click(function(e){

    e.preventDefault();

    let tipo = $(e.currentTarget).attr('data-tipo');

    if(parseInt(tipo)==0){
        
        if(!$('#delivery').is(':visible')){
            $('#retirada_loja').hide();
            $('#delivery').show();
            $('#delivery').removeClass('tab-link');
            $('#delivery').addClass('tab-link-active')
        
        }else{
            $('#retirada_loja').hide();
            $('#delivery').removeClass('tab-link');
            $('#delivery').addClass('tab-link-active')
            
        }
    }else if(parseInt(tipo)==1){
        if(!$('#retirada_loja').is(':visible')){
            $('#delivery').hide();
            $('#retirada_loja').show();
            $('#retirada_loja').removeClass('tab-link');
            $('#retirada_loja').addClass('tab-link-active')

        }else{
            $('#delivery').hide();
            $('#retirada_loja').removeClass('tab-link');
            $('#retirada_loja').addClass('tab-link-active')
        }
    }

 })
 


})();