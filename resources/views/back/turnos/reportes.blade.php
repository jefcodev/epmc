@extends('back.template.base')

@section('title','Turnos')

@section('css')
	<link href="{{ asset('back/assets/plugins/bootstrap-select2/select2.css') }}" rel="stylesheet" type="text/css" media="screen" />
    <link href="{{ asset('back/assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('back/assets/plugins/boostrap-clockpicker/bootstrap-clockpicker.min.css') }}" rel="stylesheet" type="text/css" media="screen" />
    <style>
        #map{
            width: 100%;
            height: 500px;
        }
    </style>
@endsection

@section('content')

<ul class="breadcrumb">
    <li>
        <p>Ud esta aquí</p>
    </li>
    <li>
        <a href="#" class="active">Turnos</a> 
    </li>
</ul>
<div class="page-title"> 
    <i class="icon-custom-left"></i>
    <h3>Exportar <span class="semi-bold">turnos</span></h3>
</div>
<div class="row-fluid">
    <div class="span12">
      <div class="grid simple ">
        <div class="grid-title">
          <h4>
            Sistema de emisión de <span class="semi-bold">Turnos</span>
          </h4>
        </div>
        <div class="grid-body ">
          @include('back.template.alerts')
          <div class="row">
                <div class="col-md-12">
                    <form id="form_iconic_validation" action="{{ route('turnos.exportar') }}" method="post" enctype="multipart/form-data">
                      {{ csrf_field() }}
                      <div class="form-group">
                        <label class="form-label">Sucursal</label>                        
                        <div class="controls">
                            <div class="input-with-icon  right">
                              <i class=""></i>
                              <select name="sucursal_id" id="sucursal_id" class="form-control">
                                @foreach($sucursales as $key=> $value)
                                  <option value="{{$key}}">{{$value }}</option>
                                @endforeach
                              </select>
                            </div>
                        </div>
                      </div>
                      <div class="form-group">
                          <label class="form-label"><i class="required">*</i>Fecha de inicio</label>
                          <div class="input-with-icon  right">
                            <i class=""></i>
                            <input type="text" name="desde"  id="desde" class="form-control" value="{{ $min_date }}" required />
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="form-label"><i class="required">*</i>Fecha de fin</label>
                          <div class="input-with-icon  right">
                            <i class=""></i>
                            <input type="text" name="hasta"  id="hasta" class="form-control" value="{{ $max_date }}" required />
                          </div>
                        </div>

                          <div class="form-actions">
                            <div class="pull-right">
                              <button type="submit" class="btn btn-danger btn-cons"><i class="icon-ok"></i> Generar</button>
                            </div>
                          </div>
                    </form>
                </div><!--.col-md-12-->
          </div><!--.row-->
        </div><!--.grid-body-->
      </div><!--.grid-->
    </div><!--.span12-->
  </div><!--.row-fluid-->
@endsection

@section('js')
<script src="{{ asset('back/assets/plugins/bootstrap-select2/select2.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('back/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript"></script>
<script>
  $('#hasta, #desde').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true
     });
</script>
@endsection