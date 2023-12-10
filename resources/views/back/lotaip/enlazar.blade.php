<div class="modal fade" id="myModalEnlace" tabindex="-1" role="dialog" aria-labelledby="myModalEditLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="form_iconic_validation" action="{{ route('lotaip.enlazar') }}" method="post">
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
            <label class="form-label">Documento</label>
            <div class="input-with-icon  right container-docs" >
              <i class=""></i>
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