<?php if(count($response) == 0){
   echo '<div class="alert alert-secondary" role="alert">
          No hay un historial de login de Usuario.
          </div>';
}else{ ?>
<h4 class="text-center">Historia de ingreso de usuarios</h4>
<div class="table-responsive">
<table class="table table-bordered">
  <thead>
    <tr>
      <th>#</th>
      <th>Nombre</th>
      <th>Fecha y hora</th>
      <th>Accion</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($response as $row):?>

    <tr>
      <th><?php echo $row->id_registro_login_PK; ?></th>
      <td><?php echo $row->nombre." ". $row->apellido; ?></td>
      <td><?php echo  getDatetime_login_history($row->fecha,$row->hora); ?></td>
      <td>
      <a onclick="javascript:return confirm('¿Seguro de eliminar este registro?');"
                 href="?c=administrador&m=deleteHistory&id=<?php echo $row->id_registro_login_PK; ?>" class="btn btn-outline-default" tabindex="0" 
                 title="Eliminar" data-toggle="tool"><i class="fas fa-trash"></i></a>
      </td>

    </tr>

  <?php endforeach;?>
  </tbody>
 </table>
</div>
  <?php } ?>