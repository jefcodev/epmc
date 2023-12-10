@extends('back.template.base')

@section('title','Editar día especial')

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
    <li><a href="{{ route('dias_especiales.index',$sucursal->id) }}">Días especiales</a> </li>
    <li><a href="#" class="active">Edición</a> </li>
  </ul>
  <div class="page-title"> <i class="icon-custom-right"></i>
    <h3>Editar <span class="semi-bold">día especial</span></h3>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="grid simple form-grid">
        <div class="grid-title no-border">
          <h4>Datos <span class="semi-bold">Día especial</span></h4>
        </div>
        <div class="grid-body no-border">
          <br>
            <form id="form_iconic_validation" action="{{ route('dias_especiales.update',['id'=>$sucursal->id,'dias_especiale'=> $dia->id]) }}" method="post">
              {{ csrf_field() }}
              <input type="hidden" name="_method" value="PUT">
              <div class="form-group">
                <label class="form-label">Turnos habilitados</label>
                <span class="help">eg: "Desactivar en caso de no generar turnos para ese día"</span>
                <div class="input-with-icon  right">
                  <i class=""></i>
                  <input type="checkbox" name="turnos_habilitados" id="turnos_habilitados" @if($dia->turnos_habilitados) checked @endif value="1" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="form-label">Fecha</label>
                <span class="help">eg: "2020-03-30"</span>
                <div class="input-with-icon  right">
                  <i class=""></i>
                  <input type="text" name="fecha" id="fecha" class="form-control" value="{{ $dia->fecha }}" required>
                </div>
              </div>
              <div class="form-group">
                <label class="form-label">Turnos diarios</label>
                <span class="help">eg: "Número de turnos diarios"</span>
                <div class="input-with-icon  right">
                  <input type="number" name="turnos_diarios" id="turnos_diarios" class="form-control" value="{{ $dia->turnos_diarios }}" required>
                </div>
              </div>
              <div class="form-group">
                <label class="form-label">Turnos especiales</label>
                <span class="help">eg: "Nº de turnos separados"</span>
                <div class="input-with-icon  right">
                  <i class=""></i>
                  <input type="number" name="turnos_separados" id="turnos_separados" class="form-control" value="{{ $dia->turnos_separados }}" required>
                </div>
              </div>
              <div class="form-group">
                <label class="form-label">Hora inicio</label>
                <span class="help">eg: "Hora de inicio para la emisión de turnos"</span>
                <div class="input-with-icon  right">
                  <i class=""></i>
                  <input type="text" name="turnos_hora_inicio" id="turnos_hora_inicio" class="form-control" value="{{ $dia->turnos_hora_inicio }}" required>
                </div>
              </div>
              <div class="form-group">
                <label class="form-label">Hora fin</label>
                <span class="help">eg: "Hora de fin para la emisión de turnos"</span>
                <div class="input-with-icon  right">
                  <i class=""></i>
                  <input type="text" name="turnos_hora_fin" id="turnos_hora_fin" class="form-control" value="{{ $dia->turnos_hora_fin }}"  required>
                </div>
              </div>
              <div class="form-actions">
                <div class="pull-right">
                  <button type="submit" class="btn btn-danger btn-cons"><i class="icon-ok"></i> Guardar</button>
                  <a href="{{ route('dias_especiales.index',$sucursal->id) }}" class="btn btn-white btn-cons">Cancelar</a>
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
    $("#turnos_hora_inicio, #turnos_hora_fin").inputmask("99:99");

    $('#fecha').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true
     });
  });
</script>
<!-- END JAVASCRIPTS -->
@endsection