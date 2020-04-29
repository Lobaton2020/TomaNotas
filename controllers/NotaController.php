<?php

require_once "models/Nota.php";
require_once "models/Administrador.php";

class NotaController
{
    private $model;
    private $admin;

    public function __construct()
    {
    $this->model = new Nota();
    $this->admin = new Administrador();

    if(!isset($_SESSION["id_user"]) && empty($_SESSION["id_user"])){
      echo "<script> window.location.href ='?c=auth&cod=A005';</script>";
      exit();
  }
    }

    public function index(){
         
        $response = $this->model->getAll();
        $title = "Notas";
        $content = "notas/listNotas.php";
        require_once "views/template/dashboard/content.php";
        
        }
   
        public function create(){
         
        if(isset($_POST["descripcion"])){
            if($_POST["descripcion"] != null){
                
                $response = $this->model->create($_POST);
                  
                if($response){
                  $this->admin->insert_notificacion($_SESSION["id_user"],"ha agregado una nueva nota");

                    header("location:?c=nota&cod=A001");
                     
                }else{
                     header("location:?c=nota&cod=E001");
             
                    }            
                }else{
                   header("location:?c=nota&cod=E004");
       
                }

         }else{
            header("location:?c=nota&cod=E005");

         }

        }
     
        
         public function update(){
          
             $response = $this->model->update($_POST);
             
             if($response){
                   header("location:?c=nota&cod=A002");
             }else{
              header("location:?c=nota&cod=E002");
      
             }
          }


        public function delete(){
          if(isset($_REQUEST["id"])){
             $response = $this->model->delete($_REQUEST["id"]);
             
              if($response){
               $this->admin->insert_notificacion($_SESSION["id_user"],"ha eliminado una nota");

                  header("location:?c=nota&cod=A003");
               }else{
                  header("location:?c=nota&cod=E003");
               }
          }else{
             header("location:?c=nota&cod=E005");
     
          }
          
     } 
}

?>