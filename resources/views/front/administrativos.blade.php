@extends('front.template.base')

@section('title','Equipo Administrativo')
<body oncontextmenu="return false"></body>
@section('css')

<style type="text/css" media="screen">
    .row-centered {
        text-align:center;
    }
    .col-centered {
        display:inline-block;
        float:none;
        text-align: center;
    }
</style>
@endsection

@section('content')
    <!-- Start Home Revolution Slider Parallax Section -->
    <!-- Start Page Top -->  
    <section id="page-top" style="height:400px">
    <div class="hero">
    
        <img src="{{ asset('front/img/backgrounds/bg-shortcodes.jpg') }}" alt="hero">

        <div class="page-top-title text-center">
            <h2 class="white op-1">Equipo Administrativo</h2>
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
                    <li><a href="{{ route('home') }}" title="Institución">Institución</a></li>
                    <li>Equipo Administrativo</li>
                </ul>
                    
            </div>
        </section>

        @include('front.home.administrativos',['title'=>'Equipo Administrativo','subtitle'=>'Conoce a nuestro personal administrativo'])

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