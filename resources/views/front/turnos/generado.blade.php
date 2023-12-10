@extends('front.template.base')

@section('title','Turnos')

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
		    		<li><a href="{{ route('turnero',$turno->sucursal->slug) }}">Sistema de emisión de Turnos</a></li>
                    <li>Turno {{ $turno->turno }}</li>
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

                    <div class="col-md-12">
                        <h2 class="section-title wow fadeInUp">Turno # {{ $turno->turno }}</h2>
                    </div>
                    
                    <div class="col-md-6 col-md-offset-3 text-center wow fadeInUp">
                        <div id="message"></div>
                        <!-- Contact Form will be functional only on your server. Upload to your server when testing. -->
                        <table class="table table-hovered table-responsive">
                            <tbody>
                                <tr>
                                    <th>Sucursal</th>
                                    <td><strong>{{ $turno->sucursal->nombre }}</strong></td>
                                </tr>
                                <tr>
                                    <th>Trámite</th>
                                    <td>{{ $turno->requisito->nombre }}</td>
                                </tr>
                                <tr>
                                    <th>Fecha</th>
                                    <td>{{  $turno->fecha->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Hora</th>
                                    <td>{{ $turno->fecha->format('H:i:s') }}</td>
                                </tr>
                                <tr>
                                    <th>Cédula</th>
                                    <td>{{ $turno->cedula }}</td>
                                </tr>
                                <tr>
                                    <th>Placa</th>
                                    <td>{{ $turno->placa }}</td>
                                </tr>
                                <tr>
                                    <th>Código</th>
                                    <td>
                                        {!! QrCode::size(100)->generate($turno->codigo); !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <a href="{{ route('turnos.print',$turno->codigo_aux) }}" class="print" target="_blank" id="print" />Imprimir Turno</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <img src="{{ asset('requisitos/'.$turno->requisito->ruta) }}" alt="{{ $turno->requisito->nombre }}">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <p><strong><u><font size="5">Recuerde que la generación del turno es gratuita y que debe llegar con 15 minutos de anticipación</font></u></strong></p>
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