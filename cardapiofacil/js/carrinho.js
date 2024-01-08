 
 
 

(function(){  
 

  const url  = $('body').attr("data-url");

 $(".nav-link").click(function(e){

    e.preventDefault();

    let tipo = $(e.currentTarget).attr('data-tipo');

    if(parseInt(tipo)==0){
        
        if(!$('#delivery').is(':visible')){
            $('#retirada_loja').hide();
            $('#delivery').show();
            $("#tipo_0").parent().removeClass('tab-link');
            $("#tipo_0").parent().addClass('tab-link-active');
            $("#tipo_1").parent().removeClass('tab-link-active');
            $("#tipo_1").parent().addClass('tab-link');
        
        } 
    }else if(parseInt(tipo)==1){
        if(!$('#retirada_loja').is(':visible')){
            $('#delivery').hide();
            $('#retirada_loja').show();
            $("#tipo_0").parent().removeClass('tab-link-active');
            $("#tipo_0").parent().addClass('tab-link');
            $("#tipo_1").parent().removeClass('tab-link');         
            $("#tipo_1").parent().addClass('tab-link-active')

        } 
    }

 })
 


})();