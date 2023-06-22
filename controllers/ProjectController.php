<?php

require_once "models/Project.php";
require_once "models/Administrador.php";
require_once "helpers/BaseController.php";
class ProjectController extends BaseController
{
    private $model;
    private $admin;

    public function __construct()
    {
        $this->model = new Project();
        $this->admin = new Administrador();

        parent::__construct($_SESSION);
    }

    public function index()
    {
        if (isset($_GET["format"], $_GET["status"]) && $_GET["format"] == "json") {
            header('Content-Type: application/json');
            echo json_encode($this->model->findAllByStatus($_GET["status"]));
            return;
        }
        $response = $this->model->findAll();
        $title = "Proyectos";
        $content = "project/listProject.php";
        require_once "views/template/dashboard/content.php";
    }

    public function create()
    {
        try {
            if (!isset($_POST["descripcion"], $_POST["name"], $_POST["status"])) {
                return header("location:?c=project&cod=E005");
            }
            $this->model->create($_POST);
            $this->admin->insert_notificacion($_SESSION["id_user"], "ha agregado una nueva nota");
            header("location:?c=project&cod=A001");

        } catch (Exception $e) {
            exit($e);
        }
    }

    public function update()
    {
        try {
            if (!isset($_POST["descripcion"], $_POST["name"], $_POST["status"])) {
                return header("location:?c=project&cod=E005");
            }
            $this->model->update($_POST["id"], $_POST);
            $this->admin->insert_notificacion($_SESSION["id_user"], "ha actalizado un nuevo proyecto");
            header("location:?c=project&cod=A002");

        } catch (Exception $e) {
            exit($e);
        }
    }
}