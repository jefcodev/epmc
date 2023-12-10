@extends('front.template.base')
<body oncontextmenu="return false"></body>
@section('content')
    <!-- Start Home Revolution Slider Parallax Section -->
    @include('front.home.slider')
    <!-- End Home Revolution Slider Parallax Section -->
    
    <div class="site-wrapper content">

        <section id="breadcrumb">
            <div class="container">
                
                <ul class="breadcrumb">
                    <li><a href="{{ route('home') }}" title="Inicio">Inicio</a></li>
                    <li><a href="{{ route('home') }}#about" title="Institución">Institución</a></li>
                    <li>Quiénes Somos</li>
                </ul>
                    
            </div>
        </section>
        <!-- Start About Section --> 
        @include('front.home.about')
        <!-- End About Section -->      
        
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