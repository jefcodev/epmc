@extends('front.template.base')

@section('title','Turnos')
use Illuminate\Support\Facades\RateLimiter;
@section('css')
    <link href="{{ asset('back/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css') }}" rel="stylesheet" type="text/css" />
    <style type="text/css" media="screen">
        #message, #info{
            color: red;
            font-weight: 700;
        }
        .turno-info{
         
        }
        #placa{
            text-transform: uppercase;
        }
    </style>
@endsection
    <body oncontextmenu = "return false"> </body>
    
    
@section('content')

if (RateLimiter::tooManyAttempts('send-message:'.$user->id, $perMinute = 5)) {
    return 'Too many attempts!';
}
    <!-- Start Home Revolution Slider Parallax Section -->
        <section id="page-top" style="height:400px">
    <div class="hero">
    
        <img src="{{ asset('front/img/backgrounds/bg-shortcodes.jpg') }}" alt="hero">

        <div class="page-top-title text-center">
            <h2 class="white op-1">Sistema de emisión de Turnos</h2>
            <p class="home-subheading op-1"></p>
        </div>
        
    </div>
    </section>
    <!-- End Home Revolution Slider Parallax Section -->
    
    <div class="site-wrapper content">

    	<section id="breadcrumb">
			<div class="container">
		        
		    	<ul class="breadcrumb">
		    		<li><a href="{{ route('home') }}" title="Inicio">Inicio</a></li>
		    		<li><a href="{{ route('home') }}#services" title="Servicios">Servicios</a></li>
		    		<li>Sistema de emisión de Turnos</li>
		    	</ul>
		    </div>
		</section>

        <!-- End Turnero List --> 
        <section id="contact">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 header-user">
                        <div>
                            Bienvenido <strong>{{ Auth::user()->name }}</strong>
                        </div>
                        <div>
                            <div>
                                <span class="total-turnos-user">
                                    {{ Auth::user()->turnos()->count()}} de {{ Auth::user()->turnos_disponibles }}
                                </span>
                                <a href="{{ route('perfil') }}">Mi Perfil</a>
                            </div>
                        </div>
                    </div>
                    
                    @if($turnero_habilitado)
                        @if(Auth::user()->turnos()->count() < Auth::user()->turnos_disponibles )
                        <div class="col-md-12">
                            <h3 class="section-title wow fadeInUp">Genera tu turno</h3>
                            <h4 class="text-center"> <small>Sucursal:</small> {{ $sucursal->nombre }}</h4>
                            <p class="text-justify">{{ @$general->where('nombre','=','empty')->first()->valor}}</p>
                        </div>
                        <div class="col-md-6 col-md-offset-3 text-center wow fadeInUp">
                            
                            <!-- Contact Form will be functional only on your server. Upload to your server when testing. -->
                            <form method="post" action="{{ route('turnero.generar',$sucursal->id) }}" >
                                {{ csrf_field() }}
                                <fieldset>
                                    <input type="hidden" name="sucursal_id" value="{{ $sucursal->id }}">
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    <select name="requisito_id" id="requisito_id" required class="form-control">
                                        @foreach($requisitos as $requisito)
                                            <option value="{{ $requisito->id }}">{{ $requisito->nombre }}</option>
                                        @endforeach
                                    </select>
                                    <div id="info" class="text-danger"></div>
                                    <input name="cedula" type="text" value="{{ Auth::user()->cedula }}" id="cedula" placeholder="Nº Cédula / RUC" required readonly />  
                                    <div id="info-placa" class="text-danger"></div>
                                    <input name="placa" type="text" id="placa" placeholder="Placa" required/>
                                    <div id="info-digito" class="text-danger"></div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div id="datepicker" data-date=""  class="text-center"></div>
                                            <input type="hidden" name="fecha" id="fecha">
                                        </div>
                                        <div class="col-md-6">
                                            <div class="turno-info">
                                                <div>Fecha: <strong id="current_date">{{ date('Y-m-d') }}</strong></div>
                                                <div>Último turno: <strong id="last_turno">{{ @$last_turno->turno }}</strong></div>
                                            <!-- <div>Turnos generados: <strong id="n_turnos">{{ $n_turnos }}</strong></div>-->
                                                <div>Turnos disponibles: <strong id="turnos_disponibles">{{ $turnos_disponibles }}</strong></div>
                                                <div>Hora: <strong id="last_turno_hora">{{ @$last_turno->fecha ? $last_turno->fecha->format('H:i:s'): '' }}</strong></div>
                                                <div>Placas terminadas en:  <strong id="all-digitos">0,1,2,3,4,5,6,7,8,9</strong> <strong id="digito-placa">{{ @$digitos}}</strong></div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--<input name="fecha" type="text" id="fecha" placeholder="Fecha para turno" required/>-->

                                </fieldset>
                            
                                <input type="submit" class="submit" id="submit"  value="Siguiente" onClick="window.location.href=window.location.href" disabled  />
                            </form>
                        </div>  
                        <div class="col-md-12 text-center wow fadeInUp" style="margin-top:20px;">
                            <blockquote>
                            Nos permitimos informar a la ciudadanía que los pagos realizados en las diferentes entidades bancarias correspondientes a las tasas de Matriculación y Trasferencia de Domínio serán validados en las próximas 48 horas para realizar los respectivos trámites debido a los nuevos requerimientos del sistema de matriculación vehicular.  
                
                                Recomendamos a nuestros usuarios realizar los pagos corresponientes  con 72 horas de anticipación antes de finalizar el mes para evitar inconvenientes.. </i>
                            </blockquote>
                            <br>
                            <div id="message"></div>
                            <a href="{{ route('turnero.vista.reimpresion') }}" class="btn btn-primary submit">Reimprimir turno</a>
                        </div>
                        @else
                        <div class="col-md-12">
                            <h3 class="section-title wow fadeInUp">Turnos agotados</h3>
                            <h4 class="text-center"> Usted ya ha utilizado el total de <strong>{{ Auth::user()->turnos()->count() }}</strong> turnos disponibles por cliente </h4>
                        </div>
                        @endif
                    @else
                    <div class="col-md-12 text-center">
                        <hr>
                        <h5 class="wow fadeInUp">{{ @$general->where('nombre','=','mensaje_turnos_habilitados')->first()->valor}}</h5>
                        <hr>
                        <blockquote>
                          <i class=" dark-grey">Nos permitimos informar a la ciudadanía que los pagos realizados en las diferentes entidades bancarias correspondientes a las tasas de Matriculación y Trasferencia de Domínio serán validados en las próximas 48 horas para realizar los respectivos trámites debido a los nuevos requerimientos del sistema de matriculación vehicular.  
			 
                            Recomendamos a nuestros usuarios realizar los pagos corresponientes  con 72 horas de anticipación antes de finalizar el mes para evitar inconvenientes..</i>
                        </blockquote>
                        <br>
                    </div>
                    @endif
                    
                  
                                             
                </div>
            </div>
        </section>
        <!-- End Turnero Section -->

        <!-- Start Formularios Section --> 
        @include('front.home.requisitos_section')
        <!-- End Formularios Section -->

        <!-- Start Fun Facts Section -->
        @include('front.home.counters')
        <!-- End Fun Facts Section --> 

        <!-- Start Footer 1 -->
        @include('front.template.footer')
        <!-- End Footer 1 -->
        
        <!-- Start Back To Top -->
        <a id="back-to-top"><i class="icon ion-chevron-up"></i></a>
        <!-- End Back To Top -->
        
    </div> <!-- End Site Wrapper --> 

@endsection

@section('js')
<script src="{{ asset('back/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript"></script>
<script src="{{ asset('back/assets/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('back/assets/plugins/inputmask/jquery.inputmask.min.js') }}" type="text/javascript"></script>

<script>
    var placa_valida=false;
    var cedula_valida=true;
    var digito_valido=true;
    var fecha_seteada=false;

  $(document).ready(function(){
    $("#placa").inputmask("aa[a]-999[9|a]");
    $("#cedula").inputmask("9999999999[999]");
    $('#all-digitos').fadeOut();
    $('#datepicker').datepicker({
        language: 'es',
        format: 'yyyy-mm-dd',
        weekStart:1,
        startDate: Date('Y-m-d'),
        endDate: '{{ $fecha_final->format('Y-m-d') }}',
        datesDisabled: {!! $dias_excluidos !!},
        autoclose: true,
        @if($dia_copado)
        todayHighlight: false,
        @else
        todayHighlight: true,
        @endif
    });

    function validarDigito(){
        var placa = $('#placa').val().replace('-','');
        placa = placa.replace('_','');
        var ultimo_digito = placa.slice(-1);
         if(ultimo_digito.toLowerCase().match(/[a-z]/i)){
            ultimo_digito=placa.slice(-2,-1);
        }
        let ignorarUltimoDigito = false;
        let idsSinVerificar = '{{ $servicios_sin_digito }}';
        idsSinVerificar = idsSinVerificar.split(',');
        let requisitoId = $('#requisito_id').val();
        if(idsSinVerificar.includes(requisitoId)){
            console.log('idsSinVerificar',idsSinVerificar)
            ignorarUltimoDigito = true;
            $('#digito-placa').fadeOut();
            $('#all-digitos').fadeIn();
        }else{
            $('#digito-placa').fadeIn();
            $('#all-digitos').fadeOut();
        }

        if(($('#digito-placa').html().includes(ultimo_digito)>0) || ignorarUltimoDigito ){
            digito_valido=true;
            $('#info-digito').html('');
            if(placa_valida && cedula_valida && fecha_seteada && digito_valido){
                $('#submit').removeAttr("disabled");
            }
        }else{
            digito_valido=false;
            $('#info-digito').html('En esta fecha solo se pueden generar turnos para placas terminadas en '+$('#digito-placa').html());
            $('#submit').attr("disabled", true);
        }
    }
    $('#requisito_id').on('change',function(data){
        validarDigito();
    });

    $('#placa').on('change',function(data){
        var placa = $(this).val().replace('-','');
        placa = placa.replace('_','');
        $('#submit').val("validando...");
        var url_consulta = "{{ route('placa','') }}/"+placa;
        $.get(url_consulta,{},function(data){
            if(data.mensajeServidor){
                $('#info-placa').html('La placa ingresada es incorrecta o no existe');
                $('#submit').attr("disabled", true);
                placa_valida=false;
            }else{
                placa_valida=true;
                $('#info-placa').html('');
                if(placa_valida && cedula_valida && fecha_seteada && digito_valido){
                    $('#submit').removeAttr("disabled");
                }
            }
            validarDigito();
            $('#submit').val("Siguiente");
        },'json');
    });

    $('#cedula').on('change',function(data){
        var valor = $(this).val();
        $('#submit').val("validando...");
        $.get('{{ route("cedula","") }}/'+valor,{},function(data){
            if(data){
                cedula_valida=true;
                $('#info').html('');
                if(placa_valida && cedula_valida && fecha_seteada && digito_valido){
                    $('#submit').removeAttr("disabled");
                }
            }else{
                cedula_valida=false;
                $('#info').html('El número de CI o RUC ingresado es incorrecto');
                $('#submit').attr("disabled", true);
            }
            $('#submit').val("Siguiente");
        },'json');
    });
    $('#datepicker').on('changeDate', function() {
        fecha_seteada=true;
        $('#fecha').val(
            $('#datepicker').datepicker('getFormattedDate')
        );
        $('#current_date').html(
            $('#datepicker').datepicker('getFormattedDate')
        );
        var url = '{{ route("turnero.stats","") }}/'+$('#datepicker').datepicker('getFormattedDate');
        var sucursal_id = '{{ $sucursal->id }}';
        $.get(url,{'sucursal_id':sucursal_id},function(data){
            $('#n_turnos').html(data.n_turnos);
            $('#turnos_disponibles').html(data.turnos_disponibles);
            $('#digito-placa').html(data.digitos);
            if(data.last_turno){
                $('#last_turno').html(data.last_turno.turno);
                $('#last_turno_hora').html(data.last_turno.hora);
            }else{
                $('#last_turno').html(0);
                $('#last_turno_hora').html('');
            }
            validarDigito();
            if(placa_valida && cedula_valida && fecha_seteada && digito_valido){
                $('#submit').removeAttr("disabled");
            }
        },'json');
    });

    $('#reimprimir').on('click',function(){
        var placa = $('#placa').val();
        var cedula = $('#cedula').val();
        var fecha = $('#fecha').val();
        $.post('{{ route("turnero.reimpresion") }}',{
            '_token':'{{ csrf_token() }}',
            'placa':placa,'cedula':cedula,'fecha':fecha
        },function(data){
            if(data.existe){
                location.href = "{{ route('turnos.print','') }}/"+data.turno;
            }else{
                $('#message').html(data.msg);
            }
        },'json');
    });

  });
</script>
<!-- La función desabilita el botón F12 para la inspección de código -->
<script>
    /*document.oncontextmenu = function(){return false;}*/
    // document.onkeydown=function (e){
    //     var currKey=0,evt=e||window.event;
    //     currKey=evt.keyCode||evt.which||evt.charCode;
    //     if (currKey == 123) {
    //         window.event.cancelBubble = true;
    //         window.event.returnValue = false;
    //     }
    // }
    
 </script>
 
<!-- La función no permite que le usuario regrese con el botón back -->
<script>
        $(document).ready(function() {
            function disableBack() {
                window.history.forward()
            }
            window.onload = disableBack();
            window.onpageshow = function(e) {
                if (e.persisted)
                    disableBack();
            }
        });
    </script>
   
  <!-- La función recarga la página cada 3min -->
<script type="text/javascript">
function actualizar(){location.reload(true);}
//Función para actualizar cada 3 min
setInterval("actualizar()",120000);
</script>
<!-- END JAVASCRIPTS -->
@endsection