
<?php require_once "helpers/obtener_Fechas.php";?>
<?php require_once "views/template/dashboard/errorHandler.php"?>

<?php showMessage("success-insert-tarea", "success");?>
<?php showMessage("error-insert-tarea", "danger");?>

<button type="button" data-toggle="modal" data-target="#agregar_cronograma" class="btn btn-secondary  form-control my-n2">Nuevo cronograma</button>
<!-- Modal -->
<?php include_once "views/cronograma/modals/cronogramaCreate.php";?>
<?php if (count($response) > 0) {?>
  <div class="form-group">
    </div>
    <div class="card-columns">
      <?php $i = 0;foreach ($response as $row): ?>
        <div class="card">
          <div class="card-body pb-0" >
            <h5 class="card-title"><a href="?c=cronograma&m=getTareas&id=<?php echo $row->id_cronograma_PK ?>"><?php echo $row->titulo; ?></a> &nbsp;</h5>
            <div class="card-text mt-2 pb-4"><small class="text-muted"><?php echo getDatenota($row->fecha); ?></small>
            <a class="float-right text-right" id="options_cronograma" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >&nbsp;&nbsp;<i class="fas fa-ellipsis-v"> </i>&nbsp;&nbsp;</a>
            <div class="dropdown-menu dropdown-menu-right " aria-labelledby="#options_cronograma">
              <h6 class="dropdown-header">Opcion</h6>
              <a class="dropdown-item small"  onclick="javascript:return confirm('¿Estas seguro de eliminar este cronograma?')" href="?c=cronograma&m=eliminarCronograma&idcronograma=<?php echo $row->id_cronograma_PK ?>"><i class="fas fa-trash"></i> Eliminar </a>
              <a class="dropdown-item small update-title" id="update-title-<?php echo $i++; ?>"  type="button" data-toggle="modal" data-target="#agregar_cronograma" ide="<?php echo $row->id_cronograma_PK ?>" title="<?php echo $row->titulo; ?>"><i class="fas fa-heading"></i></i> Cambiar titulo </a>
            </div>
          </div>
         </div>
        </div>
        <?php endforeach;?>
        </div>

      <?php } else {?>
        <div class="alert alert-warning mt-3">
          En el momento no existen Cronogramas guardados.
        </div>
        <?php
}
?>
</div>

<?php include_once "views/notas/modals/notaUpdate.php";?>
