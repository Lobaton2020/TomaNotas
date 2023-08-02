<?php

if (isset($_REQUEST["c"])) {
    if (isset($_REQUEST["m"])) {
        if ($_REQUEST["c"] == "archivo" && $_REQUEST["m"] == "subir") {
            $a = "";
        }
    }

}
?>
     <div id="<?php echo $e; ?>footer_ver" class="container-fluid nav navbar navbar-default <?php echo $a; ?>fixed-bottom  bg-primary ">
         <div class="container text-light">
         	<p class="parrafo">&#169 <?php echo date('Y'); ?> Andres Lobaton - TomaNota |<span class="small"> Version 3.0</small></p>
        </div>
    </div>
    <script src="libs/jquery/jquery.min.js"></script>
    <script src="libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="libs/fontawesome/js/all.min.js"></script>
    <script src="libs/bootstrap/js/popovers.min.js"></script>
    <script src="libs/bootstrap/js/bootstrap.min.js"></script>
    <?php if ($_REQUEST["c"] == "link") {?>
    <script src="assets/js/Links.js"></script>
  <?php } else if ($_REQUEST["c"] == "nota") {?>
    <script src="assets/js/Notas.js"></script>
  <?php } else if ($_REQUEST["c"] == "archivo") {?>
    <script src="assets/js/Files.js"></script>
  <?php } else if ($_REQUEST["c"] == "tarea") {?>
    <script src="assets/js/Tareas.js"></script>
  <?php } else if ($_REQUEST["c"] == "project") { ?>
            <script src="assets/js/Project.js"></script>
    <?php } else if ($_REQUEST["c"] == "cronograma") {?>
    <script src="assets/js/Cronograma.js"></script>
  <?php } else {?>
                <script src="assets/js/Usuarios.js"></script>
    <?php } ?>
    <script src="assets/js/main.js"></script>
  </body>
</html>