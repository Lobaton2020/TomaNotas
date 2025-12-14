<?php

class Link
{
    private $dbh;
    private $session;

    public function __construct()
    {

        $this->dbh = Database::Connect();
        $this->session = $_SESSION["id_user"];
    }
    private function generateSearchLikeClause($search)
    {
        $search = trim($search);
        if (empty($search)) {
            return array('', array());
        }
        
        $keywords = array_filter(explode(' ', $search), function($word) {
            return !empty(trim($word));
        });
        $keywords = array_values($keywords);
        
        $clauses = array();
        $params = array();
        
        foreach ($keywords as $keyword) {
            $clauses[] = "(LOWER(url_link) LIKE LOWER('%' ? '%') OR LOWER(titulo) LIKE LOWER('%' ? '%'))";
            $params[] = $keyword;
            $params[] = $keyword;
        }
        
        return array(implode(' AND ', $clauses), $params);
    }


    public function getAll($init, $search = null)
    {
        try {
            $clauses = $this->generateSearchLikeClause($search);
            $params = array_merge($clauses[1], array($this->session));
            $andStr = $clauses[0] != '' ? ' AND ' : '';
            $clauses[0] .= " {$andStr} id_usuario_FK = ?";
            $sql = "SELECT * FROM Link WHERE {$clauses[0]} ORDER BY id_link_PK DESC LIMIT {$init}";
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute($params);
            $res = $stmt->fetchAll();

            return $res;
        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }

    public function verHabilitadoLink()
    {
        try {
            $sql = "SELECT id_link_PK FROM Link where url_link LIKE 'http://%' OR  url_link LIKE 'https://%' ";
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute(array($this->session));

            return $stmt->fetchAll();
        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }

    public function search($link)
    {
        try {
            $sql = "SELECT * FROM Link WHERE id_usuario_FK  = ? AND (url_link LIKE '%' ? '%' OR titulo LIKE '%' ? '%') ORDER BY id_link_PK DESC limit 20";
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute(array($this->session, $link, $link));

            $res = $stmt->fetchAll();
            return $res;
        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }

    public function getone($id)
    {
        try {
            $sql = "SELECT * FROM Link WHERE id_link_PK = ? AND id_usuario_FK  = ? ";
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute(array($id, $this->session));

            return $stmt->fetch();
        } catch (Exception $e) {
            exit("Error: " . $e->getMessage());
        }
    }

    public function update($data)
    {
        try {
            $sql = "UPDATE Link SET titulo = ?, url_link = ? where id_link_PK = ? and id_usuario_FK  = ? ";
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute(array(
                $data["titulo"],
                $data["url"],
                $data["id"],
                $this->session
            ));

            return true;
        } catch (Exception $e) {
            exit("Error: " . $e->getMessage());
        }
    }

    public function create($data)
    {
        try {
            $sql = "SELECT * FROM Link WHERE url_link = ? AND id_usuario_FK = ?";
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute(array($data["url"], $this->session));

            if (!$stmt->fetch()) {
                $fecha = date("Y-m-d H:m:i");
                $stmt = $this->dbh->prepare("INSERT INTO Link VALUES(null,?,?,?,?)");
                $stmt->execute(array(
                    $this->session,
                    $data["titulo"],
                    $data["url"],
                    $fecha
                ));

                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $sql = "DELETE FROM Link where id_link_PK = ? and id_usuario_FK = ?";
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute(array($id, $this->session));

            return true;
        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }

    public function insertShareLink($datos)
    {
        try {
            $sql = "INSERT INTO Link_Compartido values(?,?,?,?,?)";
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute(array(
                null,
                $datos["idusuarioentrega"],
                $datos["idusuariorecibe"],
                $datos["idlink"],
                $datos["fecha"],
            ));

            return true;
        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }
    public function getLinksCompartidos()
    {
        try {
            $sql = "CALL Links_Compartidos(?)";
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute(array($this->session));

            return $stmt->fetchAll();
        } catch (Exception $e) {
            exit("Error: " . $e->getMessage());
        }
    }

    public function deleteShareLink($id)
    {
        try {
            $sql = "DELETE FROM Link_Compartido where id_link_compartido_PK = ? and (id_usuario_entrega_FK = ? OR id_usuario_recibe_FK = ? )";
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute(array($id, $this->session, $this->session));

            return true;
        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }
}
