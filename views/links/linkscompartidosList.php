<?php require_once "helpers/obtener_Fechas.php";?>

<?php include "views/links/modals/mostrarLink.php";?>
<div class="container tipo-letra">
    <?php require_once "views/template/dashboard/errorHandler.php"?>

    <h4 class="text-center py-2 mt-n3  ">Links Compartidos</h4>
    <div class="text-left mb-2">
        <a href="?c=link" class="">Regresar</a>
    </div>
     <?php if (count($response["links"]) > 0) {?>

    <div class="table-responsive col-sm-12">
    <table  class="table tabla">
    <thead class="table-info border-top-danger">
       <tr>
          <th class="num">#</th>
          <th class="descripcion">Descripcion</th>
          <th class="fecha">Fecha</th>
          <th class="links-compartir">Links</th>
       </tr>
      </thead>
      <tbody>
   <?php $i = 1;
    foreach ($response["links"] as $row) {

        if ($row->id_usuario_recibe_FK !== $_SESSION["id_user"]) {
            $tipo = "Compartido con " . $row->nombre . " " . $row->apellido;
        }
        if ($row->id_usuario_entrega_FK !== $_SESSION["id_user"]) {
            $user = $this->usuario->getone($row->id_usuario_entrega_FK);
            $tipo = $user->nombre . " " . $user->apellido . " te lo ha compartido.";
        }

        ?>     <tr>
           <td class="num"><?php echo $i++; ?></td>
           <td class="descripcion">
            <a class="font-weight-bold font-italic text-dark ver-modal-link" href="<?php echo $row->url_link; ?>" >
               <?php echo !empty($row->titulo) ? " -- " . $row->titulo : $row->url_link; ?>
            </a>

               <div class="d-block mb-0 mt-0">
               <small class="small text-muted"><?php echo $tipo; ?></small>
               </div>
           </td>
           <td style="display:non" class="fecha"><small><?php echo getDatetime($row->fecha) ?></small></td>
           <td class="links-compartir">
           <?php foreach ($response["http"] as $link) {
            if ($link->id_link_PK == $row->id_link_FK) {?>
                  <a class="float-left" target="_blank" href="<?php echo $row->url_link; ?>">Ir al Sitio</a>
           <?php }}?>
                <a  onclick="javascript:return confirm('¿Seguro de eliminar este registro?');"
                 class="eliminar float-right btn btn-outline-danger " title="Eliminar Link" href="?c=link&m=deleteCompartido&id=<?php echo $row->id_link_compartido_PK; ?>" name="eliminar_nota"><i class="fas fa-trash-alt"></i></a>
              </td>
       </tr>
    <?php }?>
   </tbody>
 </table>
        </div>
     <?php } else {?>
     <div class="alert alert-warning">
          No de encontraron links Compartidos.
     </div>
     <?php }?>

</div>
