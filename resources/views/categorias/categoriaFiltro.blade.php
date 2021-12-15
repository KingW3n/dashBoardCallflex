@extends('layoutPadrao.index')
@section('Titulo')
Callflex Youniversity - Grupos de Usuários
@endsection


@section('Content')
<!-- Modal Usuarios categoria -->
<div class="modal fade" id="modalUsuariosCategorias" tabindex="-1" role="dialog" aria-labelledby="modalFiltroDashboardTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalFiltroDashboardTitle">Adicionar Usuário</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form class="formModalUsuariosCategorias">
                @csrf
                <div class="bodyModalUsuariosCategorias">

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btnAplicarFiltro">Aplicar</button>
                </div>
            </form>
        </div>
      </div>
    </div>
</div>
<!-- Modal confirm -->
  <div class="modal fade" id="modalConfirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Deletar Grupo de Usuário</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <input type="hidden" id="idDeletar">
                <div class="modal-body">Ao deletar o grupo de usuário não sera mais possivel selecionar no filtro do dashBoard.<br><br>Deseja mesmo deletar?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" onclick="excluirCategoria()">Deletar</a>
                </div>
            </div>
        </div>
    </div>

<!-- modalCriarCategoria -->
<div class="modal fade" id="modalCriarCategoria" tabindex="-1" role="dialog" aria-labelledby="modalFiltroDashboardTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCriarCategoria">Novo Grupo de Usuário</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form class="formModalCriarCategoria">
                @csrf
                <center>
                    <div class="form-group mt-5">
                        <input type="text" class="form-control w-75" id="idCategoria" name="categoria" placeholder="Nome da Categoria">
                        <div id="invalidMensagemCategoria" class="invalid-feedback">
                            Categoria inserida invalida
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btnCadastrarCategoria mt-5 mb-5">Cadastrar</button>
                </center>
            </form>
        </div>
      </div>
    </div>
</div>
<!-- Begin Page Content -->
<link href="{{asset('Template/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Grupos de Usuários </h1>
        <div>
            <a href="" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm btnVGD" >Visualizar Desativados</a>
            <a href="" class="d-none  btn btn-sm btn-danger shadow-sm btnNVGD" >Não Visualizar Desativados</a>
            <a href="" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm btnModalAdicionar"><i class="fas fa-plus-circle"></i> Adicionar</a>
        </div>
    </div>
    <div class="row BoxCardCategorias">
        <!-- Pie Chart -->
        <div class="col-xl-6 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold ">  titulo </h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Ações:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Excluir</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class=" conteudoBoxCategorias border rounded">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="{{asset('Template/vendor/jquery/jquery.min.js')}}"></script>
  <!-- Bootstrap core JavaScript-->
  <script src="{{asset('Template/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{asset('Template/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{asset('Template/js/sb-admin-2.min.js')}}"></script>

  <!-- Page level plugins -->
  <script src="{{asset('Template/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('Template/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>


<script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>


<script src="{{ asset('js/categoria.js') }}"></script>
<script>
preencherCategorias();

</script>
<style>
    .conteudoBoxCategorias{
        overflow-y: scroll;
        height: 250px;

    }
.btnExport{
    float: right;
}
.textTipo{
    float: left;
}
.categoriasDesativadas{
    display: none;
}
.clssCursor{
    cursor: pointer;
}

</style>

@endsection
