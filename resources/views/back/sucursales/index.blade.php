@extends('back.template.base')

@section('title','Sucursales')

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
    <li><a href="{{ route('sucursales.index') }}" class="active">Sucursales</a> </li>
    <li><a href="#" class="active">Creación</a> </li>
  </ul>
  <div class="page-title"> <i class="icon-custom-left"></i>
    <h3>Listado <span class="semi-bold">Sucursales</span></h3>
  </div>
  <div class="row-fluid">
    <div class="span12">
      <div class="grid simple ">
        <div class="grid-title">
          <h4>
            Listado <span class="semi-bold">Sucursales</span>
            <!--<a href="{{ route('sucursales.create') }}" class="btn btn-default" title="Nueva sucursal">
              <i class="fa fa-plus"></i>
              Nueva sucursal
            </a>-->
          </h4>
        </div>
        <div class="grid-body ">
          @include('back.template.alerts')
          <table class="table table-striped" id="example2">
            <thead>
              <tr>
                <th>Imagen</th>
                <th>Titulo</th>
                <th>Turnero</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach($sucursales as $sucursal)
              <tr class="odd gradeX" id="item{{ $sucursal->id }}">
                <td><img src="{{ asset('front/img/sucursal/'.$sucursal->imagen) }}" alt="{{ $sucursal->nombre }}" width="220" height="180" class="img-responsive"></td>
                <td>
                  {{ $sucursal->nombre }}<br>
                  <small>{{ $sucursal->telefono }} - {{ $sucursal->direccion }}</small>
                </td>
                <td class="center">
                  <a href="{{ route('sucursales.turnero', $sucursal->id) }}" title="Turnero" class="btn btn-primary"><i class="fa fa-app"></i>T</a>
                  <a href="{{ route('dias_especiales.index', $sucursal->id) }}" title="Dias especiales" class="btn btn-primary"><i class="fa fa-apps"></i>D</a>
                  <a href="{{ route('turnos.calendario', $sucursal->id) }}" title="Calendario" class="btn btn-primary"><i class="fa fa-calendar"></i></a>
                </td>
                <td>
                  <a href="{{ route('sucursales.edit', $sucursal->id) }}" title="Editar" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                  <a href="{{ route('sucursales.destroy', $sucursal->id) }}" title="Eliminar" class="btn btn-danger btn-delete-item"><i class="fa fa-trash"></i></a>
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