<div class="edi">
<form method="post">
         <input type="hidden" name="c" value="link">
         <input type="hidden" name="m" value="<?php echo isset($res->id_link_PK) ? "update" : "create"; ?>">
         <input type="hidden" name="id" value=<?php echo isset($res->id_link_PK) ? $res->id_link_PK : ""; ?> >
<input type="text" name="titulo" class="form-control mb-1" placeholder="Ingresa un titulo del link  (es opcional)" value="<?php echo isset($res->id_link_PK) ? $res->titulo : ''; ?>">
<textarea name="url" id="" cols="50" rows="8" class="form-control" placeholder="Ingresa la URL del Link.."><?php echo isset($res->id_link_PK) ? $res->url_link : ""; ?></textarea>
                <input type="submit" class="btn btn-primary btn-block boton"  value="<?php echo isset($res->id_link_PK) ? "Actualizar Link" : "Guardar Link"; ?>">
</form>
</div>
