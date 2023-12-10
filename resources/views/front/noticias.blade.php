@extends('front.template.base')

@section('title','Noticias')
<body oncontextmenu="return false"></body>
@section('content')
    <!-- Start Home Revolution Slider Parallax Section -->
    <!-- Start Page Top -->  
    <section id="page-top" style="height:400px">
    <div class="hero">
    
        <img src="{{ asset('front/img/backgrounds/bg-shortcodes.jpg') }}" alt="hero">

        <div class="page-top-title text-center">
            <h2 class="white op-1">NOTICIAS</h2>
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
                    <li>Noticias</li>
                </ul>
                    
            </div>
        </section>
    <!-- Start Blog Classic -->
        <section id="blog">
            <div class="container">
                
                <div id="masonry">
                    
                    @foreach($noticias_destacadas as $noticia)
                        <div class="column">
                            <div class="blog-column">
                                <a href="{{ route('noticia',$noticia->slug) }}"><img class="img-responsive blog-img" src="{{ asset('front/img/news/'.$noticia->imagen) }}" alt=""></a>
                                <div class="column-info">
                                    <h4 class="uppercase"><a href="{{ route('noticia',$noticia->slug) }}">{{ $noticia->titulo }}</a></h4>                            
                                    <ul class="blog-post-info">
                                        <li><a href="#"><i class="ion-calendar"></i> {{ $noticia->fecha->diffForHumans() }}</a></li>  
                                        <!--<li><a href="#"><i class="ion-folder"></i> {{ $noticia->tags }}</a></li>-->
                                    </ul>    
                                    <p class="text-justify">{!! substr(strip_tags($noticia->contenido), 0,200) !!}...</p>
                                    <a class="btn btn-primary btn-xs" href="{{ route('noticia',$noticia->slug) }}">Leer más</a>                                    
                                </div>
                            </div>
                        </div>
                    @endforeach

                    @foreach($noticias as $noticia)
                        <div class="column">
                            <div class="blog-column">
                                <a href="{{ route('noticia',$noticia->slug) }}"><img class="img-responsive blog-img" src="{{ asset('front/img/news/'.$noticia->imagen) }}" alt=""></a>
                                <div class="column-info">
                                    <h4 class="uppercase"><a href="{{ route('noticia',$noticia->slug) }}">{{ $noticia->titulo }}</a></h4>                            
                                    <ul class="blog-post-info">
                                        <li><a href="#"><i class="ion-calendar"></i> {{ $noticia->fecha->diffForHumans() }}</a></li>  
                                        <!--<li><a href="#"><i class="ion-folder"></i> {{ $noticia->tags }}</a></li>-->
                                    </ul>    
                                    <p class="text-justify">{!! substr(strip_tags($noticia->contenido), 0,200) !!}...</p>
                                    <a class="btn btn-primary btn-xs" href="{{ route('noticia',$noticia->slug) }}">Leer más</a>                                    
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                    
                <hr>
                @if($noticias->hasMorePages())
                <!-- Pager -->
                <ul class="pager">
                    <li class="previous">
                        <a href="{{ $noticias->previousPageUrl() }}"><i class="ion-android-arrow-back"></i></a>
                    </li>
                    <li class="next">
                        <a href="{{ $noticias->nextPageUrl() }}"><i class="ion-android-arrow-forward"></i></a>
                    </li>
                </ul>
                @endif
                
            </div>
        
        </section>


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