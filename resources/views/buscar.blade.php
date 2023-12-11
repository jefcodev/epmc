<!-- resources/views/buscar.blade.php -->
@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if($errors->any())
                <div style="color: red;">
                    @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                    @endforeach
                </div>
                @endif

                <form method="post" action="{{ route('buscar') }}">
                    @csrf
                    <label for="placa">Número de Placa:</label>
                    <input type="text" name="placa" required>
                    <button type="submit">Buscar</button>
                </form>


            </div>
        </div>
    </div>
</div>


@endsection