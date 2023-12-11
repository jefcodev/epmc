@extends('layouts.app')

@section('content')
    <!-- En tu vista resultado.blade.php -->
    @if(session('success'))
    <div style="color: green;">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div style="color: red;">
        {{ session('error') }}
    </div>
    @endif

    <!-- Resto de tu vista -->
    <h1>Resultado de Búsqueda</h1>

    @if(isset($turno))
    <p>Fecha: {{ $turno->fecha }}</p>
    <p>Número de Cédula: {{ $turno->cedula }}</p>
    <p>Placa: {{ $turno->placa }}</p>
    @php
        $tipo = 'A';
        $requisito = App\Requisito::find($turno->requisito_id);
        $nombreRequisito = $requisito ? $requisito->nombre : 'No Disponible';
    @endphp
    <p>Requisito: {{ $nombreRequisito  }}</p>

    <form method="post" action="{{ route('agregar.tipo', ['id_turno' => $turno->id, 'tipo' => $tipo]) }}">
        @csrf
        <label for="tipo">Seleccionar Categoría:</label>
        <select name="tipo" required >
            <option value="{{$tipo='A'}}">General</option>
            <option value="{{$tipo='B'}}">Especial - (3era Edad, Embarazadas, Especial)</option>
        </select>
        <button type="submit">Generar Turno</button>
    </form>
    @else
    <p>No se encontró nada.</p>
    @endif
@endsection