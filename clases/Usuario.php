<?php 

include('Conexion_DB.php');

class Usuario{
       public $conexion = "";
       public $mensaje;
       public $error;

  function __construct (){
       
       $this->conexion = new ConexionDB();   
       $this->conexion = $this->conexion->connect();

      if (isset($_POST['agregar_usuario'])) {
         $this->agregarusuario();
       }
       if (isset($_POST['recuperar_contra'])) {
         $this->recuperarcontraseña();
      }
       
}


function agregarusuario(){

if (!empty($_POST['nombre_usuario'])  &&
    !empty($_POST['apellido_usuario']) &&
    !empty($_POST['correo_usuario']) &&
    !empty($_POST['clave_usuario'])) {
  if ($_POST['rep_clave_usuario'] === $_POST['clave_usuario']) {

       $nombre = mysqli_real_escape_string($this->conexion,$_POST['nombre_usuario']);
       $apellido = mysqli_real_escape_string($this->conexion,$_POST['apellido_usuario']);
       $correo = mysqli_real_escape_string($this->conexion,$_POST['correo_usuario']);
       $clave = mysqli_real_escape_string($this->conexion,$_POST['clave_usuario']);
       $clave_segura = password_hash($clave,PASSWORD_DEFAULT);
       date_default_timezone_set('America/Bogota');
       $fecha = date('d-m-Y   h:i a');

         	     $consulta = @mysqli_query($this->conexion,"SELECT * FROM Usuario WHERE Correo_Usuario = '" . $correo . "'"); 
         	     $numrows = @mysqli_num_rows($consulta);
    if (filter_var($correo,FILTER_VALIDATE_EMAIL)) {
   
   
        if ($numrows !== 1) {

            $query = "INSERT INTO Usuario VALUES (null,'$nombre','$apellido','$correo','$clave_segura','$fecha')";
            $resultado = mysqli_query($this->conexion,$query);
            
           if ($resultado) {
               $this->mensaje = "<b>Aviso!</b> Usuario registrado correctamente ya puedes ingresar.";
           }else{
             $this->error = "<b>Error!</b> No se pudo registrar tu usuario.";
         }
     }else{
          $this->error = "<b>Error!</b> El correo del usuario ya esta registrado.";
         }
     }else{
     	 $this->error = "<b>Error!</b> Ingresa un correo electronico valido.";
     }
   }else{
    $this->error = "<b>Error!</b> Las contraseñas no coinciden.";
   }
}else{
  $this->error = "<b>Error!</b> Le faltan campos por llenar.";
  
}
}


   function recuperarcontraseña(){
    $correo = mysqli_real_escape_string($this->conexion,$_POST['recuperar_contra_user']);

    $query = "SELECT Clave_Usuario FROM Usuario WHERE Correo_Usuario = '" . $correo . "'";
    $resultado = mysqli_query($this->conexion,$query);
    $filas = mysqli_fetch_array($resultado);
     
    $destinatario = $correo;
    $asunto = "<b>Recuperacion de Contraseña (TomaNota) </b>";
    $mensaje = "<b>Instrucciones</b>\n 
                      - Debes poner es siguiente link en el campo de contraseña y tu correo e ingresar.\n 
                      - Luego debes cambiar la contraseña cuando ingreses al sistema. \n 
                        dentro del sistema en la parte superior derecha al lado del boton <em>Agregar Nota</em> \n 
                      <h4>Este es el link</h4>\n
                      <p style='color:blue'>" . $filas['Clave_Usuario'] . "</p>";  
    
    $envio_mail =  mail($destinatario,$asunto,$mensaje);
   
   if ($envio_mail) {
        $this->mensaje = "<b>Aviso!</b> Revisa tu correo y acata las instrucciones.";
   }else{
     $this->error = "<b>Error!</b> No se pudo enviar el correo.";
   }

   }




}

 ?>