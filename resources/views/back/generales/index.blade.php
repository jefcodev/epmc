@extends('back.template.base')

@section('title','Generales')

@section('css')
<link href="{{ asset('back/assets/plugins/bootstrap-datepicker/css/datepicker.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('back/assets/plugins/bootstrap-select2/select2.css') }}" rel="stylesheet" type="text/css" media="screen" />
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
    <li><a href="#" class="active">Generales</a> </li>
  </ul>
  <div class="page-title"> <i class="icon-custom-left"></i>
    <h3>Información <span class="semi-bold">general</span></h3>
  </div>
  <div class="row-fluid">
    <div class="span12">
      <div class="grid simple ">
        <div class="grid-title">
          <h4>
            Información <span class="semi-bold">General</span>
          </h4>
        </div>
        <div class="grid-body ">
          @include('back.template.alerts')
          <div class="row">
              <div class="col-md-12">
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="active">
                      <a href="#tabGeneral" role="tab" data-toggle="tab">Datos Generales</a>
                    </li>
                    <li>
                      <a href="#tabQuienes" role="tab" data-toggle="tab">Misión y Visión</a>
                    </li>
                    <li>
                      <a href="#tabMapa" role="tab" data-toggle="tab">Ubicación</a>
                    </li>
                    <li>
                      <a href="#tabSistema" role="tab" data-toggle="tab">Sistema</a>
                    </li>
                  </ul>
                  <div class="tab-content">
                    <div class="tab-pane active" id="tabGeneral">
                      <div class="row column-seperation">
                        <div class="col-md-6">
                            <div class="grid simple vertical green">
                                
                                <div class="grid-body no-border">
                                  <div class="row-fluid ">
                                    <form id="form_iconic_validation" action="{{ route('generales.store') }}" method="post" enctype="multipart/form-data">
                                      {{ csrf_field() }}
                                      <div class="form-group">
                                        <label class="form-label"><i class="required">*</i> Teléfono</label>
                                        <div class="input-with-icon  right">
                                          <i class=""></i>
                                          <input type="text" name="telefono" id="telefono" class="form-control" value="{{ @$general->where('nombre','=','telefono')->first()->valor }}" required>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="form-label"><i class="required">*</i> Correo</label>
                                        <div class="input-with-icon  right">
                                          <i class=""></i>
                                          <input type="email" name="email" id="email" class="form-control" value="{{ @$general->where('nombre','=','email')->first()->valor }}" required>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="form-label"><i class="required">*</i> Dirección</label>
                                        <div class="input-with-icon  right">
                                          <i class=""></i>
                                          <input type="text" name="direccion" id="direccion" class="form-control" value="{{ @$general->where('nombre','=','direccion')->first()->valor }}" required>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="form-label"><i class="required">*</i> Horario</label>
                                        <div class="input-with-icon  right">
                                          <i class=""></i>
                                          <input type="text" name="horario" id="horario" class="form-control" value="{{ @$general->where('nombre','=','horario')->first()->valor }}" required>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="form-label"><i class="required">*</i> Facebook</label>
                                        <div class="input-with-icon  right">
                                          <i class=""></i>
                                          <input type="text" name="facebook" id="facebook" class="form-control" value="{{ @$general->where('nombre','=','facebook')->first()->valor }}" required>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="form-label"><i class="required">*</i> Twitter</label>
                                        <div class="input-with-icon  right">
                                          <i class=""></i>
                                          <input type="text" name="twitter" id="twitter" class="form-control" value="{{ @$general->where('nombre','=','twitter')->first()->valor }}" required>
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
                    <div class="tab-pane" id="tabQuienes">
                      <div class="row column-seperation">
                        <div class="col-md-12">
                          <form id="form_iconic_validation" action="{{ route('generales.store') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                              <label class="form-label"><i class="required">*</i> Quiénes Somos</label>
                              <div class="input-with-icon  right">
                                <i class=""></i>
                                <textarea name="quienes_somos" rows="4" id="quienes_somos" class="form-control" required>{!! @$general->where('nombre','=','quienes_somos')->first()->valor !!}</textarea>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="form-label"><i class="required">*</i> Misión</label>
                              <div class="input-with-icon  right">
                                <i class=""></i>
                                <textarea name="mision" id="mision" class="form-control" required>{!! @$general->where('nombre','=','mision')->first()->valor !!}</textarea>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="form-label"><i class="required">*</i> Visión</label>
                              <div class="input-with-icon  right">
                                <i class=""></i>
                                <textarea name="vision" id="vision" class="form-control" required>{!! @$general->where('nombre','=','vision')->first()->valor !!}</textarea>
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
                    <div class="tab-pane" id="tabMapa">
                      <div class="row">
                        <div class="col-md-12">
                          <div id="map">
                              
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane" id="tabSistema">
                        <div class="row column-seperation">
                        <div class="col-md-12">
                          <form id="form_iconic_validation" action="{{ route('generales.store') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                              <label class="form-label"><i class="required">*</i> Dias atras para buscar placas entregadas</label>
                              <div class="input-with-icon  right">
                                <i class=""></i>
                                <input type="number" name="dias_atras_placas"  id="dias_atras_placas" class="form-control" value="{{ @$general->where('nombre','=','dias_atras_placas')->first()->valor }}" required />
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="form-label"><i class="required">*</i>Fecha de inicio para todos los dígitos</label>
                              <div class="input-with-icon  right">
                                <i class=""></i>
                                <input type="text" name="fecha_inicio_digitos"  id="fecha_inicio_digitos" class="form-control" value="{{ @$general->where('nombre','=','fecha_inicio_digitos')->first()->valor }}" required />
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="form-label"><i class="required">*</i>Fecha de fin para todos los dígitos</label>
                              <div class="input-with-icon  right">
                                <i class=""></i>
                                <input type="text" name="fecha_fin_digitos"  id="fecha_fin_digitos" class="form-control" value="{{ @$general->where('nombre','=','fecha_fin_digitos')->first()->valor }}" required />
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
@endsection

@section('js')
<script src="{{ asset('back/assets/plugins/bootstrap-select2/select2.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('back/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBCT_YSl_vNgxGOsCdJvOGlbIe0_9K_MA4&sensor=false&amp;language=es"></script>
<script src="{{ asset('front/js/plugins/gmap3.min.js' ) }}"></script>
<!-- END PAGE LEVEL JS INIT -->
<script>
    $("#map").gmap3({
        marker:{
        address:"Terminal terrestre, Salcedo",
        options:{ icon: "img/assets/marker.png"}},
        map:{
        options:{
        styles: [ {
        stylers: [ { "saturation":-90 }, { "lightness": 0 }, { "gamma": 0.0 }]},
        ],
        zoom: 16,
        scrollwheel:false,
        draggable: true }
        }
    });

    $('#fecha_fin_digitos').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true
     });

    $('#fecha_inicio_digitos').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true
     });

</script>
@endsection