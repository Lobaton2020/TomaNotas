<?php if(count($response) == 0){
   echo '<div class="alert alert-secondary" role="alert">
          No hay Reportes de usuarios.
          </div>';
}else{ ?>
<h4 class="text-center">Gestion de contenido</h4>
<div class="table-responsive">
<table class="table table-bordered">
  <thead>
    <tr>
      <th>#</th>
      <th>Usuario</th>
      <th>Links</th>
      <th>Archivos</th>
      <th>Notas</th>
      <th>Tareas</th>
    </tr>
  </thead>
  <tbody>
  <?php for($i=0;$i<count($response);$i++):?>

    <tr>
      <td><?php echo $response[$i]["id"]; ?></td>
      <th><?php echo $response[$i]["nickname"]; ?></th>
      <td><?php echo $response[$i]["numLinks"]; ?></td>
      <td><?php echo $response[$i]["numArchivos"]; ?></td>
      <td><?php echo $response[$i]["numNotas"]; ?></td>
      <td><?php echo $response[$i]["numTareas"]; ?></td>

      
    </tr>

  <?php endfor;?>
  </tbody>
 </table>
</div>
  <?php } ?>