<!-- variable para mostrar o no el footer fijo <?php $a ="as"; $e="as"; ?> -->
    <nav class="navbar navbar-expand-lg  navbar-dark bg-primary">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <!-- se muestra la siguiente seccion cuando esta n modo celular pero solo se peromite 3 por el tamaño -->
        <a class="nav-item nav-link active_n logo_peque <?php echo $_REQUEST["c"] == "link" ? "text-light" : "" ;?>" href="?c=link"><i class="fas fa-link"></i> Links <span class="sr-only text-light">(current)</span></a>
        <a class="nav-item nav-link active_n logo_peque <?php echo $_REQUEST["c"] == "archivo" ? "text-light" : "" ;?>" href="?c=archivo"><i class="fas fa-file-upload"></i> Archivos</a>
        <a class="nav-item nav-link active_n logo_peque <?php echo $_REQUEST["c"] == "nota" ? "text-light" : "" ;?>" href="?c=nota"><i class="fas fa-clipboard"></i> Notas</a>

        
        <!-- <span class="h3 text-light logo_peque "  >TomaNotas</span> -->
<!-- se muestra en modo de computador -->
  <div class="collapse navbar-collapse " id="navbarTogglerDemo01">
    <a class="navbar-brand text-light ml-md-5 my-0 " href="<?php echo "?c=auth";?>"><h4><?php echo "TomaNotas"?></h4></a>
    <ul class="navbar-nav text-light logo_peque_min mr-auto mt-2 mt-lg-0">
      <li class="nav-item <?php echo $_REQUEST["c"] == "link" ? "active" : ""; ?>">
        <a class="nav-link" href="?c=link"><i class="fas fa-link"></i> Links <span class="sr-only text-light">(current)</span></a>
      </li>
      <li class="nav-item <?php echo $_REQUEST["c"] == "archivo" ? "active" : "";?> ">
        <a class="nav-link" href="?c=archivo"><i class="fas fa-file-upload"></i> Archivos</a>
      </li>
      <li class="nav-item <?php echo $_REQUEST["c"] == "nota" ? "active" : "";?> ">
        <a class="nav-link" href="?c=nota"><i class="fas fa-clipboard"></i> Notas</a>
      </li>

      <li class="nav-item <?php echo $_REQUEST["c"] == "tarea" ? "active" : "";?> ">
         <a class="nav-link " href="?c=tarea"><i class="fas fa-bookmark"></i> Tareas</a>
      </li>

    </ul>
    <div class=" d-md-inline-block   mr-0 mt-2">
          <span class="text-light ml-2 mr-2">
            <label for="userDropdown">
             <i class="fas fa-user"></i> &nbsp; <?php echo $_SESSION["nickname_user"]; ?>
             </label>
             
 <!-- modo celular activado con el toggle -->
          <a class="nav-item nav-link active_n logo_peque " href="?c=tarea"><i class="fas fa-bookmark"></i> Tareas</a>
             <?php  if($_SESSION["rol_user"] == 1):?>
                <a class="nav-item nav-link active_n logo_peque" href="?c=administrador&m=usuarios"><i class="fas fa-users"></i> Usuarios <span class="badge badge-primary"><?php echo $this->admin->getnumber_user(); ?></span></a>
                <a class="nav-item nav-link active_n logo_peque" href="?c=administrador&m=historial"><i class="fas fa-history"></i> Historial <span class="badge badge-primary"><?php echo $this->admin->getnumber_historial(); ?></span></a>
                <a class="nav-item nav-link active_n logo_peque" href="?c=administrador&m=notificacion"><i class="fas fa-bell"></i> Notificaciones <span class="badge badge-primary"><?php echo $this->admin->getnumber_notificacion(); ?></span></a>
                <a class="nav-item nav-link active_n logo_peque" href="?c=administrador&m=reportesUsuario"><i class="fas fa-bug"></i> Reportes</a>
          <?php endif; ?>
          <a href=""data-toggle="modal" data-target="#enviar_reporte" class="nav-link  nav-item  active_n logo_peque "><i class="fas fa-exclamation-circle"></i> Reportar un problema</a>

          </span>
      </div>
<!-- se muestra en modo de computador como opciones -->

  <ul class="navbar-nav ml-auto ml-md-0 mr-5">
    <li class="nav-item dropdown no-arrow">
 <span class="">
      <li class="nav-item logo_peque">
            <a class="nav-link" href="?c=usuario&m=index"> <i class="fas fa-wrench"></i> Ver mi perfil</a>
          </li>
          <li class="nav-item logo_peque">
            <a class="nav-link" href="#" data-toggle="modal" data-target="#cerrarsesion" ><i class="fas fa-sign-out-alt"> </i> Cerrar Sesion</a>
          </li>
  </span>  
  <span class="logo_peque_min">
      <a class="nav-link dropdown-toggle text-light" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    </a>
      <div class="dropdown-menu dropdown-menu-right mr-5" aria-labelledby="userDropdown">
     <?php if($_SESSION["rol_user"] == 1):?>
      <h6 class="dropdown-header text-danger">Administracion</h6>
      <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="?c=administrador&m=usuarios"><i class="fas fa-users"></i> Usuarios <span class="badge badge-primary"><?php echo $this->admin->getnumber_user(); ?></span></a>
                <a class="dropdown-item" href="?c=administrador&m=historial"><i class="fas fa-history"></i> Historial <span class="badge badge-primary"><?php echo $this->admin->getnumber_historial(); ?></span></a>
                <a class="dropdown-item" href="?c=administrador&m=notificacion"><i class="fas fa-bell"></i> Notificaciones <span class="badge badge-primary"><?php echo $this->admin->getnumber_notificacion(); ?></span></a>
                <a class="dropdown-item" href="?c=administrador&m=reportesUsuario"><i class="fas fa-bug"></i> Reportes</a>
      <div class="dropdown-divider"></div>
      <?php endif; ?>
      
      <h6 class="dropdown-header text-primary">Mi perfil</h6>
      <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="?c=usuario&m=index"> <i class="fas fa-wrench"></i> Ver mi Perfil</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#cerrarsesion"><i class="fas fa-sign-out-alt"> </i> Cerrar Sesion</a>
      </div>
    </li>
    </span>
    <a href=""data-toggle="modal" data-target="#enviar_reporte" class="nav-link logo_peque_min text-light"><i class="fas fa-exclamation-circle"></i></a>
  </ul>

  <!-- Logout Modal de cierre de sesion-->
<div class="modal fade" id="cerrarsesion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Cierre de sesion</h5>
    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">×</span>
    </button>
  </div>
  <div class="modal-body">¿Estas seguro de cerrar tu sesion?</div>
  <div class="modal-footer">
    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
    <a class="btn btn-primary" href="?c=usuario&m=logout">Cerrar la Sesion</a>
  </div>
</div>
</div>
</div>

  </div>
</nav>
<br>



<!-- Modal reportar un problema -->
<div class="modal fade" id="enviar_reporte" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Reportar un problema</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" id="form">
        <input type="hidden"  name="c" value="usuario">
        <input type="hidden"  name="m" value="reporte_problema">
        <div class="form-group">
           <label for="titulo_problema">Escribe el Asunto del problema</label>
           <input class="form-control" type="text" id="titulo_problema" placeholder="Asunto del problema" name="titulo">
        </div>
        <div class="form-group">
           <label for="descripcion_problema">Escribe la descripcion del problema</label>
           <textarea class="form-control" id="descripcion_problema" name="descripcion" rows=5 placeholder="Breve descripcion del problema"></textarea>
        </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" form="form" class="btn btn-primary">Enviar Reporte</button>
      </div>
    </div>
  </div>
</div>