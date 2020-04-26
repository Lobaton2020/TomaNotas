
<div class="modal fade" id="agregar_nota" tabindex="-1" role="dialog" aria-labelledby="agregar_nota" aria-hidden="true" >
	<div class="modal-dialog modal-md" rolde="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="agregar_nota">Agregar Nueva Nota</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="close" >
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
				<form method="post" id="form_registro_notas"></form>
					<label for="descripcion_nota">Agregar descripcion: </label>
					<textarea name="descripcion_nota" form="form_registro_notas" id="descripcion_nota" rows="4" cols="30" class="form-control" placeholder="Agregar nueva nota..." autofocus="on"></textarea>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				<button type="submit" name="agregar_nota" form="form_registro_notas" id="agregar_nota" class="btn btn-primary">Agregar nota</button>
			</div>
		</div>
	</div>
</div>