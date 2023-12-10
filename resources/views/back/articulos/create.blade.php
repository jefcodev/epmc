@extends('back.template.base')

@section('title','Nuevo Artículo')

@section('css')
	<link href="{{ asset('back/assets/plugins/bootstrap-select2/select2.css') }}" rel="stylesheet" type="text/css" media="screen" />
@endsection

@section('content')

<ul class="breadcrumb">
    <li>
      <p>Ud esta aquí</p>
    </li>
    <li><a href="{{ route('articulos.index') }}">Artículos</a> </li>
    <li><a href="#" class="active">Creación</a> </li>
  </ul>
  <div class="page-title"> <i class="icon-custom-right"></i>
    <h3>Nuevo <span class="semi-bold">Artículo</span></h3>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="grid simple form-grid">
        <div class="grid-title no-border">
          <h4>Datos <span class="semi-bold">Artículo</span></h4>
        </div>
        <div class="grid-body no-border">
          <br>
            <form id="form_iconic_validation" action="{{ route('articulos.store') }}" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="form-group">
                <label class="form-label">Literal</label>
                <span class="help">eg: "a"</span>
                <div class="input-with-icon  right">
                  <i class=""></i>
                  <input type="text" name="literal" id="literal" class="form-control" required>
                </div>
              </div>
              <div class="form-group">
                <label class="form-label">Artículo</label>
                <span class="help">eg: "Artículo resumido"</span>
                <div class="input-with-icon  right">
                  <i class=""></i>
                  <input type="text" name="articulo" id="articulo" class="form-control" required>
                </div>
              </div>
              <div class="form-group">
                <label class="form-label">Descripción</label>
                <span class="help">eg: ""</span>
                <div class="input-with-icon  right">
                  <i class=""></i>
                  <input type="text" name="descripcion" id="descripcion" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="form-label">Orden</label>
                <span class="help">eg: ""</span>
                <div class="input-with-icon  right">
                  <i class=""></i>
                  <input type="number" name="orden" id="orden" class="form-control">
                </div>
              </div>
              <div class="form-actions">
                <div class="pull-right">
                  <button type="submit" class="btn btn-danger btn-cons"><i class="icon-ok"></i> Guardar</button>
                  <a href="{{ route('articulos.index') }}" class="btn btn-white btn-cons">Cancelar</a>
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