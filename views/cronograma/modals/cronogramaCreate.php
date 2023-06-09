<!-- Modal -->
<div class="modal fade" id="agregar_cronograma" tabindex="-1" role="dialog" aria-labelledby="agregar_nota" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titulo-modal">Nuevo Cronograma</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form method="post" id="form_cronograma">
              <input type="hidden" name="c" value="cronograma">
              <input type="hidden" id="update-title-cronograma"  name="m" value="createCronograma">
              <input type="hidden" id="idcronograma"  name="idcronograma" >
          <div class="form-group">
            <small>Agrega un titulo</small>
            <input id="titulo" class="form-control text-peque " name='titulo' placeholder="Dale un titulo a este nuevo cronograma" />
          </div>
        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" form="form_cronograma" class="btn btn-primary">Guardar Cambios</button>
      </div>
    </div>
  </div>
</div>
