<?php

class Notas
{
   private $dbh;

   public function __construct()
   {
         $this->dbh = Database::Connection();
   }

   public function show()
   {
     try{
      $sql = "SELECT * FROM notas ORDER BY id ASC";
      $stmt = $this->dbh->prepare($sql);
      $stmt->execute();
      $res = $stmt->fetchAll();

      $sql = "SELECT * FROM notas where descripcion LIKE 'http://%' OR  descripcion LIKE 'https://%'";
      $stmt = $this->dbh->prepare($sql);
      $stmt->execute();
      $reslink = $stmt->fetchAll();
      return  array($res,$reslink);
      
    }catch(Exception $e){
        exit("Error: " . $e->getMessage());
     }
   }
  

   
   public function ajax($link)
   {
      try{
         $sql = "SELECT * FROM notas WHERE descripcion LIKE '%' ? '%'";
         $stmt = $this->dbh->prepare($sql);
         $stmt->execute(array($link));
   
         $res = $stmt->fetchAll();
         return $res;
         
       }catch(Exception $e){
           exit("Error: " . $e->getMessage());
        }      
   }



   public function getone($id)
   {
    try{
        $sql = "SELECT * FROM notas WHERE id = ?";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute(array($id));
  
        $res = $stmt->fetch();
        return $res;
        
      }catch(Exception $e){
          exit("Error: " . $e->getMessage());
       } 
   }



   public function create($data){
    try{
       $fecha = date('d-m-Y  h:i a');

       $sql = "INSERT INTO notas VALUES(null,?,?);";
       $stmt = $this->dbh->prepare($sql);
       $stmt->execute(array(
           $data["descripcion_nota"],
           $fecha));

       return true;
     
    }catch(Exception $e){
       exit("Error: " . $e->getMessage());
    }
  }
   


  public function update($data){
    try{
        $sql = "UPDATE notas SET descripcion = ? where id = ?";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute(array(
            $data["descripcion_nota"],
            $data["id"]));

        return true;

    }catch(Exception $e){
       exit("Error: " . $e->getMessage());
    }
  }



  public function delete($id){
    try{
      $sql = "DELETE FROM notas WHERE id = ?";
      $stmt = $this->dbh->prepare($sql);
      $stmt->execute(array($id));

       return true;
    }catch(Exception $e){
       exit("Error: " . $e->getMessage());
    }
  }
}

?>