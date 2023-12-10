@extends('back.template.base')

@section('title','Editar usuario')

@section('css')
	<link href="{{ asset('back/assets/plugins/bootstrap-select2/select2.css') }}" rel="stylesheet" type="text/css" media="screen" />
@endsection

@section('content')

<ul class="breadcrumb">
    <li>
      <p>Ud esta aquí</p>
    </li>
    <li><a href="{{ route('usuarios.index') }}">Usuarios</a> </li>
    <li><a href="#" class="active">Edición</a> </li>
  </ul>
  <div class="page-title"> <i class="icon-custom-right"></i>
    <h3>Editar <span class="semi-bold">Usuario</span></h3>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="grid simple form-grid">
        <div class="grid-title no-border">
          <h4>Datos <span class="semi-bold">Usuario</span></h4>
        </div>
        <div class="grid-body no-border">
          <br>
            <form id="form_iconic_validation" action="{{ route('usuarios.update',$usuario->id) }}" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}
              <input type="hidden" name="_method" value="PUT">
              <div class="form-group">
                <label class="form-label">Nombre</label>
                <span class="help">eg: "Nombre Apellido"</span>
                <div class="input-with-icon  right">
                  <i class=""></i>
                  <input type="text" name="name" id="name" value="{{ $usuario->name }}" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="form-label">Email</label>
                <span class="help">eg: "usuario@test.com"</span>
                <div class="input-with-icon  right">
                  <i class=""></i>
                  <input type="email" name="email" id="email" value="{{ $usuario->email }}" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="form-label">Contraseña</label>
                <div class="input-with-icon  right">
                  <i class=""></i>
                  <input type="password" name="password" id="password" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="form-label">Imagen</label>
                <div class="input-with-icon  right">
                  <i class=""></i>
                  <input type="file" name="imagen" id="imagen" class="form-control">
                </div>
                @if($usuario->imagen)
                  <img src="{{ asset('front/img/users/'.$usuario->imagen) }}" width="160" height="160" alt="{{ $usuario->name }}">
                @endif
              </div>
              <div class="form-actions">
                <div class="pull-right">
                  <button type="submit" class="btn btn-danger btn-cons"><i class="icon-ok"></i> Guardar</button>
                  <a href="{{ route('usuarios.index') }}" class="btn btn-white btn-cons">Cancelar</a>
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