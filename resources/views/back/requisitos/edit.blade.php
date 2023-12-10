@extends('back.template.base')

@section('title','Edición formulario')

@section('css')
  <link href="{{ asset('back/assets/plugins/bootstrap-select2/select2.css') }}" rel="stylesheet" type="text/css" media="screen" />
@endsection

@section('content')

<ul class="breadcrumb">
    <li>
      <p>Ud esta aquí</p>
    </li>
    <li><a href="{{ route('requisitos.index') }}">Requisitos</a> </li>
    <li><a href="#" class="active">Edición</a> </li>
  </ul>
  <div class="page-title"> <i class="icon-custom-right"></i>
    <h3>Edición <span class="semi-bold">Requisito</span></h3>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="grid simple form-grid">
        <div class="grid-title no-border">
          <h4>Datos <span class="semi-bold">Requisito</span></h4>
        </div>
        <div class="grid-body no-border">
          <br>
            <form id="form_iconic_validation" action="{{ route('requisitos.update',$formulario->id) }}" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}
              <input type="hidden" name="_method" value="PUT">
              <div class="form-group">
                <label class="form-label"><i class="required">*</i> Nombre</label>
                <span class="help">eg: "Concesión de Permiso de Operación"</span>
                <div class="input-with-icon  right">
                  <i class=""></i>
                  <input type="text" name="nombre" id="nombre" value="{{ $formulario->nombre }}" class="form-control" required>
                </div>
              </div>
              <div class="form-group">
                <label class="form-label">Descripción</label>
                <span class="help">eg: "Necesario para ..."</span>
                <div class="input-with-icon  right">
                  <i class=""></i>
                  <input type="text" name="descripcion" id="descripcion" value="{{ $formulario->descripcion }}" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="form-label">Requisito</label>
                <span class="help">eg: "requisito.jpg"</span>
                <div class="input-with-icon  right">
                  <i class=""></i>
                  <input type="file" name="documento" id="documento" class="form-control">
                </div>
              </div>
              <div class="form-actions">
                <div class="pull-right">
                  <button type="submit" class="btn btn-danger btn-cons"><i class="icon-ok"></i> Guardar</button>
                  <a href="{{ route('requisitos.index') }}" class="btn btn-white btn-cons">Cancelar</a>
                </div>
              </div>
            </form>
        </div>
      </div>
    </div><!--/col-md-6-->
    @if($formulario->ruta)
    <div class="col-md-6">
      <div class="panel-body">
        <img src="{{ asset('requisitos/'.$formulario->ruta) }}" alt="{{ $formulario->nombre }}">
      </div>
    </div>
    @endif
  </div>
@endsection

@section('js')
<script src="{{ asset('back/assets/plugins/datatables-responsive/js/lodash.min.js') }}" type="text/javascript"></script>
<!-- END PAGE LEVEL JS INIT -->
<!-- END JAVASCRIPTS -->
@endsection