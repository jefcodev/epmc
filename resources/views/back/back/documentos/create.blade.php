@extends('back.template.base')

@section('title','Nuevo formulario')

@section('css')
	<link href="{{ asset('back/assets/plugins/bootstrap-select2/select2.css') }}" rel="stylesheet" type="text/css" media="screen" />
  <link href="{{ asset('back/assets/plugins/bootstrap-datepicker/css/datepicker.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

<ul class="breadcrumb">
    <li>
      <p>Ud esta aquí</p>
    </li>
    <li><a href="{{ route('documentos.index') }}">Documentos</a> </li>
    <li><a href="#" class="active">Creación</a> </li>
  </ul>
  <div class="page-title"> <i class="icon-custom-right"></i>
    <h3>Nuevo <span class="semi-bold">Documento</span></h3>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="grid simple form-grid">
        <div class="grid-title no-border">
          <h4>Datos <span class="semi-bold">Documento</span></h4>
        </div>
        <div class="grid-body no-border">
          <br>
            <form id="form_iconic_validation" action="{{ route('documentos.store') }}" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="form-group">
                <label class="form-label">Nombre</label>
                <span class="help">eg: "Concesión de Permiso de Operación"</span>
                <div class="input-with-icon  right">
                  <i class=""></i>
                  <input type="text" name="nombre" id="nombre" class="form-control" required>
                </div>
              </div>
              <div class="form-group">
                <label class="form-label">Categoría</label>
                <div class="input-with-icon  right">
                  <i class=""></i>
                  <select name="categoria_id" class="form-control">
                    @foreach($categorias as $key=>$value)
                    <option value="{{$key}}">{{$value}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="form-label">Descripción</label>
                <span class="help">eg: "Documento de..."</span>
                <div class="input-with-icon  right">
                  <i class=""></i>
                  <input type="text" name="descripcion" id="descripcion" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="form-label">Documento</label>
                <span class="help">eg: "Documento.pdf"</span>
                <div class="input-with-icon  right">
                  <i class=""></i>
                  <input type="file" name="documento" id="documento" class="form-control" required>
                </div>
              </div>
              <div class="form-group">
                <label class="form-label">Fecha</label>
                <span class="help">e.g. "2020-01-30"</span>
                <div class="input-with-icon  right">
                  <i class=""></i>
                  <input type="text" name="fecha" id="fecha" value="{{ date('Y-m-d')}}" class="form-control">
                </div>
              </div>
              <div class="form-actions">
                <div class="pull-right">
                  <button type="submit" class="btn btn-danger btn-cons"><i class="icon-ok"></i> Guardar</button>
                  <a href="{{ route('documentos.index') }}" class="btn btn-white btn-cons">Cancelar</a>
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
<script src="{{ asset('back/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript"></script>
<!-- END PAGE LEVEL JS INIT -->
<script>

  $(document).ready(function(){
    $('#fecha').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true
     });
  });
</script>
<!-- END JAVASCRIPTS -->
@endsection