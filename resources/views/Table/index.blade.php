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
            <h6 class="m-0 font-weight-bold text-primary">{{$tipo}}</h6>
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
                    <tfoot>
                        <tr>
                            @foreach ($Title as $val )
                            <th>{{$val}}</th>
                            @endforeach
                        </tr>
                    </tfoot>
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
                                <td>{{$value->user_registered}}</td>
                            </tr>
                            @endforeach
                        @else

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
<script>
    $('#dataTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
</script>


@endsection
