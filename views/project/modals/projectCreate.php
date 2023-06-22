<!-- Modal -->
<div class="modal fade" id="add_project" tabindex="-1" role="dialog" aria-labelledby="add_project" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titulo-modal">Nuevo Proyecto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="form_prject">
                    <input type="hidden" name="c" value="project">
                    <input type="hidden" id="update-create-project" name="m" value="create">
                    <input type="hidden" id="id_project" name="id">
                    <input type="hidden" id="status_project_hidden" name="status" value="1">
                    <div class="form-group">
                        <small>Agrega un titulo (*)</small>
                        <input id="name" class="form-control text-peque " name="name" required
                            placeholder="Proyecto xyz" />
                    </div>
                    <div class="form-group d-none">
                        <small>Estado</small>
                        <select id="status_project" class="form-control text-peque " name="status">
                            <option selected value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <small>Agrega una descripcion</small>
                        <textarea rows="6  " id="descripcion" class="form-control text-peque " name="descripcion"
                            placeholder="Descriptción xyz"></textarea>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" form="form_prject" class="btn btn-primary">Guardar Cambios</button>
            </div>
        </div>
    </div>
</div>