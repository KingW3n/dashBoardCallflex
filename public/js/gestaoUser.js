function AdicionarAdminAbrirModal(id) {
    $("#modalConfirmacao").modal("show");
    $("#IdUserModal").val(id);
}

function AdicionarAdmin() {
    $("#modalConfirmacao").modal("hide");
    let id = $("#IdUserModal").val();
    $.ajax({
        url:window.location+"/atribuir-admin-user",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type:"post",
        data: "id="+id,
        dataType: 'json',
        cache : false,
        processData: false,
        beforeSend: function() {
            $("#boxloadingTela").css({'display':'block'});
        },
        success:function(response) {
            $("#boxloadingTela").css({'display':'none'});
            if(response.status== true){
                alertSucess(response.mensagem);
                $(".op_Menu"+id).attr('onclick', 'RemoverAdmin('+id+');');
                $(".op_Menu"+id).css({'color':"green"});
                $(".op_Menu"+id).css({'border':"2px solid green"});
            }else{
                preencherPlanilhaCategoria();
                alertDanger(response.mensagem);
            }
            $("#boxloadingTela").css({'display':'none'});
        }
    })
}

function RemoverAdminAbrirModal(id) {
    $("#modalConfirmacaoRemover").modal("show");
    $("#IdUserModalRemover").val(id);
}
function RemoverAdmin() {
    $("#modalConfirmacaoRemover").modal("hide");
    let id = $("#IdUserModalRemover").val();
    $.ajax({
        url:window.location+"/remover-admin-user",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type:"post",
        data: "id="+id,
        dataType: 'json',
        cache : false,
        processData: false,
        beforeSend: function() {
            $("#boxloadingTela").css({'display':'block'});
        },
        success:function(response) {
            if(response.status== true){
                alertSucess(response.mensagem);
                $(".op_Menu"+id).attr('onclick', 'AdicionarAdmin('+id+');');
                $(".op_Menu"+id).css({'color':"red"});
                $(".op_Menu"+id).css({'border':"2px solid red"});
            }else{
                preencherPlanilhaCategoria();
                alertDanger(response.mensagem);
            }
            $("#boxloadingTela").css({'display':'none'});
        }
    })
}
function removerUserModal(id) {
    $("#modalConfirmacaoExcluirUser").modal("show");
    $("#IdUserModalRemoverAcesso").val(id);
}
function removerUser() {
    $("#modalConfirmacaoExcluirUser").modal("hide");
    let id = $("#IdUserModalRemoverAcesso").val();
    $.ajax({
        url:window.location+"/remover-acesso-user",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type:"post",
        data: "id="+id,
        dataType: 'json',
        cache : false,
        processData: false,
        beforeSend: function() {
            $("#boxloadingTela").css({'display':'block'});
        },
        success:function(response) {
            if(response.status== true){
                alertSucess(response.mensagem);
                $('.tr_'+id).remove();
            }else{
                preencherPlanilhaCategoria();
                alertDanger(response.mensagem);
            }
            $("#boxloadingTela").css({'display':'none'});
        }
    })
}

function alertDanger(mensagem) {
    $('.alert-danger p').html(mensagem);
        $('.alert-danger').css({'display':'block'});
    setTimeout(function(){
        $('.alert-danger p').html('');
        $('.alert-danger').css({'display':'none'});
    },4000)
}
function alertSucess(mensagem) {
    $('.alert-success p').html(mensagem);
        $('.alert-success').css({'display':'block'});
    setTimeout(function(){
        $('.alert-success p').html('');
        $('.alert-success').css({'display':'none'});
    },4000)
}

