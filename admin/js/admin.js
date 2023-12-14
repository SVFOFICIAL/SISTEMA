"use-strict"
import{ noti } from './notification.js'

export const admin = {


    dateValues : {
        minDate : null,
        maxDate : null
    },


 table_admin :  $('#adminTable').DataTable({
    "dom":'lrtip',
    "bPaginate": false,
    "bLengthChange": false,
    "bFilter": true,
    "bInfo": false,       
    "bAutoWidth": false,
   
    
    "search" : {
        "caseInsensitive": true,
         
    },
    
   
    "language": {          
        "zeroRecords": "Nenhum registro encontrado.",
        "infoEmpty": "Nenhum registro disponível"
    }, 
    
    "ajax" : {
        url : 'controllers/admin.php?action=al'
    },
    "order": [],
    columns: [
        {data:'nomeEmpresa'},       
        {data: 'cidadeEmpresa'},   
        {data: 'totalItems'},
        {data: 'totalPedidos'},
        {data: 'dataRenovacao'},
        {data: 'dataCadastro'},
        {data: 'statusRenovacao'},
        {data: 'disponivel'},
        {data: 'comandos'},
 
    ],
    "drawCallback" : function(settings){ var api = this.api();      $('#count-rows').text(api.rows({page: 'current'}).data().count())},
    createdRow: (row) => {            
            $(row).addClass('border-b text-center');
           
    },
    columnDefs: [
        { orderable: true, targets: 0 },
        { targets: [4], className:"flex justify-center" },
             
    ],
    "searchCols": [
        null,
        null,
        null,
        null,
        null,   
        null,    
        null,    
        {"search" : 'Sim'},
        null,
        
  
    ],

}),


customSearch : () => {
 

   
    $.fn.dataTable.ext.search.push(
        function (settings, data, dataIndex) {
    
            let formatedDateParts = data[5] ? data[5].split('/') : null;
            let dateObj = formatedDateParts ? new Date(formatedDateParts[1]+"/" + formatedDateParts[1] + "/" + formatedDateParts[2]) : null 
             

 
              if (
                (admin.dateValues.minDate == null && admin.dateValues.maxDate == null) ||
                (admin.dateValues.minDate == null && dateObj.getTime() <= admin.dateValues.maxDate ||
                (admin.dateValues.minDate <=dateObj.getTime() && admin.dateValues.maxDate == null)) ||
                (admin.dateValues.minDate <= dateObj.getTime() && dateObj.getTime() <= admin.dateValues.maxDate)
            ) {
              
                return true;
            }
    
            return false;
              
           
    
            });
        },
    
     showCalendar : () =>{
    $("#adminTable" ).on('focus', 'input#datepicker.atualiza_renovacao', function(e){
       $(e.currentTarget).datepicker({
        autoclose: true,
        container: true,
        format: 'dd/mm/yyyy',
        daysOfWeekDisabled: '0,6',
        todayHighlight: true,
        orientation: 'top',         
         }).on('changeDate', function(){             
               
                $(this).trigger('change');               
              
         })
       
    })
},

dadosClienteModal : () => {

    $("#adminTable").on('click', '.altera_senha', function(e){
        
        let idUser = $(e.currentTarget).data('iduser');
        let nomeEmpresa = $(e.currentTarget).data('nomeempresa');
        let url = $(e.currentTarget).data('url');
    
        if(idUser && nomeEmpresa){
            $('.modal-body #updateSenhaCliente').attr("data-iduser", idUser);
            $('.modal-body #updateSenhaCliente').attr("data-nomeempresa", nomeEmpresa);
            $('.modal-body #updateSenhaCliente').attr("data-url", url);
            $(".modal-title").text("Loja: " + nomeEmpresa)
            $("#nome_empresa").text(nomeEmpresa);
            $('#modalSenha').attr('style', "display:flex !important; justify-content: center; align-items: center;height: 100%;width: 100%;")
        } else{
            return;
        }

    })


},

textEditorInit : () => {

    if($("#termo").is(":visible")){

        $('.content').richText();
    
        let url = $('#termoCliente').data('url');    

       
        $.ajax({
            url: url + 'controllers/admin.php?action=agt',
            method: "get",
          
        
            success: function(data){ 
                let j = JSON.parse(data);
        
                if(j.success && !j.error && j.data){
               
                    $('.richText-editor div:first-child').remove();
                    $('.richText-editor').append(j.data); 
                  
                    
                 
                }else if(!j.success & j.error){
                    noti.init(j.error,j.msg);
                   
                 
                 
                }               
                  
              }
            });



       
    }else{
        return;
    }

},

dadosCliente : () => {

    $("#adminTable").on('click', '.dados_cliente', function(e){

        let idUser = $(e.currentTarget).data('iduser');
        
        let url = $(e.currentTarget).data('url');
        
        if(idUser){
            $('#modalDadosCliente').attr('style', "display:flex !important; justify-content: center; align-items: center;height: 100%;width: 100%;")

            $.ajax({
                url: url + 'controllers/admin.php?action=adc',
                method: "post",
                data:  {"user_id": idUser},
    
                success: function(data){ 
                    let j = JSON.parse(data);
                  
                    if(j.success && !j.error){
                        
                         $("input[name='user_name']").val(j.user[0].user_name);               
                         $("input[name='user_lastname']").val(j.user[0].user_lastname); 
                         $("input[name='user_email']").val(j.user[0].user_email); 
                         $("input[name='user_cpf']").val(j.user[0].user_cpf); 
                         $("input[name='user_telefone']").val(j.user[0].user_telefone); 

                        
                         $("input[name='cep_empresa']").val(j.empresa[0].cep_empresa); 
                         $("input[name='end_uf_empresa']").val(j.empresa[0].end_uf_empresa); 
                         $("input[name='cidade_empresa']").val(j.empresa[0].cidade_empresa); 
                         $("input[name='end_bairro_empresa']").val(j.empresa[0].end_bairro_empresa); 
                         $("input[name='end_rua_n_empresa']").val(j.empresa[0].end_rua_n_empresa); 
                         $("input[name='telefone_empresa']").val(j.empresa[0].telefone_empresa); 

                         $("input[name='nome_empresa']").val(j.empresa[0].nome_empresa); 
                         $("input[name='nome_empresa_link']").val(j.empresa[0].nome_empresa_link); 
                         $("input[name='user_nome_plano']").val(j.user[0].user_nome_plano); 
                        
                     
                    }else if(!j.success & j.error){
                        noti.init(j.error,j.msg);
                        admin.table_admin.ajax.reload();   
                     
                    }                            
                   
                }
                }); 
            





 
        } else{
            return;
        }

    })


},

update : ()=>{


    $('#termoCliente').submit(function(e){



        e.preventDefault();
        let url = $(e.currentTarget).data('url');    

       
        $.ajax({
            url: url + 'controllers/admin.php?action=aut',
            method: "post",
            data: $(this).serialize(),
        
            success: function(data){ 
                let j = JSON.parse(data);
        
                if(j.success && !j.error){
                    noti.init(j.error, j.msg);                 
                    setTimeout(function(){
                        
                        window.location.assign(url)},3000);
                 
                }else if(!j.success & j.error){
                    noti.init(j.error,j.msg);
                   
                 
                 
                }               
                  
              }
            });




    })


    $('#adminTable').on('click','.atualiza_cliente', function(e){

        let idUser = $(e.currentTarget).data('iduser');
        let url = $(e.currentTarget).data('url');    
        

        $.ajax({
            url: url + 'controllers/admin.php?action=asc',
            method: "post",
            data: {user_id: idUser},
        
            success: function(data){ 
                let j = JSON.parse(data);
        
                if(j.success && !j.error){
                    noti.init(j.error, j.msg);                 
                    admin.table_admin.ajax.reload();
                 
                }else if(!j.success & j.error){
                    noti.init(j.error,j.msg);
                    admin.table_admin.ajax.reload();
                 
                 
                }               
                  
              }
            });


    })

    $("#updaSenhaAdmin").submit(function(e){

        e.preventDefault();
        let url = $(e.currentTarget).data('url');    

        $.ajax({
            url: url + 'controllers/admin.php?action=ausa',
            method: "post",
            data: $(this).serialize(),
        
            success: function(data){ 
                let j = JSON.parse(data);
        
                if(j.success && !j.error){
                    noti.init(j.error, j.msg);          
                    setTimeout(function(){
                        
                        window.location.assign(url)},3000);
                 
                }else if(!j.success & j.error){
                    noti.init(j.error,j.msg);
                
                 
                 
                }               
                  
              }
            });







    })

    $("#updateDadosAdmin").submit(function(e){

        e.preventDefault();
        let url = $(e.currentTarget).data('url');    

        $.ajax({
            url: url + 'controllers/admin.php?action=aud',
            method: "post",
            data: $(this).serialize(),
        
            success: function(data){ 
                let j = JSON.parse(data);
        
                if(j.success && !j.error){
                    noti.init(j.error, j.msg);                 
                    
                    setTimeout(function(){
                        
                        window.location.assign(url)},3000);
                 
                }else if(!j.success & j.error){
                    noti.init(j.error,j.msg);
                    
                 
                 
                }               
                  
              }
            });







    })


    $('#adminTable').on('change','.atualiza_renovacao', function(e){


        let idUser = $(e.currentTarget).data('iduser');
        let url = $(e.currentTarget).data('url');    
        let dataRenovacao = $(e.currentTarget).val();


        $.ajax({
            url: url + '/controllers/admin.php?action=adr',
            method: "post",
            data: {user_id: idUser, empresa_data_renovacao : dataRenovacao},
        
            success: function(data){ 
                let j = JSON.parse(data);
        
                if(j.success && !j.error){
                    noti.init(j.error, j.msg);                 
                    admin.table_admin.ajax.reload();
                 
                }else if(!j.success & j.error){
                    noti.init(j.error,j.msg);
                    admin.table_admin.ajax.reload();
                 
                 
                }               
                  
              }
            });
     

    })



},

search : () =>{

    admin.dateValues.maxDate = null;
    admin.dateValues.minDate = null;
   
    $('#count-rows').text(admin.table_admin.rows().count());
    $("input#datepicker-to.search_date_to" ).on('focus',  function(e){
 
        $(e.currentTarget).datepicker({
         autoclose: true,
         clearBtn : true,
         format: 'dd/mm/yyyy hh:mm:ss',
         daysOfWeekDisabled: '0,6',
         todayHighlight: true,
            
          }).on('changeDate', function(){             
                
                 $(this).trigger('change');  
                 let formatedDateParts = $(e.currentTarget).val() ? $(e.currentTarget).val().split('/') : null;
                 let dateObj = formatedDateParts ? new Date(formatedDateParts[1]+"/" + formatedDateParts[1] + "/" + formatedDateParts[2]) : null 
             
                 admin.dateValues.maxDate = dateObj ? dateObj.getTime() : null;
                 admin.table_admin.draw(); 
                 $('#count-rows').text(admin.table_admin.rows( {search:'applied'} ).count());
           
                  
                 
                }).keyup(function() {
                    let formatedDateParts = $(e.currentTarget).val() ? $(e.currentTarget).val().split('/') : null;
                    let dateObj = formatedDateParts ? new Date(formatedDateParts[1]+"/" + formatedDateParts[1] + "/" + formatedDateParts[2]) : null 
                
                    admin.dateValues.maxDate = dateObj ? dateObj.getTime() : null;
                    admin.table_admin.draw(); 
                    $('#count-rows').text(admin.table_admin.rows( {search:'applied'} ).count());
                   
                  });
        
     });


    $("input#datepicker-from.search_date_from" ).on('focus',  function(e){
        $(e.currentTarget).datepicker({
         autoclose: true,        
         format: 'd/mm/yyyy',
         clearBtn : true,
         daysOfWeekDisabled: '0,6',
         todayHighlight: true,
          
        
                
          }).on('changeDate', function(){             
                
                 $(this).trigger('change');  
                 let formatedDateParts = $(e.currentTarget).val() ? $(e.currentTarget).val().split('/') : null;
                 let dateObj = formatedDateParts ? new Date(formatedDateParts[1]+"/" + formatedDateParts[1] + "/" + formatedDateParts[2]) : null 
             
                 admin.dateValues.minDate = dateObj ? dateObj.getTime() : null;
                 
              
                 admin.table_admin.draw();
                 $('#count-rows').text(admin.table_admin.rows( {search:'applied'} ).count());

                  
          }).keyup(function() {
          
            let formatedDateParts = $(e.currentTarget).val() ? $(e.currentTarget).val().split('/') : null;
            let dateObj = formatedDateParts ? new Date(formatedDateParts[1]+"/" + formatedDateParts[1] + "/" + formatedDateParts[2]) : null         
            admin.dateValues.minDate = dateObj ? dateObj.getTime() : null;          
            admin.table_admin.draw();
            $('#count-rows').text(admin.table_admin.rows( {search:'applied'} ).count());
          });
        
     })
    $("#search_cliente").off().on("keyup", function(e){


        admin.table_admin.column(0).search(this.value).draw();
        $('#count-rows').text(admin.table_admin.rows( {search:'applied'} ).count());
    })
    $("#datepicker-from").on('change',function(e){
     
        $(".datepicker").hide();
       
    })

    $("#datepicker-to").on('change',function(e){
     
        $(".datepicker").hide();
       
    })


    $("#search_cidade").off().on("keyup",function(e){


        admin.table_admin.column(1).search(this.value).draw();
        $('#count-rows').text(admin.table_admin.rows( {search:'applied'} ).count());
    })

   
   

    $('#clientes_inativos').change( function(){
          
        if(!$(this).is(':checked')){           
           
            admin.table_admin.columns(7).search('Sim').draw();
            $('#count-rows').text(admin.table_admin.rows( {search:'applied'} ).count());
                              
        }else {
           
            //prod.table_prod.column(6).data().filter(function(value, index){ return value == "Não"}.draw())
            admin.table_admin.column(7).search('Não').draw();   
            $('#count-rows').text(admin.table_admin.rows( {search:'applied'} ).count());          
        }                
   })      
},

alteraSenhaCliente : () =>{

    $('#updateSenhaCliente').submit(function(e){


        
        e.preventDefault();

        let idUser = $(this).data('iduser');       
        let url = $(this).data('url');
        
        let senhaAtual = $('input[name="pass"]').val();
        let novaSenha = $('input[name="r_pass"]').val();


      
        $.ajax({
            url: url + '/controllers/admin.php?action=auc',
            method: "post",
            data:  {"user_id": idUser, "pass": senhaAtual, "r_pass" : novaSenha},

            success: function(data){ 
                let j = JSON.parse(data);
               
                if(j.success && !j.error){
                    noti.init(j.error, j.msg);
                    $('#updateSenhaCliente')[0].reset();                   
                    
                    setTimeout(function(){                        
                        $('#modalSenha').modal('hide')},3000);
                    admin.table_admin.ajax.reload();
                 
                }else if(!j.success & j.error){
                    noti.init(j.error,j.msg);
                    admin.table_admin.ajax.reload();   
                 
                }                            
               
            }
            }); 

    })



},

 

    
     
init : () => {
    admin.customSearch();
       admin.showCalendar();
       admin.dadosClienteModal()
       admin.alteraSenhaCliente();
       admin.dadosCliente();
       admin.search();
       admin.update();
       admin.textEditorInit();
      

    },
    fn : () => {
        return admin.init();
    },
     
 








}