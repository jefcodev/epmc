@extends('back.template.base')

@section('title','Dígitos')

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
    <li><a href="{{ route('digitos.index') }}" class="active">Dígitos</a> </li>
  </ul>
  <div class="page-title"> <i class="icon-custom-right"></i>
    <h3>Listado <span class="semi-bold">Dígitos</span></h3>
  </div>
  <div class="row-fluid">
    <div class="span12">
      <div class="grid simple ">
        <div class="grid-title">
          <h4>
            Listado <span class="semi-bold">Dígitos</span>
          </h4>
        </div>
        <div class="grid-body ">
          @include('back.template.alerts')
          <table class="table table-striped" id="example2">
            <thead>
              <tr>
                <th>Dígito</th>
                <th>Habilitado</th>
                <th>Desde</th>
                <th>Hasta</th>
                <th>Descripción</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach($digitos as $digito)
              <tr class="odd gradeX" id="item{{ $digito->id }}">
                <td class="center">{{ $digito->digito }}</td>
                <td class="center">
                  <input type="checkbox" name="entregada" class="entregada" @if($digito->habilitado) checked @endif digito-id="{{ $digito->id }}">
                </td>
                <td class="center">{{  $digito->desde->format('d, M') }} </td>
                <td class="center">{{  $digito->hasta->format('d, M') }} </td>
                <td class="center">{{ $digito->descripcion }}</td>
                <td>
                  
                  <a href="{{ route('digitos.edit', $digito->id) }}" title="Editar" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                  
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
          var lotaip_id = $(this).attr('digito-id');
            var url = "{{ route('digitos.update','') }}/"+lotaip_id;
            var valor = $(this).val();
            var estado = $(this).prop("checked");
            $.post(url,{'_token':'{{ csrf_token() }}','_method':'put','habilitado':estado},function(data){
              if(estado){
                $('#item'+data.id).addClass('success');
                swal("Actualizada!", "Digito habilitado correctamente", "success");
              }else{
                $('#item'+data.id).removeClass('success');
                swal("Actualizada!", "Digito deshabilitado correctamente", "success");
              }
            },'json');
        });
</script>

@include('back.template.delete_script')
<!-- END JAVASCRIPTS -->
@endsection