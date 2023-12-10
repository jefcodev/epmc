@extends('back.template.base')

@section('title','Miembros')

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
    <li><a href="{{ route('miembros.index') }}" class="active">Miembros</a> </li>
  </ul>
  <div class="page-title"> <i class="icon-custom-right"></i>
    <h3>Listado <span class="semi-bold">Miembros</span></h3>
  </div>
  <div class="row-fluid">
    <div class="span12">
      <div class="grid simple ">
        <div class="grid-title">
          <h4>
            Listado <span class="semi-bold">Miembros</span>
            <a href="{{ route('miembros.create') }}" class="btn btn-default" title="Nuevo miembro">
              <i class="fa fa-plus"></i>
              Nuevo miembro
            </a>
          </h4>
        </div>
        <div class="grid-body ">
          @include('back.template.alerts')
          <table class="table table-striped" id="example2">
            <thead>
              <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Cargo</th>
                <th>Tipo</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach($miembros as $miembro)
              <tr class="odd gradeX" id="item{{ $miembro->id }}">
                <td><img src="{{ asset('team/'.$miembro->imagen) }}" alt="{{ $miembro->nombre }}" width="220" height="180" class="img-responsive"></td>
                <td>
                    {{ $miembro->nombre }}
                </td>
                <td class="center">
                  {{ $miembro->cargo }}
                  <br>
                  <small>{{ $miembro->puesto }}</small>
                </td>
                <td class="center">{{ $miembro->tipo }}</td>
                <td>
                  <a href="{{ route('miembros.edit', $miembro->id) }}" title="Editar" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                  <a href="{{ route('miembros.destroy', $miembro->id) }}" title="Eliminar" class="btn btn-danger btn-delete-item"><i class="fa fa-trash"></i></a>
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
<script src="{{ asset('back/assets/plugins/bootstrap-select2/select2.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('back/assets/plugins/jquery-datatable/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('back/assets/plugins/jquery-datatable/extra/js/dataTables.tableTools.min.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('back/assets/plugins/datatables-responsive/js/datatables.responsive.js') }}"></script>
<script type="text/javascript" src="{{ asset('back/assets/plugins/datatables-responsive/js/lodash.min.js') }}"></script>
<!-- END PAGE LEVEL JS INIT -->
<script src="{{ asset('back/assets/js/datatables.js') }}" type="text/javascript"></script>
<script>
        $(document).on('click','.btn-delete-item',function(e){
            e.preventDefault();
            var url = $(this).attr('href');
            swal({
              title: "{!! trans('comun.estas_seguro') !!}?",
              text: "{!! trans('comun.esta_accion_no') !!}!",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "{{ trans('comun.si_eliminar') }}!",
              cancelButtonText: "{{ trans('comun.no_cancelar') }}!",
              closeOnConfirm: false,
              closeOnCancel: true
            },
            function(isConfirm){
                if (isConfirm) {
                    $.ajax({
                        url: url,
                        data:{'_token':'{{ csrf_token() }}'},
                        type: 'DELETE',
                        dataType: 'json',
                        success: function(data) {
                            // Do something with the result
                            if(data.success){
                                $('#item'+data.id).fadeOut('slow');
                                swal("Eliminado!", "Eliminado correctamente", "success");
                            }else{
                                swal("Error", "Error al eliminar", "error");
                            }
                        }
                    });
                }
            });
        });
    </script>
<!-- END JAVASCRIPTS -->
@endsection