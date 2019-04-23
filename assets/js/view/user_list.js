    
    window.onload = hideErrorMessages();

    function hideErrorMessages(){
        $("#error_email").hide();
        $("#error_email2").hide();
        $("#error_email3").hide();
        $("#error_nome").hide();
        $("#error_nome2").hide();
        $("#error_grupo").hide();
        $("#edit_img-error").hide();
        $("#edit-error_email").hide();
        $("#edit-error_email2").hide();
        $("#edit-error_email3").hide();
        $("#error-editarNomeUsuario").hide();
        $("#error-editarNomeUsuario2").hide();
        $("#edit-error_grupo").hide();
        hide_loading();
    }

    $(document).ready( function () {

        //$('#dataTables-user-log').DataTable();
        $('#dataTables-user-list').DataTable({
            "bFilter": true,
            "paging":   false,
            //"iDisplayLength": 20,
            "order": [[ 0, "asc" ]]
            //"bDestroy": true,
        });
     } );

    function editar_usuario_popup(email,id,nome,grupo,edit_img){
        $( "#edit-email" ).val(email);
        $( "#edit-user-id" ).val(id);
        $( "#edit-nome" ).val(nome);
        $( "#edit_img" ).val(edit_img);

        if(grupo=='admin')
            optGrupo = "<option value='admin' selected>Admin</option><option value='user'>User</option>";
        else
        optGrupo = "<option value='admin'>Admin</option><option value='user' selected>User</option>";

        $( "#edit-grupo" ).html(optGrupo);
        $('#editarUsuarioSubmit').attr("onclick","update_usuario("+id+")");
    }

    function deactivate_confirmation(email,id){
        $( "#user-email" ).html(email);
        $('#deactivateYesButton').attr("onclick","deactivate_submit('"+email+"',"+id+")");
    }

    function reset_confirmation(email,id){
        $( "#reset-user-email" ).html(email);
        $('#resetYesButton').attr("onclick","reset_submit('"+email+"',"+id+")");
    }

    function deactivate_submit(email,id){
        show_loading();
            $.ajax({
            url: $("#base-url").val()+"admin/desativar_usuario/"+email+"/"+id,
            cache: false,
            success: function (result) {
                var result = $.parseJSON(result);
                if(result.status=='success'){
                    location.reload();
                }
                else{
                    alert("Oops there is something wrong!");
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
                    alert("Oops there is something wrong!");
                }
            },
            error: ajax_error_handling
        });
    }

    function update_usuario(id){
        hideErrorMessages();
        show_loading();
        var i=0;
        var nome = $('#edit-nome').val().trim();
        var email = $('#edit-email').val().trim();
        var grupo = $('#edit-grupo').val();


        if(nome == ""){
            $("#error-editarNomeUsuario").show();
            i++;
        }
        else if (!nome.match(/^[A-Za-z0-9\s]+$/)) {
            $("#error-editarNomeUsuario2").show();
            i++;
        }

        if(email == ""){
            $("#edit-error_email").show();
            i++;
        }
        else if (!email.match(/^[\w -._]+@[\-0-9a-zA-Z_.]+?\.[a-zA-Z]{2,3}$/)) {
            $("#edit-error_email3").show();
            i++;
        }

        if(grupo == 0){
            $("#edit-error_grupo").show();
            i++;
        }



        if(i == 0){
            $.ajax({
                url: $("#base-url").val()+"admin/update_usuario/",
                traditional: true,
                type: "post",
                dataType: "text",
                data: {email: email, id:id, nome:nome, grupo:grupo},
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
                        alert("Oops there is something wrong!");
                    }
                },
                error: ajax_error_handling
            });
        }
    }






    $( "#newUserSubmit" ).click(function() {
        hideErrorMessages();
        show_loading();
        var i=0;
        var nome = $('#nome').val().trim();
        var email = $('#email').val().trim();
        var grupo = $('#grupo').val();
        var url_img = $('#url_img').val();

        if(nome == ""){
            $("#error_nome").show();
            i++;
        }
        else if (!nome.match(/^[A-Za-z0-9\s]+$/)) {
            $("#error_nome2").show();
            i++;
        }

        if(email == ""){
            $("#error_email").show();
            i++;
        }
        else if (!email.match(/^[\w -._]+@[\-0-9a-zA-Z_.]+?\.[a-zA-Z]{2,3}$/)) {
            $("#error_email3").show();
            i++;
        }

        if(grupo == 0){
            $("#error_grupo").show();
            i++;
        }

        if(i == 0){
            $.ajax({
                url: $("#base-url").val() + "admin/create_usuario",
                traditional: true,
                type: "post",
                dataType: "text",
                data: {email:email, grupo:grupo, nome:nome, url_img:url_img},
                success: function (result) {
                    var result = $.parseJSON(result);
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


