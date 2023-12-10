@extends('back.template.base')

@section('title','Nuevo turno')

@section('css')
	<link href="{{ asset('back/assets/plugins/bootstrap-select2/select2.css') }}" rel="stylesheet" type="text/css" media="screen" />
    <link href="{{ asset('back/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

<ul class="breadcrumb">
    <li>
      <p>Ud esta aquí</p>
    </li>
    <li><a href="{{ route('turnos.index') }}">Turnos</a> </li>
    <li><a href="#" class="active">Creación</a> </li>
  </ul>
  <div class="page-title"> <i class="icon-custom-right"></i>
    <h3>Nuevo <span class="semi-bold">Turno</span></h3>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="grid simple form-grid">
        <div class="grid-title no-border">
          <h4>Datos <span class="semi-bold">Turno</span></h4>
        </div>
        <div class="grid-body no-border">
          <br>
            <form id="form_iconic_validation" action="{{ route('turnos.store') }}" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="form-group">
                <label class="form-label">Sucursal</label>
                <span class="help">eg: "Salcedo o La Mana"</span>
                <div class="input-with-icon  right">
                  <select name="sucursal_id" class="form-control" required>
                    @foreach($sucursales_data as $index => $req)
                    <option value="{{ $index }}">{{ $req }}</option>            
                    @endforeach    
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="form-label">Trámite</label>
                <span class="help">eg: "Trámite"</span>
                <div class="input-with-icon  right">
                  <select name="requisito_id" class="form-control" required>
                    @foreach($requisitos as $index => $req)
                    <option value="{{ $index }}">{{ $req }}</option>            
                    @endforeach    
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="form-label">Cliente</label>
                <span class="help">eg: "Cliente" </span>
                <span><a href="{{ route('usuarios.create') }}">Crear Usuario</a></span>
                <div class="input-with-icon  right">
                  <select id="user_id" name="user_id" class="form-control">
                    <option value="">Seleccione un cliente</option>
                    @foreach($clientes as $index => $cliente)
                    <option value="{{ $cliente->id }}" cedula="{{ $cliente->cedula}}">{{ $cliente->para_select }}</option>            
                    @endforeach    
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="form-label">Cédula / RUC</label>
                <span class="help">eg: "Nº cédula o RUC"</span>
                <div class="input-with-icon  right">
                  <i class=""></i>
                  <input type="text" name="cedula" id="cedula" class="form-control" required>
                </div>
              </div>
              <div class="form-group">
                <label class="form-label">Placa</label>
                <span class="help">eg: "ABC-1234..."</span>
                <div class="input-with-icon  right">
                  <i class=""></i>
                  <input type="text" name="placa" id="placa" class="form-control" required>
                </div>
              </div>
              <div class="form-group">
                <label class="form-label">Fecha</label>
                <span class="help">eg: "2020-03-30"</span>
                <div class="input-with-icon  right">
                  <i class=""></i>
                  <input type="text" name="fecha" id="fecha" value="{{ date('Y-m-d') }}" class="form-control" required>
                </div>
              </div>
              <div class="form-group">
                <label class="form-label">Especial</label>
                <span class="help">eg: "Marcar para turno especial"</span>
                <div class="input-with-icon  right">
                  <i class=""></i>
                  <input type="checkbox" name="especial" id="especial" value="1" class="form-control" checked>
                </div>
              </div>
              <div class="form-actions">
                <div class="pull-right">
                  <button type="submit" class="btn btn-danger btn-cons"><i class="icon-ok"></i> Guardar</button>
                  <a href="{{ route('turnos.index') }}" class="btn btn-white btn-cons">Cancelar</a>
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
<script src="{{ asset('back/assets/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('back/assets/plugins/inputmask/jquery.inputmask.min.js') }}" type="text/javascript"></script>
<script>

  $(document).ready(function(){
    $("#placa").inputmask("aaa-999[9]");
    $("#cedula").inputmask("9999999999[999]");

    $('#user_id').on('change', function() {
      var val = $(this).val();
      let selectedOption = $(this).find('option[value="'+val+'"]');
      $("#cedula").val($(selectedOption).attr('cedula'));
      
    });

    $('#fecha').datepicker({
        format: 'yyyy-mm-dd',
        locale:'es',
        autoclose: true,
        weekStart:1,
        startDate: Date('Y-m-d'),
        datesDisabled: {!! $dias_excluidos !!},
        daysOfWeekDisabled:[0,6],
        todayHighlight: true
    });
    $('#fecha').on('changeDate', function() {
        var url = '{{ route("turnero.stats","") }}/'+$('#fecha').datepicker('getFormattedDate');
        $.get(url,{},function(data){
              if(data.last_turno_especial){
                  $('#turno').val((data.n_turnos_especiales)+1);
              }else{
                  $('#turno').val(1);
              }
          },'json');
      });
  });
</script>
<!-- END JAVASCRIPTS -->
@endsection