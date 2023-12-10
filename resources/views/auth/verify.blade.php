@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <header>
                    <img src="{{ asset('front/img/assets/logo-blanco.png') }}" alt="EPMC" class="logo-small" width="320">
                
                    <h2 class="card-header">Verifica tu correo electrónico</h2>
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            Se ha enviado un enlace de verificación a su dirección de correo electrónico.
                        </div>
                    @endif
                </header>

                <div class="card-body">

                    Antes de continuar, verifique su correo electrónico para activar el link de verificación. <br>
                    Si no recibió el correo electrónico,
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">Haga clic aquí para solicitar otro</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
