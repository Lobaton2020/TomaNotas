<?php

require_once "models/Notas.php";

class AuthController
{
    private $model;

    public function __construct()
    {
     $this->model = new Notas();   
    }

    public function index(){

        $content = "dashboard/main.php";
        $content_form = "dashboard/form.php";
        require_once "views/template/dashboard/content.php";
        
        }
    // este es de una consulta ajax
    public function main()
    {   
     if(isset($_REQUEST["ver"])){
        $array = $this->model->show();
        
        if(count($array) != 0){
        $res = $array[0];
        $reslink = $array[1];
        require_once "views/dashboard/resultados.php";
        }else{
          echo null;
      }
    
    }else{
      header("location:?c=auth");
    }
    }



    public function getone()
    {

        $id = filter_var($_REQUEST["id"],FILTER_SANITIZE_NUMBER_INT);
        $res = $this->model->getone($id);
       if($res){
           $content = "dashboard/main.php";
           $content_form = "dashboard/form.php";
           require_once "views/template/dashboard/content.php";
       }else{
              header("location:?c=auth&msg=error");
          }
     
    }


    public function create()
    {

        if(!empty($_POST["descripcion_nota"])){
            $this->model->create($_POST);
            header("location:?c=auth&msg=success");
        }else{
            header("location:?c=auth&msg=error");
        }
    }
 
    public function update()
    {
        $this->model->update($_POST);
        header("location:?c=auth&msg=success");
    }


    public function delete()
    { 
       $id = filter_var($_REQUEST["id"],FILTER_SANITIZE_NUMBER_INT);
       $this->model->delete($id);
       header("location:?c=auth&msg=success");
    }

    // funciones de habilitacion y deshabilitacion de acciones

    public function on_delete()
    {
      $_SESSION["crud"] = "on_delete";
      header("location:?c=auth");
    }

    public function on_update()
    {
        $_SESSION["crud"] = "on_update";
        header("location:?c=auth");
    }


    public function on_date()
    {
       $_SESSION["date"] = "date";
       header("location:?c=auth");
    }


    public function off()
    {
        session_unset();
        session_destroy();
        header("location:?c=auth");
    }
    public function validacion()
    {   
        if(isset($_POST["clave"])){

            $res = filter_var($_POST["clave"],FILTER_SANITIZE_NUMBER_INT);
            $clave = "20022002"; 

             if($res == $clave){
                  switch ($_SESSION["crud"]){
                      case "on_update":
                          $_SESSION["update"] = 1;
                          $_SESSION["crud"] = null;
                          header("location:?c=auth");
                      break;

                      case "on_delete":
                          $_SESSION["delete"] = 1;
                          $_SESSION["crud"] = null;
                          header("location:?c=auth");
                      break; 
                      default:
                      header("location:?c=auth");
                  }
              }else{
                header("location:?c=auth");
             } 
         }else{
            header("location:?c=auth");
         } 
    }

    // consulta de datos por meio de ajax

    public function ajax()
    {
      if(isset($_REQUEST["value"])){
          $res = $this->model->ajax($_REQUEST["value"]);
    
        if(count($res) != 0){
             require_once "views/dashboard/ajax/notasList.php";
          }else{
             echo null;
          }
    }else{
        header("location:?c=auth");
    }
}

}

?>