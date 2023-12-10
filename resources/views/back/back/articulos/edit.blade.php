@extends('back.template.base')

@section('title','Edición consulta')

@section('css')
  <link href="{{ asset('back/assets/plugins/bootstrap-select2/select2.css') }}" rel="stylesheet" type="text/css" media="screen" />
@endsection

@section('content')

<ul class="breadcrumb">
    <li>
      <p>Ud esta aquí</p>
    </li>
    <li><a href="{{ route('consultas.index') }}">Consultas</a> </li>
    <li><a href="#" class="active">Edición</a> </li>
  </ul>
  <div class="page-title"> <i class="icon-custom-right"></i>
    <h3>Edición <span class="semi-bold">Consulta</span></h3>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="grid simple form-grid">
        <div class="grid-title no-border">
          <h4>Datos <span class="semi-bold">Consulta</span></h4>
        </div>
        <div class="grid-body no-border">
          <br>
            <form id="form_iconic_validation" action="{{ route('consultas.update',$consulta->id) }}" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}
              <input type="hidden" name="_method" value="PUT">
              <div class="form-group">
                <label class="form-label">Nombre</label>
                <span class="help">eg: "Concesión de Permiso de Operación"</span>
                <div class="input-with-icon  right">
                  <i class=""></i>
                  <input type="text" name="nombre" id="nombre" value="{{ $consulta->nombre }}" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="form-label">Descripción</label>
                <span class="help">eg: "Necesario para ..."</span>
                <div class="input-with-icon  right">
                  <i class=""></i>
                  <input type="text" name="descripcion" id="descripcion" value="{{ $consulta->descripcion }}" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="form-label">URL</label>
                <span class="help">eg: "https://srienlinea.sri.gob.ec/sri-en-linea/inicio/NAT"</span>
                <div class="input-with-icon  right">
                  <i class=""></i>
                  <input type="text" name="url" id="url" value="{{ $consulta->url }}" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="form-label">Externo</label>
                <span class="help">eg: "Enlace externo"</span>
                <div class="input-with-icon  right">
                  <i class=""></i>
                  <input type="checkbox" name="externo" id="externo" @if($consulta->externo) checked @endif value="1" class="form-control">
                </div>
              </div>
              <div class="form-actions">
                <div class="pull-right">
                  <button type="submit" class="btn btn-danger btn-cons"><i class="icon-ok"></i> Guardar</button>
                  <a href="{{ route('consultas.index') }}" class="btn btn-white btn-cons">Cancelar</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')
<script src="{{ asset('back/assets/plugins/datatables-responsive/js/lodash.min.js') }}" type="text/javascript"></script>
<!-- END PAGE LEVEL JS INIT -->
<!-- END JAVASCRIPTS -->
@endsection