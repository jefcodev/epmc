@extends('back.template.base')

@section('title','Nuevo slider')

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
    <li><a href="{{ route('sliders.index') }}">Sliders</a> </li>
    <li><a href="#" class="active">Edición</a> </li>
  </ul>
  <div class="page-title"> <i class="icon-custom-right"></i>
    <h3>Nueva <span class="semi-bold">Slider</span></h3>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="grid simple form-grid">
        <div class="grid-title no-border">
          <h4>Datos <span class="semi-bold">Slider</span></h4>
        </div>
        <div class="grid-body no-border">
          <br>
          <form id="form_iconic_validation" action="{{ route('sliders.update', $slider->id) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group">
              <label class="form-label">Título</label>
              <span class="help">eg: "Mancomunidad de Cotopaxi"</span>
              <div class="input-with-icon  right">
                <i class=""></i>
                <input type="text" name="title" id="title" value="{{ $slider->title }}" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="form-label">Subtitulo</label>
              <span class="help">eg: "EMPRESA PÚBLICA DE MOVILIDAD"</span>
              <div class="input-with-icon  right">
                <i class=""></i>
                <input type="text" name="subtitle" id="subtitle" value="{{ $slider->subtitle }}" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="form-label">Boton</label>
              <span class="help">e.g. "SERVICIOS"</span>
              <div class="input-with-icon  right">
                <i class=""></i>
                <input type="text" name="texto_boton" id="texto_boton" value="{{ $slider->texto_boton }}" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="form-label">URL</label>
              <span class="help">e.g. "#servicios"</span>
              <div class="input-with-icon  right">
                <i class=""></i>
                <input type="text" name="url" id="url" value="{{ $slider->url }}" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="form-label">Visible</label>
              <div class="input-with-icon  right">
                <i class=""></i>
                <input type="checkbox" name="visible" id="visible" value="1" class="form-control" @if($slider->visible) checked @endif>
              </div>
            </div>
            <div class="form-group">
              <label class="form-label">Imagen</label>
              <div class="input-with-icon  right">
                <i class=""></i>
                <input type="file" name="imagen" id="imagen" class="form-control">
              </div>
              @if($slider->imagen)
                <img src="{{ asset('front/img/slider/'.$slider->imagen) }}" alt="{{ $slider->title }}" width="300" height="180">
              @endif
            </div>
            </div>
            <div class="form-actions">
              <div class="pull-right">
                <button type="submit" class="btn btn-danger btn-cons"><i class="icon-ok"></i> Guardar</button>
                <a href="{{ route('sliders.index') }}" class="btn btn-white btn-cons">Cancelar</a>
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