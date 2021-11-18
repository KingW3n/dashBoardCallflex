

$(".iconView, .divFiltroPorMes, .divFiltroPorAno, .divFiltroPorPeriodo").css({"display":'none'});

//submitForm
$('.formFiltroDashboard').submit(function (e) {
    $("#BoxTable_oneC, #BoxTable_twoC, #BoxTable_threeC, #BoxTable_fourC, #BoxTable_fiveC, #BoxTable_sixC,.btnExport").html('');
    $("#BoxTable_one, #BoxTable_two, #BoxTable_three, #BoxTable_four, #BoxTable_five, #BoxTable_six").css({'display':"none"});
    e.preventDefault();
    if(verificarFiltro()){
        let lbUrl = $('.FiltroURL').val();
        $.ajax({
            url:lbUrl,
            type:"post",
            data: $(this).serialize(),
            dataType: 'json',
            cache : false,
            processData: false,
            beforeSend: function() {
                $("#boxloadingTela").css({'display':'block'});
            },
            success:function(response) {
                $("#boxloadingTela").css({'display':'none'});
                $('.divUsuariosCadastrados').html(response.users);
                $('.divInscriçãoCursos').html(response.subscribe_course);
                $('.divCertificadosCursos').html(response.student_certificate);
                $('.divCursosPublicados').html(response.Cursos_ativos);
                $('.divAcessosaoSistema').html(response.Acessos);
                atualizardadosChart(response.subscribe_course, response.student_certificate, response.Cursos_ativos, response.Cursos_desativados);
                $('#modalFiltroDashboard').modal('hide');
            }
        })
    }else{
        alertDanger("Verifique os campos e tente novamente!");
    }

})

//select ação quando escolhe o tempo de exebição
$('#SelectFiltrotempo').change(function() {
    $("#SelectFiltroMes, #SelectFiltroMesAno, #SelectFiltroAno, #dataInicioBusca, #dataFimBusca").val("");
    switch ($(this).val()) {
        case 'PM':
            $(".divFiltroPorMes").css({'display':'block'});
            $(".divFiltroPorAno, .divFiltroPorPeriodo").css({'display':'none'});
        break;
        case 'PA':
            $(".divFiltroPorAno").css({'display':'block'});
            $(".divFiltroPorMes, .divFiltroPorPeriodo").css({'display':'none'});
        break;
        case 'PL':
            $(".divFiltroPorPeriodo").css({'display':'block'});
            $(".divFiltroPorMes, .divFiltroPorAno").css({'display':'none'});
        break;
        default:
            $(".divFiltroPorMes, .divFiltroPorAno, .divFiltroPorPeriodo").css({'display':'none'});
            $("#SelectFiltroMes, #SelectFiltroMesAno, #SelectFiltroAno, #dataInicioBusca, #dataFimBusca").val("");
        break;
    }

})

$('.viewTable').click(function (e) {
    e.preventDefault();

    var largura = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
    let bydiv,bydivT,bydivC;
    var currentLocation = window.location;
    let html = '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"><thead><tr>';
    $("#BoxTable_oneC, #BoxTable_twoC, #BoxTable_threeC, #BoxTable_fourC, #BoxTable_fiveC, #BoxTable_sixC,.btnExport").html('');
    $("#BoxTable_one, #BoxTable_two, #BoxTable_three, #BoxTable_four, #BoxTable_five, #BoxTable_six").css({'display':"none"});

    switch ($(this).attr("name")) {
        case 'viewUsuarioCadastrados':
            //define a div onde sera exibida a tabela
            if(largura>1199){
                bydiv = document.getElementById("BoxTable_three");
                bydivC = document.getElementById("BoxTable_threeC");
                bydivT = document.getElementById("BoxTable_threeT");
            }else if(largura>767){
                bydiv = document.getElementById("BoxTable_two");
                bydivC = document.getElementById("BoxTable_twoC");
                bydivT = document.getElementById("BoxTable_twoT");
            }else{
                bydiv = document.getElementById("BoxTable_one");
                bydivC = document.getElementById("BoxTable_oneC");
                bydivT = document.getElementById("BoxTable_oneT");
            }
            html = html+tableViewUsuariosCadastrados(currentLocation);
            $(bydivC).html(html);
            $(bydivT).html('Usuarios Cadastrados');
            $(bydiv).css({'display':'block'});
            configurarTable();
        break;
        case 'viewInscricoesEmCurso':
            //define a div onde sera exibida a tabela
            if(largura>1199){
                bydiv = document.getElementById("BoxTable_three");
                bydivC = document.getElementById("BoxTable_threeC");
                bydivT = document.getElementById("BoxTable_threeT");
            }else{
                bydiv = document.getElementById("BoxTable_two");
                bydivC = document.getElementById("BoxTable_twoC");
                bydivT = document.getElementById("BoxTable_twoT");
            }
            html = html+tableViewInscricoesEmCurso(currentLocation);
            $(bydivC).html(html);
            $(bydivT).html('Usuarios Cadastrados');
            $(bydiv).css({'display':'block'});
            configurarTable();
        break;
        case 'viewCertificadosEmitidos':
            //define a div onde sera exibida a tabela
            bydiv = document.getElementById("BoxTable_three");
            bydivC = document.getElementById("BoxTable_threeC");
            bydivT = document.getElementById("BoxTable_threeT");
            html = html+tableViewCertificaosEmCurso(currentLocation);
            $(bydivC).html(html);
            $(bydivT).html('Usuarios Cadastrados');
            $(bydiv).css({'display':'block'});
            configurarTable();
        break;
        case 'viewCursospublicados':
            //define a div onde sera exibida a tabela
            if(largura>1199){
                bydiv = document.getElementById("BoxTable_six");
                bydivC = document.getElementById("BoxTable_sixC");
                bydivT = document.getElementById("BoxTable_sixT");
            }else if(largura>767){
                bydiv = document.getElementById("BoxTable_five");
                bydivC = document.getElementById("BoxTable_fiveC");
                bydivT = document.getElementById("BoxTable_fiveT");
            }else{
                bydiv = document.getElementById("BoxTable_four");
                bydivC = document.getElementById("BoxTable_fourC");
                bydivT = document.getElementById("BoxTable_fourT");
            }
            html = html+tableViewCursosPublicados(currentLocation);
            $(bydivC).html(html);
            $(bydivT).html('Usuarios Cadastrados');
            $(bydiv).css({'display':'block'});
            configurarTable();
        break;
        case 'viewAcessoTotal':
            //define a div onde sera exibida a tabela
            if(largura>1199){
                bydiv = document.getElementById("BoxTable_six");
                bydivC = document.getElementById("BoxTable_sixC");
                bydivT = document.getElementById("BoxTable_sixT");
            }else{
                bydiv = document.getElementById("BoxTable_five");
                bydivC = document.getElementById("BoxTable_fiveC");
                bydivT = document.getElementById("BoxTable_fiveT");
            }
            html = html+tableViewAcessoTotal(currentLocation);
            $(bydivC).html(html);
            $(bydivT).html('Usuarios Cadastrados');
            $(bydiv).css({'display':'block'});
            configurarTable();
        break;
        case 'viewAcessoHoje':
            //define a div onde sera exibida a tabela
            bydiv = document.getElementById("BoxTable_six");
            bydivC = document.getElementById("BoxTable_sixC");
            bydivT = document.getElementById("BoxTable_sixT");
            html = html+tableViewAcessoHoje(currentLocation);
            $(bydivC).html(html);
            $(bydivT).html('Usuarios Cadastrados');
            $(bydiv).css({'display':'block'});
            configurarTable();
        break;

    }


})

//Preencher os dados iniciais
function DadosIniciais(inscricoes,  certificado,cursosPublicados,cursosDespublicados,timelineAcessos,arrayAnos, arrayAcessos){
    let numeroInscricoes = parseInt(inscricoes);
    let numeroCertificado = parseInt(certificado);
    let cursosIniciados = numeroInscricoes-numeroCertificado;

    //verifica se o numero é negativo para evitar erros
    if(cursosIniciados<=0){    cursosIniciados = 0;   }

    //preenche o chart Cusos concluidos/pendentes
    instanciarChart("PieChartCursos","Concluidos","Cursos Pendentes",numeroCertificado,cursosIniciados,"#4e73df","#1cc88a","#2e59d9","#17a673");

    //cursos pubicados/despublicados
    instanciarChart("PieChartCursosPublicados","Cursos Publicados","Cursos Despublicados",cursosPublicados,cursosDespublicados,"#4e73df","#1cc88a","#2e59d9","#17a673");

    //preenche Time Line Acessos
    areaChart("AreaTimeLineDoAno",new Date().getFullYear(),timelineAcessos[0],timelineAcessos[1], timelineAcessos[2], timelineAcessos[3],timelineAcessos[4], timelineAcessos[5]);

    areaChart5Year("Area5Ano",new Date().getFullYear(),arrayAnos, arrayAcessos);

    $('.CardDashboard').hover(function() {
        $("#"+this.id+" .iconView").css({"display":'block'});
    },function () {
        $("#"+this.id+" .iconView").css({"display":'none'});
    })
}

//Atualizar os charts.
function atualizardadosChart(inscricoes,  certificado,cursosPublicados,cursosDespublicados) {
    let numeroInscricoes = parseInt(inscricoes);
    let numeroCertificado = parseInt(certificado);
    let cursosIniciados = numeroInscricoes-numeroCertificado;

    //verifica se o numero é negativo para evitar erros
    if(cursosIniciados<=0){    cursosIniciados = 0;   }

    //preenche o chart Cusos concluidos/pendentes
    instanciarChart("PieChartCursos","Concluidos","Cursos Pendentes",numeroCertificado,cursosIniciados,"#4e73df","#1cc88a","#2e59d9","#17a673");

    //cursos pubicados/despublicados
    instanciarChart("PieChartCursosPublicados","Cursos Publicados","Cursos Despublicados",cursosPublicados,cursosDespublicados,"#4e73df","#1cc88a","#2e59d9","#17a673");
}

function verificarFiltro() {
    let resposta = true;
    switch ($('#SelectFiltrotempo').val()) {
        case 'PM':
            $('#SelectFiltroMes , #SelectFiltroMesAno , #SelectFiltroAno,#dataInicioBusca,#dataFimBusca').removeClass('is-invalid');
            if($("#SelectFiltroMes").val() == "" ||$("#SelectFiltroMes").val() == null || $("#SelectFiltroMesAno").val() == "" || $("#SelectFiltroMesAno").val() == null){
                if($("#SelectFiltroMes").val() == "" ||$("#SelectFiltroMes").val() == null){
                    $("#SelectFiltroMes").addClass('is-invalid');
                }if($("#SelectFiltroMesAno").val() == "" || $("#SelectFiltroMesAno").val() == null){
                    $("#SelectFiltroMesAno").addClass('is-invalid');
                }
                return false;
            }
            $("#SelectFiltroAno,#dataInicioBusca,#dataFimBusca").val("");
        break;
        case 'PA':
            $('#SelectFiltroMes , #SelectFiltroMesAno , #SelectFiltroAno,#dataInicioBusca,#dataFimBusca').removeClass('is-invalid');
            if($("#SelectFiltroAno").val() == "" || $("#SelectFiltroAno").val() == null){
                $("#SelectFiltroAno").addClass('is-invalid');
                return false;
            }
            $("#SelectFiltroMes,#SelectFiltroMesAno,#dataInicioBusca,#dataFimBusca").val("");
        break;
        case 'PL':
            $('#SelectFiltroMes , #SelectFiltroMesAno , #SelectFiltroAno,#dataInicioBusca,#dataFimBusca').removeClass('is-invalid');
            if($("#dataInicioBusca").val() == "" || $("#dataInicioBusca").val() == null||$("#dataFimBusca").val() == "" || $("#dataFimBusca").val() == null){
                if($("#dataInicioBusca").val() == "" ||$("#dataInicioBusca").val() == null){
                     $("#dataInicioBusca").addClass('is-invalid');
                 }if($("#dataFimBusca").val() == "" || $("#dataFimBusca").val() == null){
                     $("#dataFimBusca").addClass('is-invalid');
                 }
                 return false;
            }
            $("#SelectFiltroMes,#SelectFiltroMesAno,#SelectFiltroAno ").val("");
        break;
        default:
            $("#SelectFiltroMes ,#SelectFiltroMesAno,#SelectFiltroAno,#dataInicioBusca,#dataFimBusca").val("");
        break;
    }

    return resposta;
}

function alertDanger(mensagem) {
    $('.alert-danger p').html(mensagem);
        $('.alert-danger').css({'display':'block'});
    setTimeout(function(){
        $('.alert-danger p').html('');
        $('.alert-danger').css({'display':'none'});
    },4000)
}

function tableViewUsuariosCadastrados(currentLocation) {
    let html = '<th></th>'+
                '<th>Nome</th>'+
                '<th>UserName</th>'+
                '<th>E-mail</th>'+
                '<th>Data do cadastro</th>'+
            '</tr>'+
        '</thead>'+
    '<tbody>';

    $.ajax({
        url:currentLocation+'table/viewUsuarioCadastrados',
        type:"post",
        data:  "_token="+$('meta[name="csrf-token"]').attr('content'),
        dataType: 'json',
        cache : false,
        processData: false,
        async: false,
        beforeSend: function() {
            $("#boxloadingTela").css({'display':'block'});
        },
        success:function(response) {
            let contador =0;
            $("#boxloadingTela").css({'display':'none'});
            for (let i = 0; i < response.length; i++) {
                contador ++;
                html += '<tr>'+
                                '<td>'+contador+'</td>'+
                                '<td>'+response[i].display_name+'</td>'+
                                '<td>'+response[i].user_nicename+'</td>'+
                                '<td>'+response[i].user_email+'</td>'+
                                '<td>'+response[i].user_registered+'</td>'+
                            '</tr>';
            }
            html +='</tbody>'+
                    '</table>';
            $('#modalFiltroDashboard').modal('hide');
        }
    })
    return html
}

function tableViewInscricoesEmCurso(currentLocation) {
    let html = '<th></th>'+
                '<th>Nome do Aluno</th>'+
                '<th>UserName do Aluno</th>'+
                '<th>E-mail</th>'+
                '<th>Curso inscrito</th>'+
                '<th>Data da inscrição</th>'+
            ' </tr>'+
        '</thead>'+
    '<tbody>';

    $.ajax({
        url:currentLocation+'table/viewInscricoesEmCurso',
        type:"post",
        data:  "_token="+$('meta[name="csrf-token"]').attr('content'),
        dataType: 'json',
        cache : false,
        processData: false,
        async: false,
        beforeSend: function() {
            $("#boxloadingTela").css({'display':'block'});
        },
        success:function(response) {
            let contador =0;
            $("#boxloadingTela").css({'display':'none'});
            for (let i = 0; i < response.length; i++) {
                contador ++;
                let curso ;
                if(response[i].course == null){
                    curso = "";
                }else{
                    curso = response[i].course;
                }
                html= html+ '<tr>'+
                                '<td>'+contador+'</td>'+
                                '<td>'+response[i].display_name+'</td>'+
                                '<td>'+response[i].user_nicename+'</td>'+
                                '<td>'+response[i].user_email+'</td>'+
                                '<td>'+curso+'</td>'+
                                '<td>'+response[i].date_recorded+'</td>'+
                            '</tr>';
            }

            html = html+'</tbody>'+
                    '</table>';
            $('#modalFiltroDashboard').modal('hide');
        }
    })
    return html;
}

function tableViewCertificaosEmCurso(currentLocation) {
    let html = '<th></th>'+
                    '<th>Nome do Aluno</th>'+
                    '<th>UserName do Aluno</th>'+
                    '<th>E-mail</th>'+
                    '<th>Curso inscrito</th>'+
                    '<th>Data da inscrição</th>'+
                ' </tr>'+
            '</thead>'+
        '<tbody>';

    $.ajax({
        url:currentLocation+'table/viewCertificadosEmitidos',
        type:"post",
        data:  "_token="+$('meta[name="csrf-token"]').attr('content'),
        dataType: 'json',
        cache : false,
        processData: false,
        async: false,
        beforeSend: function() {
            $("#boxloadingTela").css({'display':'block'});
        },
        success:function(response) {
            let contador =0;
            $("#boxloadingTela").css({'display':'none'});
            for (let i = 0; i < response.length; i++) {
                contador ++;
                let curso ;
                if(response[i].course == null){
                    curso = "";
                }else{
                    curso = response[i].course;
                }
                html= html+ '<tr>'+
                                '<td>'+contador+'</td>'+
                                '<td>'+response[i].display_name+'</td>'+
                                '<td>'+response[i].user_nicename+'</td>'+
                                '<td>'+response[i].user_email+'</td>'+
                                '<td>'+curso+'</td>'+
                                '<td>'+response[i].date_recorded+'</td>'+
                            '</tr>';
            }

            html = html+'</tbody>'+
                    '</table>';
            $('#modalFiltroDashboard').modal('hide');
        }
    })
    return html;
}

function tableViewCursosPublicados(currentLocation) {
    let html = '<th></th>'+
                    '<th>Cod do Curso</th>'+
                    '<th>Nome do Curso</th>'+
                    '<th>Duração do Curso</th>'+
                ' </tr>'+
            '</thead>'+
        '<tbody>';

    $.ajax({
        url:currentLocation+'table/viewCursospublicados',
        type:"post",
        data:  "_token="+$('meta[name="csrf-token"]').attr('content'),
        dataType: 'json',
        cache : false,
        processData: false,
        async: false,
        beforeSend: function() {
            $("#boxloadingTela").css({'display':'block'});
        },
        success:function(response) {
            let contador =0;
            $("#boxloadingTela").css({'display':'none'});
            for (let i = 0; i < response.length; i++) {
                contador ++;
                let curso
                if(response[i].course == null){
                    curso = "";
                }else{
                    curso = response[i].course;
                }
                html= html+ '<tr>'+
                                '<td>'+contador+'</td>'+
                                '<td>'+response[i].id_course+'</td>'+
                                '<td>'+curso+'</td>'+
                                '<td>'+response[i].duracao+'</td>'+
                            '</tr>';
            }

            html = html+'</tbody>'+
                    '</table>';
            $('#modalFiltroDashboard').modal('hide');
        }
    })
    return html;
}

function tableViewAcessoTotal(currentLocation) {
    let html = '<th></th>'+
                    '<th>Nome</th>'+
                    '<th>UserName</th>'+
                    '<th>E-mail</th>'+
                    '<th>Data/Hora do Acesso</th>'+
                ' </tr>'+
            '</thead>'+
        '<tbody>';

    $.ajax({
        url:currentLocation+'table/viewAcessoTotal',
        type:"post",
        data:  "_token="+$('meta[name="csrf-token"]').attr('content'),
        dataType: 'json',
        cache : false,
        processData: false,
        async: false,
        beforeSend: function() {
            $("#boxloadingTela").css({'display':'block'});
        },
        success:function(response) {
            let contador =0;
            $("#boxloadingTela").css({'display':'none'});
            for (let i = 0; i < response.length; i++) {
                contador ++;
                html= html+ '<tr>'+
                                '<td>'+contador+'</td>'+
                                '<td>'+response[i].display_name+'</td>'+
                                '<td>'+response[i].user_nicename+'</td>'+
                                '<td>'+response[i].user_email+'</td>'+
                                '<td>'+response[i].DataHora+'</td>'+
                            '</tr>';
            }

            html = html+'</tbody>'+
                    '</table>';
            $('#modalFiltroDashboard').modal('hide');
        }
    })
    return html;
}

function tableViewAcessoHoje(currentLocation) {
    let html = '<th></th>'+
                    '<th>Nome</th>'+
                    '<th>UserName</th>'+
                    '<th>E-mail</th>'+
                    '<th>Data/Hora do Acesso</th>'+
                ' </tr>'+
            '</thead>'+
        '<tbody>';

    $.ajax({
        url:currentLocation+'table/viewAcessoHoje',
        type:"post",
        data:  "_token="+$('meta[name="csrf-token"]').attr('content'),
        dataType: 'json',
        cache : false,
        processData: false,
        async: false,
        beforeSend: function() {
            $("#boxloadingTela").css({'display':'block'});
        },
        success:function(response) {
            let contador =0;
            $("#boxloadingTela").css({'display':'none'});
            for (let i = 0; i < response.length; i++) {
                contador ++;
                html= html+ '<tr>'+
                                '<td>'+contador+'</td>'+
                                '<td>'+response[i].display_name+'</td>'+
                                '<td>'+response[i].user_nicename+'</td>'+
                                '<td>'+response[i].user_email+'</td>'+
                                '<td>'+response[i].DataHora+'</td>'+
                            '</tr>';
            }

            html = html+'</tbody>'+
                    '</table>';
            $('#modalFiltroDashboard').modal('hide');
        }
    })
    return html;
}

function configurarTable(byid) {
    var table = $('#dataTable').DataTable({
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });
    new $.fn.dataTable.Buttons( table, {
        buttons: [
                    { extend: 'csv' , text: 'csv',className:'btn btn-info '},
                    { extend: 'excel' , text: 'excel',className:'btn btn-info '},
                    { extend: 'pdf' , text: 'pdf',className:'btn btn-info '},
                    { extend: 'print' , text: 'Imprimir',className:'btn btn-info '},
                    { text: 'X',className:'btn btn-light', action: function () {
                        $("#BoxTable_oneC, #BoxTable_twoC, #BoxTable_threeC, #BoxTable_fourC, #BoxTable_fiveC, #BoxTable_sixC,.btnExport").html('');
                        $("#BoxTable_one, #BoxTable_two, #BoxTable_three, #BoxTable_four, #BoxTable_five, #BoxTable_six").css({'display':"none"});
                    }}
                ]
    } );

    table.buttons( 1, null ).container().appendTo(
        $('.btnExport')
    );
}











