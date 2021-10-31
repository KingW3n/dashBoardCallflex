function DadosIniciais(inscricoes,  certificado,cursosPublicados,cursosDespublicados,timelineAcessos){
    let numeroInscricoes = parseInt(inscricoes);
    let numeroCertificado = parseInt(certificado);
    let cursosIniciados = numeroInscricoes-numeroCertificado;

    //verifica se o numero é negativo para evitar erros
    if(cursosIniciados<=0){    cursosIniciados = 0;   }

    //preenche o chart Cusos concluidos/pendentes
    instanciarChart("PieChartCursos","Concluidos","Cursos Pendentes",numeroCertificado,cursosIniciados,"#4e73df","#1cc88a","#2e59d9","#17a673");

    //cursos pubicados/despublicados
    instanciarChart("PieChartCursosPublicados","Cursos Publicados","Cursos Despublicados",cursosPublicados,cursosDespublicados,"#4e73df","#1cc88a","#2e59d9","#17a673");

    areaChart("AreaTimeLineDoAno",2021,timelineAcessos[0],timelineAcessos[1], timelineAcessos[2], timelineAcessos[3],timelineAcessos[4], timelineAcessos[5]);



}











