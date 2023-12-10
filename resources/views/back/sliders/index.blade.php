@extends('back.template.base')

@section('title','Sliders')

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
    <li><a href="{{ route('sliders.index') }}" class="active">Sliders</a> </li>
    <li><a href="#" class="active">Creación</a> </li>
  </ul>
  <div class="page-title"> <i class="icon-custom-left"></i>
    <h3>Listado <span class="semi-bold">Sliders</span></h3>
  </div>
  <div class="row-fluid">
    <div class="span12">
      <div class="grid simple ">
        <div class="grid-title">
          <h4>
            Listado <span class="semi-bold">Sliders</span>
            @can('crear slider')
            <a href="{{ route('sliders.create') }}" class="btn btn-default" title="Nueva slider">
              <i class="fa fa-plus"></i>
              Nuevo slider
            </a>
            @endcan
          </h4>
        </div>
        <div class="grid-body ">
          @include('back.template.alerts')
          <table class="table table-striped" id="example2">
            <thead>
              <tr>
                <th>Imagen</th>
                <th>Titulo</th>
                <th>Boton</th>
                <th>Orden</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach($sliders as $slider)
              <tr class="odd gradeX" id="item{{ $slider->id }}">
                <td><img src="{{ asset('front/img/slider/'.$slider->imagen) }}" alt="{{ $slider->title }}" width="220" height="180" class="img-responsive"></td>
                <td>
                  @if($slider->visible)
                  <i class="fa fa-eye"></i>
                  @else
                  <i class="fa fa-eye-slash"></i>
                  @endif
                  {{ $slider->title }}<br>
                  <small>{{ $slider->subtitle }}</small>
                </td>
                <td class="center">
                    <a href="{{ $slider->url }}" title="{{ $slider->texto_boton }}">{{ $slider->texto_boton }}</a>
                </td>
                <td class="center">{{ $slider->orden }}</td>
                <td>
                  @can('editar slider')
                  <a href="{{ route('sliders.edit', $slider->id) }}" title="Editar" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                  @endcan
                  @can('eliminar slider')
                  <a href="{{ route('sliders.destroy', $slider->id) }}" title="Eliminar" class="btn btn-danger btn-delete-item"><i class="fa fa-trash"></i></a>
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