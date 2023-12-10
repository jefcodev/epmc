@can('editar turnero')
<a href="{{ route('turnos.edit',$turno->id) }}" class="print btn btn-success"><i class="fa fa-edit"></i></a>
@endcan
@can('imprimir turnero')
<a href="{{ route('turnos.print',$turno->codigo_aux) }}" class="print btn btn-success " target="_blank" id="print"><i class="fa fa-print"></i></a>
@endcan
@can('eliminar turnero')
<a href="{{ route('turnos.destroy', $turno->id) }}" title="Eliminar" class="btn btn-danger btn-delete-item"><i class="fa fa-trash"></i></a>
@endcan