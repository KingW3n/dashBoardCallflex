<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>@yield('Titulo')</title>

    <link href="{{ asset('Template/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="{{asset('Template/css/sb-admin-2.min.css')}}" rel="stylesheet">

</head>
@include('Alerts.alerts')
@include('Loading.index')
<!-- modalCriarCategoria -->
<div class="modal fade" id="modalConvidarUsuarios" tabindex="-1" role="dialog" aria-labelledby="modalConvidarUsuarios" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCriarCategoria">Convidar funcionarios para o Dashboard</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form class="formModalConvidarFuncionario">
                @csrf
                <center>
                    <div class="form-group mt-5">
                        <input type="email" class="form-control w-75" id="emailConvdar" name="email" placeholder="E-mail">
                        <input type="hidden" id="LinkBaseSite" name="LinkBaseSite" value="{{ env('APP_URL_Local') }}">
                        <div id="invalidMensagemEmail" class="invalid-feedback">
                            E-mail inserido invalido
                        </div>
                        <small id="emailHelp" class="form-text text-muted">Para convidar o usuario precisa ter acesso @callfle.net.br e deve está cadastrado no YOUniversity.</small>
                    </div>
                    <button type="submit" class="btn btn-primary btnConvidarEmail mt-5 mb-5">Convidar</button>
                </center>
            </form>
        </div>
      </div>
    </div>
</div>

<!-- modalperfil -->
<div class="modal fade" id="modalPerfil" tabindex="-1" role="dialog" aria-labelledby="modalPerfil" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCriarCategoria">Convidar funcionarios para o Dashboard</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form class="formModalConvidarFuncionario">
                @csrf
                <center>
                    <div class="form-group mt-5">
                        <input type="email" class="form-control w-75" id="emailConvdar" name="email" placeholder="E-mail">
                        <input type="hidden" id="LinkBaseSite" name="LinkBaseSite" value="{{ env('APP_URL_Local') }}">
                        <div id="invalidMensagemEmail" class="invalid-feedback">
                            E-mail inserido invalido
                        </div>
                        <small id="emailHelp" class="form-text text-muted">Para convidar o usuario precisa ter acesso @callfle.net.br e deve está cadastrado no YOUniversity.</small>
                    </div>
                    <button type="submit" class="btn btn-primary btnConvidarEmail mt-5 mb-5">Convidar</button>
                </center>
            </form>
        </div>
      </div>
    </div>
</div>
<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav bg-secondary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('home')}}">
                <img src="{{ asset('img/logoCallflexBranco.png') }}" style="width: 28%">
                <div class="mx-3">Callflex </div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a class="nav-link" href="{{route('home')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
             <li class="nav-item active">
                <a class="nav-link" href="{{route('viewIndex')}}">
                    <i class="fas fa-user-friends"></i>
                    <span>Grupos de Usuários</span></a>
            </li>
            @if ($DadosUser->perfil == "Admin" )
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('viewGestaodeUser')}}">
                        <i class="fas fa-users"></i>
                        <span>Gestão de Usuário</span></a>
                </li>
            @endif
        </ul>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{$DadosUser->nome}}</span>
                                @if ($DadosUser->photo)

                                @else
                                    <img class="img-profile rounded-circle" src="{{ asset('Template/img/undraw_profile.svg')}}">
                                @endif

                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <!--<a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Perfil
                                </a>-->
                                <a class="dropdown-item" onclick="funConvidarUser()">
                                    <i class="fas fa-user-plus fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Convidar
                                </a>

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Sair
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>

                @yield('Content')

            </div>

            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Callflex 2021</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Deseja realmente sair?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="{{route('Realizarlogout')}}">Sair</a>
                </div>
            </div>
        </div>
    </div>


</body>
    <script src="{{ asset('js/convidarUser.js') }}"></script>
</html>

<style>
    a{
        cursor: pointer;
    }
</style>
<script>


</script>
