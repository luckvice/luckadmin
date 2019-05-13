    
    window.onload = escondeErrorMessages();

    function escondeErrorMessages(){
        $("#error-edit-jogo").hide();
        $("#error-edit-jogo2").hide();
        $("#edit-error_desenvolvedora").hide();
        $("#edit-error_publishers").hide();
        $("#edit-error_plataformas").hide();
        $("#edit-error_email").hide();
        $("#edit-error_email2").hide();
        $("#edit-error_email3").hide();

        $("#error-new-jogo").hide();
        $("#error-new-jogo2").hide();
        $("#new-error_desenvolvedora").hide();
        $("#new-error_publishers").hide();
        $("#new-error_plataformas").hide();
        $("#new-error_email").hide();
        $("#new-error_email2").hide();
        $("#new-error_email3").hide();
        hide_loading();
    }

    $(document).ready( function () {

        //$('#dataTables-user-log').DataTable();
        $('#dataTables-games-list').DataTable({
            "bFilter": true,
            "paging":   false,
            //"iDisplayLength": 20,
            "order": [[ 0, "asc" ]]
            //"bDestroy": true,
        });
     } );

    function editar_jogo_popup(id, jogo, plataforma, desenvolvedor, dev_id, publisher, ps_id, plataforma, p_id,){
        $( "#ejogo-id" ).val(id);
        $( "#ejogo" ).val(jogo);
        $( "#edesenvolvedora" ).val(desenvolvedor);
        $( "#dev_id" ).val(dev_id);
        $( "#eplataforma" ).val(plataforma);
        $( "#epublisher" ).val(publisher);

    
        desenvolvedora = "<option value='"+dev_id+"' selected>"+desenvolvedor+" Selecionado</option>";
        $( "#edesenvolvedora" ).empty;
        $( "#edesenvolvedora" ).append(desenvolvedora);
        $('#editarJogoSubmit').attr("onclick","update_jogo("+id+")");
    }

    function desativaGame(jogo,id){
        $( "#jogo-mensagem" ).html(jogo);
        $('#deactivateYesButton').attr("onclick","desativaGameSubmit('"+jogo+"',"+id+")");
    }

    //Não deleta jogo somente desativa
    function desativaGameSubmit(jogo,id){
        show_loading();
            $.ajax({
            url: $("#base-url").val()+"admin/desativarGame/"+jogo+"/"+id,
            cache: false,
            success: function (result) {
                var result = $.parseJSON(result);
                if(result.status=='success'){
                    location.reload();
                }
                else{
                    alert("Ocorreu um erro!");
                }
            },
            error: ajax_error_handling
        });
    }

    function reset_submit(email,id){
        show_loading();
            $.ajax({
            url: $("#base-url").val()+"admin/reset_senha/"+email+"/"+id,
            cache: false,
            success: function (result) {
                var result = $.parseJSON(result);
                if(result.status=='success'){
                    location.reload();
                }
                else{
                    alert("Ocorreu um erro!");
                }
            },
            error: ajax_error_handling
        });
    }

    function update_jogo(id){
        escondeErrorMessages();
        show_loading();
        var i=0;
        var ejogo = $('#ejogo').val();
        var edesenvolvedora = $('#edesenvolvedora').val();
        var eplataforma = $('#epublishers').val();
        var epublishers = $('#epublishers').val();


       
        if(i == 0){
            $.ajax({
                url: $("#base-url").val()+"admin/update_jogo/",
                traditional: true,
                type: "post",
                dataType: "text",
                data: {ejogo: ejogo, edesenvolvedora:edesenvolvedora, eplataforma:eplataforma, epublishers:epublishers},
                success: function (result) {
                    var result = $.parseJSON(result);
                    if(result.status=='success'){
                        location.reload();
                    }
                    else if(result.status=='exist'){
                        $("#edit-error_email2").show();
                        hide_loading();
                    }
                    else{
                        alert("Ocorreu um erro!");
                    }
                },
                error: ajax_error_handling
            });
        }
    }






    $( "#newGameSubmit" ).click(function() {
        escondeErrorMessages();
        show_loading();
       var i=0;
       var njogo = $('#njogo').val();
       var new_desenvolvedora = $('#new_desenvolvedora').val();
       var new_plataformas = $('#new_plataformas').val();
       var new_publishers = $('#new_publishers').val();
       //var status = 1;
       
    
        if(i == 0){
            $.ajax({
                url: $("#base-url").val() + "admin/novo_jogo",
                traditional: true,
                type: "post",
                dataType: "text",
                data: {njogo: njogo, new_desenvolvedora:new_desenvolvedora, new_plataformas:new_plataformas, new_publishers:new_publishers},
                success: function (result) {
                    var result = $.parseJSON(result);
                    console.log(result);
                    if(result.status=='success'){
                        location.reload();
                    }
                    else if(result.status=='exist'){
                        $("#error_email2").show();
                        hide_loading();
                    }
                    else{
                        alert("Ocorreu um erro!");
                    }
                  
                },
                error: ajax_error_handling
            });
        }else{
            hide_loading();
        }
            
    });


