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
    <li><a href="#" class="active">Turnos</a> </li>
  </ul>
  <div class="page-title"> <i class="icon-custom-left"></i>
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
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="active">
                      <a href="#tabGeneral" role="tab" data-toggle="tab">Configuraciones</a>
                    </li>
                  </ul>
                  <div class="tab-content">
                    <div class="tab-pane active" id="tabGeneral">
                      <div class="row column-seperation">
                        <div class="col-md-6">
                            <div class="grid simple vertical green">
                                
                                <div class="grid-body no-border">
                                  <div class="row-fluid ">
                                    <form id="form_iconic_validation" action="{{ route('periodos.store') }}" method="post" enctype="multipart/form-data">
                                      {{ csrf_field() }}
                                      <div class="form-group">
                                        <label class="form-label">Cantidad de turnos diarios</label>
                                        <span class="help">eg: "200"</span>
                                        <div class="input-with-icon  right">
                                          <i class=""></i>
                                          <input type="text" name="turnos_diarios" id="turnos_diarios" class="form-control" value="{{ @$general->where('nombre','=','turnos_diarios')->first()->valor }}">
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="form-label">Generador habilitado</label>
                                        <span class="help">eg: "El sistema habilita la generación para el usuario"</span>
                                        <div class="input-with-icon  right">
                                          <i class=""></i>
                                          <input type="checkbox" name="turnos_habilitados" id="turnos_habilitados" class="form-control">
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
                                                    <span class="input-group-addon ">
                                                   <i class="fa fa-clock-o"></i>
                                                  </span>
                                              </div>
                                            </div>
                                      </div>
                                      <div class="form-actions">
                                        <div class="pull-right">
                                          <button type="submit" class="btn btn-danger btn-cons"><i class="icon-ok"></i> Actualizar</button>
                                        </div>
                                      </div>
                                    </form>
                                              
                                  </div>
                                </div>
                              </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            
          </div>
        </div>
      </div>
    </div>
  </div>
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