<!-- Modal -->
<div class="modal fade" id="agregar_nota" tabindex="-1" role="dialog" aria-labelledby="agregar_nota" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Agregar Nueva Nota</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form method="post" id="form_nota">
              <input type="hidden" name="c" value="nota">
              <input type="hidden" name="m" value="create">
          <div class="form-group">
            <small>Agrega un titulo</small>
            <textarea rows=1 class="form-control text-peque " name='titulo' placeholder="Titulo"></textarea>
          </div>
          <div class="form-group">
            <small>Agrega una descripcion (*) <span class="text-danger"> campo obligatorio</span></small>
            <textarea  class="form-control text-peque size_content" name='descripcion' placeholder="Descripcion"></textarea>
          </div>
        </form>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" form="form_nota" class="btn btn-primary">Guardar Nota</button>
      </div>
    </div>
  </div>
</div>
