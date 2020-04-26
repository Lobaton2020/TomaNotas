<?php  require_once "views/template/dashboard/errorHandler.php"?>
<div class="card mb-3">
    <div class="card-header">
    <i class="fas fa-fw fa-user"></i>
       Editar Perfil</div>
    <div class="card-body">
     <form method="post" enctype="multipart/form-data">
          <div class="row">
       
          <input type="hidden" name="c" value="usuario">
          <input type="hidden" name="m" value="updateUser">
          <input type="hidden" name="id" value="<?php echo $_SESSION["id_user"];?>">

           <div class="col-md-4">
              <div class="mx-md-2">
               <div class="form-group">
                        <label>Nombre completo</label>
                        <input type="text" disabled class="form-control" value="<?php echo $user->nombre ." ".$user->apellido; ?>" placeholder="Ingrese el primer nombre" required>
               </div>
               <div class="form-group">
                        <label>Correo</label>
                        <input type="text" disabled class="form-control" value="<?php echo $user->correo; ?>" placeholder="Ingrese el primer nombre" required>
               </div>
               <div class="form-group">
                        <label>Cumpleaños</label>
                        <input type="text" disabled class="form-control" value="<?php echo getDatenota($user->fecha_nacimiento) ; ?>" placeholder="Ingrese el primer nombre" required>
               </div>
               <div class="form-group">
                        <label>Usuario desde</label>
                        <input type="text" disabled class="form-control" value="<?php echo getDatenota($user->fecha_ingreso); ?>" placeholder="Ingrese el primer nombre" required>
               </div>
               <div class="form-group">
                 <a href="?c=usuario&m=delete&id=<?php echo $_SESSION["id_user"]; ?>" onclick="if(!confirm('¿Seguro quieres eliminar tu cuenta?')){return false}" class="text-danger"><em>Eliminar mi cuenta</em></a>
             </div>
              </div>
           </div>
           <div class="col-md-8">
               <div class="row">
                   <div class="col-md-6">
                      <div class="form-group">
                          <label>Nombre</label>
                          <input type="text" name="nombre" class="form-control" value="<?php echo $user->nombre;?>" placeholder="Ingrese el primer nombre" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                         <label>Apellido</label>
                         <input type="text" name="apellido" class="form-control"  value="<?php echo $user->apellido; ?>" placeholder="Ingrese el primer apellido" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                          <label>Nickname</label>
                          <input type="text" name="nickname" class="form-control" value="<?php echo $user->nickname;?>" placeholder="Ingrese el primer nombre" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                         <label>Correo</label>
                         <input type="text" name="correo" class="form-control"  value="<?php echo $user->correo; ?>" placeholder="Ingrese el primer apellido" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                          <label>Nacimiento</label>
                          <input type="date" name="fecha_nacimiento" class="form-control" value="<?php echo $user->fecha_nacimiento;?>" placeholder="Ingrese el primer nombre" >
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">

                    </div>
                  </div>
                     <div class="col-md-12">
                      <div class="form-group">
                        <a href="#" class="text-info" data-toggle="modal" data-target="#cambiar_contrasena"><em>Cambiar mi contraseña</em></a>
                       
                       </div>
                    </div>
                  </div>
               <div class="text-right">
                    <button type="submit" class="btn btn-success">Actualizar Perfil</button>
                    <button type="button" onclick="window.location.replace('?c=main&m=index');"  class="btn btn-secondary">Cancelar</button>
                 </div>
                 </div>
           </div>  
           </form>
      </div> 
      <div class="card-footer small text-muted">Actualizado Hoy <?php echo date('h:i a');?></div>
  </div>
</div>


<!-- Modal para cambiar la contraseña -->
<div class="modal fade" id="cambiar_contrasena" tabindex="-1" role="dialog" aria-labelledby="cambiar_contrasena" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cambia tu contraseña</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
        <div id="alert_pass"></div>
          <form method="post" id="form_change_pass">
          <input type="hidden" name="id" value="<?php echo $_SESSION["id_user"];?>">
              <div class="form-group">
                <label for="exampleInputEmail1">Contraseña:</label>
                <input type="password" class="form-control mb-3" name="pass1"  aria-describedby="emailHelp" placeholder="Escribe la contraseña">
                <input type="password" class="form-control" name="pass2" placeholder="Repite la contraseña">
              </div>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="window.location.reload()">Cerrar</button>
        <button type="submit" id="envio1" class="btn btn-primary" form="form_change_pass">Cambiar Contraseña</button>
      </div>
    </div>
  </div>
</div>