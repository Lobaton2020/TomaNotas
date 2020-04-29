<?php
require_once "models/Cronograma.php";
require_once "helpers/verAlerta.php";
require_once "models/Administrador.php";

class CronogramaController
{
    private $admin;
    private $tarea;
    private $idsesion;

    public function __construct()
    {
        $this->idsesion = $_SESSION["id_user"];

        $this->admin = new Administrador();
        $this->cronograma = new Cronograma();

        if (!isset($_SESSION["id_user"]) && empty($_SESSION["id_user"])) {
            echo "<script> window.location.href ='?c=auth&cod=A005';</script>";
            exit();
        }

    }

    public function index()
    {
        $response = $this->cronograma->getAllCronograma($this->idsesion);
        $content = "cronograma/listCronograma.php";
        $title = "Cronogramas";
        require_once "views/template/dashboard/content.php";

    }

    public function getTareas()
    {
        if (isset($_GET["id"])) {

            $response = $this->cronograma->getAllTareas($_GET["id"]);
            $content = "cronograma/listTareas.php";
            $title = "Cronograma de Tareas";
            require_once "views/template/dashboard/content.php";

        } else {
            header("location:?c=cronograma");
        }
    }

    public function createCronograma()
    {
        $datos = [
            "idusuario" => $this->idsesion,
            "titulo" => trim($_POST["titulo"]),
        ];
        if ($datos["titulo"] != "") {
            if ($this->cronograma->insertCronograma($datos)) {
                $this->admin->insert_notificacion($_SESSION["id_user"], "ha creado un nuevo cronograma");
                header("location:?c=cronograma&cod=A001");
            } else {
                header("location:?c=cronograma&cod=E001");
            }
        } else {
            header("location:?c=cronograma&cod=E001");
        }

    }

    public function createTareaCronograma()
    {
        $datos = [
            "idtareacronograma" => null,
            "idcronograma" => trim($_POST["idcronograma"]),
            "descripcion" => trim($_POST["contenido-tarea"]),
            "hora" => trim($_POST["hora"]),
            "minuto" => trim($_POST["minuto"]),
            "meridiano" => trim($_POST["meridiano"]),
            "estado" => 0,
        ];

        if ($this->cronograma->insertTareaCronograma($datos)) {
            $this->admin->insert_notificacion($_SESSION["id_user"], "ha creado una tarea de un cronograma");
            $_SESSION["success-insert-tarea"] = "Esta nueva actividad se ha agregado correctamente.";
            header("location:?c=cronograma&m=getTareas&id=" . $datos["idcronograma"]);
        } else {
            $_SESSION["error-insert-tarea"] = "Hubo un error, no se agregó la tarea.";
            header("location:?c=cronograma&m=getTareas&id=" . $datos["idcronograma"]);
        }

    }

    public function cambiarEstado()
    {
        $datos = [
            "idcronograma" => trim($_GET["idcronograma"]),
            "idtarea" => trim($_GET["idtarea"]),
            "estado" => trim($_GET["estado"]),
        ];

        if ($this->cronograma->cambiarEstadoTareaCronograma($datos)) {
            header("location:?c=cronograma&m=getTareas&id=" . $datos["idcronograma"]);
        } else {
            header("location:?c=cronograma&m=getTareas&id=" . $datos["idcronograma"]);
        }

    }
    public function eliminarTareasCronograma()
    {
        if (isset($_GET["idcronograma"])) {
            $idcronograma = trim($_GET["idcronograma"]);
            if ($this->cronograma->eliminarTareasCronograma($idcronograma)) {
                header("location:?c=cronograma&m=getTareas&id=" . $idcronograma);
            } else {
                header("location:?c=cronograma&m=getTareas&id=" . $idcronograma);
            }
        }

    }

    public function reiniciarTareasCronograma()
    {
        if (isset($_GET["idcronograma"])) {
            $idcronograma = trim($_GET["idcronograma"]);
            if ($this->cronograma->reiniciarEstadosTareaCronograma($idcronograma)) {
                header("location:?c=cronograma&m=getTareas&id=" . $idcronograma);
            } else {
                header("location:?c=cronograma&m=getTareas&id=" . $idcronograma);
            }
        }

    }

    public function eliminarTareaCronograma()
    {
        if (isset($_GET["idtarea"])) {
            $idcronograma = trim($_GET["idcronograma"]);
            $idtarea = trim($_GET["idtarea"]);
            if ($this->cronograma->eliminarTareaCronograma($idtarea)) {
                header("location:?c=cronograma&m=getTareas&id=" . $idcronograma);
            } else {
                header("location:?c=cronograma&m=getTareas&id=" . $idcronograma);
            }
        }

    }

    public function updateTareaCronograma()
    {
        $datos = [
            "idtarea" => trim($_POST["idtarea"]),
            "idcronograma" => trim($_POST["idcronograma"]),
            "descripcion" => trim($_POST["contenido-tarea"]),
            "hora" => trim($_POST["hora"]),
            "minuto" => trim($_POST["minuto"]),
            "meridiano" => trim($_POST["meridiano"]),
        ];

        if ($this->cronograma->updateTareaCronograma($datos)) {
            $_SESSION["success-insert-tarea"] = "La tarea se ha actualizado correctamente.";
            header("location:?c=cronograma&m=getTareas&id=" . $datos["idcronograma"]);
        } else {
            $_SESSION["error-insert-tarea"] = "Hubo un error, no se actualizó la tarea.";
            header("location:?c=cronograma&m=getTareas&id=" . $datos["idcronograma"]);
        }

    }

    public function eliminarCronograma()
    {
        if (isset($_GET["idcronograma"])) {
            $idcronograma = trim($_GET["idcronograma"]);
            if ($this->cronograma->eliminarTareasCronograma($idcronograma)) {
                if ($this->cronograma->eliminarCronograma($idcronograma)) {
                    header("location:?c=cronograma&cod=A003");
                } else {
                    header("location:?c=cronograma&cod=E003");
                }
            } else {
                header("location:?c=cronograma&cod=E003");

            }
        }

    }

    public function updateTitleCronograma()
    {
        $datos = [
            "idcronograma" => trim($_POST["idcronograma"]),
            "titulo" => trim($_POST["titulo"]),
        ];

        if ($this->cronograma->updateTituloCronograma($datos)) {
            $_SESSION["success-insert-tarea"] = "Titulo cambiado correctamente.";
            header("location:?c=cronograma");
        } else {
            $_SESSION["error-insert-tarea"] = "Hubo un error, no se cambió el titulo.";
            header("location:?c=cronograma");
        }

    }

}
