
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Notas | Andres Lobaton</title>
	    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
         
    	<link class="icon" rel=icon sizes="32x32" type="image/png" href='https://image.flaticon.com/icons/png/512/9/9462.png'>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<style type="text/css">
body{
    padding-bottom: 0px; 
    padding-top:0px;
}
.header{
 margin-bottom:20px;
}
.h2{
margin-left:100px;
}
	@media (max-width: 720px){
          .parrafo{
         	font-size: 14px;
         	margin: 0px auto 6px auto;
         }
         .titulo{
         margin-left:0px;
         }
	}

</style>
            <div class=" header container-fluid nav navbar navbar-default   bg-primary">
              <header>
               <div class="container text-light">
              
                 <p class="h2 titulo">TomaNotas</p>

             </div>
              <header>
           </div>

	<div class="container">
	
	 <div class="row>"
		<div class="col-sm-12">
	  <form method="post">
	        	<textarea name="descripcion_nota" id="" cols="50" rows="8" class="form-control" placeholder="Ingresa la descripcion de tu Nota.."></textarea><br>
	        	<input type="submit" class="btn btn-primary btn-block" name="agregar_nota" value="Guardar Nota">
            <a href="recordatorio.html" class="btn btn-white"          title="Ver siguiete pagina" style="text-align: left;"><i class="fas fa-arrow-circle-right"></i></a>|
            <button type="submit" class="btn btn-default pull-right"   title="Habilitar eliminacion de notas" name="habilitar_eliminacion" value="1"><i class="fas fa-trash-alt"></i></button>|
              <button type="submit" class="btn btn-default pull-right" title="Habilitar Lectura Ordenada" name="habilitar_pre"><i class="fas fa-book-open"></i></button>|
              <button type="submit" class="btn btn-default pull-right" title="Habilitar Fecha" name="habilitar_fecha"><i class="fas fa-calendar"></i></button>|
              <button type="submit" class="btn btn-default pull-right" title="Inhabilitacion" name="inhabilitar_eliminacion_pre"><i class="fas fa-ban"></i></button>|
              <a href="vocabulario.html" class="btn btn-default pull-right" title="Vocabulario"><i class="fas fa-user-edit"></i></a>|
              <a href="Subir_Archivos_Server" class="btn btn-default pull-right" title="Gestion de archivos" ><i class="fas fa-file-upload"></i></a>
              
	      	
	 <form>
	<?php if(isset($_POST['habilitar_eliminacion'])){ ?>
         <div class="col-md-3 col-sm-12">
	   <form method="post">
		<div class="form-group"> 
			<input type="password" class="form-control" placeholder="Validar contase&#241;a" name="clave" />

		</div>
		<div class="form-group">
			<input type="submit" class="btn btn-secondary" value="Verify Password" name="verify_pass"/>
		</div>
	   </form>
        </div>
	<?php } ?>
</div><br>
<?php 
session_start();
       $conexion = mysqli_connect('localhost','root','','andreslobaton');
         $query = "SELECT * FROM notas ORDER BY id ASC";
            $consulta = mysqli_query($conexion,$query);
            $numfilas = mysqli_num_rows($consulta);
            if ($numfilas) {
     
      ?> 
 <div class="table-responsive col-sm-12">
    <table class="table ">
       <tr class="table-info">
          <th><div style="width: 65px;"># Notas</div></th>
          <?php  if(isset($_SESSION['pre'])){ ?>
          <th><div style="max-width: 400px;">Descripcion</div></th>
          <?php }else{ ?>
          <th><div style="max-width: 400px;">Descripcion Ordenado</div></th>
          <?php } ?>
          <?php   if(isset($_SESSION['fecha'])){ ?>
          <th><div style="width: 160px;">Fecha</div></th> 
          <?php } ?>
          <th><div style="width: 100px;">Links</div></th>
          <?php   if(isset($_SESSION['id'])){ ?>
          <th>Accion</th>
          <?php } ?>


       <?php 
       $i = 1;
        while($fila = mysqli_fetch_array($consulta)){
        

        ?>
       <tr>
             <td class="td1"><?php echo $i++; ?></td>
             <?php   if(isset($_SESSION['pre'])){ ?>
             <td class="td2"><pre><?php echo $fila['descripcion']; ?></pre></td>
              <?php }else{ ?>
             <td class="td2"><?php echo $fila['descripcion']; ?></td>
              <?php } ?> 
             <?php  if(isset($_SESSION['fecha'])){ ?>
             <td class="td2"><?php echo $fila['fecha']; ?></td>
             <?php } ?>
             <?php
             $linkcon = mysqli_query($conexion,"SELECT descripcion FROM notas WHERE descripcion = '" . $fila['descripcion'] . "' AND descripcion LIKE 'http%'");
             $files = mysqli_num_rows($linkcon);
             if($files){
             ?>
             <td><a target="_blank" href="<?php echo $fila['descripcion']; ?>">Ir al Sitio</a></td>
             <?php } else{ echo "<td> </td>"; } ?>
          <td>
           <?php  if(isset($_SESSION['id'])){ ?>
              <form method="post"  >
                <button type="submit" title="Eliminar Notas" class="boton-acciones" name="eliminar_nota">
                  <input type="hidden"  value="<?php echo $fila[0]; ?>" name="id">
                  Eliminar
                </button>
              </form>
            <?php } ?>
          </td>
       </tr>  
  <?php 
}
}
   ?>
</table>
  </div>
    </div>
      </div>
   <?php
if(isset($_POST['agregar_nota'])){
  if(!empty($_POST['descripcion_nota'])){

    	$descripcion = $_POST['descripcion_nota'];
    	    date_default_timezone_set('America/Bogota');
        $fecha = date('d-m-Y   h:i a');
                  

        $query = "INSERT INTO notas VALUES('','$descripcion','$fecha');";
        $resultado = mysqli_query($conexion,$query);
        
        header('Location:index.php');
        
    }
  }
if(isset($_POST['eliminar_nota'])){
          $id = $_POST['id'];
            $query = " DELETE FROM notas WHERE id = '$id'"; 
            $resultado = mysqli_query($conexion,$query);
            
            header('Location:redireccion.php');
        }
 if(isset($_POST['verify_pass'])){
    if($_POST['clave'] === "20022002"){	
          
         $_SESSION['id'] = "Eliminar";
            
            header('Location:index.php');
       }
        }
//----------------------------------------------
//destruir sesiones
 if(isset($_POST['inhabilitar_eliminacion_pre'])){
           
            session_destroy();
            header('Location:index.php');
        }

//----------------------------------------------

 if(isset($_POST['habilitar_pre'])){
          
          $_SESSION['pre'] = "Habilitado";
            
            header('Location:index.php');

        }
//----------------------------------------------
//hablilitar fecha
 if(isset($_POST['habilitar_fecha'])){
         
          $_SESSION['fecha'] = "links";
            
            header('Location:index.php');

        }
 ?>

<div class="container-fluid nav navbar navbar-default dfixed-bottom  bg-primary  fijar_div">
      <div class="container text-light">
    	<p class="parrafo">&#169 <?php echo date('Y'); ?> Andres Lobaton - TomaNota |<span class="small"> Version 2.0</small></p>   
     </div>
</div>
</body>
</html>

