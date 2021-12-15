@extends('layoutPadrao.index')
@section('Titulo')
Callflex Youniversity - Categorias
@endsection


@section('Content')
<div class="container-fluid">
    <center><div class="col-xl-6 col-lg-5 mt-5">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="font-weight-bold ">Categorias</h6>
                <div class="dropdown no-arrow">
            </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <table id="planilhaCategoria" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $contador =0;?>
                @foreach ($Categoria as $value )
                <?php $contador ++;?>
                    @if ($value->status == "Ativo")
                        <tr>
                            <td scope="row">{{$contador}}</td>
                            <td>{{ $value-> categoria}}</td>
                            <td><center><div class="toggle"><input type="checkbox" id="{{ $value->ID  }}" checked><label for="{{ $value->ID  }}"></label></div></center></td>
                        </tr>
                    @else
                    <tr>
                        <td scope="row">{{ $contador}}</td>
                        <td>{{ $value-> categoria}}</td>
                        <td><center><div class="toggle"><input type="checkbox" id="{{ $value->ID  }}"><label for="{{ $value->ID  }}"></label></div></center></td>
                    </tr>
                    @endif
                @endforeach
                    </tbody>
                </table>
                <br>
                <center><button type="button" id="salvarAtivarCategorias" class="btn btn-primary">Salvar</button></center>

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





</div>


<!-- Page level plugins -->
<script src="{{asset('Template/vendor/jquery/jquery.min.js')}}"></script>


 <!-- Bootstrap core JavaScript-->
 <script src="{{asset('Template/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

 <!-- Core plugin JavaScript-->
 <script src="{{asset('Template/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
 <script src="{{ asset('js/categoria.js') }}"></script>

 <style>
    .toggle {padding: 5px;}
    .toggle > input {display: none;}
    .toggle > label {position: relative;display: block;height: 20px;width: 44px;background: #898989;border-radius: 100px;cursor: pointer;transition: all 0.3s ease;}
    .toggle > label:after {position: absolute;left: -2px;top: -3px;display: block;width: 26px;height: 26px;border-radius: 100px;background: #fff;box-shadow: 0px 3px 3px rgba(0,0,0,0.05);content: '';transition: all 0.3s ease;}
    .toggle > label:active:after {transform: scale(1.15, 0.85);}
    .toggle > input:checked ~ label {background: #6fbeb5;}
    .toggle > input:checked ~ label:after {left: 20px;background: #179588;}
    .toggle > input:disabled ~ label {background: #d5d5d5;pointer-events: none;}
    .toggle > input:disabled ~ label:after {background: #bcbdbc;}
    #Categoria .Categoria_Bx{width: 47%;height: auto;box-shadow: 0 0 5px gray;border-radius: 10px;float: left;margin-left: 2%;margin-top: 50px;margin-bottom: 100px;}
    #Categoria #BoxPlanilha #planilhaC_1{width: 80%;float: left;margin-left: 10%;margin-top: 50px;margin-bottom: 50px;}
    #Categoria #BoxPlanilha #planilhaC_1 #planilhaCategoria{text-align: center;}

 </style>
@endsection
