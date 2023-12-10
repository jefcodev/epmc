@extends('back.template.base')

@section('title','Placas')

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
    <li><a href="{{ route('placas.index') }}" class="active">Placas</a> </li>
  </ul>
  <div class="page-title"> <i class="icon-custom-right"></i>
    <h3>Listado <span class="semi-bold">Placas</span></h3>
  </div>
  <div class="row-fluid">
    <div class="span12">
      <div class="grid simple ">
        <div class="grid-title">
          <h4>
            Listado <span class="semi-bold">Placas</span>
            @can('subir placas')
            <a href="{{ route('placas.create') }}" class="btn btn-default" title="Subir documento">
              <i class="fa fa-plus"></i>
              Subir documento
            </a>
            @endcan
          </h4>
        </div>
        <div class="grid-body ">
          @include('back.template.alerts')
          <table class="table table-striped" id="example2">
            <thead>
              <tr>
                <th>Placa</th>
                <th>Fecha</th>
                <th>Tipo</th>
                <th>Entregado</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach($placas as $placa)
              <tr class="odd gradeX @if($placa->entregada) success @endif" id="item{{ $placa->id }}">
                <td>
                    {{ $placa->placa }}
                </td>
                <td class="center">{{ $placa->created_at }}</td>
                <td class="center">{{ $placa->tipo }}</td>
                <td class="center">
                  <input type="checkbox" name="entregada" class="entregada" @if($placa->entregada) checked @endif placa-id="{{ $placa->id }}">
                </td>
                <td>
                  @can('eliminar placas')
                  <a href="{{ route('placas.destroy', $placa->id) }}" title="Eliminar" class="btn btn-danger btn-delete-item"><i class="fa fa-trash"></i></a>
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
<script src="{{ asset('back/assets/plugins/bootstrap-select2/select2.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('back/assets/plugins/jquery-datatable/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('back/assets/plugins/jquery-datatable/extra/js/dataTables.tableTools.min.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('back/assets/plugins/datatables-responsive/js/datatables.responsive.js') }}"></script>
<script type="text/javascript" src="{{ asset('back/assets/plugins/datatables-responsive/js/lodash.min.js') }}"></script>
<!-- END PAGE LEVEL JS INIT -->
<script src="{{ asset('back/assets/js/datatables.js') }}" type="text/javascript"></script>
<script>
        $(document).on('change','.entregada',function(e){
          var lotaip_id = $(this).attr('placa-id');
            var url = "{{ route('placas.update','') }}/"+lotaip_id;
            var valor = $(this).val();
            var estado = $(this).prop("checked");
            $.post(url,{'_token':'{{ csrf_token() }}','_method':'put','entregada':estado},function(data){
              if(estado){
                $('#item'+data.id).addClass('success');
                swal("Actualizada!", "Placa registrada como entregada", "success");
              }else{
                $('#item'+data.id).removeClass('success');
                swal("Actualizada!", "Placa registrada como NO entregada", "success");
              }
            },'json');
        });
</script>
@include('back.template.delete_script')
<!-- END JAVASCRIPTS -->
@endsection