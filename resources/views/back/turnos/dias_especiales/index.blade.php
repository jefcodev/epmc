@extends('back.template.base')

@section('title','Días especiales calendario')

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
    <li><a href="{{ route('sucursales.index') }}" class="active">{{ $sucursal->nombre }}</a> </li>
    <li><a href="{{ route('dias_especiales.index',$sucursal->id) }}" class="active">Días especiales calendario</a> </li>
  </ul>
  <div class="page-title"> <i class="icon-custom-right"></i>
    <h3>Listado <span class="semi-bold">Días especiales calendario</span></h3>
  </div>
  <div class="row-fluid">
    <div class="span12">
      <div class="grid simple ">
        <div class="grid-title">
          <h4>
            Listado <span class="semi-bold">Días especiales calendario</span>
            @can('crear dia_especial')
            <a href="{{ route('dias_especiales.create',$sucursal->id) }}" class="btn btn-default" title="Nuevo día">
              <i class="fa fa-plus"></i>
              Nuevo día
            </a>
            @endcan
          </h4>
        </div>
        <div class="grid-body ">
          @include('back.template.alerts')
          <table class="table table-striped" id="example2">
            <thead>
              <tr>
                <th>Fecha</th>
                <th>Turnero habilitado</th>
                <th>Turnos diarios</th>
                <th>Turnos separados</th>
                <th>Horario</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach($dias_especiales as $dia)
              <tr class="odd gradeX" id="item{{ $dia->id }}">
                <td class="center">{{  $dia->fecha->format('d/m/Y') }} <br>
                  {{ $dia->fecha->timestamp }}
                </td>
                <td class="center">{{ $dia->turnos_habilitados? 'SI' : 'NO' }}</td>
                <td class="center">{{ $dia->turnos_diarios }}</td>
                <td class="center">{{ $dia->turnos_separados }}</td>
                <td class="center">
                  {{ $dia->turnos_hora_inicio }} -
                  {{ $dia->turnos_hora_fin }}
                </td>
                <td>
                  @can('editar dia_especial')
                  <a href="{{ route('dias_especiales.edit', ['id'=>$dia->sucursal_id,'dias_especiale'=>$dia->id]) }}" title="Editar" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                  @endcan
                  @can('eliminar dia_especial')
                  <a href="{{ route('dias_especiales.destroy', $dia->id) }}" title="Eliminar" class="btn btn-danger btn-delete-item"><i class="fa fa-trash"></i></a>
                  @endcan
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')
<script src="{{ asset('back/assets/plugins/bootstrap-select2/select2.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('back/assets/plugins/jquery-datatable/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('back/assets/plugins/jquery-datatable/extra/js/dataTables.tableTools.min.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('back/assets/plugins/datatables-responsive/js/datatables.responsive.js') }}"></script>
<script type="text/javascript" src="{{ asset('back/assets/plugins/datatables-responsive/js/lodash.min.js') }}"></script>
<!-- END PAGE LEVEL JS INIT -->
<script src="{{ asset('back/assets/js/datatables.js') }}" type="text/javascript"></script>
@include('back.template.delete_script')
<!-- END JAVASCRIPTS -->
@endsection