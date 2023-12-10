<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="form_iconic_validation" action="{{ route('lotaip.store') }}" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <br>
        <h4 class="modal-title"></h4>
        <h5 ><strong class="anio">{{ $anio }}</strong> - <small class="mes"></small></h5>
      </div>
      <div class="modal-body">
          {{ csrf_field() }}
          <input type="hidden" name="tipo" value="documento">
          <input type="hidden" name="articulo_id" class="articulo_id" value="">
          <input type="hidden" name="anio" class="input_anio" value="{{ $anio }}">
          <input type="hidden" name="mes" class="input_mes" value="">
          <div class="form-group">
            <label class="form-label">Nombre</label>
            <span class="help">eg: "Concesión de Permiso de Operación"</span>
            <div class="input-with-icon  right">
              <i class=""></i>
              <input type="text" name="nombre" id="nombre" class="form-control" required>
            </div>
          </div>
          <div class="form-group">
            <label class="form-label">Categoría</label>
            <div class="input-with-icon  right">
              <i class=""></i>
              <select name="categoria_id" class="form-control">
                @foreach($categorias as $key=>$value)
                <option value="{{$key}}">{{$value}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="form-label">Descripción</label>
            <span class="help">eg: "Documento de..."</span>
            <div class="input-with-icon  right">
              <i class=""></i>
              <input type="text" name="descripcion" id="descripcion" class="form-control">
            </div>
          </div>
          <div class="form-group">
            <label class="form-label">Documento</label>
            <span class="help">eg: "Documento.pdf"</span>
            <div class="input-with-icon  right">
              <i class=""></i>
              <input type="file" name="documento" id="documento" class="form-control" required>
            </div>
          </div>
          <div class="form-group">
            <label class="form-label">Fecha</label>
            <span class="help">e.g. "2020-01-30"</span>
            <div class="input-with-icon  right">
              <i class=""></i>
              <input type="text" name="fecha" id="fecha" value="{{ date('Y-m-d')}}" class="form-control">
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>