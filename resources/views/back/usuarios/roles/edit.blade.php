@extends('back.template.base')

@section('title','Editar usuario')

@section('css')
	<link href="{{ asset('back/assets/plugins/bootstrap-select2/select2.css') }}" rel="stylesheet" type="text/css" media="screen" />
@endsection

@section('content')

<ul class="breadcrumb">
    <li>
      <p>Ud esta aquí</p>
    </li>
    <li><a href="{{ route('roles.index') }}">Roles</a> </li>
    <li><a href="#" class="active">Edición</a> </li>
  </ul>
  <div class="page-title"> <i class="icon-custom-right"></i>
    <h3>Editar <span class="semi-bold">Rol</span></h3>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="grid simple form-grid">
        <div class="grid-title no-border">
          <h4>Datos <span class="semi-bold">Rol</span></h4>
        </div>
        <div class="grid-body no-border">
          <br>
            <form id="form_iconic_validation" action="{{ route('roles.update', $rol->id) }}" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}
              <input type="hidden" name="_method" value="PUT">
              <div class="form-group">
                <label class="form-label">Rol</label>
                <span class="help">eg: "Nombre de rol"</span>
                <div class="input-with-icon  right">
                  <i class=""></i>
                  <input type="text" name="name" id="name" class="form-control" value="{{ $rol->name }}" required>
                </div>
              </div>

              <div class="form-group">
                <label class="form-label"></label>
                <span class="help">eg: "web"</span>
                <div class="input-with-icon  right">
                  <i class=""></i>
                  <input type="text" name="guard_name" id="guard_name" value="{{ $rol->guard_name }}" class="form-control" readonly>
                </div>
              </div>
              <fieldset>
                <legend>Permisos</legend>
                 @foreach($permisos->groupBy('group_key') as $permission_group)
                    <h5>{{$permission_group->pluck('group_key')->pop()}}</h5>
                    <div class="form-group row">
                        @foreach($permission_group as $permission) 
                        <?php $status = ($rol->hasPermissionTo($permission->id) ? 'checked="checked"' : '' ) ?>
                          <div class="col-xs-3 col-sm-3">
                                <div class="checkbox checkbox-theme">
                                    <input type="checkbox" name="permissions[]" id="permission_{{$permission->id}}" value="{{$permission->id}}"  {{ $status }}>
                                    <label for="permission_{{$permission->id}}">{{ $permission->name }}</label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
              </fieldset>
              <div class="form-actions">
                <div class="pull-right">
                  <button type="submit" class="btn btn-danger btn-cons"><i class="icon-ok"></i> Guardar</button>
                  <a href="{{ route('roles.index') }}" class="btn btn-white btn-cons">Cancelar</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')
<script src="{{ asset('back/assets/plugins/datatables-responsive/js/lodash.min.js') }}" type="text/javascript"></script>
<!-- END PAGE LEVEL JS INIT -->
<!-- END JAVASCRIPTS -->
@endsection