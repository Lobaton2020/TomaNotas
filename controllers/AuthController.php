<?php
require_once "models/Usuario.php";
require_once "models/Administrador.php";

class AuthController
{
    public function __construct()
    {
        if(isset($_SESSION["id_user"]) || !empty($_SESSION["id_user"])){
            header("location:?c=link");
        }
    }
        public function index(){
            $title = "Iniciar Sesion";
            $content = "auth/login.php";
            require_once "views/template/auth/content.php";
            
        }

        public function registro(){
            $title = "Registrarse";
            $content = "auth/registro.php";
            require_once "views/template/auth/content.php";
            
        }

        public function forgot_pass(){
            $title = "Recuperar Contraseña";
            $content = "auth/recuperar_contra.php";
            require_once "views/template/auth/content.php";
            
        }

        public function login(){

          $user_c = new Usuario();   
           $user = filter_var($_POST["usuario"],FILTER_SANITIZE_STRING);
           $clave = filter_var($_POST["clave"],FILTER_SANITIZE_STRING);

           $response = $user_c->login($user,$clave);

           if($response){
              $history = new Administrador();
              $history->insert_history_login($_SESSION["id_user"]);
             header("location:?c=link&m=index");
           }else{
            header("location:?c=auth&cod=E008&user=".$user);
           }
            
        }

        public function send_mail(){            
            
            $recuperacion = new Administrador();
            $user_c = new Usuario();
             $response = $user_c->forgot_pass($_REQUEST["correo"]);
            //  a($response);
             if($response[0] == "SENT"){
                 $recuperacion->insert_notificacion($response[1]," esta recuperando la contraseña");

                 header("location:?c=auth&m=forgot_pass&cod=A006");
                }else if($response == "NO_EXIST"){
                    header("location:?c=auth&m=forgot_pass&cod=E009");
                }else{
                    header("location:?c=auth&m=forgot_pass&cod=E010");
                    
                }
              
            }
            
            
            
        public function insert(){
            
            $insercion = new Administrador();
            $user_c = new Usuario();   
            if(filter_var($_POST["correo"],FILTER_VALIDATE_EMAIL)){

                $response = $user_c->insert($_POST);
                $insercion->insert_notificacion($response[1]," es nuevo miembro de la comunidad");
                echo json_encode(["response"=>$response[0]]);
            }else{
                echo json_encode(["response"=>"bad_email"]);
            }
            
        }

}

?>