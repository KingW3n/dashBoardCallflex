@extends('layoutPadrao.index')
@section('Titulo')
Callflex Youniversity - Cadastro de Categorias
@endsection


@section('Content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Cadastro de categorias</h1>
    </div>
    <center><div class="col-xl-6 col-lg-5 mt-5">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="font-weight-bold ">Cadastro de Categorias</h6>
                <div class="dropdown no-arrow">
            </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <form method="POST" id="formCadastroForm">
                    @csrf
                    <div class="form-group mt-5">
                        <input type="text" class="form-control w-75"
                            id="idCategoria" name="categoria"
                            placeholder="Nome da Categoria">
                        <div id="invalidMensagemCategoria" class="invalid-feedback">
                            Categoria inserida invalida
                        </div>
                    </div>
                    <input type="submit" div="CadastrarCategoria" class="btn btn-primary mt-5 mb-5" value="Cadastrar">

                </form>

            </div>
        </div>
    </div></center>
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <div class="w-100">

                </div>
            </div>
            <div class="col-3"></div>
        </div>

        <div class="row">
            <div class="col-xl-4 col-md-6 mb-4 CardDashboard" id="divUsuarioadastrado">
                <div class="card border-left-secondary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <center>
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        1 - Prospecção
                                    </div>
                                    <div class="h1 mb-0 font-weight-bold text-gray-800 align-items-center divprosp">

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

            <div class="col-xl-4 col-md-6 mb-4 CardDashboard" id="divUsuarioadastrado">
                <div class="card border-left-secondary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <center>
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        2 - Qualificação da Solução
                                    </div>
                                    <div class="h1 mb-0 font-weight-bold text-gray-800 align-items-center divqualidicacao">

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

            <div class="col-xl-4 col-md-6 mb-4 CardDashboard" id="divUsuarioadastrado">
                <div class="card border-left-secondary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <center>
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        3 - Elaboração de Proposta
                                    </div>
                                    <div class="h1 mb-0 font-weight-bold text-gray-800 align-items-center divelabpropost">

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

            <div class="col-xl-4 col-md-6 mb-4 CardDashboard" id="divUsuarioadastrado">
                <div class="card border-left-secondary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <center>
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        4 - Validação de proposta - Pré vendas
                                    </div>
                                    <div class="h1 mb-0 font-weight-bold text-gray-800 align-items-center divvalidacaoPoposta">

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

            <div class="col-xl-4 col-md-6 mb-4 CardDashboard" id="divUsuarioadastrado">
                <div class="card border-left-secondary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <center>
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        5 - Negociação\ Revisão (Negócios Prováveis)
                                    </div>
                                    <div class="h1 mb-0 font-weight-bold text-gray-800 align-items-center divNegociacaoRevisao">

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

            <div class="col-xl-4 col-md-6 mb-4 CardDashboard" id="divUsuarioadastrado">
                <div class="card border-left-secondary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <center>
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        6 - Discussão de Contrato
                                    </div>
                                    <div class="h1 mb-0 font-weight-bold text-gray-800 align-items-center divDiscucaoContrato">

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

            <div class="col-xl-4 col-md-6 mb-4 CardDashboard" id="divUsuarioadastrado">
                <div class="card border-left-secondary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <center>
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Validação  Jurídico
                                    </div>
                                    <div class="h1 mb-0 font-weight-bold text-gray-800 align-items-center divValidacaoJuridico">

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

            <div class="col-xl-4 col-md-6 mb-4 CardDashboard" id="divUsuarioadastrado">
                <div class="card border-left-secondary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <center>
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Novas Demandas
                                    </div>
                                    <div class="h1 mb-0 font-weight-bold text-gray-800 align-items-center divNovasDemandas">

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

            <div class="col-xl-4 col-md-6 mb-4 CardDashboard" id="divUsuarioadastrado">
                <div class="card border-left-secondary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <center>
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Demandas Pendentes
                                    </div>
                                    <div class="h1 mb-0 font-weight-bold text-gray-800 align-items-center divDemandasPendentes">

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

            <div class="col-xl-4 col-md-6 mb-4 CardDashboard" id="divUsuarioadastrado">
                <div class="card border-left-secondary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <center>
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Negócio Fechado
                                    </div>
                                    <div class="h1 mb-0 font-weight-bold text-gray-800 align-items-center divNegocioFechado">

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

            <div class="col-xl-4 col-md-6 mb-4 CardDashboard" id="divUsuarioadastrado">
                <div class="card border-left-secondary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <center>
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Negócio Perdido
                                    </div>
                                    <div class="h1 mb-0 font-weight-bold text-gray-800 align-items-center divNegocioPerdido">

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
        </div>


</div>


<!-- Page level plugins -->
<script src="{{asset('Template/vendor/jquery/jquery.min.js')}}"></script>


 <!-- Bootstrap core JavaScript-->
 <script src="{{asset('Template/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

 <!-- Core plugin JavaScript-->
 <script src="{{asset('Template/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
 <script src="{{ asset('js/categoria.js') }}"></script>

 <style>
     .divCenter{

     }
 </style>
@endsection
