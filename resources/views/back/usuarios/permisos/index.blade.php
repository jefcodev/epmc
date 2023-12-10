@extends('back.template.base')

@section('title','Permisos')

@section('content')

  <ul class="breadcrumb">
    <li>
      <p>Ud esta aquí</p>
    </li>
    <li><a href="{{ route('usuarios.index') }}">Usuarios</a> </li>
    <li><a href="{{ route('permisos.index') }}" class="active">Permisos</a> </li>
  </ul>
  <div class="page-title"> <i class="icon-custom-right"></i>
    <h3>Listado <span class="semi-bold">Permisos</span></h3>
  </div>
  <div class="row-fluid">
    <div class="span12">
      <div class="grid simple ">
        <div class="grid-title">
          <h4>
            Listado <span class="semi-bold">Permisos</span>
          </h4>
        </div>
        <div class="grid-body ">
          @include('back.template.alerts')
          <table class="table table-striped" id="example2">
            <thead>
              <tr>
                <th></th>
                <th>Grupo</th>
                <th>Permiso</th>
                <th>Roles</th>
              </tr>
            </thead>
            <tbody>
              @foreach($permisos as $index=> $permiso)
              <tr class="odd gradeX" id="item{{ $permiso->id }}">
                <td>{{ $permiso->id }}</td>
                <td>
                  {{ $permiso->group_key }}
                </td>
                <td>
                  {{ $permiso->name }}
                </td>
                <td>
                  <ul>
                    @foreach($permiso->roles as $rol)
                    {{ $rol->name}} -
                    @endforeach
                  </ul>
                  
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
