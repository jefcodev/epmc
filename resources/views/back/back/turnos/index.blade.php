@extends('back.template.base')

@section('title','Turnos')

@section('css')
	 <link href="{{ asset('back/assets/plugins/fullcalendar/fullcalendar.css') }}" rel="stylesheet" type="text/css" media="screen" />
@endsection

@section('content')

  <ul class="breadcrumb">
    <li>
      <p>Ud esta aquí</p>
    </li>
    <li><a href="{{ route('periodos.index') }}" class="active">Turnos</a> </li>
  </ul>
  <div class="page-title"> <i class="icon-custom-right"></i>
    <h3>Calendario de <span class="semi-bold">Turnos</span></h3>
  </div>

<div class="row" style="max-height:600px;">
    <div class="tiles row tiles-container red no-padding">
        <div class="col-md-12 tiles white no-padding">
        <div class="tiles-body">
          <div id='calendar'></div>
        </div>
        </div>
    </div>
</div>
  <br>
  @endsection

@section('js')

<!-- END PAGE LEVEL JS INIT -->
    <!-- BEGIN PAGE LEVEL JS -->
<script src="{{ asset('back/assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('back/assets/plugins/jquery-ui-touch/jquery.ui.touch-punch.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('back/assets/plugins/fullcalendar/fullcalendar.min.js') }}"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- PAGE JS -->

<script>
  /* Webarch Admin Dashboard 
-----------------------------------------------------------------*/ 
    $(document).ready(function() {
        /* initialize the external events
        -----------------------------------------------------------------*/
        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)

        $.get('{{ route("turnos.listado") }}',{},function(data){
            console.log(data);

            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                editable: false,
                droppable: false, // this allows things to be dropped onto the calendar !!!
                events: data
            });

        },'json');
    
        /* initialize the calendar
        -----------------------------------------------------------------*/
        

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