@extends('front.template.base')

@section('title','Mi Perfil')
<body oncontextmenu = "return false"> </body>
@section('css')
    <link href="{{ asset('back/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css') }}" rel="stylesheet" type="text/css" />
    <style type="text/css" media="screen">
        #message, #info{
            color: red;
            font-weight: 700;
        }
        .turno-info{
         
        }
        #placa{
            text-transform: uppercase;
        }
    </style>
@endsection

@section('content')

    <!-- End Perfil List --> 
    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-md-12 header-user">
                    <div>
                        Bienvenido <strong>{{ Auth::user()->name }}</strong>
                    </div>
                    <div>
                        <div class="flex">
                            <a href="{{ route('perfil') }}">Actualizar Datos</a>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="logout-button">Cerrar sesión</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 shortcode-title wow fadeIn">
                    <h4 class="section-title">MIS TURNOS</h4> 
                    <a href="{{ route('turnero.seleccion') }}" class="btn btn-primary submit">Generar Turno</a>
                    <p class="text-center">{{ $usuario->turnos()->count()}} utilizados de {{ $usuario->turnos_disponibles }} disponibles en el {{ date('Y') }}</p>
                </div>          
                <div class="col-md-12 wow fadeIn">
                    <table class="table table-hovered table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th>Turno</th>
                                <th>Sucursal</th>
                                <th>Cédula</th>
                                <th>Placa</th>
                                <th>Fecha</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($usuario->turnos()->orderBy('fecha','desc')->get() as $turno)
                            <tr>
                                <td>
                                    {!! QrCode::size(80)->generate('Sucursal: '.$turno->sucursal->nombre.' - Tramite: '.$turno->requisito->nombre.' - Turno: '.$turno->turno.' - Cedula: '.$turno->cedula.' - Codigo: '.$turno->codigo); !!}
                                    {{ $turno->turno }}
                                </td>
                                <td>{{ $turno->sucursal->nombre }}</td>
                                <td>{{ $turno->cedula }}</td>
                                <td>{{ $turno->placa }}</td>
                                <td>
                                    <dl>
                                        <dd>Turno:
                                            {{ $turno->fecha }}
                                        </dd>
                                        <dd>Creado :
                                            {{ $turno->createdUTC }}
                                        </dd>
                                    </dl>
                                </td>

                                <td>
                                <span class="label label-warning">Pendiente</span>

                                </td>
                                <td><a href="{{ route('turnos.print',$turno->codigo_aux) }}">Imprimir</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                                            
            </div>
        </div>
    </section>
    <!-- End Perfil Section -->

@endsection