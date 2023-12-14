@extends('front.template.base')
@section('js')
@section('title','Turno '.$turno->turno)

@section('css')
<style>
    .print{
        padding-top: 0px !important;
        padding-bottom: : 0px !important;
    }
    .logo-big{
        height: 140px;
    }
</style>
@endsection
@section('content')
    
    <div class="site-wrapper content">

        <!-- End Turnero List --> 
        <section id="" class="print">
            <div class="container">
                <div class="row">
                    
                    <div class="col-md-12 text-center">
                        <img src="{{ asset('front/img/assets/logo-blanco.png') }}" alt="EPMC" class="logo-big ">
                    </div>
                    
                    <div class="col-md-6 col-md-offset-3 text-center wow fadeInUp">
                        <div id="message"></div>
                        <!-- Contact Form will be functional only on your server. Upload to your server when testing. -->
                        <table class="table table-hovered table-responsive">
                            <tbody>
                                <tr>
                                    <th>Sucursal</th>
                                    <td><strong>{{ $turno->sucursal->nombre  }}</strong></td>
                                </tr>
                                <tr>
                                    <th>Turno #</th>
                                    <td><strong>{{ $turno->turno  }}</strong></td>
                                </tr>
                                <tr>
                                    <th>Trámite</th>
                                    <td>{{ $turno->requisito->nombre }}</td>
                                </tr>
                                <tr>
                                    <th>Fecha</th>
                                    <td>{{  $turno->fecha->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Hora</th>
                                    <td>{{ $turno->hora }}</td>
                                </tr>
                                <tr>
                                    <th>Cédula</th>
                                    <td>{{ $turno->cedula }}</td>
                                </tr>
                                <tr>
                                    <th>Placa</th>
                                    <td>{{ $turno->placa }}</td>
                                </tr>
                                <tr>
                                    <th>Código</th>
                                    <td>
                                       {!! QrCode::size(110)->generate('Sucursal: '.$turno->sucursal->nombre.' - Tramite: '.$turno->requisito->nombre.' - Turno: '.$turno->turno.' - Cedula: '.$turno->cedula.' - Codigo: '.$turno->codigo); !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <img src="{{ asset('requisitos/'.$turno->requisito->ruta) }}" alt="{{ $turno->requisito->nombre }}">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <p><strong><u><font size="5">Recuerde que la generación del turno es gratuita y que debe llegar con 15 minutos de anticipación</font></u></strong></p>
                    </div>                                               
                </div>
            </div>
        </section>
        <!-- End Turnero Section -->
        
    </div> <!-- End Site Wrapper --> 

<!-- La función desabilita el botón F12 para la inspección de código -->
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
<!-- La función desabilita el click derecho -->
<script type=»text/javascript»>

document.oncontextmenu = function(){return false;}

</script>
@endsection

@section('js')
<script>
    setTimeout(function(){
        window.print();
    },2500);
</script>
@endsection