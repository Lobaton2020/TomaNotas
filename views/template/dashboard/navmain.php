<div class="row">
   <div class="col-sm-12">
<!-- muestra un pequeño menu que perite realizar diferenetes acciones -->
      <?php require_once "views/$content_form";?>
 	  <!-- <form method="post">
         <input type="hidden" name="c" value="auth">
         <input type="hidden" name="m" value="create">
	        	<textarea name="descripcion_nota" id="" cols="50" rows="8" class="form-control" placeholder="Ingresa la descripcion de tu Nota.."></textarea>
             <input type="submit" class="btn btn-primary btn-block boton" value="Guardar Nota">
      <form> -->
   <!-- opcopnes del menu de navegacion -->
   <div class="border my-2">
      <div class="row p-1 ">
         <div class="col-md-5 col-sm-12">
            <a href="assets/archivos/recordatorio.html" class="btn btn-white" title="Ver siguiete pagina" style="text-align: left;"><i class="fas fa-arrow-circle-right"></i></a>|
            <a href="?c=auth&m=on_delete" class="btn btn-default pull-right"   title="Habilitar eliminacion de notas"  value="1"><i class="fas fa-trash-alt"></i></a>|
            <a href="?c=auth&m=on_update" class="btn btn-default pull-right" title="Habilitar Modificacion" ><i class="fas fa-edit"></i></a>|
            <a href="?c=auth&m=on_date" class="btn btn-default pull-right" title="Habilitar Fecha" ><i class="fas fa-calendar"></i></a>|
            <a href="?c=auth&m=off" class="btn btn-default pull-right" title="Inhabilitacion" ><i class="fas fa-ban"></i></a>|
            <!-- <a href="vocabulario.html" class="btn btn-default pull-right" title="Vocabulario"><i class="fas fa-user-edit"></i></a>| -->
            <a href="Subir_Archivos_Server" class="btn btn-default pull-right" title="Gestion de archivos" ><i class="fas fa-file-upload"></i></a>      	
          </div>
          <div class="col-md-1 col-sm-12 text-center"><span id="mensajeCargando" ><img  src="assets/img/ajax-loader.gif" /></span></div>
           <div class="col-md-6 col-sm-12">
              <input id="search" type="search" class="form-control " placeholder="Search for link..">
           </div>
         </div>
    </div> 
</div>
<!-- abre una ventana extra para agregar una contraseña  -->
	<?php if(isset($_SESSION['crud'])){ ?>
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
	<?php } ?>
</div>
   <!-- mensaje de alerta de ajax -->
   <div class="alert alert-warning" id="mensaje-ajax" role="alert">
     No existen Links con ese nombre..
   </div>