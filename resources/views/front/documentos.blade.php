@extends('front.template.base')

@section('title',$categoria->categoria)
<body oncontextmenu="return false"></body>
@section('content')
    <!-- Start Home Revolution Slider Parallax Section -->
    <!-- Start Page Top -->  
    <section id="page-top" style="height:400px">
    <div class="hero">
    
        <img src="{{ asset('front/img/backgrounds/bg-shortcodes.jpg') }}" alt="hero">

        <div class="page-top-title text-center">
            <h2 class="white op-1">{{ $categoria->categoria }}</h2>
            <p class="home-subheading op-1"></p>
        </div>
        
    </div>
    </section>
    <!-- End Page Top --> 
    <!-- End Home Revolution Slider Parallax Section -->
    
    <div class="site-wrapper content">
       
        <section id="breadcrumb">
            <div class="container">
                
                <ul class="breadcrumb">
                    <li><a href="{{ route('home') }}" title="Inicio">Inicio</a></li>
                    <li><a href="{{ route('home') }}" title="Documentos">Documentos</a></li>
                    <li>{{ $categoria->categoria }}</li>
                </ul>
                    
            </div>
        </section>

        <!-- Start Team Section -->
            <section id="team">
                <div class="container"> 
                    
                    <div class="col-md-12 text-center wow fadeInUp">
                        <h3 class="section-title">{{ $categoria->categoria }}</h3> 
                        <p class="subheading">{{ $categoria->descripcion }}</p>
                    </div>
                    
                    <div class="row">
                        @foreach($documentos as $documento)
                    
                        <div class="col-md-4 col-sm-12 feature-column">
                            <div class="feature-icon">
                                <i class="document-text-outline size-2x highlight"></i>
                                <i class="document-text-outline back-icon"></i>
                            </div>
                            <div class="feature-info">
                                <h4><a href="{{ asset('uploads/'.$documento->ruta) }}" title="{{ $documento->nombre }}" target="_blank">{{ $documento->nombre }}</a></h4>
                                <p class="feature-description">{{ $documento->descripcion }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>
            <!-- End Team Section -->

        <!-- Start Footer 1 -->
        @include('front.template.footer')
        <!-- End Footer 1 -->
        
        <!-- Start Back To Top -->
        <a id="back-to-top"><i class="icon ion-chevron-up"></i></a>
        <!-- End Back To Top -->

    </div> <!-- End Site Wrapper --> 

@endsection

@section('js')

<script src="{{ asset('front/js/plugins/masonry.js') }}"></script>  
<script>
    var msnry = new Masonry( '#masonry', {
      // options
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
@endsection