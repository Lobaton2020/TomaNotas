<?php 
include('Conexion_DB.php');

class InicioSesion{
       public $conexion = "";
       public $mensaje = "";
       public $error = "";
       public $mensaje_expiracion = "";
       public $estado = null;


  function __construct (){

       session_start();
       
       $con = new ConexionDB();   
       $this->conexion = $con->connect();
       
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

        $usuario = mysqli_real_escape_string($this->conexion,$_POST['usuario']);
        $clave = mysqli_real_escape_string($this->conexion,$_POST['clave']);
    

        $consulta = "SELECT * FROM Usuario WHERE Correo_Usuario = '$usuario'";
        $resultado = mysqli_query($this->conexion,$consulta);
        $numfilasuser = mysqli_num_rows($resultado);
         $filas = mysqli_fetch_array($resultado);
         $contraseña_hash = $filas['Clave_Usuario'];

     if ($numfilasuser == 1){
               
         if (password_verify($clave,$contraseña_hash)) {

                    $_SESSION['id'] = $filas['Id_Usuario'];
                    $_SESSION['usuario'] = $filas['Correo_Usuario'];
                    
              header('Location: panel.php');
              die();

            
           }else{
            $this->error= "<b>Error!</b> Usuario y/o contrase&ntilde;a no coinciden.";
           }

         }else{
             $this->error= "<b>Error!</b> Usuario y/o contrase&ntilde;a no coinciden.";
         
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

 ?>