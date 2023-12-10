@extends('front.template.base')

@section('title','Turnos')
<body oncontextmenu = "return false"> </body>
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
		    		<!-- <li><a href="{{ route('home') }}" title="Inicio">Inicio</a></li>
		    		<li><a href="{{ route('home') }}#services" title="Servicios">Servicios</a></li> -->
		    		<li>Sistema de emisión de Turnos</li>
		    	</ul>
		    </div>
		</section>

        <!-- End Turnero List --> 
        <section id="contact">
            <div class="container">
                <div class="row">

                    @if(Auth::user())
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
                        @if(Auth::user()->turnos()->count() < Auth::user()->turnos_disponibles )
                            <div class="col-md-12">
                                <h3 class="section-title wow fadeInUp">Genera tu turno</h3>
                                <h4 class="text-center">Por favor seleccione la Sucursal en la que necesita obtener su turno</h4>
                            </div>
                            <div class="col-md-6 col-md-offset-3 text-center wow fadeInUp">
                                
                                <!-- Contact Form will be functional only on your server. Upload to your server when testing. -->
                                <form method="post" action="{{ route('turnero.seleccion.store') }}" >
                                    {{ csrf_field() }}
                                    <fieldset>
                                        <select name="sucursal_id" id="sucursal_id" required class="form-control" required>
                                            @foreach($sucursales as $sucursal)
                                                <option value="{{ $sucursal->id }}">{{ $sucursal->nombre }}</option>
                                            @endforeach
                                        </select>
                                        <div id="info"></div>

                                    </fieldset>
                                    <input type="submit" class="submit" id="submit" value="Siguiente" />
                                </form>
                            </div>
                        @else
                            <div class="col-md-12">
                                <h3 class="section-title wow fadeInUp">Turnos agotados</h3>
                                <h4 class="text-center"> Usted ya ha utilizado el total de <strong>{{ $total_turnos_x_usuario }}</strong> turnos disponibles por cliente </h4>
                            </div>
                        @endif
                    @else
                        <div class="col-md-12">
                            <h3 class="section-title wow fadeInUp">Regístrate para generar tu turno</h3>
                            <h4 class="text-center">Por favor inicia sesión o crea una cuenta para continuar</h4>
                        </div>
                        <div class="col-md-6 text-center">
                            <a href="{{ route('login') }}" class="btn btn-primary submit">Iniciar sesión</a>
                        </div>
                        <div class="col-md-6 text-center">
                            <a href="{{ route('register') }}" class="btn btn-primary submit">Crear cuenta</a>
                        </div>
                    @endif

                    <div class="col-md-12 text-center wow fadeInUp" style="margin-top:20px;">
                        <blockquote>
                            <i class=" dark-grey">Trabajamos por una movilidad diferente</i>
                        </blockquote>
                        <br>
                        <div id="message"></div>
                        <!-- <a href="{{ route('turnero.vista.reimpresion') }}" class="btn btn-primary submit">Reimprimir turno</a> -->
                    
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

  $(document).ready(function(){


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
    
 </script>
<!-- END JAVASCRIPTS -->
@endsection