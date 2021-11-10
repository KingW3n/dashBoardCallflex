@extends('layoutPadrao.index')
@section('Titulo')
SB Admin 2 - Dashboard
@endsection


@section('Content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    <!-- Content Row -->
    <div class="row">
        <!-- Usuarios cadastrados -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <center>
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Usuários Cadastrados
                                </div>
                                <div class="h1 mb-0 font-weight-bold text-gray-800 align-items-center">
                                    {{$user}}
                                </div>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <center>
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total de Inscrições em Cursos</div>
                                <div class="h1 mb-0 font-weight-bold text-gray-800">
                                   {{$inscricao}}
                                </div>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <center>
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total de certificados Emitidos
                                </div>
                                <div class="h1 mb-0 font-weight-bold text-gray-800">
                                    {{$certificado}}
                                </div>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <center>
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Cursos Publicados (Ativo)
                                </div>
                                <div class="h1 mb-0 font-weight-bold text-gray-800">
                                    {{$cursos}}
                                </div>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <center>
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Acessos
                                </div>
                                <div class="h1 mb-0 font-weight-bold text-gray-800">
                                    {{$acessoTotal}}
                                </div>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pending Requests Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <center>
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Acessos Hoje</div>
                                <div class="h1 mb-0 font-weight-bold text-gray-800">
                                    {{$acessoHoje}}
                                </div>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
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
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
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
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
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
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
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
<script src="{{asset('Template/vendor/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('js/chart.js')}}"></script>
<script src="{{asset('js/area.js')}}"></script>
<script src="{{asset('js/dashboard.js')}}"></script>
<script>
    var dadosAcessos=[ {{$acessoHoje}} , {{$acessosSemana}} , {{$acessosMes}} , {{$acessosPrimeiroSemestre}} , {{$acessosSegndoSemestre}} ,{{$acessosAno}}];
    let arrayAnos = [ {{$AnosDosAcessos[0]['Ano']}} ,  {{$AnosDosAcessos[1]['Ano']}}, {{$AnosDosAcessos[2]['Ano']}}, {{$AnosDosAcessos[3]['Ano']}},{{$AnosDosAcessos[4]['Ano']}}];
    let arrayAcessos = [ {{$AnosDosAcessos[0]['Acessos']}} ,  {{$AnosDosAcessos[1]['Acessos']}}, {{$AnosDosAcessos[2]['Acessos']}}, {{$AnosDosAcessos[3]['Acessos']}},{{$AnosDosAcessos[4]['Acessos']}}]
    DadosIniciais({{$inscricao}},{{$certificado}},{{$cursosPublicados}},{{$cursosDespublicados}},dadosAcessos, arrayAnos, arrayAcessos);

</script>
@endsection
