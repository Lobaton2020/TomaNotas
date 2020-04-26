<?php
require_once "models/Usuario.php";
require_once "models/Administrador.php";
class UsuarioController{

    private $model;
    private $admin;

    public function __construct(){
        
        $this->model = new Usuario();
        $this->admin = new Administrador();

        if(!isset($_SESSION["id_user"]) && empty($_SESSION["id_user"])){
            header("location:?c=auth&cod=A005");
        }
    }


    public function index(){
    //    funcion ver mi perfil
       $user = $this->model->getone($_SESSION["id_user"]);
       $title = "Mi perfil";
       $content = "usuarios/updateUsuario.php";
       require_once "helpers/obtener_Fechas.php";
       require_once "views/template/dashboard/content.php";
     
    }


    public function updateUser(){
       
        $response = $this->model->updateUser($_POST);
        if($response){
            $this->model->actulizarDatos($_SESSION["id_user"]);
           header("location:?c=usuario&m=mi_perfil&cod=A002");
        }else{
            header("location:?c=usuario&m=mi_perfil&cod=E002");
        }
 
     }

     public function updatePass_ax(){
       
        echo  json_encode($this->model->updatePass($_POST));

 
     }


     public function delete(){
             
        $response = $this->model->delete($_REQUEST["id"]);
        if($response){
           $this->admin->insert_notificacion($_SESSION["id_user"],"ha eliminado su cuenta");
           session_destroy();
           header("location:?c=auth&cod=A003");

        }else{
            header("location:?c=usuario&m=mi_perfil&cod=E003");
        }
     }

    public function logout(){
       session_destroy();
       header("location:?c=auth&cod=A005");
    }

    
    public function reporte_problema(){

        if(!empty($_POST["descripcion"]) || !empty($_POST["titulo"])){

            $titulo = !empty($_POST["titulo"]) ? $_POST["titulo"] : " No se expreso un titulo.";
            $descripcion = !empty($_POST["descripcion"]) ? $_POST["descripcion"] : " No se expreso una descrcipcion.";


         $contenido =   '<!DOCTYPE html>';
         $contenido .= '<html lang="en">';
         $contenido .= '<head>';
         $contenido .= '	<meta charset="UTF-8">';
         $contenido .= '	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>';
         $contenido .= '    <meta name="viewport" content="width=device-width, user-scalable=no">';
         $contenido .= '    <meta http-equiv="X-UA-Compatible" content="IE=edge"> ';
         $contenido .= '</head>';
         $contenido .= '<body>';
         $contenido .= '';
         $contenido .= '  <p>El usuario <B>'. $_SESSION["name"] ." ". $_SESSION["lastname"] .'.</B>  ['.$_SESSION["nickname_user"].'] </p>';
         $contenido .=   '<p>Ha reportado un problema</p>';
         $contenido .= '  <h3><em>Asunto:</em></h3>';
         $contenido .= '  <p>'.$titulo.'</p>';
         $contenido .= '  ';
         $contenido .= '<h3><em>Descripcion:</em></h3>';
         $contenido .= '<p>'. $descripcion . '</p>';
         $contenido .= '';
         $contenido .= '<p><b>Correo: </b>'. $_SESSION["correo_user"].'</p>';
         $contenido .= '  </body></html>';
         
         $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
        $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        
        // Cabeceras adicionales
        $cabeceras .= 'To: Andres Lobaton <andrespipe021028@gmail.com>' . "\r\n";
        $cabeceras .= 'From: '. $_SESSION["name"] ." ". $_SESSION["lastname"] .' <'. $_SESSION["correo_user"].'>' . "\r\n";
        
        $titulo = "Reporte Problemas | TomaNotas";
        if(mail("andrespipe021028@gmail.com",$titulo,$contenido,$cabeceras)){
            $this->admin->insert_notificacion($_SESSION["id_user"],"ha enviado un reporte");
            header("location:?c=".$_GET["c"]."&cod=A009");
        }else{
            header("location:?c=".$_GET["c"]."&cod=E005");
        }

    }else{
        header("location:?c=". $_GET["c"]."&cod=E011");
        
    }
}
}

?>