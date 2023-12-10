@extends('back.template.base')
@section('content')

@section('css')

<style>
  .flex{
    display: flex;
    justify-content: space-between;
    padding: 2rem;
  }
</style>
@endsection
<div class="page-title">
	<h3>Dashboard</h3>
</div>


<div class="row">
  @can('listar turnero')
    @foreach($sucursales as $sucursal)
    <div class="col-md-4 col-vlg-4 col-sm-6">
      <div class="tiles blue m-b-10">
        <div class="tiles-body">
          <div class="controller">
            @canany(['listar turnero','crear turnero'])
          	<a href="{{ route('turnos.index') }}" class="config"></a>
            @endcanany
          </div>
          <div class="tiles-title text-black"><strong>{{ $sucursal->nombre }}</strong> - RESUMEN TURNOS</div>
          <div class="widget-stats">
            <div class="wrapper transparent">
              <span class="item-title">Total Generados</span> <span class="item-count animate-number semi-bold" data-value="{{ $sucursal->turnos()->count() }}" data- animation-duration="700">0</span>
            </div>
          </div>
          <div class="widget-stats ">
            <div class="wrapper transparent">
              <span class="item-title">Mensuales</span> <span class="item-count animate-number semi-bold" data-value="{{ $sucursal->turnos()->whereDate('fecha',date('now'))->count() }}" data-animation-duration="700">0</span>
            </div>
          </div>
          <div class="widget-stats">
            <div class="wrapper last">
              <span class="item-title">Diarios</span> <span class="item-count animate-number semi-bold" data-value="{{ $sucursal->turnos()->whereMonth('fecha',date('m'))->count() }}" data-animation-duration="700">0</span>
            </div>
          </div>
          <div class="progress transparent progress-small no-radius m-t-20" style="width:100%">
            <div class="progress-bar progress-bar-white animate-progress-bar" data-percentage="100%"></div>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  @endcan
  @can('listar placas')
    <div class="col-md-4 col-vlg-4 col-sm-6">
      <div class="tiles purple m-b-10">
        <div class="tiles-body">
          <div class="controller">
            @canany(['listar placas','subir placas'])
            <a href="{{ route('placas.index') }}" class="config"></a>
            @endcanany
          </div>
          <div class="tiles-title text-black">RESUMEN PLACAS </div>
          <div class="widget-stats">
            <div class="wrapper transparent">
              <span class="item-title">Total Cargadas</span> <span class="item-count animate-number semi-bold" data-value="{{ $placas_totales }}" data-animation-duration="700">0</span>
            </div>
          </div>
          <div class="widget-stats">
            <div class="wrapper transparent">
              <span class="item-title">Total Entregadas</span> <span class="item-count animate-number semi-bold" data-value="{{ $placas_entregadas }}" data-animation-duration="700">0</span>
            </div>
          </div>
          <div class="widget-stats ">
            <div class="wrapper last">
              <span class="item-title">Diarios</span> <span class="item-count animate-number semi-bold" data-value="{{ $placas_hoy }}" data-animation-duration="700">0</span>
            </div>
          </div>
          <div class="progress transparent progress-small no-radius m-t-20" style="width:100%">
            <div class="progress-bar progress-bar-white animate-progress-bar" data-percentage="100%"></div>
          </div>
        </div>
      </div>
    </div>
  @endcan


  <div class="flex">
    @if(Auth::user()->hasRole('cliente'))
      <a class="btn btn-primary" href="{{ route('turnero.seleccion') }}">Generar turno</a>
    @endif
    <form action="{{ route('logout') }}" method="post">
        @csrf
        <button type="submit" class="logout-button"><i class="material-icons">power_settings_new</i>&nbsp;&nbsp;Cerrar sesión</button>
    </form>
  </div>
  
  </div>
@endsection