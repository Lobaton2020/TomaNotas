<?php
require_once "models/Cronograma.php";
require_once "helpers/verAlerta.php";
require_once "models/Administrador.php";
require_once "helpers/order_tarea_cronograma.php";
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
        $completed_rate = (array) $this->cronograma->getStatisticsCompletedTasks();
        $title = "Cronogramas";
        require_once "views/template/dashboard/content.php";
    }

    public function getTareas()
    {
        if (isset($_GET["id"])) {
            $titulo = $this->cronograma->getTituloCronograma($_GET["id"]);
            $response = $this->cronograma->getAllTareas($_GET["id"]);
            usort($response, 'compararPorHoraMinuto');
            $listCronogramaSelect = $this->cronograma->lastTenCronogramas($this->idsesion);
            $content = "cronograma/listTareas.php";
            $title = "Cronograma de Tareas";
            require_once "views/template/dashboard/content.php";
        } else {
            header("location:?c=cronograma");
        }
    }
    public function getTareasJSON()
    {
        if (isset($_GET["id"])) {
            $titulo = $this->cronograma->getTituloCronograma($_GET["id"]);
            $data = $this->cronograma->getAllTareas($_GET["id"]);
            $response =  [];
            $response["data"] =  $data;
            $response["titulo"] = $titulo;
            $response["username"] = $_SESSION["name"];
            http_response_code(200);
            echo json_encode($response);
        } else {
            http_response_code(404);
        }
    }

    public function createCronograma()
    {
        $datos = [
            "idusuario" => $this->idsesion,
            "titulo" => trim($_POST["titulo"]),
            "date" => date(trim($_POST["date"]) . " " . date('00:00:00'))
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
            "project_id" => isset($_POST["project_id"]) && $_POST["project_id"] != "" ? trim($_POST["project_id"]) : null,
            "estado" => 0,
            "order" => 0,
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
                $_SESSION["success-deleted-task"] = "Tarea eliminada con exito.";
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
            "project_id" => isset($_POST["project_id"]) && $_POST["project_id"] != "" ? trim($_POST["project_id"]) : null,
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
            "date" => date(trim($_POST["date"]) . " " . "00:00:00")
        ];

        if ($this->cronograma->updateTituloCronograma($datos)) {
            $_SESSION["success-insert-tarea"] = "Titulo cambiado correctamente.";
            header("location:?c=cronograma");
        } else {
            $_SESSION["error-insert-tarea"] = "Hubo un error, no se cambió el titulo.";
            header("location:?c=cronograma");
        }
    }
    public function copiar()
    {
        if(!isset($_GET["idcronograma"])){
            echo json_encode(["message"=>"ID requerido"]);
            return;
        }
        $cronomgramaId = intval(trim($_GET["idcronograma"]));
       $this->cronograma->copy( $cronomgramaId);
       header("location:?c=cronograma&cod=A010");
    }

    public function moveTask()
    {
        $is_error = !isset($_POST["id_cronograma_fuente"]) || !isset($_POST["id_cronograma_destino"]) || !isset($_POST["id_tarea"]);
        if ($is_error) {
            echo json_encode(["message" => "id_cronograma_fuente,id_cronograma_destino, id_tarea son requeridos"]);
            return;
        }
        $id_cronograma_fuente = intval($_POST["id_cronograma_fuente"]);
        $id_cronograma_destino = intval($_POST["id_cronograma_destino"]);
        $id_tarea = intval($_POST["id_tarea"]);
        $this->cronograma->move(
            $id_cronograma_fuente,
            $id_cronograma_destino,
            $id_tarea
        );
        header("location:?c=cronograma&m=getTareas&id={$_POST["id_cronograma_fuente"]}&cod=A011");
    }
    /**
     * TODO:
     * This method arise because after create or after update need reorder the tasks of every sigle task
     * Possible solutions:
     * 1- Create from DB a trigger that have that logic
     * 2- Intall throught compose RxPhp and emit an event for this updating
     * 3- Every call to see the detail of a cronogram from frontent
     *    ?c=cronograma&m=getTareas&id=136, it request here to update in front background. Currently this works but i need found some thing better.
     */

    public function front_event__autoOrganizerOrder()
    {
        if (!isset($_GET["idcronograma"])) {
            echo json_encode(["message" => "idcronograma in query is required"]);
            http_response_code(400);
            return;
        }
        $this->cronograma->autoOrganizeOrder($_GET["idcronograma"]);
        http_response_code(204);
    }
}
