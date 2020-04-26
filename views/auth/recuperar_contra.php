
<body>
  <div class="container">
    <div class="row">
      <div class="col-lg-10 col-xl-9 mx-auto">
        <div class="card card-signin flex-row my-5">
          <div class="card-img-left d-none d-md-flex">
             <!-- Background image for card set in CSS! -->
          </div>
          <div class="card-body">
            <h5 class="card-title text-center">Recuperacion de contraseña</h5>
            <?php  require_once "views/template/dashboard/errorHandler.php"?>
            <form method="post" class="form-signin">
                 <input type="hidden" name="c" value="auth">
                 <input type="hidden" name="m" value="send_mail">
              <div class="form-label-group">
                <input type="email" name="correo" id="inputEmail" class="form-control" placeholder="Email address" required>
                <label for="inputEmail">Ingresa tu Email </label>
              </div>


              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Recuperar Contraseña</button>
              <a class="d-block text-center mt-2 small" href="?c=auth">Iniciar Sesion</a>
              <!-- <hr class="my-4"> -->
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>