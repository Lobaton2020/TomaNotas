<?php if(count($response) == 0){
   echo '<div class="alert alert-secondary" role="alert">
          No hay Notificaciones.
          </div>';
}else{ ?>
<h4 class="text-center">Listado de Notificaciones</h4>
<div class="table-responsive">
<table class="table table-bordered">
  <thead>
    <tr>
      <th>#</th>
      <th>Descripcion</th>
      <th>Fecha</th>
      <th>Accion</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($response as $row):?>

    <tr>
      <th><?php echo $row->id_notificacion_PK; ?></th>
      <td><?php echo "El usuario <em>".$row->nombre." ". $row->apellido." <b>".$row->tipo_notificacion.".</b></em>"; ?></td>
      <td><?php echo getDatetime($row->fecha); ?></td>
      <td>
      <a onclick="javascript:return confirm('¿Seguro de eliminar este registro?');"
                 href="?c=administrador&m=deleteNoti&id=<?php echo $row->id_notificacion_PK; ?>" class="btn btn-outline-default" tabindex="0" 
                 title="Eliminar" data-toggle="tool"><i class="fas fa-trash"></i></a>
      </td>

    </tr>

  <?php endforeach;?>
  </tbody>
 </table>
</div>
  <?php } ?>