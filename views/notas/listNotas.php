<?php require_once "helpers/obtener_Fechas.php"; ?>
<?php require_once "views/template/dashboard/errorHandler.php" ?>
<button type="button" data-toggle="modal" data-target="#agregar_nota" class="btn btn-success form-control my-n2">Agregar Nota</button>

<!-- Modal -->
<?php include_once "views/notas/modals/notaCreate.php"; ?>
<?php if (count($response) != 0) { ?>

  <div class="card-columns mt-4">
    <?php $i = 1;
    foreach ($response as $row) : ?>
      <?php
        $idNota    = (int) $row->id_nota_PK;
        $titulo    = htmlspecialchars($row->titulo ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
        $descJson  = htmlspecialchars(json_encode($row->descripcion ?? '', JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_UNICODE), ENT_QUOTES, 'UTF-8');
        $colorVal  = htmlspecialchars($row->color ?? '#ffffff', ENT_QUOTES, 'UTF-8');
        $colorSafe = preg_match('/^#([0-9a-fA-F]{3}|[0-9a-fA-F]{6})$/', (string)($row->color ?? '')) ? $row->color : '#ffffff';
        $fechaSafe = htmlspecialchars(getDatenota($row->fecha_ingreso), ENT_QUOTES, 'UTF-8');
      ?>
      <div class="card" style="background-color: <?= htmlspecialchars($colorSafe, ENT_QUOTES, 'UTF-8') ?>">
        <div class="card-body ">
          <input type="hidden" value='<?= $descJson ?>' id="descripcion<?= $idNota ?>">
          <input type="hidden" value="<?= $titulo ?>" id="titulo<?= $idNota ?>">
          <input type="hidden" value="<?= $colorVal ?>" id="color<?= $idNota ?>">
          <input type="hidden" value="<?= $fechaSafe ?>" id="fecha<?= $idNota ?>">
          <h5 class="card-title"><?= $titulo ?> &nbsp;</h5>
          <textarea class="card-text form-control p-0 text-peque muestra_nota size_js " id="size_js<?= $i++ ?>" data-resizable="true" disabled><?= htmlspecialchars($row->descripcion ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></textarea>

          <p class="card-text mt-2"><small class="text-muted"><?= $fechaSafe ?></small> <span onclick="getNota(<?= $idNota ?>);" data-toggle="modal" data-target="#staticBackdrop" class="float-right text-right">&nbsp;&nbsp;<i class="fas fa-ellipsis-v"> </i>&nbsp;&nbsp;</span></p>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

<?php } else { ?>
  <div class="alert alert-warning mt-3">
    En el momento no existen notas guardadas.
  </div>
<?php
}
?>
</div>

<?php include_once "views/notas/modals/notaUpdate.php"; ?>