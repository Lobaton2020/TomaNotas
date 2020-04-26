<?php
class Archivo{
    public $conexion;
    public $exito = array();
    public $error = array();


   function __construct(){
     session_start();

     $this->conexion = mysqli_connect('localhost','root','','Archivos');
     
    
   if(isset($_POST['envio_eliminar'])){
      $this->habilitar_eliminacion();
}

     if(isset($_POST['subir_archivo'])){
      $this->ingresar_archivo();
}
if(isset($_GET['destroy_session']) || isset($_GET['eli_sesion'])){
  $this->cerrar_sesion();
}

if(isset($_POST['sesion'])){
  $this->validar_usuario();
}
    }
   function ingresar_archivo(){
     
    $name = $_FILES['archivo']['name'];
    $tmp_name = $_FILES['archivo']['tmp_name'];
    $ruta = $tmp_name;
    $destino = "archivos/" . $name; 
    if($name != ""){
      if(!file_exists('archivos')){
           mkdir('archivos',0777,true);
           if(file_exists('archivos')){
             if (move_uploaded_file($ruta,$destino)){
                  
                echo "Exitos";
              }else{
                echo "Mal";
             }       
           }
       }else{
            
           if(file_exists('archivos')){
             if (move_uploaded_file($ruta,$destino)){

              $query = "SELECT * from archivos where nombre_archivo = '$name'";
              $consulta = mysqli_query($this->conexion,$query); 
              $filas = mysqli_num_rows($consulta);
              
              if($filas > 0){
                   
                  $this->error = "Ya existe un archivo con el mismo nombre.";

                    }else{
                    if(isset($_SESSION['id_user'])){
                     $sql = "INSERT INTO archivos VALUES (null,1,'$name')";
                    }else{
                      $sql = "INSERT INTO archivos VALUES (null,null,'$name')";
                    }
                  
                   $resultado = mysqli_query($this->conexion,$sql);
                    if($resultado){
                      $this->exito = "<span class='exito'>El Archivo ha sido guardado. Exitosamente!</span>";
                    }else{
                      $this->error = "<span class='error'>El archivo no se pudo guardar.</span>";
                    }
                  }
            }else{
              $this->error = "<span class='error'>El Archivo es demasiado pesado.</span>";
            }
         }
       } 
    }else{
      $this->error = "<span class='error'>Ingresa un Archivo que puedas Subir!</span>";
    }

  

   }

  function habilitar_eliminacion(){
   if($_POST['eliminar'] == "mipassword"){
     $_SESSION['eliminar'] = "Habilitado";
  }

}
   function cerrar_sesion(){
    
     session_destroy();
    
 
      header('Location:mostrar_archivo.php');
    
   }

  function validar_usuario(){
    $correo = mysqli_real_escape_string($this->conexion,$_POST['correo']);
    $clave = mysqli_real_escape_string($this->conexion,$_POST['clave']);

    if($correo == "micorreo" && $clave=="mipassword"){
    
      $_SESSION['id_user'] = 1;
      $_SESSION['nombre'] = "minombre";
      $_SESSION['apellido'] = "miapellido";
      
     if(!empty($_SESSION['apellido'])){
        header('Location:mostrar_archivo.php');
     }
    }else{
      $this->error = "<span class='error'>Usuario y/o contrse&#241;a no coinciden.</span>";
    }
  }
    
}
?>