@extends('back.template.base')

@section('title','Nueva consulta')

@section('css')
	<link href="{{ asset('back/assets/plugins/bootstrap-select2/select2.css') }}" rel="stylesheet" type="text/css" media="screen" />
@endsection

@section('content')

<ul class="breadcrumb">
    <li>
      <p>Ud esta aquí</p>
    </li>
    <li><a href="{{ route('categorias.index') }}">Categorias</a> </li>
    <li><a href="#" class="active">Creación</a> </li>
  </ul>
  <div class="page-title"> <i class="icon-custom-right"></i>
    <h3>Nueva <span class="semi-bold">Categoría</span></h3>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="grid simple form-grid">
        <div class="grid-title no-border">
          <h4>Datos <span class="semi-bold">Categoría</span></h4>
        </div>
        <div class="grid-body no-border">
          <br>
            <form id="form_iconic_validation" action="{{ route('categorias.store') }}" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="form-group">
                <label class="form-label">Categoria</label>
                <span class="help">eg: "Ordenanzas"</span>
                <div class="input-with-icon  right">
                  <i class=""></i>
                  <input type="text" name="categoria" id="categoria" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="form-label">Descripción</label>
                <span class="help">eg: "Contiene informacion relacionada a..."</span>
                <div class="input-with-icon  right">
                  <i class=""></i>
                  <input type="text" name="descripcion" id="descripcion" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="form-label">Icono</label>
                <span class="help">eg: "icono.png"</span>
                <div class="input-with-icon  right">
                  <i class=""></i>
                  <input type="input" name="icono" id="icono" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="form-label">Externo</label>
                <span class="help">eg: "Enlace externo"</span>
                <div class="input-with-icon  right">
                  <i class=""></i>
                  <input type="checkbox" name="externo" id="externo" value="1" class="form-control">
                </div>
              </div>
              <div class="form-actions">
                <div class="pull-right">
                  <button type="submit" class="btn btn-danger btn-cons"><i class="icon-ok"></i> Guardar</button>
                  <a href="{{ route('categorias.index') }}" class="btn btn-white btn-cons">Cancelar</a>
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