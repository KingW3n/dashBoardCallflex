@extends('forgot.template')

@section('Title')
    Callflex - Cadastrar Senha
@endsection

@section('content'
)
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block ">
                            <center><img style="margin-top: 200px; width:130px" src="{{asset('img/LogoCallflex verde.png')}}"></center>
                        </div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-2">Cadastre sua nova senha!</h1>
                                    <p class="mb-4">
                                        Seja Bem vindo a plataforma, agora basta criar uma nova senha, lembre-se de criar uma senha segura e não compartilhe com ninguém!</p>
                                </div>
                                <form class="formNovaSenha">
                                    @csrf
                                    <input type="hidden" name="Url" class="lbUrl" value="{{route('salvarNewCadastro')}}">
                                    <input type="hidden" name="UrlRedirect" class="lbEnterCode" value="{{route('indexLogin')}}">
                                    <input type="hidden" name="email" class="email" value="{{$email}}">
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user"
                                            id="inputSenha" aria-describedby="passwordHelp"
                                            placeholder="Senha" name="senha">
                                            <small id="emailHelp" class="form-text text-muted" style="font-size: 10px">
                                                Lembramos que a senha deve conter
                                                <li>1 Letra Maiúscula </li>
                                                <li>1 Letra minúscula </li>
                                                <li>1 Caractere especial</li>
                                                <li>1 Número</li>
                                                <li>Mais de 8 caracteres </li>
                                            </small>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user"
                                            id="inputConfirmarSenha" aria-describedby="passwordHelp"
                                            placeholder="Confirmação de senha" name="confirmarSenha">
                                            <div id="invalidMensagemSenha" class="invalid-feedback">
                                                Senha invalida
                                            </div>
                                    </div>
                                    <button class="btn btn-primary btn-user btn-block">
                                        Salvar
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="{{route('indexLogin')}}">Voltar para a tela de login</a>
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

     <script src="{{asset('js/convidarUser.js')}}"> </script>
@endsection
