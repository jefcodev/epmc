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
    <h3>Buscar Placa</h3>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                    @endforeach
                </div>
                @endif
                <form method="post" action="{{ route('buscar') }}">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="input-group">
                                <label for="placa">Número de Placa:</label>
                                <input type="text" class="form-control" placeholder="Buscar  placa..." name="placa" required>
                                <br>
                                <br>
                                <button type="submit" class="btn btn-success dropdown-toggle">Buscar</button>

                            </div><!-- /input-group -->
                        </div><!-- /.col-lg-6 -->
                        <div class="col-lg-6">
                        </div><!-- /.col-lg-6 -->
                    </div><!-- /.row -->

                    @csrf

                </form>

            </div>
        </div>
    </div>
</div>


@endsection