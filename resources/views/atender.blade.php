<!-- resources/views/atender.blade.php -->
@extends('back.template.base')
@section('content')

@section('css')

<style>
    .flex {
        display: flex;
        justify-content: space-between;
        padding: 2rem;
    }
</style>
@endsection
<div class="page-title">
    <h3>Atender</h3>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                
            @if($turno)
                <form method="post" action="/atender/turno/{{$turno->id_turno}}">
                    @csrf
                    <button type="submit">Atender</button>
                </form>

                <p>ID del Turno: {{ $turno->id_turno }}</p>
                <p>Turno: {{ $turno->turno }}</p>
                <p>Tipo: {{ $turno->tipo }}</p>
                <p>Hora de inicio: {{ $turno->hora_inicio }}</p>
                @else
                    <p>No hay turnos disponibles en este momento.</p>
                @endif




            </div>
        </div>
    </div>
</div>
@endsection