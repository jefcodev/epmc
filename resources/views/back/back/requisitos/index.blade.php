@extends('back.template.base')

@section('title','Requisitos')

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
    <li><a href="{{ route('requisitos.index') }}" class="active">Requisitos</a> </li>
  </ul>
  <div class="page-title"> <i class="icon-custom-right"></i>
    <h3>Listado <span class="semi-bold">Requisitos</span></h3>
  </div>
  <div class="row-fluid">
    <div class="span12">
      <div class="grid simple ">
        <div class="grid-title">
          <h4>
            Listado <span class="semi-bold">Requisitos</span>
            <a href="{{ route('requisitos.create') }}" class="btn btn-default" title="Nuevo requisito">
              <i class="fa fa-plus"></i>
              Nuevo requisito
            </a>
          </h4>
        </div>
        <div class="grid-body ">
          @include('back.template.alerts')
          <table class="table table-striped" id="example2">
            <thead>
              <tr>
                <th>Requisito</th>
                <th>Descripción</th>
                <th>Documento</th>
                <th>Orden</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach($requisitos as $requisito)
              <tr class="odd gradeX" id="item{{ $requisito->id }}">
                <td>
                    {{ $requisito->nombre }}
                </td>
                <td class="center">{{ $requisito->descripcion }}</td>
                <td class="center"><a href="{{ asset('requisitos/'.$requisito->ruta) }}" target="_blank">{{ $requisito->nombre }}</a></td>
                <td class="center">{{ $requisito->orden }}</td>
                <td>
                  <a href="{{ route('requisitos.edit', $requisito->id) }}" title="Editar" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                  <a href="{{ route('requisitos.destroy', $requisito->id) }}" title="Eliminar" class="btn btn-danger btn-delete-item"><i class="fa fa-trash"></i></a>
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