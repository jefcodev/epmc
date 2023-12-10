@extends('front.template.base')

@section('title','Formularios')
<body oncontextmenu="return false"></body>
@section('content')
    <!-- Start Home Revolution Slider Parallax Section -->
    <section id="page-top" style="height:400px">
        <div class="hero">
        
            <img src="{{ asset('front/img/backgrounds/bg-shortcodes.jpg') }}" alt="hero">

            <div class="page-top-title text-center">
                <h2 class="white op-1">Mancomunidad de Cotopaxi</h2>
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
		    		<li>Formularios</li>
		    	</ul>
		            
		    </div>
		</section>

    	 <!-- Start Formularios Section --> 
        @include('front.home.formularios_section')
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
@endsection