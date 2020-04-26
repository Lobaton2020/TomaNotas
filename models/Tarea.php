<?php

class Tarea
{
   private $dbh;
   private $session;

   public function __construct()
   {

        $this->dbh = Database::Connect();
        $this->session = $_SESSION["id_user"];


   }



   public function getAll()
   {
     try{
            $sql = "SELECT * FROM Tarea WHERE id_usuario_FK = ? ORDER BY id_tarea_PK DESC";
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute(array($this->session));
            
            return $stmt->fetchAll();
    }catch(Exception $e){
        exit($e->getMessage());
     }
   }



   public function getOne($id)
   {
    try{
        $sql = "SELECT * FROM Tarea WHERE id_tarea_PK = ? AND id_usuario_FK  = ? ";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute(array($id,$this->session));
  
         return $stmt->fetch();
      }catch(Exception $e){
          exit("Error: " . $e->getMessage());
       } 
   }



   public function updateDescription($id,$description){
      try{
          $sql = "UPDATE Tarea SET descripcion = ? where id_tarea_PK = ? and id_usuario_FK  = ? ";
          $stmt = $this->dbh->prepare($sql);
          $stmt->execute(array($description,
                               $id,
                               $this->session));
       return true;
      }catch(Exception $e){
         exit("Error: " . $e->getMessage());
      }
    }


  
    public function updateState($id,$n_state){
        try{
            $sql = "UPDATE Tarea SET estado = ? where id_tarea_PK = ? and id_usuario_FK  = ? ";
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute(array($n_state,
                                 $id,
                                 $this->session));
         return true;
        }catch(Exception $e){
           exit("Error: " . $e->getMessage());
        }
      }
    



   public function insert($data){
     try{
        $fecha = date('Y-m-d"');
        $hora = date("H:m:i");
        // echo $hora;
        $stmt = $this->dbh->prepare("INSERT INTO Tarea VALUES(null,?,?,?,?,?)");
        $stmt->execute(array(
                            $this->session,
                            $data["descripcion"],
                            $fecha,
                            $hora,
                            0));

      return true;

   }catch(Exception $e){
      exit($e->getMessage());
   }
 }



 public function delete($id){

   try{
     $sql = "DELETE FROM Tarea where id_tarea_PK = ? and id_usuario_FK = ?";
     $stmt = $this->dbh->prepare($sql);
     $stmt->execute(array($id,$this->session));

      return true;

   }catch(Exception $e){
      exit($e->getMessage());
   }
 }


 public function reiniciarTareas(){
   
try{

   $sql = "SELECT id_tarea_PK FROM Tarea WHERE id_usuario_FK = ?";
   $stmt = $this->dbh->prepare($sql);
   $stmt->execute(array($this->session));
   $total = $stmt->fetchAll();

 
   for($i=0;$i<count($total);$i++){

       $sql = "UPDATE Tarea SET estado = 0 WHERE id_tarea_PK = ? and id_usuario_FK = ?";
       $stmt = $this->dbh->prepare($sql);
       $stmt->execute(array( $total[$i]->id_tarea_PK,
                             $this->session));
   }

       return true;
 
    }catch(Exception $e){
       exit($e->getMessage());
    } 
}

public function getNumTask()
{
 try{
     $sql = "SELECT count(*) as num FROM Tarea WHERE id_usuario_FK  = ? ";
     $stmt = $this->dbh->prepare($sql);
     $stmt->execute(array($this->session));
     $total_t = $stmt->fetch()->num;
 
     $sql = "SELECT count(*) as num_t FROM Tarea WHERE id_usuario_FK  = ? and estado = 0 ";
     $stmt = $this->dbh->prepare($sql);
     $stmt->execute(array($this->session));
     $t_faltan = $stmt->fetch()->num_t;
     
      return [$total_t,$t_faltan];
   }catch(Exception $e){
       exit("Error: " . $e->getMessage());
    } 
}

}
?>