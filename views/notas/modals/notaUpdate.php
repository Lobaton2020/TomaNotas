<div class="modal fade" id="staticBackdrop" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"><span id="titulo_nota"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body tall_min">
        <form method="post" id="actualizar_nota">
          <input type="hidden" name="c" value="nota">
          <input type="hidden" name="m" value="update">
          <input type="hidden" name="id" id="id_nota">
          <input type="hidden" name="color" id="color">
          <span id="form_titulo"></span>
          <span id="descripcion"></span>
          <span id="form_color"></span>
        </form>
        <input type="hidden" id="titulo_n">
        <input type="hidden" id="descripcion_n">
        <input type="hidden" id="fecha_n">
        <input type="hidden" id="color_n">

        <small class="text-muted my-2 date_down"><span id="fecha" class="text-bottom"></span></small>
      </div>
      <div class="modal-footer">
        <button style="display:block" data-dismiss="modal" aria-label="Close" type="button" class=" btn btn-secondary" id="cancelar">Cancelar</button>
        <button style="display:none" type="submit" form="actualizar_nota" class=" btn btn-primary" id="actualizar">Guardar Cambios</button>
        <button type="button" id="editar_nota" class="btn btn-primary">Editar</button>
        <button type="button" onclick="if(confirm('¿Seguro quieres eliminar esta Nota?')){ eliminarNota() }" id="eliminar_nota" class="btn btn-danger">Borrar</button>
      </div>
    </div>
  </div>