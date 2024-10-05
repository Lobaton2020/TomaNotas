<?php

class Project
{
    private $dbh;
    private $userId;

    public function __construct()
    {

        $this->dbh = Database::Connect();
        $this->userId = $_SESSION["id_user"];
    }

    public function create($data)
    {
        try {
            $sql = "INSERT INTO projects(user_id,name, status, descripcion) values(?,?,?,? )";
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute([$this->userId, $data["name"], $data["status"], $data["descripcion"]]);
            return true;
        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }

    public function findAll()
    {
        try {
            $sql = "SELECT p.*, tps.* from projects p
                    left join time_project_spent tps on p.id = tps.project_id WHERE user_id = ? ORDER BY status DESC";
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute([$this->userId]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }
    public function findAllByStatus($status)
    {
        try {
            $sql = "SELECT id, name FROM projects WHERE user_id = ? AND status = ? ORDER BY id DESC";
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute([$this->userId, $status]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }
    public function findOne($id)
    {
        try {
            $sql = "SELECT * FROM projects WHERE id = ? AND user_id = ?";
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute(array($id, $this->userId));
            return $stmt->fetch();
        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }
    public function update($id, $data)
    {
        try {
            $sql = "UPDATE projects SET name = ?, status = ?, descripcion = ? WHERE id = ? AND user_id = ?";
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute([
                $data["name"], $data["status"], $data["descripcion"],
                $id, $this->userId
            ]);
            return true;
        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }

    public function get_tasks_by_project($project_id, $status)
    {
        try {
            $status_added = "AND tc.estado = {$status}";
            if ($status == "none") {
                $status_added = "";
            }
            $sql = "SELECT tc.*, c.titulo FROM tarea_cronograma tc
            inner join cronograma c on c.id_cronograma_PK  = tc.id_cronograma_FK
            WHERE c.id_usuario_FK = ? AND tc .project_id = ? {$status_added} ORDER BY tc.estado ASC, c.fecha ASC";
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute(array($this->userId, $project_id));
            return $stmt->fetchAll();
        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }
}