@extends('layoutPadrao.index')
@section('Titulo')
Callflex Youniversity - Dashboard
@endsection


@section('Content')
<!-- Begin Page Content -->
<link href="{{asset('Template/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary textTipo">{{$tipo}}</h6>
            <div class="btnExport btn-group"></div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            @foreach ($Title as $val )
                            <th>{{$val}}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        <?php $contador =0;?>
                        @if ($tipo == "Usuarios Cadastrados")
                            @foreach ($coteudoTable as  $value)
                                <?php $contador++;?>
                                <tr>
                                    <td>{{$contador}}</td>
                                    <td>{{$value->display_name}}</td>
                                    <td>{{$value->user_nicename}}</td>
                                    <td>{{$value->user_email}}</td>
                                    <td>{{ \Carbon\Carbon::parse($value->user_registered)->format('d/m/Y H:i:s')}}</td>
                                </tr>
                            @endforeach
                        @elseif($tipo == "Inscrições em curso" || $tipo == "Certificados Emitidos")
                            @foreach ($coteudoTable as  $value)
                                <?php $contador++;?>
                                <tr>
                                    <td>{{$contador}}</td>
                                    <td>{{$value->display_name}}</td>
                                    <td>{{$value->user_nicename}}</td>
                                    <td>{{$value->user_email}}</td>
                                    <td>{{$value->course}}</td>
                                    <td>{{ \Carbon\Carbon::parse($value->date_recorded)->format('d/m/Y H:i:s')}}</td>
                                </tr>
                            @endforeach
                        @elseif($tipo == "Cursos Publicados")
                            @foreach ($coteudoTable as  $value)
                                <?php $contador++;?>
                                <tr>
                                    <td>{{$contador}}</td>
                                    <td>{{$value->id_course}}</td>
                                    <td>{{$value->course}}</td>
                                    <td>{{$value->duracao}}</td>
                                </tr>
                            @endforeach
                        @elseif($tipo == "Acessos" || $tipo =="Acessos Hoje")
                            @foreach ($coteudoTable as  $value)
                                <?php $contador++;?>
                                <tr>
                                    <td>{{$contador}}</td>
                                    <td>{{$value->display_name}}</td>
                                    <td>{{$value->user_nicename}}</td>
                                    <td>{{$value->user_email}}</td>
                                    <td>{{ \Carbon\Carbon::parse($value->DataHora)->format('d/m/Y H:i:s')}}</td>
                                </tr>
                            @endforeach
                        @endif

                    </tbody>
                </table>
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



<script>

    var table = $('#dataTable').DataTable({
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });
    new $.fn.dataTable.Buttons( table, {
        buttons: [
                    { extend: 'csv' , text: 'csv',className:'btn btn-info '},
                    { extend: 'excel' , text: 'excel',className:'btn btn-info '},
                    { extend: 'pdf' , text: 'pdf',className:'btn btn-info '},
                    { extend: 'print' , text: 'Imprimir',className:'btn btn-info '}
                ]
    } );

    table.buttons( 1, null ).container().appendTo(
        $('.btnExport')
    );
</script>
<style>
.btnExport{
    float: right;
}
.textTipo{
    float: left;
}
</style>

@endsection
