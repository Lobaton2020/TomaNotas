<?php 
include("logueado.php");
include ("clases/Conexion_DB.php");
include ("clases/Notas.php");


$title = "TomaNota | Dashboard";
$archivo_css = "css/_styles_navbar.css";


?>
 <!DOCTYPE html>
 <html lang="en">
    <?php include('head.php'); ?>
 <body>
    <?php include('navbar.php'); ?> 	
 <div class="container">
 	<?php include('notas.php'); ?>
 </div>
    <?php include('footer.php'); ?>
 </body>
 </html>