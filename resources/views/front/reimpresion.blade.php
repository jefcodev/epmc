@extends('front.template.base')

@section('title','Turnos')
<body oncontextmenu="return false"></body>
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

@section('content')
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
                    <div class="col-md-12">
                        <h3 class="section-title wow fadeInUp">Reimpresión de turno</h3>
                        <p class="text-center">Ingrese los mismos datos con los que generó su turno, para reimprimirlo</p>
                    </div>
                    <div class="col-md-6 col-md-offset-3 text-center wow fadeInUp">
                        
                        <!-- Contact Form will be functional only on your server. Upload to your server when testing. -->
                        <form method="post" action="#" >
                            {{ csrf_field() }}
                            <fieldset>
                                <select name="sucursal_id" id="sucursal_id" required class="form-control" required>
                                    @foreach($sucursales as $sucursal)
                                        <option value="{{ $sucursal->id }}">{{ $sucursal->nombre }}</option>
                                    @endforeach
                                </select>
                                <select name="requisito_id" id="requisito_id" required class="form-control">
                                    @foreach($requisitos as $requisito)
                                        <option value="{{ $requisito->id }}">{{ $requisito->nombre }}</option>
                                    @endforeach
                                </select>
                                <div id="info" class="text-danger"></div>
                                <input name="cedula" type="text" id="cedula" placeholder="Nº Cédula / RUC" required />  
                                <div id="info-placa" class="text-danger"></div>
                                <input name="placa" type="text" id="placa" placeholder="Placa" required/>
                                <div id="info-digito" class="text-danger"></div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="datepicker" data-date=""  class="text-center"></div>
                                        <input type="hidden" name="fecha" id="fecha">
                                    </div>
                                </div>

                                <!--<input name="fecha" type="text" id="fecha" placeholder="Fecha para turno" required/>-->

                            </fieldset>
                                               <div id="message"></div>
                            <hr>
                            <input type="button" class="submit"  id="reimprimir" value="Reimprimir turno" />
                        </form>
                    </div>  
                    <div class="col-md-12 text-center wow fadeInUp" style="margin-top:20px;">
                        <blockquote>
                          <i class=" dark-grey">Trabajamos por una movilidad diferente</i>
                        </blockquote>
                        <br>
    
                        
                    </div>
                    
                  
                                             
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
    var cedula_valida=false;
    var digito_valido=true;
    var fecha_seteada=false;

  $(document).ready(function(){
    $("#placa").inputmask("aa[a]-999[9|a]");
    $("#cedula").inputmask("9999999999[999]");

    $('#datepicker').datepicker({
        language: 'es',
        format: 'yyyy-mm-dd',
        weekStart:1,
        startDate: Date('Y-m-d'),
        autoclose: true,
        todayHighlight: true,
    });

    function validarDigito(){
        var placa = $('#placa').val().replace('-','');
        placa = placa.replace('_','');
        var ultimo_digito = placa.slice(-1);
        if(ultimo_digito.toLowerCase().match(/[a-z]/i)){
            ultimo_digito=placa.slice(-2,-1);
        }
        if($('#digito-placa').html().includes(ultimo_digito)>0){
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
<script>
    /*document.oncontextmenu = function(){return false;}*/
    document.onkeydown=function (e){
        var currKey=0,evt=e||window.event;
        currKey=evt.keyCode||evt.which||evt.charCode;
        if (currKey == 123) {
            window.event.cancelBubble = true;
            window.event.returnValue = false;
        }
    }
    
<!-- La función desabilita el botón F12 para la inspección de código -->
<script>
    /*document.oncontextmenu = function(){return false;}*/
    document.onkeydown=function (e){
        var currKey=0,evt=e||window.event;
        currKey=evt.keyCode||evt.which||evt.charCode;
        if (currKey == 123) {
            window.event.cancelBubble = true;
            window.event.returnValue = false;
        }
    }
    
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
 </script>
<!-- END JAVASCRIPTS -->
@endsection