@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Buscar Turnos</h1>

        <form action="{{ route('buscar.turnos') }}" method="GET">
            @csrf
            <div class="form-group">
                <label for="placa">Placa:</label>
                <input type="text" name="q" id="placa" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>

        @if(isset($resultados) && count($resultados) > 0)
            <h2>Resultados:</h2>
            <ul>
                @foreach($resultados as $resultado)
                    <li>Cédula: {{ $resultado->cedula }}, Requisito ID: {{ $resultado->requisito_id }}, Sucursal ID: {{ $resultado->sucursal_id }}</li>
                @endforeach
            </ul>
        @else
            <p>No se encontraron resultados.</p>
        @endif
    </div>
@endsection
