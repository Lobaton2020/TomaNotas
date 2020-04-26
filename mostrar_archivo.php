<?php
       include_once("class/archivo.php");

       $archivo_intancia = new Archivo();

       if(!empty($_SESSION['id_user'])){
        $sql = "SELECT * from archivos where id_usuario_FK is null or id_usuario_FK = 1";
       }else{
        $sql = "SELECT * from archivos where id_usuario_FK is null";
       
       }

      $resultado = mysqli_query($archivo_intancia->conexion,$sql);
       $comprobar = mysqli_num_rows($resultado);

       echo "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link class="icon" rel=icon sizes="32x32" type="image/png" href='https://image.flaticon.com/icons/png/512/9/9462.png'>
    <title>Archivos</title>
    <link class="icon" rel=icon sizes="32x32" type="image/png" href='https://image.flaticon.com/icons/png/512/9/9462.png'>
    <link rel="stylesheet"  type="text/css" href="bootstrap/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body>
 <div class="container">
   <div class="row">
     <div class="col-md-3 col-sm-12"></div>
     <div class="col-md-6 col-sm-12 ">
      <div class="todo">
      <form method="post" id="eliminar"></form>
      <?php if($comprobar <> 0){ ?>
        <div class="float-left "><a href="index.php">Subir nuevo archivo.</a></div>
      <?php } ?>
            <div class="float-right ">
            <?php if(!isset($_SESSION['eliminar'])){ ?>
            <?php if(!isset($_GET['setdelete'])){ ?>
              <?php if($comprobar <> 0){ ?>
            <a href="?setdelete">Eliminar</a>
            <?php if(isset( $_SESSION['id_user'])){ ?>
            <!-- <p style ="color:black" class="d-inline"><?php echo $_SESSION['nombre']; ?></p> -->
            <a href="?eli_sesion" class="btn btn-danger btn-sm">Drop Sesion</a>
            <?php } ?>
            <?php }} if(isset($_GET['setdelete'])){ ?>
                  <input type="password" form="eliminar" name="eliminar" class="form-control-sm" placeholder="Introduce el PIN" autofocus>
                  <button type="submit" form="eliminar" name="envio_eliminar"class="btn btn-success btn-sm">Verificar</button>
                  <input type="hidden" name="and">
             <?php } }else{ echo "<a href='?destroy_session'>Cerrar Sesion</a>"; } ?>
           </div>
           <table  class="table table-hover">
            <thead>
                <?php
                    if($comprobar <> 0){
                   if(!empty($_GET['id_b'])){
                    // borrar archivo del directorio
                    $sql_dir = "SELECT nombre_archivo from Archivos where id_archivo = '" . $_GET['id_b'] . "' ";
                    $resultado2 = mysqli_query($archivo_intancia->conexion,$sql_dir); 
                    

                   if($fila2 = mysqli_fetch_row($resultado2)){
                       if(unlink('archivos/' . $fila2[0])){
                         echo "<tr><td colspan='3'>";
                         echo "<div class='alert alert-success'>";
                         echo "El Archivo <span style='color:black'>" . $fila2[0] . "</span>
                            </span>. Ha sido <span style='color:'>Eliminado! <a href='mostrar_archivo.php'>Recargar</a><span>";
                         echo "</div></td>  </tr>";
                       }else{
                           echo "No se pudo borrar el archivo";
                    }
               }
              }     

               ?>
           <tr>
             <td>#</td>
             <td>Archivo</td>
             <?php if(isset($_SESSION['eliminar'])){ ?>
             <td>Accion</td>
             <?php } ?>
         
             <?php

                  }else{
                    echo "<div class='alert alert-danger text-left'>";
                    echo "No existen archivos registrados. <a href='index.php'>Nuevo archivo.</a>";
                    echo "</div>";
                  }
                  $i = 0;
                  
                      while($filas = mysqli_fetch_array($resultado)){    
              ?> 
            </tr>   
          </thead>
          <tbody class=" table table-hover">
             <tr>
            <td><?php  echo ++$i; ?></td>
            <td><a href="?id=<?php echo $filas[0]; ?>#iframe"><?php echo $filas[2]; ?></a></td>
            <?php if(isset($_SESSION['eliminar'])){ ?>
            <td><a href="?id_b=<?php echo $filas[0]; ?>">Eliminar</a></td>
            <?php } ?>
          </tr>
            <?php
            }
            
          ?>
          </tbody>
       </table>

          <?php

           if(!empty($_GET['id_b'])){
        
      
         $sql = "DELETE from Archivos where id_archivo = " . $_GET['id_b'];
          mysqli_query($archivo_intancia->conexion,$sql);
       	}
        if(!empty($_GET['id'])){
          $sql = "select nombre_archivo from Archivos where id_archivo = '" . $_GET['id'] . "'";
          $resultado = mysqli_query($archivo_intancia->conexion,$sql);
          $fila = mysqli_fetch_row($resultado);
        }
        
       ?>

     </div>
    </div>
   <div class="col-md-3 col-sm-12"></div>
 </div>
    <?php if(!empty($_GET['id'])){ ?>
      <div class="row" >
          <div class="col-md-1 col-sm-12 padd" id="iframe">
            <span><a href="mostrar_archivo.php" >Recargar</a></span>
            <span><a href="archivos/<?php echo $fila[0]; ?>" download="archivos/<?php echo $fila[0]; ?>" >Download</a></span>
          </div>
          <div class="col-md-10 col-sm-12 padd">
          <div class="altura">
              <div class="embed-responsive embed-responsive-21by9 altura">
                <iframe class="embed-responsive-item"   src="archivos/<?php echo $fila[0]; ?>"  allowfullscreen></iframe>
              </div>
          </div>
          </div>
         <div class="col-md-0 col-sm-12"></div>
     </div>
     
    <?php }  ?>
    
</div>
</body>
</html>