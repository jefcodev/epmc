@extends('back.template.base')

@section('title','Usuarios')

@section('css')
    <link href="{{ asset('back/assets/plugins/bootstrap-select2/select2.css') }}" rel="stylesheet" type="text/css" media="screen" />
    <link href="{{ asset('back/assets/plugins/jquery-datatable/css/jquery.dataTables.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('back/assets/plugins/datatables-responsive/css/datatables.responsive.css') }}" rel="stylesheet" type="text/css" media="screen" />
@endsection

@section('content')

  <ul class="breadcrumb">
    <li>
      <p>Ud esta aquí</p>
    </li>
    <li><a href="{{ route('usuarios.index') }}" class="active">Usuarios</a> </li>
  </ul>
  <div class="page-title"> <i class="icon-custom-right"></i>
    <h3>Listado <span class="semi-bold">Usuarios</span></h3>
  </div>
  <div class="row-fluid">
    <div class="span12">
      <div class="grid simple ">
        <div class="grid-title">
          <h4>
            Listado <span class="semi-bold">Usuarios</span>
            @can('crear usuarios')
            <a href="{{ route('usuarios.create') }}" class="btn btn-default" title="Nuevo usuario">
              <i class="fa fa-plus"></i>
              Nuevo usuario
            </a>
            @endcan
          </h4>
        </div>
        <div class="grid-body ">
          @include('back.template.alerts')
          <table class="table table-striped" id="example2">
            <thead>
              <tr>
                <th></th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Roles</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach($usuarios as $usuario)
              <tr class="odd gradeX" id="item{{ $usuario->id }}">
                
                <td>
                  @if($usuario->imagen)
                    <img src="{{ asset('front/img/users/'.$usuario->imagen) }}" width="160" height="160" alt="{{ $usuario->name }}">
                  @endif
                </td>
                <td>{{ $usuario->name }}</td>
                <td class="center">{{ $usuario->email }}</td>
                <td>
                  @foreach($usuario->roles as $rol)
                    {{ $rol->name}} -
                    @endforeach
                </td>
                <td>
                  @can('editar usuarios')
                  <a href="{{ route('usuarios.edit', $usuario->id) }}" title="Editar" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                  @endcan
                  @can('eliminar usuarios')
                  <a href="{{ route('usuarios.destroy', $usuario->id) }}" title="Eliminar" class="btn btn-danger btn-delete-item"><i class="fa fa-trash"></i></a>
                  @endcan
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          {{ $usuarios->links() }}
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')
<script src="{{ asset('back/assets/plugins/bootstrap-select2/select2.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('back/assets/plugins/jquery-datatable/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('back/assets/plugins/jquery-datatable/extra/js/dataTables.tableTools.min.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('back/assets/plugins/datatables-responsive/js/datatables.responsive.js') }}"></script>
<script type="text/javascript" src="{{ asset('back/assets/plugins/datatables-responsive/js/lodash.min.js') }}"></script>
<!-- END PAGE LEVEL JS INIT -->
<script src="{{ asset('back/assets/js/datatables.js') }}" type="text/javascript"></script>
@include('back.template.delete_script')
<!-- END JAVASCRIPTS -->
@endsection