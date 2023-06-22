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
            $sql = "SELECT p.*, ROUND(tps.time_difference,1) as hours_spent from projects p
                    left join time_project_spent tps on p.id = tps.project_id WHERE user_id = ? ORDER BY id DESC";
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
}