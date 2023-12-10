@extends('back.template.base')

@section('title','Editar dígito')

@section('css')
	<link href="{{ asset('back/assets/plugins/bootstrap-select2/select2.css') }}" rel="stylesheet" type="text/css" media="screen" />
    <link href="{{ asset('back/assets/plugins/bootstrap-datepicker/css/datepicker.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

<ul class="breadcrumb">
    <li>
      <p>Ud esta aquí</p>
    </li>
    <li><a href="{{ route('turnos.index') }}">Turnos</a> </li>
    <li><a href="{{ route('digitos.index') }}">Dígitos</a> </li>
    <li><a href="#" class="active">Edición</a> </li>
  </ul>
  <div class="page-title"> <i class="icon-custom-right"></i>
    <h3>Editar <span class="semi-bold">dígito</span></h3>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="grid simple form-grid">
        <div class="grid-title no-border">
          <h4>Datos <span class="semi-bold">Dígito</span></h4>
        </div>
        <div class="grid-body no-border">
          <br>
            <form id="form_iconic_validation" action="{{ route('digitos.update',$digito->id) }}" method="post">
              {{ csrf_field() }}
              <input type="hidden" name="_method" value="PUT">
              <div class="form-group">
                <label class="form-label">Dígito</label>
                <span class="help">eg: "Último dígito de placa"</span>
                <div class="input-with-icon  right">
                  <input type="number" name="digito" id="digito" class="form-control" value="{{ $digito->digito }}" required>
                </div>
              </div>
              <div class="form-group">
                <label class="form-label">Desde</label>
                <span class="help">eg: "2020-<strong>03-30</strong>"</span>
                <div class="input-with-icon  right">
                  <i class=""></i>
                  <input type="text" name="desde" id="desde" class="form-control" value="{{ $digito->desde->format('Y-m-d') }}" required>
                </div>
              </div>
              <div class="form-group">
                <label class="form-label">Hasta</label>
                <span class="help">eg: "2020-<strong>05-30</strong>"</span>
                <div class="input-with-icon  right">
                  <i class=""></i>
                  <input type="text" name="hasta" id="hasta" class="form-control" value="{{ $digito->hasta->format('Y-m-d') }}" required>
                </div>
              </div>
              <div class="form-actions">
                <div class="pull-right">
                  <button type="submit" class="btn btn-danger btn-cons"><i class="icon-ok"></i> Guardar</button>
                  <a href="{{ route('digitos.index') }}" class="btn btn-white btn-cons">Cancelar</a>
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
<!-- END PAGE LEVEL JS INIT -->
<script src="{{ asset('back/assets/plugins/datatables-responsive/js/lodash.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('back/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript"></script>
<script src="{{ asset('back/assets/plugins/inputmask/jquery.inputmask.min.js') }}" type="text/javascript"></script>
<script>

  $(document).ready(function(){
    $("#digito").inputmask("9");

    $('#desde').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true
     });
    $('#hasta').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true
     });
  });
</script>
<!-- END JAVASCRIPTS -->
@endsection