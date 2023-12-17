<?php require_once "helpers/if_null_then_0.php"; ?>
<div class="container tipo-letra">
  <div class="row">
    <div class="col-md-1 col-sm-12"></div>
    <div class="col-md-10 col-sm-12 ">
      <?php require_once "views/template/dashboard/errorHandler.php" ?>
      <button type="button" data-toggle="modal" data-target="#add_project"
        class="btn btn-success  form-control mt-n2 mb-2">Nuevo proyecto</button>
      <?php if (count($response) == 0): ?>
        <div class="alert alert-warning">
          No se encontraron registros guardados.
          Deseas crear uno <a href="?c=project&m=create">aqui</a>
        </div>
      <?php endif; ?>
      <?php if (count($response) > 0): ?>
        <div class="table-responsive">

          <table class="table table-hover">
            <thead>
            <tr>
              <td>#</td>
              <td style="min-width:150px">Nombre</td>
              <td>Estado</td>
              <td>Horas planeadas</td>
              <td>Horas completadas</td>
              <td>Horas no completadas</td>
              <td>Total horas</td>
              <?php if (isset($_SESSION["id_user"]) || !empty($_SESSION["id_user"])): ?>
                <td class="eliminar_archivo">Accion</td>
                <?php endif; ?>
            </tr>
          </thead>
          <tbody class="table table-hover">
            <?php
            $i = 1;
            foreach ($response as $row): ?>
              <tr>
                <td>
                  <?= $row->id ?>
                </td>
                <td>
                  <a href="?c=project&m=tasks&project_id=<?= $row->id ?>&name=<?= $row->name ?>" class="under-line">
                  <span data-toggle="tool" title="<?= $row->descripcion ?>"><?= $row->name ?></span>
                </a>
                </td>
                <td>
                  <?php if ($row->status == "1"): ?>
                    <span class="badge badge-pill badge-success">Active</span>
                    <?php else: ?>
                      <span class="badge badge-pill badge-danger">Inactive</span>
                    <?php endif; ?>
                </td>
                <td>
                  <? if ($row->time_difference_planned <= 1 && $row->time_difference_planned > 0): ?>
                    <span class="text-mute text-success">
                      <?= if_null_then_0($row->time_difference_planned) ?> h
                            </span>
                  <? endif; ?>
                  <? if ($row->time_difference_planned <= 3 && $row->time_difference_planned > 1): ?>
                    <span class="text-mutd text-warning">
                      <?= if_null_then_0($row->time_difference_planned) ?> h
                            </span>
                  <? endif; ?>
                  <? if ($row->time_difference_planned > 3): ?>
                    <span class="text-mued text-danger">
                      <?= if_null_then_0($row->time_difference_planned) ?> h
                            </span>
                    <? endif; ?>
                  <? if (!$row->time_difference_planned || $row->time_difference_planned <= 0): ?>
                    <span class="text-muted ">
                      <?= if_null_then_0($row->time_difference_planned) ?> h
                            </span>
                  <? endif; ?>
                </td>
                <td>
                  <span class="text-muted">
                    <?= if_null_then_0($row->time_difference_done) ?> h <small class="text-muted" style="font-size:.6rem">
                          <?= $row->percentage_done_of_total ?>%
                        </small>
                        </span>
                        </td>
                        <td>
                          <span class="text-muted">
                    <?= if_null_then_0($row->time_difference_never_done) ?> h
                      </span>
                      </td>
                      <td>
                          <span class="text-muted">
                        <?= if_null_then_0($row->total_hours_planned) ?> h
                      </span>
                    </td>
                    <td class="text-left">
                  <?php $row->descripcion = base64_encode($row->descripcion) ?>
                  <a href="#" onclick='updateProjectParser(`<?= json_encode($row); ?>`)' data-toggle="modal"
                  data-target="#add_project" class="text-dark"><i s class="far fa-edit"></i></a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <?php endif; ?>
    </div>
    <div class="col-md-1 col-sm-12"></div>
  </div>
</div>
<?php require_once "views/project/modals/projectCreate.php" ?>