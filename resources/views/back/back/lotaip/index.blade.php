@extends('back.template.base')

@section('title','Lotaip')

@section('css')
	<link href="{{ asset('back/assets/plugins/bootstrap-select2/select2.css') }}" rel="stylesheet" type="text/css" media="screen" />
  <link href="{{ asset('back/assets/plugins/bootstrap-datepicker/css/datepicker.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

  <ul class="breadcrumb">
    <li>
      <p>Ud esta aquí</p>
    </li>
    <li><a href="{{ route('periodos.index') }}" class="active">Documentos Lotaip</a> </li>
  </ul>
  <div class="page-title"> <i class="icon-custom-right"></i>
    <h3>Listado <span class="semi-bold">Documentos Lotaip</span></h3>
  </div>
  <div class="row-fluid">
    <div class="span12">
      <div class="grid simple ">
        <div class="grid-title">
          <h4>
            <span class="semi-bold">Documentos Lotaip</span>
            <select name="periodo" id="periodo" class="form-control">
              @foreach($periodos as $periodo)
                <option value="{{ $periodo->anio }}" @if($periodo->anio == $anio) selected @endif>{{$periodo->anio}}</option>
              @endforeach
            </select>
          </h4>
        </div>
        <div class="grid-body ">
          @include('back.template.alerts')
          <table class="table table-striped table-responsive" id="example2">
            <thead>
              <tr>
                <th>Artículo</th>
                
                @foreach($meses as $index=> $mes)
                  <th>{{ $mes }}</th>
                @endforeach
              </tr>
            </thead>
            <tbody>
              @foreach($articulos as $articulo)
              <tr class="odd gradeX" id="item{{ $articulo->id }}">
                <td>
                  <strong>{{ $articulo->literal }}</strong>
                    {{ $articulo->articulo }}
                </td>
                <?php $n_mes=1; ?>
                @foreach($meses as $index=> $mes)
                  <td>
                    <div class="btn-group">

                      <a class="btn dropdown-toggle btn-small btn-demo-space @if($articulo->documentoPeriodo($anio,$n_mes)->count()>0) btn-success @endif " data-toggle="dropdown" href="#"> 
                        {{ $mes }}<span class="caret"></span> 
                      </a>
                      <ul class="dropdown-menu">
                        @if($articulo->documentoPeriodo($anio,$n_mes)->count()>0)
                          <li>
                            @if($articulo->documentoPeriodo($anio,$n_mes)->first()->tipo=="documento")
                              <a href="{{ asset('uploads/'.$articulo->documentoPeriodo($anio,$n_mes)->first()->documento->ruta ) }}" class="bg-info" target="_blank"><i class="fa fa-eye"></i> Visualizar</a>
                            @else
                              <a href="{{ asset('uploads/'.$articulo->documentoPeriodo($anio,$n_mes)->first()->url_documento ) }}" class="bg-info" target="_blank"><i class="fa fa-eye"></i> Visualizar</a>
                            @endif
                          </li>
                          <li class="divider"></li>
                          <li><a href="{{ route('lotaip.destroy',$articulo->documentoPeriodo($anio,$n_mes)->first()->id) }}" class="btn-delete-item"><i class="fa fa-trash"></i> Eliminar</a></li>
                        @else
                          <li><a href="#" data-toggle="modal" data-target="#myModal" id_articulo="{{ $articulo->id }}" mes_id="{{ $n_mes }}" mes="{{ $mes }}" title="{{ $articulo->literal }}) {{ $articulo->articulo }}"><i class="fa fa-upload"></i> Subir</a></li>
                          <li><a href="#" data-toggle="modal" data-target="#myModalEnlace" id_articulo="{{ $articulo->id }}" mes_id="{{ $n_mes }}" mes="{{ $mes }}" title="{{ $articulo->literal }}) {{ $articulo->articulo }}"><i class="fa fa-exchange"></i> Enlazar</a></li>
                        @endif
                      </ul>
                    </div>
                  </td>
                  <?php  $n_mes++; ?>
                @endforeach
              </tr>
              @endforeach
            </tbody>
          </table>
          <!-- Modal -->
            @include('back.lotaip.create')
            @include('back.lotaip.enlazar')
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')
<script src="{{ asset('back/assets/plugins/bootstrap-select2/select2.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('back/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript"></script>
<!-- END PAGE LEVEL JS INIT -->
<script>

    $(document).ready(function(){
      $('#fecha').datepicker({
          format: 'yyyy-mm-dd',
          autoclose: true,
          todayHighlight: true
       });
    });
    
    $('#myModalEnlace').on('shown.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var url = button.attr('action') // Extract info from data-* attributes+
      var id_articulo = button.attr('id_articulo') // Extract info from data-* attributes
      var articulo = button.attr('title') // Extract info from data-* attributes
      var mes_id = button.attr('mes_id') // Extract info from data-* attributes
      var mes = button.attr('mes') // Extract info from data-* attributes
      
      var modal = $(this);

      modal.find('.modal-title').text(articulo);
      modal.find('.mes').text(mes);
      modal.find('.articulo_id').val(id_articulo);
      modal.find('.input_mes').val(mes_id);
      
      $.get('{{ route("documentos.dropdown") }}',{},function(data){
        modal.find('.container-docs').html(data);
        $('#document_id').select2();
      });
      
    });

    $('#myModal').on('shown.bs.modal', function (event) {

        var button = $(event.relatedTarget) // Button that triggered the modal
        var articulo = button.attr('title') // Extract info from data-* attributes
        var id_articulo = button.attr('id_articulo') // Extract info from data-* attributes
        var mes_id = button.attr('mes_id') // Extract info from data-* attributes
        var mes = button.attr('mes') // Extract info from data-* attributes

        var modal = $(this);
        modal.find('.modal-title').text(articulo);
        modal.find('.articulo_id').val(id_articulo);
        modal.find('.input_mes').val(mes_id);
        modal.find('.mes').text(mes);
        modal.find('#nombre').val('{{$anio}}-'+mes+': ');
      
    });

    $(document).on('change','#periodo',function(e){
      var valor = $(this).val();
      location.href = "{{ route('lotaip.index','') }}/"+valor;
    });

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
                            swal("Eliminado!", "Eliminado correctamente", "success");
                            location.reload();
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