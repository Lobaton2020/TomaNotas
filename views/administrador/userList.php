
<h4 class="text-center">Listado de Usuarios</h4>
<div class="table-responsive">
<table class="table table-bordered">
  <thead>
    <tr>
      <th>#</th>
      <th>Nombre</th>
      <th>Nickname</th>
      <th>Correo</th>
      <th>Rol</th>
      <th>Estado</th>
      <th>Nacimiento</th>
      <th>Ingreso</th>

    </tr>
  </thead>
  <tbody>
  <?php foreach($response as $row):?>

    <tr>
      <th><?php echo $row->id_usuario_PK; ?></th>
      <td><?php echo $row->nombre." ". $row->apellido; ?></td>
      <td><?php echo $row->nickname; ?></td>
      <td><?php echo $row->correo; ?></td>
      <td><?php echo ($row->id_rol_FK == 1) ? "Admin":"User"; ?></td>
      <td><?php echo ($row->estado == 1) ? "<span class='ac'>Activo</span>":"<span class='iac'>Inactivo</span>";  ?></span></td>
      <td><?php echo $row->fecha_nacimiento; ?></td>
      <td><?php echo $row->fecha_ingreso; ?></td>

    </tr>

  <?php endforeach;?>
  </tbody>
 </table>
</div>