@extends('forgot.template')

@section('Title')
    Callflex - Valide o codigo
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block " style="padding: 10%">
                            <img src="{{asset('img/codigo.png')}}" width="100%">
                        </div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-2">Insira o codigo</h1>
                                    <p class="mb-4">
                                        Nós enviamos o codigo de verificação para o E-mail informado. </p>
                                </div>
                                <form class="FormVerificarCodigo" method="POST">
                                    @csrf
                                    <input type="hidden" class="lbUrl" name="" value="{{route('verificarCode')}}">
                                    <input type="hidden" class="lbEnterCode" name="" value="{{route('NewSenha')}}">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user"
                                            id="inputCode" aria-describedby="pinCode"
                                            placeholder="Codigo de verificação" name="codigo">

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
