<?php

class Nota
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

         $sql = "SELECT * FROM Nota where id_usuario_FK = ? AND estado = 1 ORDER BY id_nota_PK DESC";
         $stmt = $this->dbh->prepare($sql);
         $stmt->execute(array($this->session));
         return $stmt->fetchAll();

      
    }catch(Exception $e){
        exit($e->getMessage());
     }
   }



   public function getone($id)
   {
    
    try{
        $sql = "SELECT * FROM Nota WHERE id_nota_PK = ? AND id_usuario_FK  = ? AND estado = 1";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute(array($id,$this->session));
  
         return $stmt->fetch();
  
        
      }catch(Exception $e){
          exit($e->getMessage());
       } 
   }

   public function update($data){
      try{

          $sql = "UPDATE Nota SET titulo = ?, descripcion = ? where id_nota_PK = ? and id_usuario_FK = ?";
          $stmt = $this->dbh->prepare($sql);
          $stmt->execute(array(
                               $data["new_titulo"],
                               $data["nueva_descripcion"],
                               $data["id"],
                               $this->session));
  
       return true;
  
      }catch(Exception $e){
         exit($e->getMessage());
      }
    }
  



   public function create($data){
     try{
        $fecha = date('Y-m-d');
        $stmt = $this->dbh->prepare("INSERT INTO Nota VALUES(?,?,?,?,?,?)");
        $stmt->execute(array(null,
                            $this->session,
                            $data["titulo"],
                            $data["descripcion"],
                            1,
                            $fecha));

      return true;

   }catch(Exception $e){
      exit($e->getMessage());
   }
 }



 public function delete($id){
   try{
     $sql = "UPDATE Nota SET estado = 0  where id_nota_PK = ? and id_usuario_FK  = ?";
     $stmt = $this->dbh->prepare($sql);
     $stmt->execute(array($id,$this->session));
     
    return true;
   }catch(Exception $e){
      exit($e->getMessage());
   }
 }

}
?>