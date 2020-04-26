
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Recuperacion Contraseña | Andres Lobaton</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <!-- mas contenido del auto y  de posissionamiento -->
	<link rel="stylesheet" href="libs/fontawesome/css/all.css">
	<link href="libs/bootstrap/css/bootstrap.min.css" rel="stylesheet" >
    <link class="icon" rel=icon sizes="32x32" type="image/png" href='assets/img/logo.png'>
    <link rel="stylesheet" href="assets/css/estilos.css">



</head>
<body>
       <div class="header container-fluid nav navbar navbar-default   bg-primary">
            <header class="d-inline float-right">
               <div class="container text-light">
                 <span class="h2 titulo">TomaNotas</span>
               </div>
            <header>
        </div>

<div class="container">
  <p>Hola <b><?php echo $usuario->nombre ." ". $usuario->apellido; ?>.</b></p>
  <p>Usted solicitó un restablecimiento de contraseña para su cuenta <br> <b><?php echo $usuario->nickname; ?></b> en TomaNotas - Andres Lobaton.</p>
  <p><a href="http://andreslobaton.000webhostapp.com/">http://andreslobaton.000webhostapp.com/</a></p>
  <p>El codigo para la recuperacion de tu cuenta es: <h2><?php echo $new_clave; ?></h2></p>
  
  <p class="text-">- Deber ingresar como contraseña el pin anterior,<br> y como usuario el Nickname de tu cuenta <b><?php echo $usuario->nickname; ?></b>,<br> y luego cambiar inmediatamente tu contraseña.</p>
<small> Andres Lobaton - TomaNota | <?php echo date('Y'); ?></small>
</div>
   
     <div id="<?php echo $e; ?>footer_ver" class="container-fluid nav navbar navbar-default fixed-bottom  bg-primary ">
         <div class="container text-light">
         	<p class="parrafo">&#169; <?php echo date('Y'); ?> Andres Lobaton - TomaNota |<span class="small"> Version 3.0</small></p>   
        </div>
    </div>
    <script src="libs/jquery/jquery.min.js"></script>
    <script src="libs/bootstrap/js/bootstrap.min.js"></script>
    <script src="libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="libs/bootstrap/js/popovers.min.js"></script>
    <script src="libs/fontawesome/js/all.min.js"></script>
  </body>
</html> 