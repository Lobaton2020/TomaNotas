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



   public function getAll()
   {
     try{
            $sql = "SELECT * FROM Link WHERE id_usuario_FK = ? ORDER BY id_link_PK DESC";
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute(array($this->session));
            $res = $stmt->fetchAll();
            
         $sql_link_user = "SELECT * FROM Link where id_usuario_FK = ? AND (url_link LIKE 'http://%' OR  url_link LIKE 'https://%') ";
         $stmt = $this->dbh->prepare($sql_link_user);
         $stmt->execute(array($this->session));
         $reslink = $stmt->fetchAll();

         return  array($res,$reslink);
      
    }catch(Exception $e){
        exit($e->getMessage());
     }
   }



   
   public function search($link)
   {
      try{
         $sql = "SELECT * FROM Link WHERE id_usuario_FK  = ? AND (url_link LIKE '%' ? '%' OR titulo LIKE '%' ? '%') ORDER BY id_link_PK DESC";
         $stmt = $this->dbh->prepare($sql);
         $stmt->execute(array($this->session,$link,$link));
   
         $res = $stmt->fetchAll();
         return $res;
         
       }catch(Exception $e){
           exit($e->getMessage());
        }      
   }

   public function getone($id)
   {
    try{
        $sql = "SELECT * FROM Link WHERE id_link_PK = ? AND id_usuario_FK  = ? ";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute(array($id,$this->session));
  
         return $stmt->fetch();
  
        
      }catch(Exception $e){
          exit("Error: " . $e->getMessage());
       } 
   }

   public function update($data){
      try{
          $sql = "UPDATE Link SET titulo = ?, url_link = ? where id_link_PK = ? and id_usuario_FK  = ? ";
          $stmt = $this->dbh->prepare($sql);
          $stmt->execute(array(
                               $data["titulo"],
                               $data["url"],
                               $data["id"],
                               $this->session));
  
       return true;
  
      }catch(Exception $e){
         exit("Error: " . $e->getMessage());
      }
    }
  



   public function create($data){
     try{
         $sql = "SELECT * FROM Link WHERE url_link = ? AND id_usuario_FK = ?";
         $stmt = $this->dbh->prepare($sql);
         $stmt->execute(array($data["url"],$this->session));
     
if(!$stmt->fetch()){
        $fecha = date('Y-m-d"');
        $stmt = $this->dbh->prepare("INSERT INTO Link VALUES(null,?,?,?,?)");
        $stmt->execute(array(
                            $this->session,
                            $data["titulo"],
                            $data["url"],
                            $fecha));

      return true;
   }else{
      return false;
   }
   }catch(Exception $e){
      exit($e->getMessage());
   }
 }



 public function delete($id){
   try{
     $sql = "DELETE FROM Link where id_link_PK = ? and id_usuario_FK = ?";
     $stmt = $this->dbh->prepare($sql);
     $stmt->execute(array($id,$this->session));
     
    return true;
   }catch(Exception $e){
      exit($e->getMessage());
   }
 }

}
?>