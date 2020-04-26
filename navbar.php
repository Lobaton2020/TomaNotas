<?php

if(isset($title)){

   //$archivo_css = "css/st_navbar.css";

 ?>
 <header>
  <nav class="fixed-top bg-primary text-light ">
  <div class="menu_var">
      <div class="pull-left email">
          <i class="fas fa-user-alt"></i> <?php echo $_SESSION['usuario']; ?>
      </div>
      <div class="pull-right ">
               <div class=" justify-content-end" >
             <a class="opciones"  href="login.php?salir">
               <span class="opciones"><i class="fas fa-power-off"></i>&nbsp;Salir</span>
             </a>
          </div>
     </div>
           <!--  <button type="submit" class="btn  pull-right boton"><i class="fas fa-bars icon"></button></i><span class="menu_text" >Menu</span> -->
  </div>
</nav>

 <nav id="navbar" class=" navbar fixed-top navbar-expand-md bg-primary text-light">
   <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <div class="navbar-nav mr-auto  ">
      	<div class="nav-item "  >
            <a href="panel.php" class=" nav-link links">
              <span class="opciones" style="font-size: 20px">
                <i class="fas fa-address-book " style="font-size: 20px"></i> 
                TomaNota
        
            </span>
            </a>
        </div>
      </div>

    <div class=" navbar-nav navbar-right">
       <div  class="nav-item justify-content-center">
          <span id="sesion"  class="nav-link ">
            <i class="fas fa-user-alt"></i>
           <?php echo $_SESSION['usuario']; ?>
         </span>
       </div>
      <div class="nav-item justify-content-end" >
        <a class="nav-link links"  href="login.php?salir">
          <span class="opciones"><i class="fas fa-power-off"></i>&nbsp;Salir</span>
        </a>
      </div>

    </div>
 </nav>
 </header>
 <?php
 } 
  ?>