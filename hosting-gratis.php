
<?php
class ConexionDB{

public $DB_servidor;
public $DB_usuario;
public $DB_contraseña;
public $DB_nombre;
public $conexion;
  
  function __construct(){
    error_reporting(0);
    $this->DB_servidor = "";
    $this->DB_usuario = "";
    $this->DB_contraseña = "";
    $this->DB_nombre = "";


    $this->DB_conexion = mysqli_connect($this->DB_servidor, $this->DB_usuario, $this->DB_contraseña, $this->DB_nombre);
    
    return $this->DB_conexion;
    }
    }

class InicioSesion{
       public $conexion = "";
       public $mensaje = "";
       public $error = "";
       public $mensaje_expiracion = "";


  function __construct (){

       session_start();
       
       $this->conexion = new ConexionDB();   

      if (isset($_POST['enviar'])) { 
           $this->validarlogin();
          }
       
       if (isset($_GET['salir'])) { 
           $this->CerrarSesion();
         }elseif (@$_SESSION['usuario']) {
           $this->SesionExpirada();
        }
}
  function validarlogin(){

        

        $usuario = mysqli_real_escape_string($this->conexion->DB_conexion,$_POST['usuario']);
        $clave = mysqli_real_escape_string($this->conexion->DB_conexion,$_POST['clave']);
    

        $consulta = "SELECT * FROM Usuario WHERE Usuario_Usuario = '$usuario' AND Clave_Usuario = '$clave'";
        $resultado = mysqli_query($this->conexion->DB_conexion,$consulta);
        $filas = mysqli_num_rows($resultado);
        
              
          if ($filas === 1){

                  // $_SESSION['usuario'] = $usuario;
           
                   echo "<script> alert('Sitio Conectado con miarroba.com!');</script>";
              die();

           }else{
               
               $this->error= "<b>Error!</b> Usuario y contraseña no coinciden.";
         
           }
           }



    function CerrarSesion(){
         session_destroy();
         $this->mensaje = "<b>Aviso!</b> Has sido desconectado.";

    }            

  function SesionExpirada(){
         session_destroy();
         $this->mensaje_expiracion = "<b>Aviso!</b> Tu sesion ha finalizado.";
  }
       }

$login = new InicioSesion();

    if ($login->conexion->DB_conexion) {
      
    
   $title = 'Inicio Sesion';
   $archivo_css = "css_nativo/st_login.css";




 ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 	
     	   <!-- insertar icono -->
	<link rel=icon href='img/logo.png' sizes="32x32" type="image/png">
    <link rel="stylesheet" type="text/css" href="bootstrap_4.3.1/css/bootstrap.min.css">
	      <!-- libreria de logos -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="
	     sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="<?php echo $archivo_css; ?>">
	<title><?php echo $title; ?></title>
  <style>
    
 body{
  background-color:#eee ;
  background-image:url('https://cdn.pixabay.com/photo/2019/06/20/19/03/japan-4287832_960_720.jpg'); 
  background-repeat: no-repeat;
  background-position: center ;
  background-attachment:fixed;
  background-size:100% 100% ;
}


@media (max-width: 720px){
body{
    background-image:url('https://cdn.pixabay.com/photo/2014/10/07/13/48/mt-fuji-477832_960_720.jpg');

}
}
.recuperar_contra{
margin:1%;
}
#primero{
   background-color:rgba(250,250,250,0.7);
   
   padding:3% 5.5% 3% 5.5%; 
   margin: 3%;
   margin-top: 11%;
   border-radius: 3%;
    box-shadow: 0px 0px 10px black;
 }
@media (max-width: 720px){
   #primero{
    margin: -2%;
    padding: 5%;
    padding-bottom: 3%;
    padding-top: 4%;
    margin-top: 11%;
   }

}
.img{
  background-color: #bbb;
  width: 130px;
  height:130px;
  border-radius:50%;
}

.btn{
  background-color: #28a745;
  color: #fff;
  border:none;
  border-radius:5px;
  outline:0;
  margin-bottom:1%;
  font-weight: bold;

}
.btn:hover{
  background-color: #009432;
  color: #fff;
}
.btn:active{
    background-color: #20bf6b;
    box-shadow:0px 0px 5px gray;
}
.input{
  display: block;
  padding-left: 4%;
  color: #000;
  border-bottom: 5px solid ;
  border-color: rgba(0,0,250,0.5);
 /*background-color:rgba(250,250,253,0.3);*/
}
.form-control{
  width: -100px;
}
.form-control:invalid{
  width: 100%;
  transition: 1s;
  border-bottom: 4px solid ;

}
.form-control:valid{
  width: 100%;
  transition: 1s;
  border-bottom: 4px solid ;
  border-color: rgba(0,250,0,0.5) !important;
}

 .form-control:empty{
  border-bottom: 4px solid ;
  border-color: rgba(0,0,250,0.5);
}
.input-group-text{
  background-color: #FFF;
  border-top-right-radius: 20px;
}
.checkbox{
  width: 15.5px ;
  height: 15.5px;
  border: 5px solid red;

}
.titulo{
  font-size: 150%; 
  margin-bottom: 1%;
}
.alertas{
  font-size: 15px;
  }
.close{
    margin: -5px -5px auto auto;
}
.close:active,.close:focus{

  outline: transparent;
  border:none;
  margin: -5px -5px auto auto;
}
  </style>
</head>
<body>
<div class="container-fluid"> 
  <div class="row">
  	<div class="col-sm-1 col-md-3 col-lg-4 col-xl-4 "></div>
  	   <div class="col-sm-10 col-md-6 col-lg-4  col-xl-4 text-center ">
  	       <div id="primero">
  	       	<div class=" titulo text-center">Iniciar Sesion</div>
  	       	<form method="post" >   
		         <div class="form-group"><img class="img" src="https://cdn.pixabay.com/photo/2017/11/06/09/53/animal-2923186_960_720.jpg"></div> 
              <?php if(!empty($login->error)){ ?>
             <div class="alert alert-danger alert-dismissible fade show text-left" role="alert">
               <span class="alertas"><?php  echo $login->error; ?></span><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
             </div>
            <?php  }elseif(!empty($login->mensaje)){ ?>
                  <div class="alert alert-success  alert-dismissible fade show text-left" role="alert">
                      <span class="alertas"> <?php  echo $login->mensaje; ?></span><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
                 </div>
           <?php }elseif(!empty($login->mensaje_expiracion)){ ?>
                  <div class="alert alert-info alert-dismissible fade show text-left" role="alert">
                      <span class="alertas"> <?php  echo $login->mensaje_expiracion; ?></span><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
                 </div>
           <?php } ?>
                 <div style="transition: 5s;">
		              	<div class="form-group">
		                   <div class="input-group flex-nowrap">
                             <input type="username" name="usuario"  class="form-control" placeholder="Nombre de usuario"  maxlength="40" required autocomplete="on" autofocus="on">
                            <div class="input-group-prepend">
                               <span class="input-group-text" id="addon-wrapping"><i class="fas fa-envelope"></i></span>
                            </div>
                          </div>
		                </div>
		                <div class="form-group">
		                	<div class="input-group flex-nowrap ">
                               <input type="password" name="clave" class="form-control" placeholder="Contraseña"  maxlength="40"  required autocomplete="on" >
                            <div class="input-group-prepend">
                               <span class="input-group-text" id="addon-wrapping"><i class="fas fa-lock"></i></span>
                            </div>
                          </div>
		               </div>
		               <div class="form-group text-left">
		                     <input type="checkbox" name="clave" class="checkbox" id="recordar_contra" >
		                      <label for="recordar_contra">Recordar Contraseña</label> 
                          <div class="form-group" id="boton-login">
	                         <button  type="submit" name="enviar" value=" Ingresar"  class="btn  btn-block btn-md"><i class="fas fa-sign-in-alt"></i><span>&nbsp;</span>  Ingresar</button>
                         </div>
	                     </div>
                     </div>
	                     </form>
                     <div class="form-group recuperar_contra">
	                  <a  href="#">Olvidaste tu contraseña?</a>
                     </div>
                 </div>
                 </div> 
           <div class="col-sm-1 col-md-3 col-lg-4 col-xl-4  "></div>
     </div>
 </div>
<!-- se agrega jquery y js -->
<script src="bootstrap_4.3.1/jquery/jquery.min.js"></script>
<script src="bootstrap_4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
<?php 


  }else{
    echo "No se ha podido conectar a la Base de datos!";
  }

 ?>