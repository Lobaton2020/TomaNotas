<!-- modal para mover una tarea a otro cronograma-->
<div class="modal fade" id="move-task-to-other-cronograma" tabindex="-1" role="dialog" aria-labelledby="opciones_tarea"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle">Mover tarea</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="form_move">
                    <input type="hidden" name="c" value="cronograma">
                    <input type="hidden" name="m" value="moveTask">
                    <input type="hidden" name="id_cronograma_destino" value="">
                    <input type="hidden" name="id_cronograma_fuente" value="">
                    <input type="hidden" name="id_tarea" value="">
                    <div class="form-group">
                        <select class="form-control" onchange="handleChangeCronograma(event)" required>
                            <option value="">-- Selecciona un cronograma --</option>
                            <?php foreach ($listCronogramaSelect as $row): ?>
                                <?php if ($row->id_cronograma_PK != $_GET["id"]): ?>
                                    <option value="<?php echo $row->id_cronograma_PK; ?>"><?php echo $row->titulo; ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>

                        </select>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" form="form_move" class="btn btn-primary">Mover tarea</button>
            </div>
        </div>
    </div>
</div>