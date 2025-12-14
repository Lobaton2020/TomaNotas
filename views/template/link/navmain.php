<div class="row">
   <div class="col-sm-12">

   <div class="border p-1 my-2">
      <div class="row">
         <div class="col-md-6 col-sm-12">
         <?php if (isset($_SESSION["id_user"]) || !empty($_SESSION["id_user"])) {?>
            <?php if ($_SESSION["correo_user"] === "andrespipe021028@gmail.com" || $_SESSION["correo_user"] === "aflobaton@misena.edu.co") {?>
            <a href="assets/archivos/recordatorio.html" class="btn btn-white" title="Ver siguiete pagina" style="text-align: left;"><i class="fas fa-arrow-circle-right"></i></a>|
          <?php }}?>
            <span <?php echo !isset($_SESSION["id_user"]) ? "style=\"display:none\"" : ""; ?> >
                <a id="habilitar-opciones" href="?c=auth&m=on_update" class="btn btn-default pull-right" title="Habilitar Modificacion" ><i class="fas fa-wrench"></i></a>|
            </span>
            <a id="hab_fecha" href="?c=auth&m=on_date" class="btn btn-default pull-right" title="Habilitar Fecha" ><i class="fas fa-calendar"></i></a>|
            <a id="inhab" href="?c=auth&m=off" class="btn btn-default pull-right" title="Inhabilitacion" ><i class="fas fa-ban"></i></a>|
            <a id="habilitar-compartir" href="" class="btn btn-default pull-right" title="Links Compartidos" ><i class="fas fa-share"></i></a>|
            <a href="?c=link&m=compartidos" class="btn btn-default pull-right" title="Links Compartidos" ><i class="fas fa-eye"></i></a>
         </div>
          <div class="col-md-1 col-sm-12 text-center"><span id="mensajeCargando" ><img style="display:block" src="assets/img/ajax-loader.gif" /></span></div>
           <div class="col-md-5 col-sm-12">
              <input id="search" type="search" class="form-control " placeholder="Search for link.." value="<?= isset($_GET['search']) ? $_GET['search'] : ''; ?>">
           </div>
         </div>
    </div>
</div>
<!-- abre una ventana extra para agregar una contraseña  -->
	<?php if (isset($_SESSION['crud'])) {?>
      <div class="col-md-3 col-sm-12">
	        <form method="post">
                <input type="hidden" name="c" value="auth">
                <input type="hidden" name="m" value="validacion">
		       <div class="form-group">
			    <input type="password" class="form-control" placeholder="Validar contase&#241;a" name="clave" autofocus />
              </div>
     		<div class="form-group">
	    		<input type="submit" class="btn btn-secondary" value="Verify Password" name="verify_pass"/>
	    	</div>
	      </form>
     </div>
	<?php }?>
</div>
   <!-- mensaje de alerta de ajax -->
   <div style="display:none" class="alert alert-warning" id="mensaje-ajax" role="alert">
     No existen Links con ese nombre..
   </div>
   <?php include "views/links/modals/searchUser.php";?>