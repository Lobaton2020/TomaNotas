<?php
      require_once "views/template/dashboard/header.php";
      require_once "views/template/dashboard/nav.php";
?>
  <div class="container">
      <?php  require_once "views/template/dashboard/navmain.php"; ?>
      <?php  require_once "views/$content"?>
      
   
  </div>

<?php  require_once "views/template/dashboard/footer.php"; ?>