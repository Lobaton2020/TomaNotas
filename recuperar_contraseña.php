<?php 
 include('clases/Usuario.php');

 $usuario = new Usuario();

    if ($usuario->conexion->DB_conexion) {
      
    
   $title = 'TomaNota | Recuperar Contraseña';
    $archivo_css = "css/sty_agregar_user.css";

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
<div class="container">
  <div class="row">
  	<div class="col-sm-1 col-md-2  "></div>
  	   <div class="col-sm-10 col-md-8 text-left caja-medio">
  	       <div id="primero">
  	       	<div class=" titulo text-center"><span>Recuperacion contraseña</span></div>  
<!-- 		         <div class="form-group"><img class="img" src="../img/avatar.png"></div>  -->
              <?php if(!empty($usuario->error)){ ?>
             <div class="alert alert-danger alert-dismissible fade show text-left" role="alert">
               <span class="alertas"><?php  echo $usuario->error; ?></span><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
             </div>
            <?php  }elseif(!empty($usuario->mensaje)){ ?>
                  <div class="alert alert-success  alert-dismissible fade show text-left" role="alert">
                      <span class="alertas"> <?php  echo $usuario->mensaje; ?></span><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
                 </div>
           <?php }?>
                 <div>
                 	<!-- //----------------------------------------------- -->
                  	<!-- forMulario -->
            <form method="post" id="form_recuperar_contra" class="form-horizontal"></form>  
	          <div class="form-group">
					<label for="recuperar_contra_user" class=" control-label text-muted">Ingresa tu correo electronico. para confirmar tu identidad. y te enviaremos instrucciones para que puedas ingregar. </label>
				  <div class="">
					<input type="text" id="recuperar_contra_user" name="recuperar_contra_user" form="form_recuperar_contra" class="form-control  " placeholder="Ingresa tu email" autofocus="on">
				  </div>
				</div>
			  
		           <!-- //----------------------------------------------- -->
		               <div class="form-group text-left">
<!-- 		                     <input type="checkbox" name="clave" class="checkbox" id="recordar_contra" >
		                      <label for="recordar_contra">Recordar Contraseña</label>  -->
                          <div class="form-group" id="boton-login">
	                         <button  type="submit" name="recuperar_contra" class="btn  btn-block btn-primary btn-md" form="form_recuperar_contra"><i class="fas fa-sign-in-alt"></i><span>&nbsp;</span> Recuperar Contraseñea</button>
                         </div>
	                     </div>
                     </div>
	                     </form>
                     <div class="form-group recuperar_contra ">
                        <a  href="login.php" class="text-left">Iniciar Sesion</a> <br>
	                    
                     </div>
                 </div>
                 </div> 
           <div class="col-sm-1 col-md-2  "></div>
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