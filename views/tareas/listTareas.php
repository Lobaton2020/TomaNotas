<?php  require_once "helpers/obtener_Fechas.php"; ?>
<?php  require_once "views/template/dashboard/errorHandler.php"?>
<button type="button" data-toggle="modal" data-target="#agregar_tarea" class="btn btn-info form-control mb-3">Agregar Tarea</button>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">

    <li class="breadcrumb-item"><a onclick="javascript:return confirm('¿Estas seguro de reiniciar todas las tareas?')" href="?c=tarea&m=reiniciarTareas&s=1 ">Reiniciar Acciones</a></li>
    <li class="breadcrumb-item active" aria-current="page"> <span id="numTareas"></span></li>

  </ol>
</nav>

<!-- Modal -->
<?php include_once "views/notas/modals/notaCreate.php"; ?>
<?php if(count($response) != 0){ ?>

      <?php $i = 1; foreach($response as $row ):
        
        if($row->estado == 1){
           $descripcion = "<s><i>". $row->descripcion ."</s></i>"; 
           $tipo = "success bg_success";
        }else{
            $descripcion =  $row->descripcion ; 
            $tipo = "primary";
        }
        // simplifica duplicado de codigo
        $id = $row->id_tarea_PK;
        ?>
  
          <div class="input-group mb-3">
              <div class="input-group-prepend">
                   <span class="input-group-text border-<?php echo $tipo; ?>">

                      <input type="hidden" id="fecha<?php echo $id; ?>" value="<?php echo $row->fecha; ?>">
                      <input type="hidden" id="hora<?php echo $id; ?>" value="<?php echo $row->hora; ?>">
                      <input type="hidden" id="descripcion<?php echo $id; ?>" value="<?php echo $row->descripcion; ?>">
                      <input type="hidden" id="estado<?php echo $id; ?>" value="<?php echo $row->estado; ?>">
                
                      <input type="checkbox" onclick="checkinTarea(<?php echo $id; ?>)" <?php echo ($row->estado == 1) ? "checked": ""; ?> class="custom-control" style="font-size:30px" id="check<?php echo $row->id_tarea_PK; ?>">
                  </span>
              </div>
              <!-- div que muestra el mensaje -->
              <div class="form-control tarea_sm border-<?php echo $tipo; ?>  h-auto" onclick="this.style.display = 'none';habilitarEdicion(<?php echo $id; ?>)" >
                <?php echo $descripcion; ?>
              </div>
             <!-- opcio para editar el texto  -->
              <form  id="form_act<?php echo $id; ?>" method="post">
                 <input type="hidden" name="c" value="tarea">
                 <input type="hidden" name="m" value="updateDescripcion">
                 <input type="hidden" name="id" value="<?php echo $id; ?>">
              </form>
                <textarea style="display:none" name="descripcion" form="form_act<?php echo $id; ?>" id="editbox<?php echo $id; ?>" class="form-control " ><?php echo $row->descripcion; ?></textarea>
              <div class="input-group-append">
                 <a  id="show_num<?php echo $id; ?>" onclick="detalleTarea(<?php echo $id; ?>)"
                     data-toggle="modal" data-target="#opciones_tarea"  
                     class="btn float-right"><i class="fas fa-minus-circle mt-n5"></i></a>
              </div>
          </div>
          <div style="display:none" id="act<?php echo $id; ?>">
               <button type="submit" form="form_act<?php echo $id; ?>" id="num_char<?php echo $id; ?>" class="btn btn-success form-control mb-3">Actualizar Tarea</button>
          </div>

        <?php endforeach; ?>

      <?php }else{ ?>
        <div class="alert alert-warning">
          En el momento no existen Tareas guardadas.
        </div>
        <?php
      }
      ?>
</div>

<!-- modal para agregar la nueva tarea -->
<div class="modal fade" id="agregar_tarea" tabindex="-1" role="dialog" aria-labelledby="agregar_tarea" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Agregar tarea</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form method="post" id="form_tarea">
              <input type="hidden" name="c" value="tarea">
              <input type="hidden" name="m" value="create">
          <div class="form-group">
         
            <textarea rows=4 class="form-control text-peque " id="texto" name='descripcion' placeholder="Ingresa tu tarea..."></textarea>
         <small class="text-muted">Maximo 100 caracteres</small> <span id="caracteres" class="float-right">100 caracteres</span>
          </div>
        </form>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" form="form_tarea" class="btn btn-primary">Guardar tarea</button>
      </div>
    </div>
  </div>
</div>

<!-- modal para confirmar eliminacion y ppoder ver la fecha-->
<div class="modal fade" id="opciones_tarea" tabindex="-1" role="dialog" aria-labelledby="opciones_tarea" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Opciones de tarea</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form method="post" id="form_tarea">
              <input type="hidden" name="c" value="tarea">
              <input type="hidden" name="m" value="create">
          <div class="form-group">
           <p class="p-3 border rounded"><span id="descripcion_m"></span></p>
           <p><span id="estado_m"></span></p>
           <small id="fecha_m"></small>
          </div>
        </form>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <a onclick="javascript:return confirm('¿Estas seguro de eliminar esta tarea?')" href="#" id="btn-elim" class="btn btn-danger">Eliminar</a>
      </div>
    </div>
  </div>
</div>

