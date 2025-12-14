<?php
require_once "models/Link.php";
require_once "models/Administrador.php";
require_once "models/Usuario.php";
require_once "helpers/url_helper.php";

class LinkController
{
    private $model;
    private $admin;

    public function __construct()
    {
        $this->model = new Link();
        $this->usuario = new Usuario();
        $this->admin = new Administrador();

        if (!isset($_SESSION["id_user"]) && empty($_SESSION["id_user"])) {
            echo "<script> window.location.href ='?c=auth&cod=A005';</script>";
            exit();
        }
    }

    public function index()
    {
        // en este metodo se hace el uso de ajax
        $title = "Link";
        require_once "views/template/link/content.php";
    }

    public function compartidos()
    {
        $datosHablilitarHttp = $this->model->verHabilitadoLink();
        $datosLinksCompartidos = $this->model->getLinksCompartidos();
        $response = [
            "http" => $datosHablilitarHttp,
            "links" => $datosLinksCompartidos,
        ];
        $content = "links/linkscompartidosList.php";
        $title = "Links";
        require_once "views/template/dashboard/content.php";
    }

    public function newShareLink()
    {
        $datos = [
            "idusuarioentrega" => $_SESSION["id_user"],
            "idusuariorecibe" => $_GET["idusuario"],
            "idlink" => $_GET["idlink"],
            "fecha" => date("Y-m-d  H:m:i"),
        ];

        if ($this->model->insertShareLink($datos)) {
            $this->admin->insert_notificacion($_SESSION["id_user"], "ha compartido un link");
            header("location:?c=link&m=compartidos&cod=A008");
        } else {
            header("location:?c=link&m=compartidos&cod=E005");
        }
    }
    public function deleteCompartido()
    {
        if ($this->model->deleteShareLink($_GET["id"])) {
            header("location:?c=link&m=compartidos&cod=A003");
        } else {
            header("location:?c=link&m=compartidos&cod=E003");
        }
    }

    public function searchUserLink_ax()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($response = $this->usuario->getUserBy($_SESSION["id_user"], $_POST["valor"])) {
                echo json_encode($response);
            } else {
                echo "false";
            }
        } else {
            echo "false";
        }
    }

    // este es de una consulta ajax
    public function getAll_ax()
    {
        if (isset($_REQUEST["ver"])) {
            $search = isset($_REQUEST["search"]) ? $_REQUEST["search"] : null;
            $array = $this->model->getAll($this->getPages($_REQUEST["page"], 50), $search);

            if (count($array) != 0) {
                $res = $array;
                require_once "views/links/ajax/resultados.php";
            } else {
                echo null;
            }
        } else {
            header("location:?c=auth");
        }
    }
    private function getPages($init, $size)
    {
        $init = intval($init) - 1;
        $page = ($init * $size) > 1 ? ($init * $size) - 1 : 0;
        return "{$page},{$size}";
    }
    public function create()
    {
        if (!empty($_POST["url"])) {

            $response = $this->model->create($_POST);
            if ($response) {
                $this->admin->insert_notificacion($_SESSION["id_user"], "ha agregado un nuevo link");

                header("location:?c=link&cod=A001");
            } else {
                header("location:?c=link&cod=E006");
            }
        } else {
            header("location:?c=link&cod=E004");
        }
    }
    public function getone()
    {

        $id = filter_var($_REQUEST["id"], FILTER_SANITIZE_NUMBER_INT);
        $res = $this->model->getone($id);

        if ($res) {
            $title = "Link";
            require_once "views/template/link/content.php";
        } else {
            header("location:?c=auth&cod=E005");
        }
    }

    public function update()
    {
        $response = $this->model->update($_POST);
        if ($response) {
            header("location:?c=link&cod=A002");
        } else {
            header("location:?c=link&cod=E002");
        }
    }

    public function delete()
    {
        $response = $this->model->delete($_REQUEST["id"]);

        if ($response) {
            $this->admin->insert_notificacion($_SESSION["id_user"], "ha eliminado un link");
            header("location:?c=link&cod=A003");
        } else {
            header("location:?c=link&cod=E003");
        }
    }
}
