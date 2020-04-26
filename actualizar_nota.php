<?php 
if (isset($_POST['id'])) {

include("logueado.php");

$title = "TomaNota | Actualizar Nota";
 $archivo_css = "css/_styles_navbar.css";
 ?>
<!DOCTYPE html>
<html lang="en">
  <?php include('head.php'); ?>
<body>
	 <?php include('navbar.php'); ?>

	 <div class="container">	
<div class="row">
	<div class="col-sm-12 col-md-2 "></div>
	  <div class="col-sm-12 col-md-8 d-flex justify-content-center">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="actualizar_nota">Actualiza esta Nota</h5>

			</div>
			<div class="modal-body">
				<div class="form-group">
				<form method="post" id="form_registro_notas" action="panel.php"></form>
					<label for="descripcion_nota_act">Actualizar descripcion: </label>
					<textarea name="descripcion_nota_act" id="descripcion_nota_act" rows="4" form="form_registro_notas" cols="30" class="form-control" ><?php echo $_POST['mensage'];?></textarea>
				</div>
				<input type="hidden" value="<?php echo $_POST['id']; ?>" name="id" form="form_registro_notas" >
			</div>
			<div class="modal-footer">
				<button type="submit"  name="no_actualizada"class="btn btn-info" form="form_registro_notas">Regresar</button>
				<button type="submit" name="actualizar_nota" id="actualizar_nota" form="form_registro_notas"  class="btn btn-secondary">Actualizar nota</button>
			</div>
		</div>
		</div>
      <div class="col-sm-12 col-md-2"></div>
</div>
</div >
    <?php include('footer.php'); ?>
</body>
</html>
<?php }else{
	header('location:panel.php');
} ?>
