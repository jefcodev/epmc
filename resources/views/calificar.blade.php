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
                <form method="post" action="/calificar/turno/{{$turno}}">
                    @csrf
                    <div class="form-group">
                        <label for="calificacion">Califique su atención:</label><br>
                        <input type="radio" id="excelente" name="calificacion" value="excelente">
                        <label for="excelente">Excelente</label><br>
                        <input type="radio" id="bueno" name="calificacion" value="bueno">
                        <label for="bueno">Bueno</label><br>
                        <input type="radio" id="regular" name="calificacion" value="regular">
                        <label for="regular">Regular</label><br>
                        <input type="radio" id="malo" name="calificacion" value="malo">
                        <label for="malo">Malo</label>
                    </div>

                    <button type="submit">Calificar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection