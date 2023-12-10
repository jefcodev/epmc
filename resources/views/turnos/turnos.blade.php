@extends('layouts.app')  {{-- Asegúrate de utilizar el layout correcto según tu aplicación --}}

@section('content')
  <div class="container">
    <h1>Buscar Turnos</h1>

    {{-- Formulario de búsqueda --}}
    <form action="{{ route('turnos.buscar') }}" method="GET">
      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Buscar turno..." name="q" value="{{ request('q') }}">
        <div class="input-group-append">
          <button class="btn btn-primary" type="submit">Buscar</button>
        </div>
      </div>
    </form>

    {{-- Resultados de la búsqueda (puedes agregarlos aquí según tus necesidades) --}}
    <div class="search-results">
      {{-- Aquí puedes mostrar los resultados de la búsqueda --}}
    </div>
  </div>
@endsection
