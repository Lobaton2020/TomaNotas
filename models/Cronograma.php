<?php

class Cronograma
{
    private $dbh;
    private $session;

    public function __construct()
    {
        $this->session = $_SESSION["id_user"];
        $this->dbh = Database::Connect();

    }

    public function insertCronograma($datos)
    {
        try {
            $sql = "INSERT INTO cronograma values(?,?,?,?)";
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute(array(null, $datos["idusuario"], $datos["titulo"], $datos["date"]));
            return true;
        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }

    public function getAllCronograma($idusuario)
    {
        try {
            $sql = "SELECT c.*, COALESCE(ROUND((SUM(CASE WHEN tc.estado = 1 THEN 1 ELSE 0 END) / COUNT(tc.id_tarea_cronograma_PK) * 100) ),0) as completed_percent
            FROM cronograma c
            LEFT JOIN tarea_cronograma tc ON c.id_cronograma_PK = tc.id_cronograma_FK
            WHERE c.id_usuario_FK = ?
            GROUP BY c.id_cronograma_PK
            ORDER BY c.id_cronograma_PK DESC;
            ";
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute(array($idusuario));
            return $stmt->fetchAll();

        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }
    public function getAllTareas($idcronograma)
    {
        try {
            $sql = "SELECT tarea_cronograma.*, p.name FROM tarea_cronograma
            left join projects p on p.id = tarea_cronograma.project_id and p.status  = 1
            WHERE id_cronograma_FK = ?
            ORDER BY id_cronograma_FK ASC";
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute(array($idcronograma));
            return $stmt->fetchAll();

        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }

    public function insertTareaCronograma($datos)
    {
        try {
            $sql = "INSERT INTO tarea_cronograma values(?,?,?,?,?,?,?,?,?)";
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute(
                array(
                    $datos["idtareacronograma"],
                    $datos["idcronograma"],
                    $datos["descripcion"],
                    $datos["hora"],
                    $datos["minuto"],
                    $datos["meridiano"],
                    $datos["estado"],
                    $datos["project_id"],
                    $datos["order"]
                )
            );
            return true;
        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }

    public function cambiarEstadoTareaCronograma($datos)
    {
        try {
            $sql = "UPDATE tarea_cronograma SET estado = ? WHERE id_tarea_cronograma_PK = ?";
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute(array($datos["estado"], $datos["idtarea"]));
            return true;

        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }

    public function reiniciarEstadosTareaCronograma($idcronograma)
    {
        try {
            $sql = "UPDATE tarea_cronograma SET estado = 0 WHERE id_cronograma_FK = ?";
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute(array($idcronograma));
            return true;

        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }

    public function eliminarTareasCronograma($idcronograma)
    {
        try {
            $sql = "DELETE FROM tarea_cronograma WHERE id_cronograma_FK = ?";
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute(array($idcronograma));
            return true;

        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }

    public function eliminarCronograma($idcronograma)
    {
        try {
            $sql = "DELETE FROM cronograma WHERE id_cronograma_PK = ?";
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute(array($idcronograma));
            return true;

        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }

    public function eliminarTareaCronograma($idtareacronograma)
    {
        try {
            $sql = "DELETE FROM tarea_cronograma WHERE id_tarea_cronograma_PK = ?";
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute(array($idtareacronograma));
            return true;

        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }

    public function updateTareaCronograma($datos)
    {
        try {
            $sql = "UPDATE tarea_cronograma SET hora = ?,minuto = ?, meridiano = ?, descripcion = ?, project_id = ? WHERE id_tarea_cronograma_PK = ?";
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute(
                array(
                    $datos["hora"],
                    $datos["minuto"],
                    $datos["meridiano"],
                    $datos["descripcion"],
                    $datos["project_id"],
                    $datos["idtarea"]
                )
            );
            return true;

        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }

    public function updateTituloCronograma($datos)
    {
        try {
            $sql = "UPDATE cronograma SET titulo = ?, fecha = ? WHERE id_cronograma_PK = ?";
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute(array($datos["titulo"], $datos["date"], $datos["idcronograma"]));
            return true;

        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }

    public function getTituloCronograma($idcronograma)
    {
        try {
            $sql = "SELECT titulo FROM cronograma WHERE id_cronograma_PK = ?";
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute(array($idcronograma));
            return $stmt->fetch();

        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }

    public function getOne($idcronograma)
    {
        try {
            $sql = "SELECT * FROM cronograma WHERE id_cronograma_PK = ? AND id_usuario_FK = ?";
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute(array($idcronograma, $this->session));
            return $stmt->fetch();

        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }
    public function getOneTask($idtask)
    {
        try {
            $sql = "SELECT * FROM tarea_cronograma WHERE id_tarea_cronograma_PK = ?";
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute(array($idtask));
            return $stmt->fetch();

        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }


    function copy(int $cronogramaId)
    {
        try {
            $this->dbh->beginTransaction();
            $cronograma = $this->getOne($cronogramaId);

            $sql = "INSERT INTO cronograma values(?,?,?,?)";
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute([
                null,
                $cronograma->id_usuario_FK,
                "{$cronograma->titulo} Copy",
                date("Y-m-d H:m:i")
            ]);
            $newCronogramaId = $this->dbh->lastInsertId();
            $tareas = $this->getAllTareas($cronogramaId);
            foreach ($tareas as $tarea) {
                $tarea_cronograma = (array) $tarea;
                $sql = "INSERT INTO tarea_cronograma values(?,?,?,?,?,?,?,?,?)";
                $stmt = $this->dbh->prepare($sql);
                $stmt->execute(
                    array(
                        null,
                        $newCronogramaId,
                        $tarea_cronograma["descripcion"],
                        $tarea_cronograma["hora"],
                        $tarea_cronograma["minuto"],
                        $tarea_cronograma["meridiano"],
                        0,
                        $tarea_cronograma["project_id"],
                        0
                    )
                );
            }
            $this->dbh->commit();
            return true;
        } catch (PDOException $e) {
            $this->dbh->rollback();
            exit($e->getMessage());
        }

    }


    public function autoOrganizeOrder($idcronograma)
    {
        try {
            $listTasks = $this->getAllTareas($idcronograma);
            usort($listTasks, 'compararPorHoraMinuto');
            $counter = 1;
            foreach ($listTasks as $task) {
                $sql = "UPDATE  tarea_cronograma SET `order` = ? WHERE id_cronograma_FK = ? AND id_tarea_cronograma_PK = ?";
                $stmt = $this->dbh->prepare($sql);
                $stmt->execute(array($counter, $idcronograma, $task->id_tarea_cronograma_PK));
                $counter++;
            }
            return true;

        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }

    public function getStatisticsCompletedTasks()
    {
        try {
            $sql = "SELECT
            COALESCE(ROUND(SUM(CASE WHEN estado = 1 AND fecha BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 WEEK) AND CURDATE() THEN 1 ELSE 0 END) / COUNT(CASE WHEN fecha BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 WEEK) AND CURDATE() THEN 1 ELSE NULL END) * 100), 0) AS last_week,
            COALESCE(ROUND(SUM(CASE WHEN estado = 1 AND fecha BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 MONTH) AND CURDATE() THEN 1 ELSE 0 END) / COUNT(CASE WHEN fecha BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 MONTH) AND CURDATE() THEN 1 ELSE NULL END) * 100), 0) AS last_month,
            COALESCE(ROUND(SUM(CASE WHEN estado = 1 AND fecha BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 YEAR) AND CURDATE() THEN 1 ELSE 0 END) / COUNT(CASE WHEN fecha BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 YEAR) AND CURDATE() THEN 1 ELSE NULL END) * 100), 0) AS last_year,
            COALESCE(ROUND(SUM(CASE WHEN estado = 1 THEN 1 ELSE 0 END) / COUNT(*) * 100), 0) AS `all`
        FROM cronograma c
        LEFT JOIN tarea_cronograma tc ON c.id_cronograma_PK = tc.id_cronograma_FK
        WHERE c.id_usuario_FK = ?;;
            ";
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute(array($this->session));
            return $stmt->fetch();

        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }
    public function lastTenCronogramas($id_user)
    {
        try {
            $sql = "SELECT * from cronograma WHERE id_usuario_FK = ? ORDER BY fecha DESC LIMIT 10";
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute([$id_user]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }

    public function move(
        $id_cronograma_fuente,
        $id_cronograma_destino,
        $id_tarea
    ) {
        var_dump(
            $id_cronograma_fuente,
            $id_cronograma_destino,
            $id_tarea
        );
        try {
            $is_mine_cronograma_fuente = $this->getOne($id_cronograma_fuente);
            $is_mine_cronograma_destino = $this->getOne($id_cronograma_destino);
            if (!$is_mine_cronograma_fuente || !$is_mine_cronograma_destino) {
                throw new Error("No esta autorizado para esta operacion");
            }
            $task = $this->getOneTask($id_tarea);
            $task->idcronograma = $id_cronograma_destino;
            $this->insertTareaCronograma((array) $task);
            $this->eliminarTareaCronograma($id_tarea);
        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }

}