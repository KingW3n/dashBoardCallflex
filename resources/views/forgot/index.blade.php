@extends('forgot.template')

@section('Title')
    Callflex - Esqueceu a senha
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block ">
                            <img src="{{asset('img/1665b158b55ec87c9c7c6cebc3d702d0-covid-19-sintoma-de-dor-de-cabeca-de-carater.png')}}">
                        </div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-2">Esqueceu a senha?</h1>
                                    <p class="mb-4">
                                        Nós entendemos, coisas acontecem. Basta inserir seu endereço de e-mail!</p>
                                </div>
                                <form class="forgotUser" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label class="lbUrl" for="" style="display: none">{{route('enviarCode')}}</label>
                                        <label class="lbEnterCode" for="" style="display: none">{{route('enterCode')}}</label>
                                        <input type="email" class="form-control form-control-user"
                                            id="exampleInputEmail"  name="email" aria-describedby="emailHelp"
                                            placeholder="E-mail" required>
                                    </div>
                                    <button class="btn btn-primary btn-user btn-block">
                                        Enviar
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

       <script src="{{asset('js/forgot.js')}}"> </script>

@endsection
