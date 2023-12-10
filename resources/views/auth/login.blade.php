@extends('layouts.app')

@section('content')
<div class="container">
      <div class="row login-container column-seperation">
        <div class="col-md-5 col-md-offset-1">
          <h2>
        Iniciar sesión
      </h2>
          <p>
            <img src="{{ asset('front/img/assets/logo-blanco.png') }}" alt="EPMC" class="logo-small" width="320">
            <br>
            <hr>

          </p>
          <br>
          
        </div>
        <div class="col-md-5">
          <br>
          <form method="POST" action="{{ route('login') }}" class="login-form validate" id="login-form"  name="login-form">
            {{ csrf_field() }}
            <div class="row">
              <div class="form-group col-md-10">
                <label class="form-label">Email</label>
                   <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong class="text-danger">{{ $message }}</strong>
                        </span>
                    @enderror
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-10">
                <label class="form-label">Contraseña</label> <span class="help"></span>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </span>
                @enderror
              </div>
            </div>
            <div class="row">
              <div class="control-group col-md-10">
                <div class="checkbox checkbox check-success">
                  
                  <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                  <label for="remember">Recordarme</label>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-10">
                <button class="btn btn-primary btn-cons pull-right" type="submit">Login</button>
              </div>
            </div>
          </form>

          <p><a href="{{ route('password.request') }}">¿Olvidaste tu constraseña?</a></p>
        </div>
      </div>
    </div>
@endsection
