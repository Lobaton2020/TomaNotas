<?php
require_once "models/Administrador.php";

class AdministradorController
{

    private $model;

    public function __construct()
    {

        $this->admin = new Administrador();

        if (!isset($_SESSION["id_user"]) || empty($_SESSION["id_user"])) {
            if ($_SESSION["rol_user"] != 1) {
                echo "<script> window.location.href ='?c=auth&cod=A005';</script>";
                exit();
            }
        }

    }

    public function usuarios()
    {
        $response = $this->admin->getall_user();
        $title = "Administrador";
        $content = "administrador/userList.php";
        require_once "views/template/dashboard/content.php";
    }

    public function notificacion()
    {
        $response = $this->admin->getall_notificacion();
        $title = "Administrador";
        require_once "helpers/obtener_Fechas.php";
        $content = "administrador/notificacionList.php";
        require_once "views/template/dashboard/content.php";
    }

    public function historial()
    {

        $response = $this->admin->getall_history_login();
        $content = "administrador/loginHistory.php";
        $title = "Administrador";
        require_once "helpers/obtener_Fechas.php";
        require_once "views/template/dashboard/content.php";
    }

    public function reportesUsuario()
    {
        $response = $this->admin->getall_reportes_user();
        $title = "Administrador";
        $content = "administrador/reportesUsuario.php";
        require_once "views/template/dashboard/content.php";
    }

    public function deleteNoti()
    {
        $response = $this->admin->delete_notificacion($_REQUEST["id"]);

        if ($response) {
            header("location:?c=administrador&m=notificacion&cod=eliminado");
        } else {
            header("location:?c=administrador&m=notificacion&cod=no_eliminado");
        }

    }

    public function deleteHistory()
    {
        $response = $this->admin->delete_history_login($_REQUEST["id"]);

        if ($response) {
            header("location:?c=administrador&m=historial&cod=eliminado");
        } else {
            header("location:?c=administrador&m=historial&cod=no_eliminado");
        }

    }

}
