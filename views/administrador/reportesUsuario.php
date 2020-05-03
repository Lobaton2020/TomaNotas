<?php if (count($response) == 0) {
    echo '<div class="alert alert-secondary" role="alert">
          No hay Reportes de usuarios.
          </div>';
} else {?>
<h4 class="text-center">Gestion de contenido</h4>
<div class="table-responsive">
<table class="table table-bordered">
  <thead>
    <tr>
      <th>#</th>
      <th>Usuario</th>
      <th>Links</th>
      <th>Notas</th>
      <th>Archivos</th>
      <th>Tareas</th>
      <th>Cronogramas</th>
      <th>Total</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($response as $row): ?>
     <?php $total = 0;?>
     <?php $total += $row->L;?>
     <?php $total += $row->N;?>
     <?php $total += $row->A;?>
     <?php $total += $row->T;?>
	 <?php $total += $row->C; ?>
    <tr>
      <th><?php echo $row->id_usuario_PK ?></th>
      <td><?php echo $row->nickname ?></td>
      <td><?php echo $row->L; ?></td>
      <td><?php echo $row->N; ?></td>
      <td><?php echo $row->A; ?></td>
      <td><?php echo $row->T; ?></td>
      <td><?php echo $row->C; ?></td>
      <td><?php echo $total; ?></td>
    </tr>
  <?php endforeach;?>
  </tbody>
 </table>
</div>
  <?php }?>