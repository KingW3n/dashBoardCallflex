@extends('layoutPadrao.index')
@section('Titulo')
Callflex Youniversity - Dashboard
@endsection


@section('Content')
<link href="{{asset('Template/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <div>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm" data-toggle="modal" data-target="#modalFiltroDashboard"><i class="fas fa-filter fa-sm text-white-50"></i> Filtro</a>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a></div>
        </div>
    <!-- Content Row -->
    <div class="row">
        <div class="modal fade" id="modalFiltroDashboard" tabindex="-1" role="dialog" aria-labelledby="modalFiltroDashboardTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalFiltroDashboardTitle">Filtro</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <form class="formFiltroDashboard">
                        @csrf
                        <input type="hidden" class="FiltroURL" value="{{route('FiltroDashboard')}}">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Empresa</label>
                            <select class="form-control" id="SelectFiltroEmpresa" name="SelectFiltroEmpresa">
                                <option value="0">All </option>
                                @foreach ($dadosCategoria as $key =>$value )
                                    @if ($value->status == "Ativo")
                                        <option value="{{$value->ID}}">{{$value->categoria}}</option>
                                    @endif
                                @endforeach
                            </select>
                            <label for="exampleFormControlSelect1">Filtrar por Período</label>
                            <select class="form-control" id="SelectFiltrotempo" name="SelectFiltrotempo">
                                <option value="AL">All </option>
                                <option value="RH">Registros de Hoje</option>
                                <option value="US">Ultima semana</option>
                                <option value="PM">Por Mês</option>
                                <option value="PA">Por Ano</option>
                                <option value="PL">Personalizado</option>
                            </select>
                            <small id="emailHelp" class="form-text text-muted">Caso selecione Por mes ou ano, novas caixas de opções irão aparecer a baixo.</small>
                                <div class="form-row">
                                <div class="col-md-6 mb-3   divFiltroPorMes">
                                    <select class="form-control" id="SelectFiltroMes" name="SelectFiltroMes">
                                        <option value="" hidden>Selecione o mês</option>
                                        <option value="01">Janeiro </option>
                                        <option value="02">Fevereiro</option>
                                        <option value="03">Março</option>
                                        <option value="04">Abril</option>
                                        <option value="05">Maio</option>
                                        <option value="06">Junho </option>
                                        <option value="07">julho</option>
                                        <option value="08">Agosto</option>
                                        <option value="09">Setembro</option>
                                        <option value="10">Outubro</option>
                                        <option value="11">Novembro</option>
                                        <option value="12">Dezembro</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3 divFiltroPorMes">
                                    <select class="form-control" id="SelectFiltroMesAno" name="SelectFiltroMesAno">
                                        <option value="" hidden>Selecione o Ano</option>
                                        @for ($i=2021; $i <= date('Y'); $i++)
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <select class="form-control divFiltroPorAno" id="SelectFiltroAno" name="SelectFiltroAno">
                                <option value="" hidden>Selecione o Ano</option>
                                @for ($i=2021; $i <= date('Y'); $i++)
                                    <option value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                            <div class="form-row  divInicio " >
                                <div class="col-md-6 mb-3 divFiltroPorPeriodo">
                                    <input type="date" class="form-control" id="dataInicioBusca" name="dataInicioBusca" min="2021-01-01" >
                                </div>
                                <div class="col-md-6 mb-3 divFiltroPorPeriodo">
                                    <input type="date" class="form-control"  id="dataFimBusca" name="dataFimBusca" min="2021-01-01" >
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btnAplicarFiltro">Aplicar</button>
                        </div>
                    </form>
                </div>
              </div>
            </div>
        </div>
        <!-- Usuarios cadastrados -->
        <div class="col-xl-4 col-md-6 mb-4 CardDashboard" id="divUsuarioadastrado">
            <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <center>
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Usuários Cadastrados
                                </div>
                                <div class="h1 mb-0 font-weight-bold text-gray-800 align-items-center divUsuariosCadastrados">
                                    {{$user}}
                                </div>
                            </center>

                        </div>
                        <div>
                            <a href=""><i class="far fa-eye iconView viewUsuarioCadastrados viewTable" name="viewUsuarioCadastrados"></i></a>
                            <a target="_blank" href="{{route('RelatorioTable','viewUsuarioCadastrados')}}"><i class="fas fa-reply iconView viewUsuarioCadastrados mt-3 iconView" style="transform: scaleX(-1);" name="viewUsuarioCadastrados"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class=" col-xl-4 col-md-6 mb-4 CardDashboard card shadow mb-4 mt-4 col-xl-12" id="BoxTable_one" style="display: none;">
            <div class="card-header py-3" style="height: 70px;">
                <h6 class="m-0 font-weight-bold text-primary textTipo" id="BoxTable_oneT" style=" float: left;"></h6>
                <div class="btnExport btn-group" style=" float: right;"></div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="BoxTable_oneC" class="col-xl-12 mb-4 CardDashboard" cellspacing="0" ></div>
                </div>
            </div>
        </div>

        <div id="BoxTable_one"></div>
        <!-- Total de Inscrições em Cursos -->
        <div class="col-xl-4 col-md-6 mb-4 CardDashboard" id="divIncricoesurso">
            <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <center>
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total de Inscrições em Cursos</div>
                                <div class="h1 mb-0 font-weight-bold text-gray-800 divInscriçãoCursos">
                                   {{$inscricao}}
                                </div>
                            </center>
                        </div>
                        <div>
                            <a href=""><i class="far fa-eye iconView viewInscricoesEmCurso viewTable" name="viewInscricoesEmCurso"></i></a>
                            <a target="_blank" href="{{route('RelatorioTable','viewInscricoesEmCurso')}}"><i class="fas fa-reply viewInscricoesEmCurso mt-3 iconView" style="transform: scaleX(-1);" name="viewInscricoesEmCurso"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class=" col-xl-4 col-md-6 mb-4 CardDashboard card shadow mb-4 mt-4 col-xl-12" id="BoxTable_two" style="display: none;">
            <div class="card-header py-3" style="height: 70px;">
                <h6 class="m-0 font-weight-bold text-primary textTipo" id="BoxTable_twoT" style=" float: left;"></h6>
                <div class="btnExport btn-group" style=" float: right;"></div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="BoxTable_twoC" class="col-xl-12 mb-4 CardDashboard" cellspacing="0" ></div>
                </div>
            </div>
        </div>

        <!-- Total de certificados Emitidos -->
        <div class="col-xl-4 col-md-6 mb-4 CardDashboard" id="divCertificadosEmitidos">
            <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <center>
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total de certificados Emitidos
                                </div>
                                <div class="h1 mb-0 font-weight-bold text-gray-800  divCertificadosCursos">
                                    {{$certificado}}
                                </div>
                            </center>
                        </div>
                        <div>
                            <a  href=""><i class="far fa-eye iconView viewCertificadosEmitidos viewTable" name="viewCertificadosEmitidos" ></i></a>
                            <a target="_blank" href="{{route('RelatorioTable','viewCertificadosEmitidos')}}"><i class="fas fa-reply viewCertificadosEmitidos mt-3 iconView" style="transform: scaleX(-1);" name="viewCertificadosEmitidos" ></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class=" col-xl-4 col-md-6 mb-4 CardDashboard card shadow mb-4 mt-4 col-xl-12" id="BoxTable_three" style="display: none;">
            <div class="card-header py-3" style="height: 70px;">
                <h6 class="m-0 font-weight-bold text-primary textTipo" id="BoxTable_threeT" style=" float: left;"></h6>
                <div class="btnExport btn-group" style=" float: right;"></div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="BoxTable_threeC" class="col-xl-12 mb-4 CardDashboard" cellspacing="0" ></div>
                </div>
            </div>
        </div>

        <!-- Cursos Publicados (Ativo) -->
        <div class="col-xl-4 col-md-6 mb-4 CardDashboard" id="divCursosPublicados">
            <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <center>
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Cursos Publicados (Ativo)
                                </div>
                                <div class="h1 mb-0 font-weight-bold text-gray-800 divCursosPublicados">
                                    {{$cursos}}
                                </div>
                            </center>
                        </div>
                        <div>
                            <a href=""><i class="far fa-eye iconView viewCursospublicados viewTable" name="viewCursospublicados"></i></a>
                            <a target="_blank" href="{{route('RelatorioTable','viewCursospublicados')}}"><i class="fas fa-reply viewCursospublicados mt-3 iconView" style="transform: scaleX(-1);" name="viewCursospublicados"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class=" col-xl-4 col-md-6 mb-4 CardDashboard card shadow mb-4 mt-4 col-xl-12" id="BoxTable_four" style="display: none;">
            <div class="card-header py-3" style="height: 70px;">
                <h6 class="m-0 font-weight-bold text-primary textTipo" id="BoxTable_fourT" style=" float: left;"></h6>
                <div class="btnExport btn-group" style=" float: right;"></div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="BoxTable_fourC" class="col-xl-12 mb-4 CardDashboard" cellspacing="0" ></div>
                </div>
            </div>
        </div>

        <!-- Acessos -->
        <div class="col-xl-4 col-md-6 mb-4 CardDashboard" id="divAcessos">
            <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <center>
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Acessos
                                </div>
                                <div class="h1 mb-0 font-weight-bold text-gray-800 divAcessosaoSistema">
                                    {{$acessoTotal}}
                                </div>
                            </center>
                        </div>
                        <div>
                            <a href=""><i class="far fa-eye iconView viewAcessoTotal viewTable"  name="viewAcessoTotal"></i></a>
                            <a target="_blank" href="{{route('RelatorioTable','viewAcessoTotal')}}"><i class="fas fa-reply viewAcessoTotal mt-3 iconView" style="transform: scaleX(-1);"  name="viewAcessoTotal"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class=" col-xl-4 col-md-6 mb-4 CardDashboard card shadow mb-4 mt-4 col-xl-12" id="BoxTable_five" style="display: none;">
            <div class="card-header py-3" style="height: 70px;">
                <h6 class="m-0 font-weight-bold text-primary textTipo" id="BoxTable_fiveT" style=" float: left;"></h6>
                <div class="btnExport btn-group" style=" float: right;"></div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="BoxTable_fiveC" class="col-xl-12 mb-4 CardDashboard" cellspacing="0" ></div>
                </div>
            </div>
        </div>

        <!-- Acessos Hoje -->
        <div class="col-xl-4 col-md-6 mb-4 CardDashboard" id="divAcessosHoje">
            <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <center>
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Acessos Hoje</div>
                                <div class="h1 mb-0 font-weight-bold text-gray-800 divAcessosaoSistemaHoje">
                                    {{$acessoHoje}}
                                </div>
                            </center>
                        </div>
                        <div>
                            <a href=""><i class="far fa-eye iconView viewAcessoHoje viewTable" name="viewAcessoHoje"></i></a>
                            <a target="_blank" href="{{route('RelatorioTable','viewAcessoHoje')}}"><i class="fas fa-reply viewAcessoHoje mt-3 iconView" style="transform: scaleX(-1);" name="viewAcessoHoje"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class=" col-xl-4 col-md-6 mb-4 CardDashboard card shadow mb-4 mt-4 col-xl-12" id="BoxTable_six" style="display: none;">
        <div class="card-header py-3" style="height: 70px;">
            <h6 class="m-0 font-weight-bold text-primary textTipo" id="BoxTable_sixT" style=" float: left;"></h6>
            <div class="btnExport btn-group" style=" float: right;"></div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div id="BoxTable_sixC" class="col-xl-12 mb-4 CardDashboard" cellspacing="0" ></div>
            </div>
        </div>
    </div>

    <div id="BoxTable_six"></div>
    <!-- Content Row -->
    <div class="row">
        <!-- Pie Chart -->
        <div class="col-xl-6 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Cursos Pendentes/ Concluidos</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>

                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2 ChartPieChartCursos">
                        <canvas id="PieChartCursos"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-primary"></i> Concluidos
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> Cursos Pendentes
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pie Chart -->
        <div class="col-xl-6 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Cursos Publicados / Despublicados</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>

                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2 ChartPieChartCursosPublicados">
                        <canvas id="PieChartCursosPublicados"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-primary"></i> Cursos Publicados
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> Cursos Despublicados
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Area Chart -->
        <div class="col-xl-6 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Time Line Acessos</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>

                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="AreaTimeLineDoAno"></canvas>
                    </div>
                </div>
            </div>
        </div>
         <!-- Area Chart -->
         <div class="col-xl-6 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Acessos Por Ano</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>

                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="Area5Ano"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Page level plugins -->
<script src="{{asset('Template/vendor/jquery/jquery.min.js')}}"></script>


 <!-- Bootstrap core JavaScript-->
 <script src="{{asset('Template/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

 <!-- Core plugin JavaScript-->
 <script src="{{asset('Template/vendor/jquery-easing/jquery.easing.min.js')}}"></script>


 <!-- Page level plugins -->
 <script src="{{asset('Template/vendor/datatables/jquery.dataTables.min.js')}}"></script>
 <script src="{{asset('Template/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>


<script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>



<script src="{{asset('Template/vendor/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('js/chart.js')}}"></script>
<script src="{{asset('js/area.js')}}"></script>



<script src="{{asset('js/dashboard.js')}}"></script>
<script>
    var largura = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;

    var dadosAcessos=[ {{$acessoHoje}} , {{$acessosSemana}} , {{$acessosMes}} , {{$acessosPrimeiroSemestre}} , {{$acessosSegndoSemestre}} ,{{$acessosAno}}];
    let arrayAnos = [ {{$AnosDosAcessos[0]['Ano']}} ,  {{$AnosDosAcessos[1]['Ano']}}, {{$AnosDosAcessos[2]['Ano']}}, {{$AnosDosAcessos[3]['Ano']}},{{$AnosDosAcessos[4]['Ano']}}];
    let arrayAcessos = [ {{$AnosDosAcessos[0]['Acessos']}} ,  {{$AnosDosAcessos[1]['Acessos']}}, {{$AnosDosAcessos[2]['Acessos']}}, {{$AnosDosAcessos[3]['Acessos']}},{{$AnosDosAcessos[4]['Acessos']}}]
    DadosIniciais({{$inscricao}},{{$certificado}},{{$cursosPublicados}},{{$cursosDespublicados}},dadosAcessos, arrayAnos, arrayAcessos);




</script>
<style>
.iconView{
    cursor: pointer;
}

</style>
@endsection
