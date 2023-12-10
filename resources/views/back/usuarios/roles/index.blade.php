@extends('back.template.base')

@section('title','Roles')

@section('css')

@endsection

@section('content')

  <ul class="breadcrumb">
    <li>
      <p>Ud esta aquí</p>
    </li>
    <li><a href="{{ route('usuarios.index') }}">Usuarios</a> </li>
    <li><a href="{{ route('roles.index') }}" class="active">Roles</a> </li>
  </ul>
  <div class="page-title"> <i class="icon-custom-right"></i>
    <h3>Listado <span class="semi-bold">Roles</span></h3>
  </div>
  <div class="row-fluid">
    <div class="span12">
      <div class="grid simple ">
        <div class="grid-title">
          <h4>
            Listado <span class="semi-bold">Roles</span>
            @can('crear roles')
            <a href="{{ route('roles.create') }}" class="btn btn-default" title="Nuevo rol">
              <i class="fa fa-plus"></i>
              Nuevo rol
            </a>
            @endcan
          </h4>
        </div>
        <div class="grid-body ">
          @include('back.template.alerts')
          <table class="table table-striped" id="example2">
            <thead>
              <tr>
                <th>Rol</th>
                <th>Permisos</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach($roles as $rol)
              <tr class="odd gradeX" id="item{{ $rol->id }}">
                <td>
                  {{ $rol->name }}
                  <br>
                  <small>{{ $rol->guard_name }}</small>
                </td>
                <td>{{ $rol->getAllPermissions()->count() }}</td>
                <td>
                  @can('editar roles')
                  <a href="{{ route('roles.edit', $rol->id) }}" title="Editar" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                  @endcan
                  @can('eliminar roles')
                  <a href="{{ route('roles.destroy', $rol->id) }}" title="Eliminar" class="btn btn-danger btn-delete-item"><i class="fa fa-trash"></i></a>
                  @endcan
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

@section('js')

@include('back.template.delete_script')
<!-- END JAVASCRIPTS -->
@endsection