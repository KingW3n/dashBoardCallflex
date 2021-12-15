<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Callflex - Login</title>
    <link href="{{ asset('Template/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <meta name="grecaptcha-key" content="{{config('recaptcha.v3.public_key')}}">
    <script src="https://www.google.com/recaptcha/api.js?render={{config('recaptcha.v3.public_key')}}"></script>

    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('Template/css/sb-admin-2.min.css')}}" rel="stylesheet">

</head>
@include('Alerts.alerts')
@include('Loading.index')
<body class="">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block " style="padding: 10%">
                                <?php
                                    $rand = rand(1,5);
                                    switch ($rand) {
                                        case 1:
                                            ?><img src="{{asset('img/MeninadeMascara.png')}}" style="width: 100%"><?php
                                        break;
                                        case 2:
                                            ?><img src="{{asset('img/MeninadeMascara2.png')}}" style="width: 100%"><?php
                                        break;
                                        case 3:
                                            ?><img src="{{asset('img/MeninadeMascara3.png')}}" style="width: 100%"><?php
                                        break;
                                        case 4:
                                            ?><img src="{{asset('img/MeninoDeMascara.png')}}" style="width: 100%"><?php
                                        break;
                                        case 5:
                                            ?><img src="{{asset('img/MeninoDeMascara2.png')}}" style="width: 100%"><?php
                                        break;


                                    }
                                ?>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">DashBoard Callflex</h1>
                                    </div>
                                    <form class="user formUser" method="POST" >
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="InputEmail" name="email" aria-describedby="emailHelp invalidMensagemEmail"
                                                placeholder="E-mail" value="{{$email}}">
                                                <div id="invalidMensagemEmail" class="invalid-feedback">
                                            E-mail invalido
                                        </div>
                                        </div>

                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="InputPassword" name="senha" placeholder="Senha">
                                                <div id="invalidMensagemSenha" class="invalid-feedback">
                                                    Senha invalida
                                                </div>
                                        </div>

                                        <div class="form-group" style="display: none">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" name="lembreme" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Lembre-me
                                                    </label>
                                            </div>
                                        </div>
                                        <button div="entrarLgonBtn" class="btn btn-primary btn-user btn-block">Entrar</button>

                                        </a>
                                        <hr>
                                        <center><div class="g-recaptcha" id="Valrecaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_PUBLIC_KEY') }}"></div></center>
                                        <label class="lbUrl" style="display: none">{{route('realizarLogin')}}</label>
                                        <label class="lbUrlHome" style="display: none">{{route('home')}}</label>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="{{route('forgot')}}">Esqueceu a senha?</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('Template/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('Template/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('Template/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('Template/js/sb-admin-2.min.js')}}"></script>

    <script src="{{asset('js/login.js')}}"> </script>

</body>

</html>
