<?php  
         $archivo_css = "css/s_notas.css";
     
       $conexion = new ConexionDB();
       $conexion = $conexion->connect();
       $notas = new Notas();
 ?>
<!DOCTYPE html>
<html>
<head>
<?php include('head.php');?>
</head>
<body>
        <?php include('modal/agregar_nota.php'); ?>
        <?php include('modal/actualizar_contraseña.php'); ?>
<form method="post" id="buscar"></form>
<div class="container">
    <div id="panel" class="panel panel-info" >
      <div class="panel-heading">
        <button type="button"  class="btn btn-info btn-md pull-right" data-toggle="modal" data-target="#agregar_nota"> 
              <i class="fas fa-plus"></i>&nbsp;Agregar Notas  
            </button>
        <button type="button" class="boton pull-right" data-toggle="modal" data-target="#actualizar_contraseña">Cambiar contraseña</button>
             <span class="search"><i class="fas fa-search search"></i>&nbsp;Busca, consulta, registra y elimina tus notas.</span>
      </div>
      <div class="panel-body">
           <div class="form-group row ">
            <div class=" col-sm-12 col-md-12 col-lg-12 col-xl-12 d-flex justify-content-center">
              <!-- alertas de envio de datos -->
              <?php if(isset($notas->mensaje)){ ?>
              <div class="alert alert-success col-sm-12 col-md-12 col-lg-12 col-xl-12 alert-dismissible fade show text-left" role="alert">
                <span><?php  echo $notas->mensaje;  ?>   
                   </span>  
                    <button type="button" class="close" data-dismiss="alert"  aria-label="close">
                      <span aria-hidden="true">&times;</span>
                    </button>
              </div>
            <?php }elseif(isset($notas->error)){ ?>
              <div class="alert alert-danger col-sm-12 col-md-12 col-lg-12 col-xl-12 alert-dismissible fade show text-left" role="alert">
                <span><?php echo $notas->error; ?></span>
                    <button type="button" class="close" data-dismiss="alert"  aria-label="close">
                      <span aria-hidden="true">&times;</span>
                    </button>
              </div>
            <?php } ?>
              <!-- finalizacion -->
            </div>
             <div class="col-sm-12 col-md-1 col-lg-1 col-xl-1"></div>
             <div class="col-sm-12 col-md-1 col-lg-1 col-xl-1" >
               <label class="control-label btn" for="producto">Notas: </label>
             </div>
             <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 " style="margin:auto auto 8px auto;">
                <input type="text" name="producto" id="producto" form="buscar" formmethod="post" class="form-control " placeholder="Buscar por Descripción ó Fecha ..."> 
             </div>
             <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 botones ">
                <button type="submit" class="btn btn-outline-primary btn-md" form="buscar" formmethod="post" name="busqueda_nota"><i class="fas fa-search"></i>&nbsp;Buscar</button>
                <button type="submit" class="btn btn-outline-secondary btn-md" name="recargar" form="buscar"><i class="fas fa-broom"></i>&nbsp;Limpiar</button>
                <button type="submit" name="ordenado" class="btn btn-outline-warning" form="buscar"><i class="fas fa-sort-down"></i> &nbsp;Ordenado</button>
            </div> 
    
          </div>

         <?php 


     if (isset($_REQUEST['busqueda_nota'])) {
             $busqueda = mysqli_real_escape_string($conexion,$_REQUEST['producto']);
             $query = "SELECT Id_Notas,Descripcion_Notas,Fecha_Notas FROM Notas WHERE Id_Usuario_FK = '" . $_SESSION['id'] . "' AND (Descripcion_Notas LIKE '%$busqueda%' OR Fecha_Notas LIKE '%$busqueda%')";
     
           }else{
                  $query = "SELECT Id_Notas,Descripcion_Notas,Fecha_Notas FROM Notas WHERE Id_Usuario_FK = '" . $_SESSION['id'] . "' ORDER BY Fecha_Notas ASC";
           }
            $consulta = mysqli_query($conexion,$query);
            $numfilas = mysqli_num_rows($consulta);
            if ($numfilas) {
     
     
      ?> 
 <div class="table-responsive">
    <table class="table ">
       <tr class="table-info">
          <th># Notas</th>
          <th>Descripcion</th>
          <th>Fecha</th>
          <th>Acciones</th>

       <?php 
        $i = 1;
        while($fila = mysqli_fetch_array($consulta)){
        ?>
       <tr>
             <td class="td1"><?php echo $i++; ?></td>
                   <?php if(isset($_REQUEST['ordenado'])){ ?>
                            <td class="td2"><pre><?php echo $fila[1]; ?></pre></td>
                   <?php }else{ ?>
                          <td class="td2"><?php echo $fila[1]; ?></td>
                   <?php } ?>
             <td class="td3"><?php echo $fila[2]; ?></td>

          <td class="td_acciones td4" class="pull-right"><div id="acciones">
            <div id="acciones">
              <form method="post" action="actualizar_nota.php">
              <button type="submit" title="Actualizar Notas" class="boton-acciones form">
                 <i class="fas fa-edit"></i>
                 <input type="hidden"  value="<?php echo $fila[0]; ?>" name="id" >
                 <input type="hidden"  value="<?php echo $fila[1]; ?>" name="mensage" >
              </button>
              </form>
              <form method="post" class="form" >
                <button type="submit" title="Eliminar Notas" class="boton-acciones" name="eliminar_nota">
                  <input type="hidden"  value="<?php echo $fila[0]; ?>" name="id">
                  <i class="fas fa-trash"></i>
                </button>
              </form>
            </div>
          </td>
       </tr>  
  <?php 
}
    }   
   
    mysqli_close($conexion);
   ?>
    </table>
      </div>
    </div>
</div>
</div>

