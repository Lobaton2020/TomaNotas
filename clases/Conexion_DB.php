<?php
//conexion con la base de datos.
class ConexionDB{

public $DB_servidor;
public $DB_usuario;
public $DB_contraseña;
public $DB_nombre;
public $DB_conexion;
	
	function __construct(){
    $this->DB_servidor = "localhost";
    $this->DB_usuario = "root";
    $this->DB_contraseña = "";
    $this->DB_nombre = "Proyecto_Notas";

    }
    public function connect(){

    $this->DB_conexion = mysqli_connect($this->DB_servidor, $this->DB_usuario, $this->DB_contraseña, $this->DB_nombre);
    
    return $this->DB_conexion;
    }
    }
?>
