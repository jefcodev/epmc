<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Meta Data -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" sizes="57x57" href="apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
        <link rel="manifest" href="/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">

        <meta property="fb:app_id"             content="571464493580734" />
        <meta property="og:url"                content="@yield('fb_url','http://epmc.gob.ec/')" />
        <meta property="og:type"               content="article" />
        <meta property="og:title"              content="@yield('fb_title','Empresa Pública de Movilidad Mancomunidad de Cotopaxi')" />
        <meta property="og:description"        content="@yield('fb_description','Trabajamos por una movilidad diferente')" />
        <meta property="og:image"              content="@yield('fb_img','http://epmc.gob.ec/img/crane.png')" />

        <title>@yield('title','Inicio') | EPMC</title>
        <meta name="description" content="Empresa Pública de Movilidad Mancomunidad de Cotopaxi" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
        
        <!-- Stlylesheet -->
        <link href="{{ asset('front/css/style.css') }}" rel="stylesheet" type="text/css" />
        
        <!-- Skin Color -->
        <link rel="stylesheet" href="{{ asset('front/css/colors/red.css') }}" id="color-skins"/> 

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-159218650-1"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'UA-159218650-1');
        </script>

        @yield('css')
    </head>
    <body> 
        
        <!-- Start Preloader -->
        <div id="preloader">
            <div class="loader">  
                <img src="{{ asset('front/img/assets/preloader-logo.png') }}" alt="EPMC"> 
            </div>
        </div>
        <!-- End Preloader -->
        
        <!-- Start Header -->
        @if(!@$no_header)
            @include('front.template.header')
        @endif
        <!-- End Header -->

        @yield('content')
        
        <!-- jQuery -->
        <script src="{{ asset('front/js/plugins/jquery.min.js' ) }}"></script>
        <script src="{{ asset('front/js/plugins/moderniz.min.js' ) }}"></script>
        <script src="{{ asset('front/js/plugins/smoothscroll.min.js' ) }}"></script>
        <script src="{{ asset('front/js/plugins/revslider.min.js' ) }}"></script> 
        <script src="{{ asset('front/js/plugins/bootstrap.min.js' ) }}"></script>
        <script src="{{ asset('front/js/plugins/waypoints.min.js' ) }}"></script>
        <script src="{{ asset('front/js/plugins/parallax.min.js' ) }}"></script>
        <script src="{{ asset('front/js/plugins/easign1.3.min.js' ) }}"></script> 
        <script src="{{ asset('front/js/plugins/cubeportfolio.min.js' ) }}"></script>
        <script src="{{ asset('front/js/plugins/owlcarousel.min.js' ) }}"></script>
        <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBCT_YSl_vNgxGOsCdJvOGlbIe0_9K_MA4&sensor=false&amp;language=es"></script>
        <script src="{{ asset('front/js/plugins/gmap3.min.js' ) }}"></script>
        <script src="{{ asset('front/js/plugins/wow.min.js' ) }}"></script>
        <script src="{{ asset('front/js/plugins/counterup.min.js' ) }}"></script> 
        <script src="{{ asset('front/js/scripts.js' ) }}"></script>  
        @if(Auth::user())
        <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>

        <script>
            let user_id = '{{ Auth::user()->id }}';
            
            window.Echo.channel('outman-user-' + user_id)
                .listen('UserAuthenticatedEvent', () => {
                    this.alerting = true
                    setTimeout(() => {
                        window.location ='/login'
                    }, 3000)
                })
        </script>
        @endif
        @yield('js')
    </body>
</html>