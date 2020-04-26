<?php
// incluye forma de gestion de directorio local
// include_once('cambiar_dir.php');
// POO Gestionar Archivos Con Servidor
 include_once("class/archivo.php");

 $archivo= new Archivo();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Guardar Archivos</title>
    <link class="icon" rel=icon sizes="32x32" type="image/png" href='https://image.flaticon.com/icons/png/512/9/9462.png'>
    <link class="icon" rel=icon sizes="32x32" type="image/png" href='https://image.flaticon.com/icons/png/512/9/9462.png'>
        <link rel="stylesheet"  type="text/css" href="bootstrap/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="estilos.css">
        
</head>
<body>
<div class="container">
  <div class="row">
    <div class="col-md-3 col-sm-1"></div>
    <div class="col-md-6 col-sm-10">
      <div class="cont">
        <?php if(!isset($_GET['ini_sesion'])){ ?>
        <form method="post" enctype="multipart/form-data">
             <div class="form-group">
                 <span class="titulo text-center"><h3>Guarda tus Archivos</h3></span> 
             </div>
             <div class="form-group">
                   <input type="file" id="archivo" name="archivo">  
             <div>
             <small style="color:#666">El archivo no debe superar los 10 MB</small>
             </div>
             </div>
             <div class="text-center">
               <div class="block">
                  <span><input type="submit" name="subir_archivo" id="boton" value="Subir Archivo"></span>
                  <span><a href="mostrar_archivo.php">Ver Archivos</a></span>
                </div> 
              </div>
       </form>   
              <?php
                   if(!empty($archivo->error)){
                echo " <div class='alert alert-danger'>";
                echo $archivo->error;
                echo "</div>";
                    }
               if(!empty($archivo->exito)){
                echo " <div class='alert alert-success'>";
                echo $archivo->exito;
                echo "</div>";
              }
              ?>
            <div class="float-left">
              <a href="https://andreslobaton.webcindario.com">Volver</a>
              </div>
              <div class="float-right">
              <?php if(empty($_SESSION['id_user'])){ ?>
              <a href="?ini_sesion" class="text-center" >Iniciar Sesion</a></div>
            <?php } }else{ ?>
              <form method="post">
             <div class="form-group">
                 <span class=" text-center"><h3>Iniciar Sesion</h3></span> 
               </div>
             <div class="form-group">
                   <input class="form-control" type="text" id="correo" name="correo" placeholder="Ingresa tu correo">  
             </div>
             <div class="form-group">
                   <input class="form-control" type="password" id="clave" name="clave" placeholder="Ingresa tu clave">  
             </div>
             <div class="text-center">
               <div class="block">
                  <span><input type="submit" class="btn btn-primary" name="sesion" id="sesion" value="Iniciar Sesion"></span>
                  <span><a href="panel.php">Subir Archivos</a></span>
                </div> 
              </div>
       </form>   
       <?php
            if(!empty($archivo->error)){
                echo " <div class='alert alert-danger'>";
                echo $archivo->error;
                echo "</div>";
                    }
                
                 } ?>
            </div>
          </div>
         </div>
        <div class="col-md-3 col-sm-1"></div>
     </div>  
    </div>
</body>
</html>