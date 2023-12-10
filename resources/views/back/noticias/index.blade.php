@extends('back.template.base')

@section('title','Noticias')

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
    <li><a href="{{ route('noticias.index') }}" class="active">Noticias</a> </li>
  </ul>
  <div class="page-title"> <i class="icon-custom-right"></i>
    <h3>Listado <span class="semi-bold">Noticias</span></h3>
  </div>
  <div class="row-fluid">
    <div class="span12">
      <div class="grid simple ">
        <div class="grid-title">
          <h4>
            Listado <span class="semi-bold">Noticias</span>
            @can('crear noticias')
            <a href="{{ route('noticias.create') }}" class="btn btn-default" title="Nueva noticia">
              <i class="fa fa-plus"></i>
              Nueva noticia
            </a>
            @endcan
          </h4>
        </div>
        <div class="grid-body ">
          @include('back.template.alerts')
          <table class="table table-striped" id="example2">
            <thead>
              <tr>
                <th>Noticia</th>
                <th>Estado</th>
                <th>Tags</th>
                <th>Autor</th>
                <th>Fecha</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach($noticias as $noticia)
              <tr class="odd gradeX" id="item{{ $noticia->id }}">
                <td>
                   @if($noticia->destacada)
                   <i class="fa fa-star"></i>
                   @endif
                    {{ $noticia->titulo }} <br>
                    <small>{{ $noticia->slug }}</small>
                </td>
                <td class="center">{{ $noticia->estado }}</td>
                <td class="center">{{ $noticia->tags }}</td>
                <td class="center">{{ $noticia->autor->name }}</td>
                <td class="center">
                  {{ $noticia->fecha }} <br>
                  {{ $noticia->fecha->diffForHumans() }}
                </td>
                <td>
                  <a href="{{ route('noticia', $noticia->slug) }}" title="Ver" target="_blank" class="btn btn-success"><i class="fa fa-eye"></i></a>
                  @can('editar noticias')
                  <a href="{{ route('noticias.edit', $noticia->id) }}" title="Editar" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                  @endcan
                  @can('eliminar noticias')
                  <a href="{{ route('noticias.destroy', $noticia->id) }}" title="Eliminar" class="btn btn-danger btn-delete-item"><i class="fa fa-trash"></i></a>
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