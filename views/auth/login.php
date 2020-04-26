
<div class="container">
    <div class="row">
      <div class="col-lg-10 col-xl-9 mx-auto">
        <div class="card card-signin flex-row my-5">
          <div class="card-img-left d-none d-md-flex">
             <!-- Background image for card set in CSS! -->
          </div>
          <div class="card-body">
            <h5 class="card-title text-center">Iniciar Sesion</h5>
            <?php  require_once "views/template/dashboard/errorHandler.php"?>

            <form method="post" class="form-signin" >
                    <input type="hidden" name="c" value="auth">
                    <input type="hidden" name="m" value="login">
              <div class="form-label-group">
                <input type="text" name="usuario" id="inputUserame" class="form-control" <?php echo isset($_GET["user"]) ? "" : "autofocus" ?> value="<?php echo isset($_GET["user"]) ? $_GET["user"] : "" ?>" placeholder="Username" required >
                <label for="inputUserame">Nombre de usuario</label>
              </div>


              <div class="form-label-group">
                <input type="password" name="clave" id="inputPassword" class="form-control" placeholder="password" <?php echo isset($_GET["user"]) ? "autofocus" : "" ?> required>
                <label for="inputPassword"><?php echo isset($_GET["user"]) && isset($_GET["o"]) ? "Ingresa el PIN" : "Contraseña" ?></label>
              </div>
              

              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Iniciar Sesion</button>
              <a class="d-block text-center mt-2 small" href="?c=auth&m=forgot_pass">¿Olvidaste tu contraseña?</a>
              <hr class="my-4">
              <a class="d-block text-center mt-2 small" href="?c=auth&m=registro">¡Registrarse!</a>

             </form>
          </div>
        </div>
      </div>
    </div>
  </div>
