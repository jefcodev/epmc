@extends('front.template.base')

@section('title','Lotaip')
<body oncontextmenu="return false"></body>
@section('content')
    <!-- Start Home Revolution Slider Parallax Section -->
        <section id="page-top" style="height:400px">
    <div class="hero">
    
        <img src="{{ asset('front/img/backgrounds/bg-shortcodes.jpg') }}" alt="hero">

        <div class="page-top-title text-center">
            <h2 class="white op-1">Ley de Transparencia</h2>
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
		    		<li><a href="{{ route('home') }}#services" title="Transparencia">Transparencia</a></li>
		    		<li>Lotaip</li>
		    	</ul>
		            
		    </div>
		</section>

    	 <!-- Start Formularios Section --> 
               <!-- Start Price List -->
            <section id="" class="parallax-section-5">
                <div class="container">
                    <div class="row wow fadeInUp">
                             
                         <div class="col-md-12 shortcode-title wow fadeIn">
                            <h3 class="section-title">LOTAIP</h3> 
                            <p class="text-justify">{{ $general->where('nombre','=','lotaip_articulo')->first()->valor}}</p>
                        </div>

                        <div class="col-md-12 col-sm-12">
                            <div class="bs-example bs-example-tabs">

                                <ul id="myTab" class="nav nav-tabs">
                                    @foreach($periodos as $index=>$periodo)
                                    <li class="@if($index==0) active @endif"><a href="#tab-{{ $periodo->anio }}" data-toggle="tab">{{ $periodo->anio }}</a></li>
                                    @endforeach
                                </ul>

                                <div id="myTabContent" class="tab-content">
                                    @foreach($periodos as $index=>$periodo)
                                    <div class="tab-pane fade @if($index==0) active in @endif" id="tab-{{ $periodo->anio }}">
                                        <table class="table table-hovered table-bordered table-responsive">
                                            <tbody>
                                                @foreach($articulos as $articulo)
                                                <tr>
                                                    <td>
                                                        <span class="feature"><strong>{{ $articulo->literal }})</strong> {{ $articulo->articulo }}</span>
                                                    </td>
                                                    <?php $n_mes=1; ?>
                                                    @foreach($periodo->meses as $index2 => $mes)
                                                        <td>
                                                            @if($articulo->documentoPeriodo($periodo->anio,$n_mes)->count()>0)
                                                                @if($articulo->documentoPeriodo($periodo->anio,$n_mes)->first()->tipo=="documento")
                                                                    <a href="{{ asset('uploads/'.$articulo->documentoPeriodo($periodo->anio,$n_mes)->first()->documento->ruta ) }}" class="bg-info" target="_blank"><i class="fa fa-eye"></i> {{ $mes }}</a>
                                                                @else
                                                                    <a href="{{ asset('uploads/'.$articulo->documentoPeriodo($periodo->anio,$n_mes)->first()->url_documento ) }}" class="bg-info" target="_blank"><i class="fa fa-eye"></i> {{ $mes }}</a>
                                                                @endif
                                                            @else
                                                                {{ $mes }}
                                                            @endif
                                                        </td>
                                                        <?php  $n_mes++; ?>
                                                    @endforeach
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @endforeach
                                </div>

                            </div><!-- End bs-example -->

                        </div>  
                    </div>
                </div>
            </section>        
            <!-- End Price List --> 
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