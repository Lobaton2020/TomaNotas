
<body>
  <div class="container">
    <div class="row">
      <div class="col-lg-10 col-xl-9 mx-auto">
        <div class="card card-signin flex-row my-5">
          <div class="card-img-left d-none d-md-flex">
          <!-- <img style="width:100%" src="https://i.blogs.es/2b7c9a/moon-colors/450_1000.jpg" alt=""> -->
          </div>
          <div class="card-body">
            <h5 class="card-title text-center">Registro de usuario</h5>
            <?php  require_once "views/template/dashboard/errorHandler.php"?>
            <div class="text-peque" id="msg_alert"></div>
            <input type="hidden" id="getURL" value="<?php echo isset($_GET["cod"]) ? $_GET["cod"] == "A001" ? $_GET["cod"]  : "": ""; ?>">
            <form method="post" class="form-signin" style="display:block" id="registro_user">
            <div class="form-label-group">
                <input type="text" name="nombre" id="nombre"  class="form-control" placeholder="Name" required autofocus>
                <label for="nombre">Nombre</label>
              </div>

              <div class="form-label-group">
                <input type="text" name="apellido" id="apellido"  class="form-control" placeholder="LastName" required>
                <label for="apellido">Apellido </label>
              </div>

             <div class="form-label-group">
                <input type="text" name="nickname" id="nickname"  class="form-control" placeholder="Username" required autofocus>
                <label for="nickname">Nombre de usuario (Nickname)</label>
              </div>

              <div class="form-label-group">
                <input type="email" name="correo" id="correo"  class="form-control" placeholder="Email address" required>
                <label for="correo">Email </label>
              </div>
              <div class="form-label-group">
                <input type="date" name="fecha_nacimiento"  id="fecha_nacimiento" class="form-control" placeholder="Cumpleaños" required>
                <label for="fecha_nacimiento">Fecha de naciminento </label>
              </div>
              
              <hr>

              <div class="form-label-group">
                <input type="password" name="clave" id="clave" class="form-control" placeholder="Password" required>
                <label for="clave">Contraseña</label>
              </div>
              
              <div class="form-label-group">
                <input type="password" id="clave_confirmar"  class="form-control" placeholder="Password" required>
                <label for="clave_confirmar">Confirma la contraseña</label>
              </div>

              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Registrarme</button>
              <a class="d-block text-center mt-2 small" href="?c=auth">Iniciar Sesion</a>
              <!-- <hr class="my-4"> -->
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>