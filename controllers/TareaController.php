<?php

require_once "models/Tarea.php";
require_once "models/Administrador.php";

class TareaController
{
    private $admin;
    private $tarea;

    public function __construct(){
        $this->admin = new Administrador();
        $this->tarea = new Tarea();


        if(!isset($_SESSION["id_user"]) && empty($_SESSION["id_user"])){
          echo "<script> window.location.href ='?c=auth&cod=A005';</script>";
          exit();
        }

    }

    public function index(){
     $response = $this->tarea->getAll();
     $content = "tareas/listTareas.php";
     $title = "Tareas";
     require_once "views/template/dashboard/content.php";

// teber cuidado con las mayusculas
    }

    public function create(){
    
      if($_POST["descripcion"] != ""){

          if($this->tarea->insert($_POST)){
            header("location:?c=tarea&cod=A001");
          }else{
            header("location:?c=tarea&cod=E001");
          }
      }else{
        header("location:?c=tarea&cod=E001");

      }

    }

    public function updateEstado(){
         
      if(isset($_GET["id"]) && !empty($_GET["id"])){
         
        if($this->tarea->updateState($_GET["id"],$_GET["e"])){
            header("location:?c=tarea&cod=A002");
          }else{
            header("location:?c=tarea&cod=E002");
         }
     }else{
        header("location:?c=tarea&cod=E002");
      }
    }



    public function updateDescripcion(){
         
      if(isset($_POST["id"]) && !empty($_POST["id"])){
         
        if($this->tarea->updateDescription($_POST["id"],$_POST["descripcion"])){
            header("location:?c=tarea&cod=A002");
          }else{
            header("location:?c=tarea&cod=E002");
         }
     }else{
        header("location:?c=tarea&cod=E002");
      }
    }

    
 public function delete(){

      if(isset($_GET["id"]) && !empty($_GET["id"])){
         
         if($this->tarea->delete($_GET["id"])){
             header("location:?c=tarea&cod=A003");
           }else{
             header("location:?c=tarea&cod=E003");
          }
      }else{
         header("location:?c=tarea&cod=E003");
       }
  }

  public function reiniciarTareas(){
    if(isset($_GET["s"]) && !empty($_GET["s"]) && $_GET["s"] == 1){
         
      if($this->tarea->reiniciarTareas()){
          header("location:?c=tarea&cod=A001");
        }else{
          header("location:?c=tarea&cod=E001");
       }
   }else{
      header("location:?c=tarea");
    }
  }
    

  public function numTask_ax(){
    echo json_encode($this->tarea->getNumTask());
  }


}

?>