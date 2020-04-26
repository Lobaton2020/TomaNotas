


<div class="container tipo-letra">
   <div class="row">
     <div class="col-md-2 col-sm-12"></div>
     <div class="col-md-8 col-sm-12 ">
     <?php  require_once "views/template/dashboard/errorHandler.php"?>
     
     <?php if(count($response) > 0){ ?>
      <div class="todo">
        <div id="input-file" class="float-left "><a href="?c=archivo&m=subir">Subir nuevo archivo.</a></div>
        <div class="float-right ">
            <a href="?c=archivo&m=archivos_compartidos">Compartidos</a> |
            <a id="eliminar_file" onClick="comprobacion();"  class="Eliminar" href="">Eliminar</a>
      
          </div>
          <div class=" form-group my-2">
       <input type="text" class="form-control" placeholder="Buscador de archivos." id="buscar_archivo">
      </div>
      <div id="active_responsive">
        <div id="resultados_ajax">
            <?php require_once "views/archivos/tableList.php"; ?>
          
       </div>
       </div>
     </div>
     <?php }else{ ?>
      <a href="?c=archivo&m=archivos_compartidos" class="btn btn-secondary form-control mb-3">Ver archivos Compartidos</a>
      <a href="?c=archivo&m=subir" class="btn btn-success form-control mb-3">Subir Nuevo archivo</a>
     <div class="alert alert-warning">
          No de encontraron Archivos guardados.
     </div>
     <?php
      }
      ?>
    </div>
   <div class="col-md-2 col-sm-12"></div>
 </div>    
</div>


<div class="modal fade" id="rename" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Actualizar nombre de archivo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div id="alert_a" style="display:none" class="alert  alert-dismissible fade show" role="alert">
         <span id="content"></span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <input type="hidden" id="type" >
        <input type="hidden" id="new_id" >
        <input type="hidden" id="old_name_file" >

        <input type="text" class="form-control" id="new_name_file" > 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" id="guardar_cambios" class="btn btn-primary">Guardar Cambios</button>
      </div>
    </div>
  </div>
</div>