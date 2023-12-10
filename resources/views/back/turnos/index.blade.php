@extends('back.template.base')

@section('title','Turnos')

@section('css')
  <link href="{{ asset('back/assets/plugins/bootstrap-select2/select2.css') }}" rel="stylesheet" type="text/css" media="screen" />
  <link href="{{ asset('back/assets/plugins/jquery-datatable/css/jquery.dataTables.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('back/assets/plugins/datatables-responsive/css/datatables.responsive.css') }}" rel="stylesheet" type="text/css" media="screen" />
@endsection

@section('content')

  <ul class="breadcrumb">
    <li>
      <p>Ud esta aquí</p>
    </li>
    <li><a href="{{ route('turnos.index') }}" class="active">Turnos</a> </li>
  </ul>
  <div class="page-title"> <i class="icon-custom-right"></i>
    <h3>Listado <span class="semi-bold">Turnos</span></h3>
  </div>
  <div class="row-fluid">
    <div class="span12">
      <div class="grid simple ">
        <div class="grid-title">
          <h4>
            Listado <span class="semi-bold">Turnos</span>
            @can('crear turnero')
            <a href="{{ route('turnos.create') }}" class="btn btn-default" title="Nuevo turno">
              <i class="fa fa-plus"></i>
              Nuevo turno
            </a>
            @endcan

          </h4>
        </div>
        <div class="grid-body ">
          @include('back.template.alerts')
          <table class="table table-striped" id="turnos-table">
            <thead>
              <tr>
                <th>Turno</th>
                <th>Fecha</th>
                <th>CI</th>
                <th>Placa</th>
                <th>Tramite</th>
                <th>Sucursal</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <!-- <tbody>
              @foreach($turnos as $turno)
              <tr class="odd gradeX" id="item{{ $turno->id }}">
                <td>
                    @if($turno->especial)
                    <span class="badge"><i class="fa fa-star"></i></span> 
                    @endif
                    {{ $turno->turno }}
                </td>
                <td class="center">
                  {{  $turno->fecha->format('d/m/Y') }} <br>
                  {{ $turno->fecha->format('H:i:s') }}
                </td>
                <td class="center">{{ $turno->cedula }}</td>
                <td class="center">{{ $turno->placa }}</td>
                <td class="center">{{ $turno->requisito->nombre }}</td>
                <td class="center">{{ $turno->sucursal->nombre }}</td>
                <td>
                  @can('imprimir turnero')
                  <a href="{{ route('turnos.print',$turno->codigo_aux) }}" class="print btn btn-success " target="_blank" id="print" /><i class="fa fa-print"></i></a>
                  @endcan
                  @can('eliminar turnero')
                  <a href="{{ route('turnos.destroy', $turno->id) }}" title="Eliminar" class="btn btn-danger btn-delete-item"><i class="fa fa-trash"></i></a>
                  @endcan
                </td>
              </tr>
              @endforeach
            </tbody> -->
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')
<script src="{{ asset('back/assets/plugins/bootstrap-select2/select2.min.js') }}" type="text/javascript"></script>
<!-- <script src="{{ asset('back/assets/plugins/jquery-datatable/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('back/assets/plugins/jquery-datatable/extra/js/dataTables.tableTools.min.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('back/assets/plugins/datatables-responsive/js/datatables.responsive.js') }}"></script>
<script type="text/javascript" src="{{ asset('back/assets/plugins/datatables-responsive/js/lodash.min.js') }}"></script> -->

<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />

<!-- END PAGE LEVEL JS INIT -->
<!-- <script src="{{ asset('back/assets/js/datatables.js') }}" type="text/javascript"></script> -->
@include('back.template.delete_script')

<script>
  $(document).ready(function(){

    $('#turnos-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url: "{{ route('turnos.index') }}",
        },
        columns: [
          {
          data: 'turno',
          name: 'turno'
          },
          {
          data: 'fecha',
          name: 'fecha'
          },
          {
          data: 'cedula',
          name: 'cedula'
          },
          {
          data: 'placa',
          name: 'placa'
          },
          {
          data: 'requisito_id',
          name: 'requisito_id',
          render:function(data,type,full,meta){
                  return full.requisito.nombre;
              },
          },
          {
            data: 'sucursal_id',
            name: 'sucursal_id',
            render:function(data,type,full,meta){
                  return full.sucursal.nombre;
              },
          },
          {
          data: 'action',
          name: 'action',
          orderable: false
          }
        ]
        });
  });

</script>
<!-- END JAVASCRIPTS -->
@endsection