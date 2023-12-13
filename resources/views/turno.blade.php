@extends('layouts.app')
@section('js')
@section('title','1')

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
<body>
    @if(session('success'))
    <div style="color: green;">
        {{ session('success') }}
        @if(session('detallesTurno'))
            <p>Detalles del nuevo turno:</p>
            <p>ID: {{ session('detallesTurno')->id }}</p>
            <p>Turno: {{ session('detallesTurno')->turno }}</p>
            <p>Tipo: {{ session('detallesTurno')->tipo }}</p>
            <!-- Agrega más detalles según las propiedades de tu modelo tur_turno -->
        @endif
    </div>
    @endif

    @if(session('error'))
    <div style="color: red;">
        {{ session('error') }}
    </div>
    @endif
    <h1>Resultado de Turno</h1>
    
</body>

<!-- La función desabilita el botón F12 para la inspección de código -->


@section('js')
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
<script>
    setTimeout(function(){
        window.print();
    },2500);
</script>
@endsection
</html>