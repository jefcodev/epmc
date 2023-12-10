@extends('front.template.base')

@section('title','Consultas')
<body oncontextmenu="return false"></body>
@section('css')
<style>
    #contact{
        padding-top: 0 !important;
    }
    #features{
        padding-top: 0 !important;
    }
    #message{
        color: red;
        font-weight: 700;
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
                <h2 class="white op-1">Consultas</h2>
                <p class="home-subheading op-1"></p>
            </div>
            
        </div>
    </section>
    <!-- End Page Top --> 
    
    <div class="site-wrapper content">

        <section id="breadcrumb">
            <div class="container">
                
                <ul class="breadcrumb">
                    <li><a href="{{ route('home') }}" title="Inicio">Inicio</a></li>
                    <li><a href="{{ route('home') }}#services" title="Servicios">Servicios</a></li>
                    <li>Consultas</li>
                </ul>
                    
            </div>
        </section>


        <!-- Start Consultas Section --> 
        @include('front.home.consultas_section')
        <!-- End Consultas Section -->
        
    	<!-- Start Consultas Section --> 
        @include('front.home.placas_section')
        <!-- End Consultas Section -->      

        <!-- Start Footer 1 -->
        @include('front.template.footer')
        <!-- End Footer 1 -->
        
        <!-- Start Back To Top -->
        <a id="back-to-top"><i class="icon ion-chevron-up"></i></a>
        <!-- End Back To Top -->
        

    </div> <!-- End Site Wrapper --> 

@endsection

@section('js')
<script>
    $('#consulta-form').on('submit',function(e){
        e.preventDefault();
        var placa = $('#placa').val();
        $.post('{{ route("placas.consultar") }}',{'_token':'{{ csrf_token() }}', 'placa':placa},function(data){
            $('#message').html(data.msg);
        },'json');
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