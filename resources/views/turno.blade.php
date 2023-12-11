<!-- resources/views/resultado.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <title>Resultado de Turno </title>
</head>

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


</html>