<!-- Modal -->
<div class="modal fade" id="buscar-usuario" tabindex="-1" role="dialog" aria-labelledby="agregar_nota" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header py-2">
        <h5 class="modal-title" id="titulo-modal">Buscar usuario</h5>
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
            <small class="mb-1">busca un usuario</small>
            <input type="text" class="form-control text-peque" id="search-user-link" placeholder="Busca un usuario">
         </div>
      </form>
       <div id="result-user"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" form="form_cronograma" class="btn btn-primary">Guardar Cambios</button>
      </div>
    </div>
  </div>
</div>
