@extends('back.template.base')

@section('title','Nuevo formulario')

@section('css')
	<link href="{{ asset('back/assets/plugins/bootstrap-select2/select2.css') }}" rel="stylesheet" type="text/css" media="screen" />
@endsection

@section('content')

<ul class="breadcrumb">
    <li>
      <p>Ud esta aquí</p>
    </li>
    <li><a href="{{ route('miembros.index') }}">Miembros</a> </li>
    <li><a href="#" class="active">Creación</a> </li>
  </ul>
  <div class="page-title"> <i class="icon-custom-right"></i>
    <h3>Nuevo <span class="semi-bold">Miembro</span></h3>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="grid simple form-grid">
        <div class="grid-title no-border">
          <h4>Datos <span class="semi-bold">Miembro</span></h4>
        </div>
        <div class="grid-body no-border">
          <br>
            <form id="form_iconic_validation" action="{{ route('miembros.store') }}" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="form-group">
                <label class="form-label">Nombre</label>
                <span class="help">eg: "Juan Perez"</span>
                <div class="input-with-icon  right">
                  <i class=""></i>
                  <input type="text" name="nombre" id="nombre" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="form-label">Puesto</label>
                <span class="help">eg: "Director Financiero o Alcalde"</span>
                <div class="input-with-icon  right">
                  <i class=""></i>
                  <input type="text" name="puesto" id="puesto" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="form-label">Cargo</label>
                <span class="help">eg: "Miembro o Presidente del Directorio"</span>
                <div class="input-with-icon  right">
                  <i class=""></i>
                  <input type="text" name="cargo" id="cargo" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="form-label">Tipo</label>
                <div class="input-with-icon  right">
                  <i class=""></i>
                  <select name="tipo" id="tipo" class="form-control">
                    <option value="directivo">Directivo</option>
                    <option value="administrativo">Administrativo</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="form-label">Imagen</label>
                <span class="help">eg: "foto.png 780w*1000h"</span>
                <div class="input-with-icon  right">
                  <i class=""></i>
                  <input type="file" name="imagen" id="imagen" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="form-label">Email</label>
                <span class="help">eg: "juan.perez@gmail.com"</span>
                <div class="input-with-icon  right">
                  <i class=""></i>
                  <input type="email" name="email" id="email" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="form-label">Facebook</label>
                <span class="help">eg: "https://www.facebook.com/Movilidad-Cotopaxi-Epmc-109619743719632"</span>
                <div class="input-with-icon  right">
                  <i class=""></i>
                  <input type="url" name="facebook" id="facebook" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="form-label">Twitter</label>
                <span class="help">eg: "https://twitter.com/epmc2017"</span>
                <div class="input-with-icon  right">
                  <i class=""></i>
                  <input type="url" name="twitter" id="twitter" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="form-label">Orden</label>
                <div class="input-with-icon  right">
                  <i class=""></i>
                  <input type="number" name="orden" id="orden" value="0" class="form-control">
                </div>
              </div>
              <div class="form-actions">
                <div class="pull-right">
                  <button type="submit" class="btn btn-danger btn-cons"><i class="icon-ok"></i> Guardar</button>
                  <a href="{{ route('miembros.index') }}" class="btn btn-white btn-cons">Cancelar</a>
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