<?php

class Cronograma
{
    private $dbh;
    private $session;

    public function __construct()
    {

        $this->dbh = Database::Connect();

    }

    public function insertCronograma($datos)
    {
        $fecha = date("Y-m-d H:m:i");
        try {
            $sql = "INSERT INTO cronograma values(?,?,?,?)";
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute(array(null, $datos["idusuario"], $datos["titulo"], $fecha));
            return true;
        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }

    public function getAllCronograma($idusuario)
    {
        try {
            $sql = "SELECT * FROM cronograma WHERE id_usuario_FK = ? ORDER BY id_cronograma_PK DESC";
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
            $sql = "INSERT INTO tarea_cronograma values(?,?,?,?,?,?,?,?)";
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute(array($datos["idtareacronograma"],
                $datos["idcronograma"],
                $datos["descripcion"],
                $datos["hora"],
                $datos["minuto"],
                $datos["meridiano"],
                    $datos["estado"],
                    $datos["project_id"]
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
            $stmt->execute(array($datos["hora"],
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
            $sql = "UPDATE cronograma SET titulo = ? WHERE id_cronograma_PK = ?";
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute(array($datos["titulo"], $datos["idcronograma"]));
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
            $sql = "SELECT * FROM cronograma WHERE id_cronograma_PK = ?";
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute(array($idcronograma));
            return $stmt->fetch();

        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }


    function copy(Int $cronogramaId){
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
                $sql = "INSERT INTO tarea_cronograma values(?,?,?,?,?,?,?)";
                $stmt = $this->dbh->prepare($sql);
                $stmt->execute(array(
                    null,
                    $newCronogramaId,
                    $tarea_cronograma["descripcion"],
                    $tarea_cronograma["hora"],
                    $tarea_cronograma["minuto"],
                    $tarea_cronograma["meridiano"],
                    0));
            }
            $this->dbh->commit();
            return true;
        } catch(PDOException $e) {
            $this->dbh->rollback();
            exit($e->getMessage());
        }

    }
}
