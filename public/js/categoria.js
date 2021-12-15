$("#salvarAtivarCategorias").click(function(){
    let myobj = [];
    $( ".toggle input" ).each(function() {
        let checkbox = document.getElementById(this.id);
        if(checkbox.checked) {
            myobj.push({status: "Ativo",id: this.id});
        }else{
            myobj.push({status: "Desativado",id: this.id});
        }
    });
    $.ajax({
        url: window.location,
        type:"POST",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {data : myobj},
        dataType: 'json',
        cache : false,
        beforeSend: function() {
            $("#boxloadingTela").css({'display':'block'});
        },
        success:function(response) {
            if(response.status== true){
                alertSucess(response.mensagem);
            }else{
                preencherPlanilhaCategoria();
                alertDanger(response.mensagem);
            }
            $("#boxloadingTela").css({'display':'none'});
        }
    })
})

$("#formCadastroForm").submit(function(e){
    e.preventDefault();
    if($("#idCategoria").val().length>=4){
        $('#idCategoria').removeClass("is-invalid");
        $.ajax({
            url: window.location+'/salvar',
            type:"POST",
            data: $(this).serialize(),
            dataType: 'json',
            cache : false,
            beforeSend: function() {
                $("#boxloadingTela").css({'display':'block'});
            },
            success:function(response) {
                if(response.status == true){
                    $("#idCategoria").val("");
                    alertSucess(response.mensagem)
                }else{
                    alertDanger(response.mensagem)
                }
                $("#boxloadingTela").css({'display':'none'});
            }
        })
    }else{
        alertDanger("preencha o campo corretamente, ele deve conter mais de 4 caracteres");
        $('#idCategoria').addClass("is-invalid");
    }

})

function preencherPlanilhaCategoria(){
    let rowsPlanilha = "";
    let check = "";
    $.ajax({
        url: window.location+'/atualizar-dados',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: "POST",
        cache: false,
        dataType: "JSON",
        beforeSend: function() {
            $("#boxloadingTela").css({'display':'block'});
        },
        success:function(response) {
            for (let i = 0; i < response.length; i++) {
                contadorJ=i+1;
                if(response[i].status == "Ativo"){
                    rowsPlanilha += '<tr>'+
                                        '<td scope="row">'+contadorJ+'</td>'+
                                        '<td>'+response[i].categoria+'</td>'+
                                        '<td>'+
                                            '<center>'+
                                                '<div class="toggle">'+
                                                    '<input type="checkbox" id="'+response[i].ID+'" checked>'+
                                                    '<label for="'+response[i].ID+'"></label>'+
                                                '</div>'+
                                            '</center>'+
                                        '</td>'+
                                    '</tr>';
                }else{
                     rowsPlanilha +=    '<tr>'+
                                            '<td scope="row">'+contadorJ+'</td>'+
                                            '<td>'+response[i].categoria+'</td>'+
                                            '<td>'+
                                                '<center>'+
                                                    '<div class="toggle">'+
                                                        '<input type="checkbox" id="'+response[i].ID+'">'+
                                                        '<label for="'+response[i].ID+'"></label>'+
                                                    '</div>'+
                                                '</center>'+
                                            '</td>'+
                                        '</tr>';
                }
            }
            $("#planilhaCategoria tbody").html("");
            $("#planilhaCategoria tbody").html(rowsPlanilha);
            $("#boxloadingTela").css({'display':'none'});

        }
    });
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


function preencherCategorias(){
    let rowsPlanilha = "";
    let check = "";
    let url= window.location+'/view/atualizar-dados';

    $.ajax({
        url: url,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: "POST",
        cache: false,
        dataType: "JSON",
        beforeSend: function() {
            $("#boxloadingTela").css({'display':'block'});
        },
        success:function(response) {
            let IdCategoria = [];
            let  contadorJ=0;
            for (let i = 0; i < response.length; i++) {
                IdCategoria.push(response[i].ID);
                contadorJ=i+1;
                if(response[i].status == "Ativo"){
                    rowsPlanilha += '<div class="col-xl-6 col-lg-5 dv_cat_'+response[i].ID+'">'+
                                        '<div class="card shadow mb-4">'+
                                            '<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">'+
                                                '<h6 class="m-0 font-weight-bold h6_t_'+response[i].ID+'">'+response[i].categoria+'</h6>'+
                                                '<input type="hidden" id="hdn_'+response[i].ID+'" value="'+response[i].categoria+' ">'+
                                                '<div class="dropdown no-arrow">'+
                                                    '<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'+
                                                        '<i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>'+
                                                    '</a>'+
                                                    '<div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">'+
                                                        '<div class="dropdown-header">Ações:</div>'+
                                                        '<a class="dropdown-item addUserCategoria clssCursor" onclick="AdicionarUserCategoria('+response[i].ID+')">Adicionar Usuário</a>'+
                                                        '<a class="dropdown-item clssCursor alOnclifunction'+response[i].ID+'" onclick="desativarCategoria('+response[i].ID+')">Desativar</a>'+
                                                        '<a class="dropdown-item clssCursor" onclick="modalExcluirCategoria('+response[i].ID+')">Excluir</a>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+
                                            '<div class="card-body">'+
                                                '<div class=" conteudoBoxCategorias border rounded conteudoBoxCategorias_'+response[i].ID+'">'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>';
                }else{
                    rowsPlanilha += '<div class="col-xl-6 col-lg-5 categoriasDesativadas dv_cat_'+response[i].ID+'">'+
                    '<div class="card shadow mb-4">'+
                        '<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">'+
                            '<h6 class="m-0 font-weight-bold  h6_t_'+response[i].ID+'">'+response[i].categoria+'  (Desativado)</h6>'+
                            '<input type="hidden" id="hdn_'+response[i].ID+'" value="'+response[i].categoria+' ">'+
                            '<div class="dropdown no-arrow">'+
                                '<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'+
                                    '<i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>'+
                                '</a>'+
                                '<div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">'+
                                    '<div class="dropdown-header">Ações:</div>'+
                                    '<a class="dropdown-item addUserCategoria clssCursor" onclick="AdicionarUserCategoria('+response[i].ID+')">Adicionar Usuário</a>'+
                                    '<a class="dropdown-item clssCursor alOnclifunction'+response[i].ID+'" onclick="ativarCategoria('+response[i].ID+')">Ativar</a>'+
                                    '<a class="dropdown-item clssCursor" onclick="modalExcluirCategoria('+response[i].ID+')">Excluir</a>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="card-body">'+
                            '<div class=" conteudoBoxCategorias border rounded conteudoBoxCategorias_'+response[i].ID+'">'+

                            '</div>'+
                        '</div>'+
                    '</div>'+
                '</div>';
                }
            }
            $(".BoxCardCategorias").html("");
            $(".BoxCardCategorias").html(rowsPlanilha);
            $("#boxloadingTela").css({'display':'none'});
            usuariosVincluadosCategoria(IdCategoria);
        }
    });

}

function ativarCategoria(id) {
    $.ajax({
        url: window.location+'/grupo-usuario/mudar-status',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type:"POST",
        data: {status:"Ativo", id:id},
        dataType: 'json',
        cache : false,
        beforeSend: function() {
            $("#boxloadingTela").css({'display':'block'});
        },
        success:function(response) {
            if(response.status == true){
                $(".h6_t_"+id).html($('#hdn_'+id).val());
                $('.dv_cat_'+id).removeClass('categoriasDesativadas');
                $(".alOnclifunction"+id).attr('onclick', 'desativarCategoria('+id+');');
                $(".alOnclifunction"+id).html('Desativar');
                alertSucess(response.mensagem)
            }else{
                alertDanger(response.mensagem)
            }
            $("#boxloadingTela").css({'display':'none'});
        }
    })
}

function desativarCategoria(id) {
    $.ajax({
        url: window.location+'/grupo-usuario/mudar-status',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type:"POST",
        data: {status:"Desativado", id:id},
        dataType: 'json',
        cache : false,
        beforeSend: function() {
            $("#boxloadingTela").css({'display':'block'});
        },
        success:function(response) {
            if(response.status == true){
                $(".h6_t_"+id).html($('#hdn_'+id).val()+'  (Desativado)');
                $('.dv_cat_'+id).addClass('categoriasDesativadas');
                $(".alOnclifunction"+id).attr('onclick', 'ativarCategoria('+id+');');
                $(".alOnclifunction"+id).html('Ativar');
                alertSucess(response.mensagem)
            }else{
                alertDanger(response.mensagem)
            }
            $("#boxloadingTela").css({'display':'none'});
        }
    })
}

function modalExcluirCategoria(id) {
    $("#idDeletar").val(id);
    $("#modalConfirm").modal("show");
}

function excluirCategoria() {
    let id = $("#idDeletar").val();
    $("#modalConfirm").modal("hide");
    $.ajax({
        url: window.location+'/grupo-usuario/excluir',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type:"POST",
        data: {id:id},
        dataType: 'json',
        cache : false,
        beforeSend: function() {
            $("#boxloadingTela").css({'display':'block'});
        },
        success:function(response) {
            if(response.status == true){
                $('.dv_cat_'+id).remove();
                alertSucess(response.mensagem)
            }else{
                alertDanger(response.mensagem)
            }
            $("#boxloadingTela").css({'display':'none'});
        }
    })
}



function usuariosVincluadosCategoria(id) {

    let url= window.location+'/view/atualizar-dados/retornarDadosAll';
    $.ajax({
        url: url,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {condOpcao:'all'},
        type: "POST",
        cache: false,
        dataType: "JSON",
        beforeSend: function() {
            $("#boxloadingTela").css({'display':'block'});
        },
        success:function(response) {
            for (let i = 0; i < id.length; i++) {
                let  contadorJ = 0;
                let html =  '<table class="table">'+
                                '<thead class="thead-dark">'+
                                    '<tr>'+
                                        '<th scope="col">#</th>'+
                                        '<th scope="col">Nome</th>'+
                                        '<th scope="col" style="width:90px;"><center>Ação</center></th>'+
                                    '</tr>'+
                                '</thead>'+
                                '<tbody>';

                    for (let j = 0; j < response.length; j++) {
                       if (response[j].ID_categoria == id[i]) {
                            contadorJ++;
                            html = html+ '<tr class="tr_'+response[j].ID+'">'+
                                            '<th scope="row">'+contadorJ+'</th>'+
                                            '<td>'+response[j].display_name+'</td>'+
                                            '<td><center><i class="fas fa-times" style="cursor: pointer;" onclick="removerUserCategoria('+response[j].ID+')"></i></center></td>'+
                                        '</tr>';
                       }
                    }

                    html=html+  '</tbody>'+
                                    '</table>';
                $('.conteudoBoxCategorias_'+id[i]).html(html);
            }

        $("#boxloadingTela").css({'display':'none'});
        }
    });

}

//remover o usuario da categoria
function removerUserCategoria(id) {

    let url= window.location+'/grupo-usuario/view';
    $.ajax({
        url: url,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {id:id},
        type: "POST",
        cache: false,
        dataType: "JSON",
        beforeSend: function() {
            $("#boxloadingTela").css({'display':'block'});
        },
        success:function(response) {
            if(response.status == true){
                $('.tr_'+id).remove();
                alertSucess(response.Mensagem);
            }else{
                alertDanger(response.Mensagem);
            }
        $("#boxloadingTela").css({'display':'none'});
        }
    });

}

function AdicionarUserCategoria(id){
    let url= window.location+'/grupo-usuario/view/users';
    $.ajax({
        url: url,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {id:id},
        type: "POST",
        cache: false,
        dataType: "JSON",
        beforeSend: function() {
            $("#boxloadingTela").css({'display':'block'});
        },
        success:function(response) {
            let html = '<div class="row"> <input type="hidden" name="ctgid" value="'+id+'">';
            for (let i = 0; i < response.length; i++) {
                html +='<div class="col-6">'+
                            '<input type="checkbox" id="'+response[i].ID+'" name="ckb_" value="'+response[i].ID+'">&emsp;'+
                                response[i].display_name
                        +'</div>';
            }

            html+='</div>';
            $('.bodyModalUsuariosCategorias').html(html);
            $('#modalUsuariosCategorias').modal('show');

        $("#boxloadingTela").css({'display':'none'});
        }
    });
}

function AdicionarUserCategoria(id){
    let url= window.location+'/grupo-usuario/view/users';
    $.ajax({
        url: url,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {id:id},
        type: "POST",
        cache: false,
        dataType: "JSON",
        beforeSend: function() {
            $("#boxloadingTela").css({'display':'block'});
        },
        success:function(response) {
            let html = '<div class="row"> <input type="hidden" name="ctgid" value="'+id+'">';
            for (let i = 0; i < response.length; i++) {
                html +='<div class="col-6">'+
                            '<input type="checkbox" id="'+response[i].ID+'" name="ckb_" value="'+response[i].ID+'">&emsp;'+
                                response[i].display_name
                        +'</div>';
            }

            html+='</div>';
            $('.bodyModalUsuariosCategorias').html(html);
            $('#modalUsuariosCategorias').modal('show');

        $("#boxloadingTela").css({'display':'none'});
        }
    });
}

$(".formModalUsuariosCategorias").submit(function(e) {
    e.preventDefault();

    if($("input[name=ckb_]").is(':checked')){
        let arryCheked = [];

        $( "input[name=ckb_]" ).each(function() {
            let checkbox = document.getElementById(this.id);
            if(checkbox.checked) {
                arryCheked.push(this.id);
            }
        });

        $.ajax({
            url: window.location+'/grupo-usuario/salvar/usuarioCategoria',
            type:"POST",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {data:arryCheked,ctgid:$("input[name=ctgid]").val()},
            dataType: 'json',
            cache : false,
            beforeSend: function() {
                $("#boxloadingTela").css({'display':'block'});
            },
            success:function(response) {
                if(response.status == true){
                    let  contadorJ = 0;
                    let html =  '<table class="table">'+
                                    '<thead class="thead-dark">'+
                                        '<tr>'+
                                            '<th scope="col">#</th>'+
                                            '<th scope="col">Nome</th>'+
                                            '<th scope="col" style="width:90px;"><center>Ação</center></th>'+
                                        '</tr>'+
                                    '</thead>'+
                                    '<tbody>';

                        for (let j = 0; j < response.usuarios.length; j++) {
                            contadorJ++;
                            html = html+ '<tr class="tr_'+response.usuarios[j].ID+'">'+
                                            '<th scope="row">'+contadorJ+'</th>'+
                                            '<td>'+response.usuarios[j].display_name+'</td>'+
                                            '<td><center><i class="fas fa-times" style="cursor: pointer;" onclick="removerUserCategoria('+response.usuarios[j].ID+')"></i></center></td>'+
                                        '</tr>';
                        }

                    html=html+  '</tbody>'+
                                '</table>';
                    $('.conteudoBoxCategorias_'+$("input[name=ctgid]").val()).html(html);
                    alertSucess(response.Mensagem);
                }else{
                    alertDanger(response.Mensagem);
                }
                $('#modalUsuariosCategorias').modal('hide');
                $("#boxloadingTela").css({'display':'none'});
            }
        })
    }
});

$(".btnVGD").click(function(e) {
    e.preventDefault();
    $('.btnVGD').removeClass('d-sm-inline-block');
    $('.btnNVGD').addClass('d-sm-inline-block');
    $('.categoriasDesativadas').css({'display':'block'});
})
$(".btnNVGD").click(function(e) {
    e.preventDefault();
    $('.btnVGD').addClass('d-sm-inline-block');
    $('.btnNVGD').removeClass('d-sm-inline-block');
    $('.categoriasDesativadas, .btnNVGD').css({'display':'none'});
})
$('.btnModalAdicionar').click(function(e) {
    e.preventDefault();
    $('#modalCriarCategoria').modal('show');
})

$(".formModalCriarCategoria").submit(function(e){
    e.preventDefault();
    if($("#idCategoria").val().length>=4){
        $('#idCategoria').removeClass("is-invalid");
        $.ajax({
            url: window.location+'/grupo-usuario/cadastro/salvar',
            type:"POST",
            data: $(this).serialize(),
            dataType: 'json',
            cache : false,
            beforeSend: function() {
                $("#boxloadingTela").css({'display':'block'});
            },
            success:function(response) {
                if(response.status == true){
                    $('#modalCriarCategoria').modal('hide');
                    $("#idCategoria").val("");
                    alertSucess(response.mensagem)
                }else{
                    alertDanger(response.mensagem)
                }
                $("#boxloadingTela").css({'display':'none'});
                preencherCategorias();
            }
        })
    }else{
        alertDanger("preencha o campo corretamente, ele deve conter mais de 4 caracteres");
        $('#idCategoria').addClass("is-invalid");
    }

})
