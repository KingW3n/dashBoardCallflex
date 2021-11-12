$(".iconView, .divFiltroPorMes, .divFiltroPorAno, .divFiltroPorPeriodo").css({"display":'none'});

//submitForm
$('.formFiltroDashboard').submit(function (e) {
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













