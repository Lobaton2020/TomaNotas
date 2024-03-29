<?php

class Administrador
{

    public function __construct()
    {
        $this->dbh = Database::Connect();
    }

    public function getall_user()
    {
        try {

            $stmt = $this->dbh->prepare("SELECT * FROM Usuario");
            $stmt->execute();

            return $stmt->fetchAll();

        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }

    public function getall_history_login()
    {
        try {
            $stmt = $this->dbh->prepare("SELECT * FROM Consulta_Registro_Login Where id_registro_login_PK limit 30;");
            $stmt->execute();
            return $stmt->fetchAll();

        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }

    public function insert_history_login($id_user)
    {
        $fecha = date("Y-m-d");
        $hora = date("G:i:s");
        try {
            $stmt = $this->dbh->prepare("INSERT INTO Registro_Login VALUES(?,?,?,?)");
            $stmt->execute(array(null, $id_user, $fecha, $hora));
            return true;

        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }

    public function getnumber_historial()
    {
        try {
            $stmt = $this->dbh->prepare("SELECT * FROM Registro_Login");
            $stmt->execute();
            return $stmt->rowCount();

        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }

    public function getnumber_user()
    {
        try {
            $stmt = $this->dbh->prepare("SELECT * FROM Usuario");
            $stmt->execute();
            return $stmt->rowCount();

        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }

    public function delete_history_login($id)
    {
        try {
            $stmt = $this->dbh->prepare("DELETE FROM Registro_Login WHERE id_registro_login_PK = ?");
            $stmt->execute(array($id));
            return true;

        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }

    public function getall_notificacion()
    {
        try {
            $stmt = $this->dbh->prepare("SELECT * FROM Consulta_Notificacion WHERE id_usuario_PK != ? AND id_notificacion_PK limit 30");
            $stmt->execute(array($_SESSION["id_user"]));
            return $stmt->fetchAll();

        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }

    public function getnumber_notificacion()
    {
        try {
            $stmt = $this->dbh->prepare("SELECT * FROM Notificacion WHERE id_usuario_FK != ?");
            $stmt->execute(array($_SESSION["id_user"]));
            return $stmt->rowCount();

        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }

    public function insert_notificacion($id_user, $tipo)
    {
        $fecha = date("Y-m-d H:i:s");
        try {
            $stmt = $this->dbh->prepare("INSERT INTO Notificacion VALUES(?,?,?,?)");
            $stmt->execute(array(null, $id_user, $tipo, $fecha));
            return true;

        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }

    public function delete_notificacion($id)
    {
        try {
            $stmt = $this->dbh->prepare("DELETE FROM Notificacion WHERE id_notificacion_PK = ?");
            $stmt->execute(array($id));
            return true;

        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }

    public function getall_reportes_user()
    {
        try {
            $arrayReporte = array();
            $stmt = $this->dbh->prepare("SELECT * FROM Reporte_Modulos");
            $stmt->execute();
            return $stmt->fetchAll();

        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }

}
