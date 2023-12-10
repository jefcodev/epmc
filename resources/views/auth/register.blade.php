@extends('layouts.app')
@section('title', 'Registro')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <header>
                    <img src="{{ asset('front/img/assets/logo-blanco.png') }}" alt="EPMC" class="logo-small" width="320">
                
                    <h2 class="card-header">Regístrate</h2>
                    <h4>Por favor ingresa tus datos para generar tu cuenta</h4>
                </header>


                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="cedula" class="col-md-4 col-form-label text-md-right">Cédula / RUC</label>
                            
                            <div class="col-md-6">
                                <input id="cedula" placeholder="Ej: 1812345678" type="text" class="form-control @error('cedula') is-invalid @enderror" name="cedula" value="{{ old('cedula') }}" required autocomplete="cedula" autofocus>
                                
                                @error('cedula')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div id="info" class="text-danger"></div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Nombres</label>

                            <div class="col-md-6">
                                <input id="name" placeholder="Ej: Nombre Apellido" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Correo electrónico</label>

                            <div class="col-md-6">
                                <input id="email" type="email" placeholder="Ej: correo@gmail.com" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Contraseña</label>

                            <div class="col-md-6">
                                <input id="password" minlength="8" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Ej: 12345678">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirmar contraseña</label>

                            <div class="col-md-6">
                                <input id="password-confirm" minlength="8" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Ej: 12345678">
                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button id="submit" type="submit" class="btn btn-primary">
                                    Registrarme
                                </button>
                            </div>

                            <br>
                            <a href="{{ route('home') }}">Regresar a página de inicio</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

<script>

$(document).ready(function(){
    $('#cedula').on('change',function(data){
        var valor = $(this).val();
        $('#submit').val("validando...");
        $.get('{{ route("cedula","") }}/'+valor,{},function(data){
            if(data){
                cedula_valida=true;
                $('#info').html('');
                if(cedula_valida){
                    $('#submit').removeAttr("disabled");
                }
            }else{
                cedula_valida=false;
                $('#info').html('El número de CI o RUC ingresado es incorrecto');
                $('#submit').attr("disabled", true);
            }
            $('#submit').val("Registrarme");
        },'json');
    });
});
</script>
@endsection