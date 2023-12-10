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
    <h3>Configuraciones <span class="semi-bold">turnos</span></h3>
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
                    <form id="form_iconic_validation" action="{{ route('generales.store') }}" method="post" enctype="multipart/form-data">
                      {{ csrf_field() }}
                      <div class="form-group">
                        <label class="form-label">Generador habilitado</label>
                        <span class="help">eg: "El sistema habilita la generación para el usuario"</span>
                        <div class="input-with-icon  right">
                          <i class=""></i>
                          <input type="hidden" name="turnos" value="1">
                          <input type="checkbox" name="turnos_habilitados" id="turnos_habilitados" class="form-control" @if(@$general->where('nombre','=','turnos_habilitados')->first()->valor) checked @endif>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="form-label">Mensaje para turnero deshabilitado</label>
                        <span class="help">eg: "No estamos atendiendo debido a "</span>
                        <div class="controls">
                            <div class="input-with-icon  right">
                              <i class=""></i>
                              <input type="text" name="mensaje_turnos_habilitados" id="mensaje_turnos_habilitados" class="form-control" value="{{ @$general->where('nombre','=','mensaje_turnos_habilitados')->first()->valor }}">
                            </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="form-label">Cantidad de turnos diarios</label>
                        <span class="help">eg: "200"</span>
                        <div class="controls">
                            <div class="input-with-icon  right">
                              <i class=""></i>
                              <input type="number" name="turnos_diarios" id="turnos_diarios" class="form-control" value="{{ @$general->where('nombre','=','turnos_diarios')->first()->valor }}">
                            </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="form-label">Cantidad de turnos separados</label>
                        <span class="help">eg: "20"</span>
                        <div class="input-with-icon  right">
                          <i class=""></i>
                          <input type="number" name="turnos_separados" id="turnos_separados" class="form-control" value="{{ @$general->where('nombre','=','turnos_separados')->first()->valor }}">
                        </div>
                      </div>

                        <div class="form-group">
                          <label class="form-label">Duración de turno</label>
                          <span class="help">eg: "2 minutos"</span>
                          <div class="controls">
                            <div class="input-group transparent col-md-6">
                                  <input type="number" class="form-control" placeholder="Dureción de turno"  name="minutos_x_turno" id="minutos_x_turno" value="{!! @$general->where('nombre','=','minutos_x_turno')->first()->valor !!}">
                                </span>
                            </div>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="form-label">Hora de inicio</label>
                          <span class="help">eg: "08:10"</span>
                          <div class="controls">
                            <div class="input-group transparent clockpicker col-md-6">
                                  <input type="text" class="form-control" placeholder="Pick a time"  name="turnos_hora_inicio" id="turnos_hora_inicio" value="{!! @$general->where('nombre','=','turnos_hora_inicio')->first()->valor !!}">
                                  <span class="input-group-addon ">
                                 <i class="fa fa-clock-o"></i>
                                </span>
                            </div>
                          </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Hora de cierre</label>
                            <span class="help">eg: "15:00"</span>
                            <div class="controls">
                                <div class="input-group transparent clockpicker col-md-6">
                                    <input type="text" class="form-control" placeholder="Pick a time"  name="turnos_hora_fin" id="turnos_hora_fin" value="{!! @$general->where('nombre','=','turnos_hora_fin')->first()->valor !!}">
                                    <span class="input-group-addon">
                                       <i class="fa fa-clock-o"></i>
                                    </span>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                          <label class="form-label">Días habilitados</label>
                          <span class="help">eg: "Cantidad de días a partir de la fecha actual que se generan turnos"</span>
                          <div class="controls">
                            <div class="input-group transparent col-md-6">
                                  <input type="number" class="form-control" placeholder="Número de días"  name="numero_dias" id="numero_dias" value="{!! @$general->where('nombre','=','numero_dias')->first()->valor !!}">
                                </span>
                            </div>
                          </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Sabado</label>
                            <span class="help">eg: "Deshabilitar sabado en calendario"</span>
                            <div class="controls">
                                <div class="input-group transparent col-md-6">
                                    <input type="checkbox" class="form-control" value="6" name="sabado" id="sabado" @if(@$general->where('nombre','=','sabado')->first()->valor) checked @endif>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Domingo</label>
                            <span class="help">eg: "Deshabilitar domingo en calendario"</span>
                            <div class="controls">
                                <div class="input-group transparent col-md-6">
                                    <input type="checkbox" class="form-control" value="0"  name="domingo" id="domingo" @if(@$general->where('nombre','=','domingo')->first()->valor) checked @endif>
                                </div>
                            </div>
                        </div>


                          <div class="form-actions">
                            <div class="pull-right">
                              <button type="submit" class="btn btn-danger btn-cons"><i class="icon-ok"></i> Actualizar</button>
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
<script src="{{ asset('back/assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('back/assets/plugins/boostrap-clockpicker/bootstrap-clockpicker.min.js') }}" type="text/javascript"></script>
<script>
    $('.clockpicker ').clockpicker({
        autoclose: true
    });
</script>
@endsection