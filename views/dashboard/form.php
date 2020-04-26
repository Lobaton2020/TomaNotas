<div class="edi">
<form method="post">
         <input type="hidden" name="c" value="auth">
         <input type="hidden" name="m" value="<?php echo isset($res->id) ? "update" : "create"; ?>">
         <input type="hidden" name="id" value=<?php echo isset($res->id) ? $res->id : ""; ?> >
         
<textarea name="descripcion_nota" id="" cols="50" rows="8" class="form-control" placeholder="Ingresa la descripcion de tu Nota.."><?php echo isset($res->id) ? $res->descripcion : ""; ?></textarea>
                <input type="submit" class="btn btn-primary btn-block boton"  value="<?php echo isset($res->id) ? "Actualizar Nota" : "Guardar Nota"; ?>">
</form>
</div>