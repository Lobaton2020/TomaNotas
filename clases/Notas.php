<?php 

 class Notas{
   public $conexion = "";
   public $mensage;
   public $error;

    function __construct(){
     
             $this->conexion = new ConexionDB();
             $this->conexion = $this->conexion->connect();

     if(isset($_REQUEST['agregar_nota'])){
         $this->agregarnota();
     }
     if(isset($_REQUEST['actualizar_nota'])){
         $this->actualizarnota();
     }
     if (isset($_REQUEST['eliminar_nota'])) {
     	$this->eliminarnota();
     }
    if (isset($_POST['actualizar_contra'])) {
         $this->actualizarcontraseña();
     }
     if (isset($_POST['recargar'])) {
        header('location:panel.php');
     }


  }
 //----------------------------------------------------------------------------------------------------------
 //agregare el metodo actualizar nota aqui. por que no me permite hacerlo desde login ni usuario por el alcande de la conexionque no debe estar duplicado
  //solo estara una unica vez

  function actualizarcontraseña(){
        
       if (!empty($_POST['camb_clave_usuario']) && !empty($_POST['rep_camb_clave_usuario'])) {
            if ($_POST['camb_clave_usuario'] === $_POST['rep_camb_clave_usuario']) {

                 $clave = mysqli_real_escape_string($this->conexion,$_POST['rep_camb_clave_usuario']);
                 $clave_nueva = password_hash($clave,PASSWORD_DEFAULT);

                 $query = "UPDATE Usuario SET Clave_Usuario = '" . $clave_nueva . "' WHERE Id_Usuario = '" . $_SESSION['id'] . "'";
                 $resultado = mysqli_query($this->conexion,$query);

                 if ($resultado) {
                   $this->mensaje = "<b>Aviso!</b> Contraseña actualizada correctamente.";
                 }else{
                  $this->error = "<b>Error!</b> No se pudo actualizar la contraseña.";
               } 
            }else{
             $this->error = "<b>Error!</b> Las contraseñas no coinciden.";
         }
       }else{
           $this->error = "<b>Error!</b> Le faltaron campos por llenar.";
       }


  
   }
//----------------------------------------------------------------------------------------------------------
  
    function agregarnota(){
    	$id_usuario_fk = $_SESSION['id'];
    	$descripcion = mysqli_real_escape_string($this->conexion,$_POST['descripcion_nota']);
    	    date_default_timezone_set('America/Bogota');
        $fecha = date('d-m-Y   h:i a');
                  
             $consulta = mysqli_query($this->conexion,"SELECT * FROM Notas WHERE Descripcion_Notas = '" . $descripcion . "'");
             $numrows = mysqli_num_rows($consulta);

         if ($descripcion === "") {

         	$this->error = "<b>Error!</b> Ingresa contenido en la nota.";

         }elseif ($numrows > 0) {
         			$this->error = "<b>Error!</b> La nota ya esta agregada.";
         }else{

        $query = "INSERT INTO Notas VALUES(null,'$id_usuario_fk','$descripcion','$fecha') ";
        $resultado = mysqli_query($this->conexion,$query);

       if ($resultado) {
         $this->mensaje = "<b>Aviso!</b> Nota Agregada correctamente.";
       }else{
       	$this->error = "<b>Error!</b> La nota no se pudo agregar.";
       }
     
      }
    }
      function actualizarnota(){

           $descripcion = mysqli_real_escape_string($this->conexion,$_POST['descripcion_nota_act']);  
           $consulta = mysqli_query($this->conexion,"SELECT * FROM Notas WHERE Descripcion_Notas = '" . $descripcion . "'");
           $numrows = mysqli_num_rows($consulta); 
           if($numrows > 0){
                    $this->error = "<b>Error!</b> No actualizaste la nota.";
                  }else{
            $query = "UPDATE Notas SET Descripcion_Notas = '" . $descripcion . "' WHERE Id_Usuario_FK = '" . $_SESSION['id'] . "' AND Id_Notas = '" . $_REQUEST['id'] . "'";
            $resultado = mysqli_query($this->conexion,$query);

          if ($resultado) {
            $this->mensaje = "<b>Aviso!</b> Nota actualizada correctamente.";
          }else{
          	$this->error = "<b>Error!</b> La nota no se pudo actualizar.";
          }
      }
    }
      function eliminarnota(){

          	$query = " DELETE FROM Notas WHERE Id_Usuario_FK = '" . $_SESSION['id'] . "' AND Id_Notas = '" . $_REQUEST['id'] . "'";
              
            $resultado = mysqli_query($this->conexion,$query);
           if ($resultado) {
             $this->mensaje = "<b>Aviso!</b> Nota eliminada correctamente.";
           }else{
           	$this->error = "<b>Error!</b> La nota no se pudo agregar.";
           }

      }




 }

 ?>