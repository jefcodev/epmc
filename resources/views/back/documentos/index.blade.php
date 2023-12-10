@extends('back.template.base')

@section('title','Documentos')

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
    <li><a href="{{ route('documentos.index') }}" class="active">Documentos</a> </li>
  </ul>
  <div class="page-title"> <i class="icon-custom-right"></i>
    <h3>Listado <span class="semi-bold">Documentos</span></h3>
  </div>
  <div class="row-fluid">
    <div class="span12">
      <div class="grid simple ">
        <div class="grid-title">
          <h4>
            Listado <span class="semi-bold">Documentos</span>
            <a href="{{ route('documentos.create') }}" class="btn btn-default" title="Nuevo documento">
              <i class="fa fa-plus"></i>
              Nuevo documento
            </a>
            <span class="pull-right">
            <select name="categoria" id="categoria" class="form-control">
              <option value="all">Todas las categorías</option>
              @foreach($categorias as $key => $cat)
                <option value="{{ $key }}" @if($key==$categoria) selected @endif >{{ $cat }}</option>
              @endforeach
            </select>
            </span>
          </h4>
        </div>
        <div class="grid-body ">
          @include('back.template.alerts')
          <table class="table table-striped" id="example2">
            <thead>
              <tr>
                <th>Documento</th>
                <th>Descripción</th>
                <th>Categoria</th>
                <th>Fecha</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach($documentos as $documento)
              <tr class="odd gradeX" id="item{{ $documento->id }}">
                <td>
                    <a href="{{ asset('uploads/'.$documento->ruta) }}" target="_blank">{{ $documento->nombre }}</a>
                </td>
                <td class="center">{{ $documento->descripcion }}</td>
                <td class="center">{{ $documento->categoria->categoria }}</td>
                <td class="center">{{ $documento->fecha }}</td>
                <td>
                  @can('editar documentos')
                  <a href="{{ route('documentos.edit', $documento->id) }}" title="Editar" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                  @endcan
                  @can('eliminar documentos')
                  <a href="{{ route('documentos.destroy', $documento->id) }}" title="Eliminar" class="btn btn-danger btn-delete-item"><i class="fa fa-trash"></i></a>
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
<script>
  $(document).on('change','#categoria',function(e){
      var valor = $(this).val();
        var url = "{{ route('documentos.index') }}?categoria="+valor;
        window.location = url;
    });
  </script>  
@include('back.template.delete_script')
<!-- END JAVASCRIPTS -->
@endsection