
<?php require_once "helpers/obtener_Fechas.php";?>

   <!-- mensaje si no hay links -->
   <?php if (count($res) == 0) {?>
   <div class="alert alert-danger" role="alert">
     No hay Links ..
   </div>
   <?php } else {?>

 <div   class="table-responsive col-sm-12">
    <table  class="table ">
    <thead class="table-info border-top-danger">
       <tr>
          <th class="num">#</th>
          <th class="descripcion">Descripcion</th>
          <th style="display:none" class="fecha">Fecha</th>
          <th class="links">Links</th>
          <?php if (isset($_SESSION["id_user"]) && !empty($_SESSION["id_user"])) {?>
           <th style="display:none" id="table001">Accion</th>
          <?php } else {?>
            <span id="table001"></span>
          <?php }?>
       </tr>
      </thead>
      <tbody>
   <?php }
$i = 1;
foreach ($res as $row) {
    ?>     <tr>
           <td class="num"><?php echo $i++; ?></td>
           <td class="descripcion"><?php echo $row->url_link;
    echo !empty($row->titulo) ? " -- " : ""; ?><small class="font-weight-bold font-italic"><?php echo $row->titulo; ?></small></td>
           <td style="display:none" class="fecha"><?php echo getDatelink($row->fecha_ingreso) ?></td>
           <td class="links">
           <?php foreach ($reslink as $link) {
        if ($link->id_link_PK == $row->id_link_PK) {?>
                  <a target="_blank" href="<?php echo $row->url_link; ?>">Ir al Sitio</a>
           <?php }}?>
           </td>
           <?php if (isset($_SESSION["id_user"]) && !empty($_SESSION["id_user"])) {?>

           <td style="display:none" class="table002 action">
              <span class="actualizacion float-left mr-n6">
                <a  class="btn btn-outline-secondary " title="Actualizar Link" data-toggle="tool" href="?c=link&m=getone&id=<?php echo $row->id_link_PK; ?>"  ><i class="fas fa-edit"></i></a>
              </span>
              <span class="eliminacion float-right ml-n6">
                <a  onclick="javascript:return confirm('¿Seguro de eliminar este registro?');"
                 class="eliminar btn btn-outline-danger " title="Eliminar Link" href="?c=link&m=delete&id=<?php echo $row->id_link_PK; ?>" name="eliminar_nota"><i class="fas fa-trash-alt"></i></a>
                </span >
                <span style="display:none" class="compartir float-right ml-n6">
                <a href=""  class=" btn btn-outline-primary modal-compartir" id="update-title-<?php echo $i; ?>"  type="button" data-toggle="modal" " title="Compartir Link"  name="<?php echo $row->id_link_PK; ?>"><i class="fas fa-share"></i></a>
                </span >
              </td>
              <?php }?>

       </tr>
    <?php }?>
   </tbody>
 </table>
</div>

