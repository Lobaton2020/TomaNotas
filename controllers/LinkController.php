<?php
require_once "models/Link.php";
require_once "models/Administrador.php";

class LinkController
{
    private $model;
    private $admin;

    public function __construct()
    {
      $this->model = new Link();
      $this->admin = new Administrador();

      if(!isset($_SESSION["id_user"]) && empty($_SESSION["id_user"])){
        header("location:?c=auth&cod=A005");
      }
    }

    public function index(){
        // en este metodo se hace el uso de ajax
        $title = "Link";
        require_once "views/template/link/content.php";
        
        }

     // consulta de datos por meio de ajax

    public function search_ax()
    {
      if(isset($_REQUEST["value"])){
          $res = $this->model->search($_REQUEST["value"]);
          $link = $this->model->getAll();
          $link = $link[1];
    
        if(count($res) != 0){
             require_once "views/links/ajax/linkList.php";
          }else{
             echo null;
          }
      }else{
        header("location:?c=auth");
     }
    }
    
    // este es de una consulta ajax
    public function getAll_ax()
    {   
      if(isset($_REQUEST["ver"])){
        $array = $this->model->getAll();
        
        if(count($array) != 0){
          
          $res = $array[0];
          $reslink = $array[1];
          require_once "views/links/ajax/resultados.php";
        }else{
          echo null;
        }
      }else{
        header("location:?c=auth");
      }
    }
    


    public function create()
    {
        if(!empty($_POST["url"])){

              $response = $this->model->create($_POST);
                if($response){
                  $this->admin->insert_notificacion($_SESSION["id_user"],"ha agregado un nuevo link");

                    header("location:?c=link&cod=A001");

                }else{
                  header("location:?c=link&cod=E006");
                }
          
        }else{
            header("location:?c=link&cod=E004");
        }
    }
        public function getone()
        {
      
        $id = filter_var($_REQUEST["id"],FILTER_SANITIZE_NUMBER_INT);
        $res = $this->model->getone($id);

       if($res){
          $title = "Link";
          require_once "views/template/link/content.php";
       }else{
              header("location:?c=auth&cod=E005");
          }
     
    }


 
    public function update()
    {
        $response = $this->model->update($_POST);
        if($response){
          header("location:?c=link&cod=A002");
        }else{
          header("location:?c=link&cod=E002");

        }
    }


    public function delete()
    {
        $response = $this->model->delete($_REQUEST["id"]);

        if($response){
             $this->admin->insert_notificacion($_SESSION["id_user"],"ha eliminado un link");
            header("location:?c=link&cod=A003");
        }else{
            header("location:?c=link&cod=E003");

        }
    }




}

?>