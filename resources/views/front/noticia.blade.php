@extends('front.template.base')

@section('fb_url',URL::current())
@section('fb_title',$noticia->titulo)
@section('fb_description',$noticia->subtitulo)

@if($noticia->imagen)
    @section('fb_img',asset('front/img/news/'.$noticia->imagen))
@endif

@section('title',$noticia->titulo)
<body oncontextmenu="return false"></body>
@section('content')
    <!-- Start Home Revolution Slider Parallax Section -->
    <!-- Start Page Top -->  
    <section id="page-top" style="height:400px">
    <div class="hero">
    
        <img src="{{ asset('front/img/backgrounds/bg-shortcodes.jpg') }}" alt="hero">

        <div class="page-top-title text-center">
            <h2 class="white op-1">{{ $noticia->titulo }}</h2>
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
                    <li><a href="{{ route('noticias') }}" title="Noticias">Noticias</a></li>
                    <li>{{ $noticia->titulo }}</li>
                </ul>
                    
            </div>
        </section>

        <!-- Start Blog Classic -->
        <section id="blog">
            <div class="container">
                <div class="row">
                    
                    <!-- Blog Post -->
                    <div class="col-md-8"> 
                        
                        <div class="blog-post"> 
                            <h3 class="blog-post-title"><a href="#">{{ $noticia->titulo }}</a></h3>   
                            <p class="lead">{{ $noticia->subtitulo }}</p>
                            <ul class="blog-post-info">
                                <li><a href="#"><i class="ion-clock"></i> {{ $noticia->fecha->diffForHumans() }}</a></li>
                                <!--<li><a href="#"><i class="ion-folder"></i> {{ $noticia->tags }}</a></li>-->
                            </ul>   
                            @if($noticia->imagen)
                            <a href="#"><img class="img-responsive blog-img" src="{{ asset('front/img/news/'.$noticia->imagen) }}" alt="{{ $noticia->titulo }}"></a>
                            @endif
                            {!! $noticia->contenido !!}

                        </div> 
                         
                        
                        
                        
                        
                        <!-- Comment Form 
                        <div class="comment-form">
                            <h4 class="comments-title">Leave a comment</h4>
                             
                            <form method="post" action="php/contact-form.php" name="contactform" id="contactform">
                                <fieldset>
                                        <input name="name" type="text" id="name" placeholder="Name"/> 
                                        <input name="email" type="text" id="email" placeholder="Email"/>  
                                        <input name="subject" type="text" id="subject" placeholder="Website"/> 
                                </fieldset>
                                <fieldset> 
                                        <textarea name="comments" cols="40" rows="3" id="comments" placeholder="Comment"></textarea>
                                </fieldset> 
                            </form>  
                            <a class="btn btn-primary btn-xs" href="#">Post Comment</a>
                        </div>
                        <!--/Comment Form -->
                        
                        <hr>
                        <!-- Pager -->
                        
                        <ul class="pager">
                            @if($anterior)
                            <li class="previous">
                                <a href="{{ route('noticia',$anterior->slug) }}"><i class="ion-android-arrow-back"></i></a>
                            </li>
                            @endif

                            @if($siguiente)
                            <li class="next">
                                <a href="{{ route('noticia',$siguiente->slug) }}"><i class="ion-android-arrow-forward"></i></a>
                            </li>
                            @endif
                        </ul>

                    </div>
                    
                    
                    <div class="col-lg-4 blog-sidebar">
                        <!--<div class="blog-widget-container">
                            <h4></h4>
                            <div class="input-group">
                                <input type="text" class="form-control search" placeholder="Search Blog">
                                <span class="input-group-btn">
                                    <button class="btn search-button" type="button" type="submit">
                                        <span class="ion-search"></span>
                                    </button>
                                </span>
                            </div> 
                        </div>-->

                        <!--<div class="blog-widget-container">
                            <h4 class="uppercase">TEXT WIDGET</h4>
                            <p></p>
                        </div>-->

                        <div class="blog-widget-container">

                            <h4 class="uppercase">Imágenes</h4>
                            
                            <div id="owl-example" class="owl-carousel">
                                <div> Your Content </div>
                                <div> Your Content </div>
                                <div> Your Content </div>
                                <div> Your Content </div>
                            </div>

                        </div> 

                        <div class="blog-widget-container">

                            <h4 class="uppercase">Servicios</h4>
                            <ul class="blog-list">
                                <li><a href="{{ route('requisitos') }}" title="Requisitos">Requisitos</a></li>
                                <li><a href="{{ route('consultas') }}" title="Consultas">Consultas</a></li>
                                <li><a href="{{ route('formularios') }}" title="Formularios">Formularios</a></li>
                            </ul>

                        </div>                        
                   
                    </div>
                    
                </div>
            </div>
        </section>
        <!-- End Blog Classic -->

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