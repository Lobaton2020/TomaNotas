 <?php 
include('clases/Login.php');

$login = new InicioSesion();

    if ($login->conexion) {
      
    
   $title = 'TomaNota | Inicio Sesion';
   $archivo_css = "css/styl_login.css";

  ?>

  <!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 	
     	   <!-- insertar icono -->
	<link rel=icon href='img/logo.png' sizes="32x32" type="image/png">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	      <!-- libreria de logos -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="
	     sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="<?php echo $archivo_css; ?>">
	<title><?php echo $title; ?></title>
</head>
<body>
<div class="container-fluid"> 
  <div class="row">
  	<div class="col-sm-1 col-md-3 col-lg-4 col-xl-4 "></div>
  	   <div class="col-sm-10 col-md-6 col-lg-4  col-xl-4 text-center ">
  	       <div id="primero">
  	       	<div class=" titulo text-center">Iniciar Sesion</div>
  	       	<form method="post" >   
		         <div class="form-group"><img class="img" src="./img/avatar.png"></div> 
              <?php if(!empty($login->error)){ ?>
             <div class="alert alert-danger alert-dismissible fade show text-left" role="alert">
               <span class="alertas"><?php  echo $login->error; ?></span><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
             </div>
            <?php  }elseif(!empty($login->mensaje)){ ?>
                  <div class="alert alert-success  alert-dismissible fade show text-left" role="alert">
                      <span class="alertas"> <?php  echo $login->mensaje; ?></span><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
                 </div>
           <?php }elseif(!empty($login->mensaje_expiracion)){ ?>
                  <div class="alert alert-info alert-dismissible fade show text-left" role="alert">
                      <span class="alertas"> <?php  echo $login->mensaje_expiracion; ?></span><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
                 </div>
           <?php } ?>
                 <div style="transition: 5s;">
		              	<div class="form-group">
		                   <div class="input-group flex-nowrap">
                             <input type="email" name="usuario"  class="form-control login" placeholder="Ingresa con tu correo"  maxlength="40" required autocomplete="on" autofocus="on">
                            <div class="input-group-prepend">
                               <span class="input-group-text" id="addon-wrapping"><i class="fas fa-envelope"></i></span>
                            </div>
                          </div>
		                </div>
		                <div class="form-group">
		                	<div class="input-group flex-nowrap ">
                               <input type="password" name="clave" class="form-control login" placeholder="Contraseña"  maxlength="40"  required autocomplete="on" >
                            <div class="input-group-prepend">
                               <span class="input-group-text" id="addon-wrapping"><i class="fas fa-lock"></i></span>
                            </div>
                          </div>
		               </div>
		               <div class="form-group text-left">
<!-- 		                     <input type="checkbox" name="clave" class="checkbox" id="recordar_contra" >
		                      <label for="recordar_contra">Recordar Contraseña</label>  -->
                          <div class="form-group" id="boton-login">
	                         <button  type="submit" name="enviar" value=" Ingresar"  class="btn  btn-block bton btn-md"><i class="fas fa-sign-in-alt"></i><span>&nbsp;</span>  Ingresar</button>
                         </div>
	                     </div>
                     </div>
	                     </form>
                     <div class="form-group recuperar_contra ">
                      <div class="text-left">
                        <a  href="recuperar_contraseña.php">Olvidaste tu contraseña?</a> <br>
	                    </div>  
                        <a href="agregar_usuario.php"  class="text-center">Registrar mi usuario!</a>
                     </div>
                 </div>
                 </div> 
           <div class="col-sm-1 col-md-3 col-lg-4 col-xl-4  "></div>
     </div>
 </div>
<!-- se agrega jquery y js -->
<script src="bootstrap/jquery/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
<?php 

  }else{
    echo "No se ha podido conectar a la Base de datos!";
  }

 ?>