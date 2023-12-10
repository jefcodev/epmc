@extends('back.template.base')

@section('title','Nuevo sucursal')

@section('css')
	<link href="{{ asset('back/assets/plugins/bootstrap-select2/select2.css') }}" rel="stylesheet" type="text/css" media="screen" />
	<link href="{{ asset('back/assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

<ul class="breadcrumb">
    <li>
      <p>Ud esta aquí</p>
    </li>
    <li><a href="{{ route('sucursales.index') }}">Sucursales</a> </li>
    <li><a href="#" class="active">Edición</a> </li>
  </ul>
  <div class="page-title"> <i class="icon-custom-right"></i>
    <h3>Editar <span class="semi-bold">Slider</span></h3>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="grid simple form-grid">
        <div class="grid-title no-border">
          <h4>Datos <span class="semi-bold">Slider</span></h4>
        </div>
        <div class="grid-body no-border">
          <br>
          <form id="form_iconic_validation" action="{{ route('sucursales.update', $sucursal->id) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group">
              <label class="form-label">Nombre</label>
              <span class="help">eg: "Sucursal Salcedo"</span>
              <div class="input-with-icon  right">
                <i class=""></i>
                <input type="text" name="title" id="title" value="{{ $sucursal->nombre }}" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="form-label">Dirección</label>
              <span class="help">eg: "Ubicada en"</span>
              <div class="input-with-icon  right">
                <i class=""></i>
                <input type="text" name="direccion" id="direccion" value="{{ $sucursal->direccion }}" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="form-label">Cantón</label>
              <span class="help">eg: "Salcedo"</span>
              <div class="input-with-icon  right">
                <i class=""></i>
                <input type="text" name="canton" id="canton" value="{{ $sucursal->canton }}" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="form-label">Teléfono</label>
              <span class="help">eg: "4455454"</span>
              <div class="input-with-icon  right">
                <i class=""></i>
                <input type="text" name="telefono" id="telefono" value="{{ $sucursal->telefono }}" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="form-label">Email</label>
              <span class="help">eg: "test@test.com"</span>
              <div class="input-with-icon  right">
                <i class=""></i>
                <input type="email" name="email" id="email" value="{{ $sucursal->email }}" class="form-control">
              </div>
            </div>

            <div class="form-group">
              <label class="form-label">Imagen</label>
              <div class="input-with-icon  right">
                <i class=""></i>
                <input type="file" name="imagen" id="imagen" class="form-control">
              </div>
              @if($sucursal->imagen)
                <img src="{{ asset('front/img/sucursal/'.$sucursal->imagen) }}" alt="{{ $sucursal->title }}" width="300" height="180">
              @endif
            </div>
            <div class="form-actions">
              <div class="pull-right">
                <button type="submit" class="btn btn-danger btn-cons"><i class="icon-ok"></i> Guardar</button>
                <a href="{{ route('sucursales.index') }}" class="btn btn-white btn-cons">Cancelar</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')
<script src="{{ asset('back/assets/plugins/bootstrap-select2/select2.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('back/assets/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js') }}" type="text/javascript"></script>
<script src="{{ asset('back/assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js') }}" type="text/javascript"></script>
<script src="{{ asset('back/assets/plugins/datatables-responsive/js/lodash.min.js') }}" type="text/javascript"></script>
<!-- END PAGE LEVEL JS INIT -->
<script>

  $(document).ready(function(){
  	$('#contenido').wysihtml5();
  });
</script>
<!-- END JAVASCRIPTS -->
@endsection