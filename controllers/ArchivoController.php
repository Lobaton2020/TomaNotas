<?php
require_once "models/Administrador.php";
require_once "models/Archivo.php";
require_once "models/Usuario.php";


class ArchivoController{

    private $model;
    private $admin;

    public function __construct(){
        $this->model = new Archivo();
        $this->admin = new Administrador();
        $this->user = new Usuario();


        if(!isset($_SESSION["id_user"]) && empty($_SESSION["id_user"])){
            header("location:?c=auth&cod=A005");
        }
    }



     public function index(){
       $response = $this->model->getall();
       $title = "Archivo";
       $content = "archivos/archivoList.php";
       require_once "helpers/obtener_Fechas.php"; 
       require_once "views/template/dashboard/content.php";
    }
    
    public function archivos_compartidos(){
        $response = $this->model->getall_archivo_compartido();
        $title = "Archivo";
        $content = "archivos/archivocompartidoList.php";
        require_once "helpers/obtener_Fechas.php"; 
        require_once "views/template/dashboard/content.php";
     }


    public function subir(){
       
        $title = "Archivo";
        $content = "archivos/archivoCreate.php";
        require_once "views/template/dashboard/content.php";
     }

     public function cargarFiles(){
        $response = $this->model->create($_FILES);
        
        if($response){
            $this->admin->insert_notificacion($_SESSION["id_user"],"ha agregado nuevo/s archivos");
            header("location:?c=archivo&m=subir&cod=A004");
        }else{
            header("location:?c=archivo&m=subir&cod=E001");
        }

     }

     public function compartir_file(){
        $response = $this->model->compartir($_POST);
        
        if($response){
            $this->admin->insert_notificacion($_SESSION["id_user"],"ha compartido un archivo");
            header("location:?c=archivo&m=archivos_compartidos&cod=A008");
        }else{
            header("location:?c=archivo&m=archivos_compartidos&cod=E005");
        }

     }

     public function renombrar(){

        if(isset($_REQUEST["id"])){
            echo $this->model->renombrar($_REQUEST["id"],$_REQUEST["old"],$_REQUEST["new"]);
                        $this->admin->insert_notificacion($_SESSION["id_user"],"ha renombrado un archivo");


        }else{
            echo false;
    
        }
         }
         public function buscar_archivos(){

            if(isset($_REQUEST["value"])){
                $response = $this->model->buscar_archivo($_REQUEST["value"]);
               
                require_once "helpers/obtener_Fechas.php";
                require_once "views/archivos/tableList.php";

            }else{
                echo false;
        
            }
        }

     public function ver(){
    if(isset($_REQUEST["id"])){
       
        $response = $this->model->getone($_REQUEST["id"]);
        $title = "Archivo";
        $content = "archivos/archivoVer.php";
        require_once "views/template/dashboard/content.php";
    }else{
        header("location:?c=archivo&m=index&cod=E005");

    }
     }
    public function vercompartido(){
        if(isset($_REQUEST["id"])){
           
            $response = $this->model->getoneCompartido($_REQUEST["id"]);
            $title = "Archivo";
            $content = "archivos/archivoVer.php";
            require_once "views/template/dashboard/content.php";
        }else{
            header("location:?c=archivo&m=index&cod=E005");
    
        }
     }

     public function deleteCompartido(){
        $response = $this->model->deleteCompartido($_REQUEST["id"]);
        
        if($response){
            $this->admin->insert_notificacion($_SESSION["id_user"],"ha eliminado un archivo Compartido");
            header("location:?c=archivo&m=archivos_compartidos&cod=A007");

        }else{
            header("location:?c=archivo&m=archivos_compartidos&cod=E005");
        }

     }
    
     
     
     public function delete(){
        $response = $this->model->delete($_REQUEST["id"]);
        
        if($response){
            $this->admin->insert_notificacion($_SESSION["id_user"],"ha eliminado un archivo");
            header("location:?c=archivo&m=index&cod=A003");

        }else{
            header("location:?c=archivo&m=index&cod=E003");
        }

     }
    
}

?>