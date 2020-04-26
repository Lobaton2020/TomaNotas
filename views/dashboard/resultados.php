
   <!-- mensaje si no hay links -->
   <?php if (count($res) == 0){ ?>
   <div class="alert alert-danger" role="alert">
     No hay Links ..
   </div>
   <?php }else{ ?>

 <div class="table-responsive col-sm-12">
    <table class="table">
    <thead class="table-info">
       <tr>
          <th class="num">#</th>
          <th class="descripcion">Descripcion</th>
          <?php  echo isset($_SESSION['date']) ? "<th class=\"fecha\">Fecha</th>" : ""; //muestra la session de fecha si el cliente lo desea ?>
          <th class="links">Links</th>
          <?php echo isset($_SESSION["update"]) || isset($_SESSION["delete"]) ? "<th>Accion</th>" : false; ?>
       </tr>
      </thead>
      <tbody>
   <?php }
     $i = 1;
     foreach($res as $row){
?>     <tr>
           <td class="num"><?php echo $i++; ?></td>
           <td class="descripcion"><?php echo $row->descripcion; ?></td>
           <?php echo isset($_SESSION['date']) ? "<td class=\"fecha\">".$row->fecha."</td>"  : false; ?>
           <td class="links">
           <?php foreach($reslink as $link){
              if($link->descripcion == $row->descripcion){ ?>
                  <a target="_blank" href="<?php echo $row->descripcion; ?>">Ir al Sitio</a>
           <?php } } ?>
           </td>
           <?php  if(isset($_SESSION["update"]) || isset($_SESSION["delete"])){ ?>
           <td  class="action">
             <?php if(isset($_SESSION["update"])){ ?>
                <a title="Actualizar Notas" href="?c=auth&m=getone&id=<?php echo $row->id; ?>" class="btn btn-outline-secondary" ><i class="fas fa-edit"></i></a>
             <?php } if(isset($_SESSION["delete"])){ ?>
                <a class="eliminar btn btn-outline-danger" title="Eliminar Notas" href="?c=auth&m=delete&id=<?php echo $row->id; ?>" name="eliminar_nota"><i class="fas fa-trash-alt"></i></a>
             <?php } ?>
             </td>
             <?php } ?>
       </tr>  
    <?php } ?>
   </tbody>
 </table>
</div>
