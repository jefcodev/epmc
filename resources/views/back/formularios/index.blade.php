@extends('back.template.base')

@section('title','Formularios')

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
    <li><a href="{{ route('formularios.index') }}" class="active">Formularios</a> </li>
  </ul>
  <div class="page-title"> <i class="icon-custom-right"></i>
    <h3>Listado <span class="semi-bold">Formularios</span></h3>
  </div>
  <div class="row-fluid">
    <div class="span12">
      <div class="grid simple ">
        <div class="grid-title">
          <h4>
            Listado <span class="semi-bold">Formularios</span>
            <a href="{{ route('formularios.create') }}" class="btn btn-default" title="Nuevo formulario">
              <i class="fa fa-plus"></i>
              Nuevo formulario
            </a>
          </h4>
        </div>
        <div class="grid-body ">
          @include('back.template.alerts')
          <table class="table table-striped" id="example2">
            <thead>
              <tr>
                <th>Formulario</th>
                <th>Descripción</th>
                <th>Documento</th>
                <th>Orden</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach($formularios as $formulario)
              <tr class="odd gradeX" id="item{{ $formulario->id }}">
                <td>
                    {{ $formulario->nombre }}
                </td>
                <td class="center">{{ $formulario->descripcion }}</td>
                <td class="center"><a href="{{ asset('uploads/'.$formulario->ruta) }}" target="_blank">{{ $formulario->nombre }}</a></td>
                <td class="center">{{ $formulario->orden }}</td>
                <td>
                  @can('editar formularios')
                  <a href="{{ route('formularios.edit', $formulario->id) }}" title="Editar" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                  @endcan
                  @can('eliminar formularios')
                  <a href="{{ route('formularios.destroy', $formulario->id) }}" title="Eliminar" class="btn btn-danger btn-delete-item"><i class="fa fa-trash"></i></a>
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