
<?php require_once "helpers/obtener_Fechas.php";?>
<?php require_once "views/template/dashboard/errorHandler.php"?>

<?php showMessage("success-insert-tarea", "success");?>
<?php showMessage("error-insert-tarea", "danger");?>


<div class="row">
  <div class="col-md-6">
    <a href="?c=project" type="button" class="btn btn-success  form-control mt-n2 mb-3 ">Proyectos</a>
    </div>
    <div class="col-md-6">
    <button type="button" data-toggle="modal" data-target="#agregar_cronograma" class="btn btn-info  form-control mt-n2 mb-2">Nuevo cronograma</button>

  </div>
</div>
<!-- Modal -->
<?php include_once "views/cronograma/modals/cronogramaCreate.php";?>
<?php if (count($response) > 0) {?>
    <div class="card-columns">
      <?php $i = 0;foreach ($response as $row): ?>
        <div class="card border mb-2 pr-3 pl-3 pt-3 pb-0   ">
          <div class="pb-n5" >
            <h5 class="card-title"><a href="?c=cronograma&m=getTareas&id=<?php echo $row->id_cronograma_PK ?>"><?php echo $row->titulo; ?></a> &nbsp;</h5>
            <div class="card-text mt-2 pb-4"><small class="text-muted"><?php echo getDatenota($row->fecha); ?></small>
            <a class="float-right text-right" id="options_cronograma" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >&nbsp;&nbsp;<i class="fas fa-ellipsis-v"> </i>&nbsp;&nbsp;</a>
            <div class="dropdown-menu dropdown-menu-right " aria-labelledby="#options_cronograma">
              <h6 class="dropdown-header">Opcion</h6>
              <a class="dropdown-item small"  onclick="javascript:return confirm('¿Estas seguro de copíar este cronograma?')" href="?c=cronograma&m=copiar&idcronograma=<?php echo $row->id_cronograma_PK ?>"><i class="fa fa-copy"></i> Crear copia </a>
              <a class="dropdown-item small update-title" id="update-title-<?php echo $i++; ?>"  type="button" data-toggle="modal" data-target="#agregar_cronograma" ide="<?php echo $row->id_cronograma_PK ?>" title="<?php echo $row->titulo; ?>"><i class="fas fa-heading"></i></i> Cambiar titulo </a>
              <a class="dropdown-item small"  onclick="javascript:return confirm('¿Estas seguro de eliminar este cronograma?')" href="?c=cronograma&m=eliminarCronograma&idcronograma=<?php echo $row->id_cronograma_PK ?>"><i class="fas fa-trash"></i> Eliminar </a>
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

