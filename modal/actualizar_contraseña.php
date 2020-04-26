<div class="modal fade" id="actualizar_contraseña" tabindex="-1" role="dialog" aria-labelledby="actualizar_contraseña" aria-hidden="true">
	 <div class="modal-dialog modal-dialog-scrollable" role="document">
	 	<div class="modal-content">
	 		<div class="modal-header">
	 			<p class="h5 modal-title" id="actualizar_contraseña">Actualizar Contraseña</p>
	 			<button type="button" class="close" data-dismiss="modal" aria-label="close">
	 				<span aria-hidden="true">&times;</span>
	 			</button>
	 		</div>
            <div class="modal-body">
            	<form method="post" id="form_act_contra"></form>
            	  <div class="form-group">
            	  	<label for="camb_clave_usuario" class="control-label">Nueva contraseña</label>
            	  	<input type="password" class="form-control" name="camb_clave_usuario" form="form_act_contra" placeholder="Ingresa tu nueva contraseña">
            	  </div>
            	  <div class="form-group">
            	  	<label for="rep_camb_clave_usuario">Repite nueva contraseña</label>
            	  	<input type="password" class="form-control" name="rep_camb_clave_usuario" form="form_act_contra" placeholder="Repite tu nueva contraseña">
            	  </div>
            </div>
            <div class="modal-footer">
            	<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            	<button type="submit" class="btn btn-primary" name="actualizar_contra" form="form_act_contra">Actualizar Contraseña</button>
            </div>
	 	</div>
	 </div>
</div>