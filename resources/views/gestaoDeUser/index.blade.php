@extends('layoutPadrao.index')
@section('Titulo')
Callflex Youniversity - Gestão de Usuário
@endsection


@section('Content')

<div class="modal fade" id="modalConfirmacao" tabindex="-1" role="dialog" aria-labelledby="modalConfirmacao" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Adicionar Perfil ADM ao Usuario ?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body"><center>Lembramos que caso aplique perfil adm esse usuario pode:</center>
                <br>
                <li>Atribuir perfil ADM</li>
                <li>Remover perfil ADM</li>
                <li>Remover usuarios do Dashboard</li>
            </div>
            <input type="hidden" id="IdUserModal" name="IdUserModal" value="">
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                <a class="btn btn-primary" onclick="AdicionarAdmin()">Atribuir Pefil</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalConfirmacaoRemover" tabindex="-1" role="dialog" aria-labelledby="modalConfirmacaoRemover" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Remover Perfil ADM ao Usuario ?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body"><center>Deseja realmente remover o perfil adm do usuário?</center>
            </div>
            <input type="hidden" id="IdUserModalRemover" name="IdUserModalRemover" value="">
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                <a class="btn btn-primary" onclick="RemoverAdmin()">Remover Pefil</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalConfirmacaoExcluirUser" tabindex="-1" role="dialog" aria-labelledby="modalConfirmacaoExcluirUser" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Remover o acesso do Usuario?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body"><center>Lembramos que caso decida remover, o usuario perde todos os acessos ao Dashboard YOUNiversity</center>
            </div>
            <input type="hidden" id="IdUserModalRemoverAcesso" name="IdUserModalRemoverAcesso" value="">
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                <a class="btn btn-primary" onclick="removerUser()">Remover Acesso</a>
            </div>
        </div>
    </div>
</div>


<!-- Begin Page Content -->
<link href="{{asset('Template/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Gestão de Usuários </h1>
    </div>
    <div class="row BoxCardCategorias">
        <!-- Pie Chart -->
        <div class="col-xl-3 col-lg-5">
        </div>
        <div class="col-xl-6 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold ">  Usuários </h6>
                    <div class="dropdown no-arrow">
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class=" conteudoBoxCategorias border rounded">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col" style="width:90px;"><center>status</center></th>
                                    <th scope="col" style="width:150px;"><center>Remover</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $contadorJ = 1?>
                                @foreach ($user as $value)
                                @if ($value->display_name!="")
                                    <tr class="tr_{{ $value->ID }}">
                                        <th scope="row" style="vertical-align: middle;"><?php echo $contadorJ++ ?></th>
                                        <td style="vertical-align: middle;">{{ $value->display_name }}</td>
                                        @if ($value->perfil == "Admin")
                                            <td style="vertical-align: middle;"> <div class="op_Menu{{ $value->ID }}" style="color: green;border: 2px solid green;text-align: center;border-radius: 5px; cursor: pointer;" onclick="RemoverAdminAbrirModal({{ $value->ID }})">Admin</div></td>
                                        @else
                                            <td style="vertical-align: middle;"> <div class="op_Menu{{ $value->ID }}" style="color: red;border: 2px solid red;text-align: center;border-radius: 5px; cursor: pointer;" onclick="AdicionarAdminAbrirModal({{ $value->ID }})">Admin</div></td>
                                        @endif
                                        <td style="vertical-align: middle;"><center><i class="fas fa-user-minus" style="cursor: pointer;" onclick="removerUserModal({{ $value->ID }})"></i></center></td>

                                    </tr>

                                @endif
                                @endforeach

                            </tbody>
                        </table>

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

<script src="{{ asset('js/gestaoUser.js') }}"></script>


<script>


</script>

@endsection
