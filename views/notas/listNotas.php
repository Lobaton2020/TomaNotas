
<?php require_once "helpers/obtener_Fechas.php";?>
<?php require_once "views/template/dashboard/errorHandler.php"?>
<button type="button" data-toggle="modal" data-target="#agregar_nota" class="btn btn-success form-control my-n2">Agregar Nota</button>

<!-- Modal -->
<?php include_once "views/notas/modals/notaCreate.php";?>
<?php if (count($response) != 0) {?>
  <div class="form-group">
    </div>
    <div class="card-columns">
      <?php $i = 1;foreach ($response as $row): ?>
        <div class="card">
          <div class="card-body " >
            <!-- <p class="d-none" id="descripcion<?php echo $row->id_nota_PK; ?>"><?php echo $row->descripcion; ?></p> -->
            <input type="hidden" value="<?php echo $row->descripcion; ?>" id="descripcion<?php echo $row->id_nota_PK; ?>">
           <input type="hidden" value="<?php echo $row->titulo; ?>" id="titulo<?php echo $row->id_nota_PK; ?>">
           <input type="hidden" value="<?php echo getDatenota($row->fecha_ingreso); ?>" id="fecha<?php echo $row->id_nota_PK; ?>">
           <h5 class="card-title"><?php echo $row->titulo; ?> &nbsp;</h5>
           <textarea class="card-text form-control p-0 text-peque muestra_nota size_js "  id="size_js<?php echo $i++; ?>" data-resizable="true" disabled><?php echo $row->descripcion; ?></textarea>

           <p class="card-text mt-2"><small class="text-muted"><?php echo getDatenota($row->fecha_ingreso); ?></small> <span  onclick="getNota('<?php echo $row->id_nota_PK; ?>');" data-toggle="modal" data-target="#staticBackdrop" class="float-right text-right">&nbsp;&nbsp;<i class="fas fa-ellipsis-v"> </i>&nbsp;&nbsp;</span></p>
         </div>
        </div>
        <?php endforeach;?>
        </div>

      <?php } else {?>
        <div class="alert alert-warning mt-3">
          En el momento no existen notas guardadas.
        </div>
        <?php
}
?>
</div>

<?php include_once "views/notas/modals/notaUpdate.php";?>