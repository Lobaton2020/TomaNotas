<?php require_once "helpers/obtener_Fechas.php";?>
<?php require_once "views/template/dashboard/errorHandler.php"?>

<?php showMessage("success-insert-tarea", "success");?>
<?php showMessage("error-insert-tarea", "danger");?>
<form class="mb-2" method="post">
    <input type="hidden" name="c" value="cronograma">
    <input type="hidden" id="update-tarea-cronograma" name="m" value="createTareaCronograma">
    <input type="hidden"  name="idcronograma" id="idcronograma" value="<?php echo $_GET["id"] ?>">
    <input type="hidden" id="idtarea" name="idtarea" >
  <div class="row">
      <div class="col-sm-12 col-md-2 ">
          <select id="hora" class="section-option   d-inline " name="hora" >
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
              <option value="11">11</option>
              <option value="12" selected>12</option>
          </select>
          <select id="minuto" class="section-option d-inline" name="minuto" >
              <option value="00">00</option>
              <option value="05">05</option>
              <option value="10">10</option>
              <option value="15">15</option>
              <option value="20">20</option>
              <option value="25">25</option>
              <option value="30">30</option>
              <option value="35">35</option>
              <option value="40">40</option>
              <option value="45">45</option>
              <option value="50">50</option>
              <option value="55">55</option>
          </select>
          <select id="meridiano" class="section-option d-inline" name="meridiano">
              <option value="am">am</option>
              <option value="pm">pm</option>
          </select>
      </div>
    <div class="col-sm-12 col-md-10 d-inline margen">
        <input  id="descripcion" type="text" class="form-control d-inline  width-form-add-task" name="contenido-tarea"  placeholder="Escribe tu tarea?">
        <button id="btn-update-task" type="submit" class="btn btn-success float-right "><i class="fas fa-plus"></i></button>
    </div>
  </div>

</form>

<div class="mt-1 mb-3">
    <div class="card ">
           <div class="text-center  p-3 pr-2 pb-n2 mb-m2">
                <h5>Tus Tareas de hoy
                    <a class="float-right" id="actions_publication" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v small"></i></a>
						<div class="dropdown-menu dropdown-menu-right " aria-labelledby="#actions_publication">
						   <h6 class="dropdown-header">Opciones</h6>
							    <a class="dropdown-item small"  onclick="javascript:return confirm('¿Estas seguro de eliminar todas tus tareas?')" href="?c=cronograma&m=eliminarTareasCronograma&idcronograma=<?php echo $_GET["id"] ?>"><i class="fas fa-trash"></i> Vaciar tareas </a>
						    	<a class="dropdown-item small" onclick="javascript:return confirm('¿Estas seguro de reiniciar todas tus tareas?')" href="?c=cronograma&m=reiniciarTareasCronograma&idcronograma=<?php echo $_GET["id"] ?>"><i class="fas fa-redo-alt"></i> Reiniciar </a>
                        </div>
                </h5>
           </div>
           <div class="card-body">
               <div class="mt-n4">
                 <div class="row">
                    <div class="col-md-1"></div>
                     <div class="col-md-10 px-2">
                        <?php if (count($response) == 0) {?><div class=text-center>No hay contenido por mostrar</div><?php }?>
                         <?php for ($i = 0; $i < count($response); $i++): ?>
                            <?php $minuto = ($response[$i]->minuto == 5) ? "05" : $response[$i]->minuto;?>
                            <?php $minuto = ($response[$i]->minuto == 0) ? "00" : $minuto;?>
                            <?php $time = $response[$i]->hora . " : " . $minuto . " " . $response[$i]->meridiano;?>

                          <?php $check = ($response[$i]->estado == 1) ? "checked" : "";?>
                         <div class="" style="margin-top:2px;">
                             <span class="custom-control ml-1 custom-switch d-inline">
                                <input  type="checkbox" <?php echo $check; ?> ide="<?php echo $response[$i]->id_tarea_cronograma_PK; ?>" class="custom-control-input checkbox"  id="check<?php echo $i; ?>">
                                <label class="custom-control-label" for="check<?php echo $i; ?>"></label>
                            </span>
                            <?php if ($check === "checked"): ?>
                                <s><i>
                                <?php if ($i == (count($response) - 1) || $i == 0): ?>
                                        <span class="text-muted"> <?php echo $time; ?> </span>&bull; <span><?php echo $response[$i]->descripcion; ?></span>
                                        <?php else: ?>
                                            <?php $minuto = ($response[$i - 1]->minuto == 5) ? "05" : $response[$i - 1]->minuto;?>
                                           <?php $minuto = ($response[$i - 1]->minuto == 0) ? "00" : $minuto;?>
                                            <?php $timeback = $response[($i - 1)]->hora . " : " . $minuto . " " . $response[$i - 1]->meridiano;?>
                                            <span class="text-muted"> <?php echo $timeback; ?> => <?php echo $time ?></span> &bull; <span class=""><?php echo $response[$i]->descripcion; ?></span>
                                         <?php endif;?>
                                </i></s>
                            <?php else: ?>
                                    <?php if ($i == (count($response) - 1) || $i == 0): ?>
                                        <span class="text-muted"> <?php echo $time; ?> </span>&bull; <span><?php echo $response[$i]->descripcion; ?></span>
                                        <?php else: ?>
                                            <?php $minuto = ($response[$i - 1]->minuto == 5) ? "05" : $response[$i - 1]->minuto;?>
                                           <?php $minuto = ($response[$i - 1]->minuto == 0) ? "00" : $minuto;?>
                                            <?php $timeback = $response[($i - 1)]->hora . " : " . $minuto . " " . $response[$i - 1]->meridiano;?>
                                            <span class="text-muted"> <?php echo $timeback; ?> => <?php echo $time ?></span> &bull; <span class=""><?php echo $response[$i]->descripcion; ?></span>
                                         <?php endif;?>
                            <?php endif;?>
                            <a href="" class="float-right  text-dark" id="settings" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-cog"></i></a>
						       <div class="dropdown-menu dropdown-menu-right " aria-labelledby="#settings">
                                  <h6 class="dropdown-header">Opciones</h6>
                                  <input type="hidden" id="<?php echo $i; ?>id-cronograma" value="<?php echo $_GET["id"] ?>">
                                  <input type="hidden" id="<?php echo $i; ?>id-tarea-cronograma" value="<?php echo $response[$i]->id_tarea_cronograma_PK ?>">
                                  <input type="hidden" id="<?php echo $i; ?>hora" value="<?php echo $response[$i]->hora ?>">
                                  <input type="hidden" id="<?php echo $i; ?>minuto" value="<?php echo $response[$i]->minuto ?>">
                                  <input type="hidden" id="<?php echo $i; ?>meridiano" value="<?php echo $response[$i]->meridiano ?>">
                                  <input type="hidden" id="<?php echo $i; ?>descripcion" value="<?php echo $response[$i]->descripcion ?>">
						       	    <a class="dropdown-item small update-task" id="update-task-<?php echo $i; ?>" ide="<?php echo $i; ?>" href="" ><i class="fas fa-edit"></i> Editar </a>
						           	<a class="dropdown-item small" onclick="javascript:return confirm('¿Estas seguro de eliminar esta tarea?')" href="?c=cronograma&m=eliminarTareaCronograma&idtarea=<?php echo $response[$i]->id_tarea_cronograma_PK; ?>&idcronograma=<?php echo $_GET["id"] ?>"><i class="fas fa-redo-alt"></i> Eliminar </a>
                               </div>
                        </div>
                             <?php endfor;?>
                     </div>
                     <div class="col-md-1"></div>
                 </div>
                </div>
            </div>
    </div>
</div>
