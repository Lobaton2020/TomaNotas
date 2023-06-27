<div class="mt-1 mb-3">
    <div class="border mb-2 pr-0 pl-0 pt-3 pb-0 ">
        <div class="text-center   ">
            <h5>Tareas de: <?= $project->name ?>
            </h5>
        </div>
        <div class="card-body">
            <div class="mt-n3">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <?php if (count($response) == 0) { ?>
                            <div class=text-center>No hay contenido por mostrar</div>
                        <?php } ?>
                        <?php for ($i = 0; $i < count($response); $i++): ?>
                            <?php if ($i != 0): ?>
                                <hr class="my-0 mx-5 ">
                            <?php endif; ?>
                            <?php $minuto = ($response[$i]->minuto == 0) ? "00" : $response[$i]->minuto; ?>
                            <?php $time = $response[$i]->hora . " : " . $minuto; ?>

                            <?php $check = ($response[$i]->estado == 1) ? "checked" : ""; ?>
                            <div id="task-id-<?php echo $response[$i]->id_tarea_cronograma_PK ?>" class="row order-task ">
                                <div class="col-10" style="margin-top:2px;">
                                    <span class="custom-control ml-n2 mr-n2 custom-switch d-inline">
                                        <input type="checkbox" disabled <?php echo $check; ?>
                                            ide="<?php echo $response[$i]->id_tarea_cronograma_PK; ?>"
                                            class="custom-control-input checkbox" id="check<?php echo $i; ?>">
                                        <label class="custom-control-label" for="check<?php echo $i; ?>"></label>
                                    </span>
                                    <?php if ($check === "checked"): ?>
                                        <s><i>
                                                <span class="text-muted ">
                                                    <?php echo $time; ?>
                                                </span>&bull; <span>
                                                    <?php echo $response[$i]->descripcion; ?>
                                                </span>
                                            </i></s>
                                        <a href="?c=cronograma&m=getTareas&id=<?= $response[$i]->id_cronograma_FK ?>">
                                            <small class="text-muted under-line">
                                                <?= $response[$i]->titulo ?>
                                            </small>
                                        </a>
                                    <?php else: ?>
                                        <span class="text-muted">
                                            <?php echo $time; ?>
                                        </span>
                                        <span>
                                            &bull;
                                        </span>
                                        <?php echo $response[$i]->descripcion; ?>
                                        <a href="?c=cronograma&m=getTareas&id=<?= $response[$i]->id_cronograma_FK ?>">
                                            <small class="text-muted under-line">
                                                <?= $response[$i]->titulo ?>
                                            </small>
                                        </a>


                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endfor; ?>
                    </div>
                    <div class="col-md-1"></div>
                </div>
            </div>
        </div>
    </div>
</div>