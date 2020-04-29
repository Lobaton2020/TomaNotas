
<?php require_once "helpers/obtener_Fechas.php";?>
<div class="container tipo-letra">
   <div class="row">
     <div class="col-md-2 col-sm-12"></div>
     <div class="col-md-8 col-sm-12 ">
     <?php require_once "views/template/dashboard/errorHandler.php"?>
     <h4 class="text-center py-2 border border-dark">Archivos Compartidos</h4>
     <?php if (count($response) > 0) {?>
      <div class="todo">
        <div id="input-file" class="float-left "><a href="?c=archivo&m=subir">Subir nuevo archivo.</a></div>
        <div class="float-right ">
            <a href="?c=archivo&m=index">Regresar</a> |
            <a id="eliminar_file" onClick="comprobacion();"  class="Eliminar" href="">Dejar de compartir</a>

          </div>
          <div class=" form-group my-2">
       <!-- <input type="text" class="form-control" placeholder="Buscador de archivos." id="buscar_archivo"> -->
      </div>
      <div id="active_responsive">
      <table  class="table table-hover">
            <thead>

             <tr>
               <td>#</td>
               <td style="max-width:100px">Archivo</td>
               <td>Tipo</td>
               <td class="eliminar_archivo" >Accion</td>
            </tr>
          </thead>
          <tbody class="table table-hover">
             <?php
$i = 1;
    foreach ($response as $row):
        if ($row->id_usuario_recibe_FK !== $_SESSION["id_user"]) {
            $tipo = "Compartido con " . $row->nombre . " " . $row->apellido;

        }

        if ($row->id_usuario_entrega_FK !== $_SESSION["id_user"]) {
            $user = $this->user->getone($row->id_usuario_entrega_FK);
            $tipo = $user->nickname . " te lo ha compartido.";
        }
        if (isset($row->id_usuario_FK)) {
            $usuario = $this->user->getone($row->id_usuario_FK);

            $propietario = $usuario->nickname;

        } else {
            $propietario = "desconocido";
        }

        $tool = getDateTime($row->fecha) . " Propietario: " . $propietario;
        ?>
			             <tr>
			                 <input type="hidden" id="extencion<?php echo $row->id_archivo_FK; ?>" value="<?php echo pathinfo($row->ruta, PATHINFO_EXTENSION); ?>">
			                 <input type="hidden" id="nombre_archivo<?php echo $row->id_archivo_FK; ?>" value="<?php echo pathinfo($row->ruta, PATHINFO_FILENAME); ?>">
			                 <td> <span  data-toggle="tool" title="<?php echo getDateTime($row->fecha); ?>"><?php echo $i++; ?></span></td>
			                 <td><a  href="?c=archivo&m=vercompartido&id=<?php echo $row->id_archivo_FK; ?>#iframe"><span data-toggle="tool" title="<?php echo $tool; ?>"></span><span id="basename<?php echo $row->id_archivo_FK; ?>"><?php echo pathinfo($row->ruta, PATHINFO_BASENAME); ?></span></span></a></td>
			                 <td class="text-left"><small><?php echo $tipo; ?></small></td>
			                 <td class="eliminar_archivo" class="eliminar_archivo"><a href="?c=archivo&m=deleteCompartido&id=<?php echo $row->id_archivo_compartido_PK; ?> "  onclick="if(!confirm('¿Seguro quieres eliminar este Archivo?')){ return false }" ><span class="text-danger">Quitar</span></a></td>
			            </tr>
			             <?php endforeach;?>
          </tbody>
       </table>

       </div>
       </div>
     </div>
     <?php } else {?>
      <a href="?c=archivo&m=subir" class="btn btn-success form-control mb-3">Subir Nuevo archivo</a>
     <div class="alert alert-warning">
          No de encontraron Archivos Compartidos.
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