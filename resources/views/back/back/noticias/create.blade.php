@extends('back.template.base')

@section('css')
	<link href="{{ asset('back/assets/plugins/bootstrap-select2/select2.css') }}" rel="stylesheet" type="text/css" media="screen" />
	<link href="{{ asset('back/assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('back/assets/plugins/bootstrap-datepicker/css/datepicker.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

<ul class="breadcrumb">
    <li>
      <p>Ud esta aquí</p>
    </li>
    <li><a href="{{ route('noticias.index') }}">Noticias</a> </li>
    <li><a href="#" class="active">Creación</a> </li>
  </ul>
  <div class="page-title"> <i class="icon-custom-right"></i>
    <h3>Nueva <span class="semi-bold">Noticia</span></h3>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="grid simple form-grid">
        <div class="grid-title no-border">
          <h4>Datos <span class="semi-bold">Noticia</span></h4>
        </div>
        <div class="grid-body no-border">
          <br>
          <form id="form_iconic_validation" action="{{ route('noticias.store') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
              <label class="form-label">Título*</label>
              <span class="help">El titulo de la noticia</span>
              <div class="input-with-icon  right">
                <i class=""></i>
                <input type="text" name="titulo" id="titulo" class="form-control" required>
              </div>
            </div>
            <div class="form-group">
              <label class="form-label">Subtitulo</label>
              <span class="help">Subtitulo de la noticia (opcional)</span>
              <div class="input-with-icon  right">
                <i class=""></i>
                <input type="text" name="subtitulo" id="subtitulo" class="form-control">
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
            <div class="form-group">
              <label class="form-label">Contenido</label>
              <div class="input-with-icon  right">
                <i class=""></i>
                <textarea type="text" name="contenido" id="contenido" class="form-control" rows="5"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="form-label">Enlace</label>
              <span class="help">Enlace de facebook o fuente de la noticia (opcional)</span>
              <div class="input-with-icon  right">
                <i class=""></i>
                <input type="text" name="link" id="link" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="form-label">Estado</label>
              <span class="help">e.g. "Borrador"</span>
              <div class="input-with-icon  right">
                <i class=""></i>
                <select name="estado" id="estado" class="select2 form-control" data-init-plugin="select2">
                  <option value="borrador">Borrador</option>
                  <option value="publicada">Publicada</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="form-label">Imagen</label>
              <span class="help">e.g. "Imagen destacada"</span>
              <div class="input-with-icon  right">
                <i class=""></i>
                <input type="file" name="imagen" class="form-control">
              </div>
            </div>
              <div class="form-group">
	              <label class="form-label">Autor</label>
	              <div class="input-with-icon  right">
	                <i class=""></i>
	                <input type="hidden"name="autor_id" id="autor_id"  value="{{ Auth::id() }}">
	                <input type="text" value="{{ Auth::user()->name }}" class="form-control" disabled>
	              </div>
	            </div>
            <div class="form-actions">
              <div class="pull-right">
                <button type="submit" class="btn btn-danger btn-cons"><i class="icon-ok"></i> Guardar</button>
                <a href="{{ route('noticias.index') }}" class="btn btn-white btn-cons">Cancelar</a>
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
<script src="{{ asset('back/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript"></script>
<script src="{{ asset('back/assets/plugins/datatables-responsive/js/lodash.min.js') }}" type="text/javascript"></script>
<!-- END PAGE LEVEL JS INIT -->
<script>

  $(document).ready(function(){
  	$('#contenido').wysihtml5();
  	$('#fecha').datepicker({
        format: 'yyyy-mm-dd',
  			autoclose: true,
  			todayHighlight: true
     });
  });
</script>
<!-- END JAVASCRIPTS -->
@endsection