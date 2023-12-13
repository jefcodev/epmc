<!-- resources/views/buscar.blade.php -->
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
    <h3> Turno </h3>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">


                <form method="get" action="{{ route('turno.atender') }}">
                    <button type="submit" class="btn btn-success dropdown-toggle">Atender</button>
                </form>


            </div>
        </div>
    </div>
</div>


@endsection