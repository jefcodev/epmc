@extends('front.template.base')

@section('content')
<body oncontextmenu="return false"></body>
    <!-- Start Home Revolution Slider Parallax Section -->
    @include('front.home.slider')
    <!-- End Home Revolution Slider Parallax Section -->
    
    <div class="site-wrapper content">
        
        <!-- Start Services Section -->
        @include('front.home.servicios')
        <!-- End Services Section --> 

        <!-- Start About Section --> 
        @include('front.home.about')
        <!-- End About Section -->      
        
        <!-- Start Fun Facts Section -->
        @include('front.home.counters')
        <!-- End Fun Facts Section --> 
                 
        
        <!-- Start Get Connected -->
        @include('front.home.redes_sociales')
        <!-- End Get Connected -->                
        
        <!-- Start Contact Form Section -->    
        @include('front.home.contact')
        <!-- End Contact Form Section -->
        
        <!-- Start Google Map Section -->
        <div id="map"></div>
        <!-- End Google Map Section -->
        
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