<div class="container tipo-letra">
  <div class="row">
    <div class="col-md-2 col-sm-12"></div>
    <div class="col-md-8 col-sm-12 ">
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
        <table class="table table-hover">
          <thead>
            <tr>
              <td>#</td>
              <td style="min-width:150px">Nombre</td>
              <td>Estado</td>
              <td>Horas gastadas</td>
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
                  <span data-toggle="tool" title="<?= $row->descripcion ?>"><?= $row->name ?></span>
                </td>
                <td>
                  <?php if ($row->status == "1"): ?>
                    <span class="badge badge-pill badge-success">Active</span>
                  <?php else: ?>
                    <span class="badge badge-pill badge-danger">Inactive</span>
                  <?php endif; ?>
                </td>
                <td>
                  <span class="text-muted">
                    <?= $row->hours_spent ? $row->hours_spent : 0 ?> h
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
      <?php endif; ?>
    </div>
    <div class="col-md-2 col-sm-12"></div>
  </div>
</div>
<?php require_once "views/project/modals/projectCreate.php" ?>