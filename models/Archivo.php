<?php

class Archivo
{
   private $dbh;
   private $session;

   public function __construct()
   {

      $this->dbh = Database::Connect();
      $this->session = $_SESSION["id_user"];
   }
   public function renombrar($id,$old,$new)
   {
     $old = "archivos/user". $this->session."/".$old;
     $new = "archivos/user". $this->session."/".$new;
     try{            
     if(rename($old,$new)){
        
       $path = "archivos/user".$this->session."/".pathinfo($new,PATHINFO_BASENAME);
       $sql = "UPDATE Archivo SET ruta = ? where id_archivo_PK = ? AND id_usuario_FK  = ? AND estado = 1";
       $stmt = $this->dbh->prepare($sql);
       $stmt->execute(array($path,$id,$this->session));
       
        return true;
      }else{
        echo false;
       
      }
         
        }catch(Exception $e){
          exit($e->getMessage());
        }
      }
   
   
   public function getall()
   {
     try{            
         $sql = "SELECT * FROM Archivo where id_usuario_FK = ? AND estado = 1  ORDER BY id_archivo_PK DESC";
         $stmt = $this->dbh->prepare($sql);
         $stmt->execute(array($this->session));
         return $stmt->fetchAll();
         
        }catch(Exception $e){
          exit($e->getMessage());
        }
      }

      public function getall_archivo_compartido()
      {
        try{            
            $sql = "SELECT * FROM Consulta_Archivo_Compartido where id_usuario_entrega_FK = ? OR id_usuario_recibe_FK = ?  ORDER BY id_archivo_compartido_PK DESC";
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute(array($this->session,$this->session));
            return $stmt->fetchAll();
            
           }catch(Exception $e){
             exit($e->getMessage());
           }
         }

      public function buscar_archivo($value)
      {
        try{            
            $sql = "SELECT * FROM Archivo where ruta like '%' ? '%' AND id_usuario_FK= ? AND estado = 1  ORDER BY id_archivo_PK DESC";
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute(array($value,$this->session));
            return $stmt->fetchAll();
            
           }catch(Exception $e){
             exit($e->getMessage());
           }
         }


         public function compartir($data)
         {
           $fecha = date("Y-m-d");
           try{            
               $sql = "INSERT INTO Archivo_Compartido VALUES(?,?,?,?,?)";
               $stmt = $this->dbh->prepare($sql);
               $stmt->execute(array(null,
                                   $data["id_user_entrega"],
                                   $data["id_user_recibe"],
                                   $data["id_file"],
                                   $fecha));
               return true;
               
              }catch(Exception $e){
                exit($e->getMessage());
              }
            }
   
         

      public function create($data){

        try{
          $tmp = $data["archivos"]["tmp_name"];
          $name = $data["archivos"]["name"];
          $size = $data["archivos"]["size"];
          $type = $data["archivos"]["type"];
          
          
          if(!file_exists("archivos/user" . $this->session)){
            mkdir("archivos/user" . $this->session,0777,true);
              return $this->ejecucion_sql($tmp,$name,$size,$type);
          }else{
              return  $this->ejecucion_sql($tmp,$name,$size,$type);
          }
            
          }catch(Exception $e){
            exit($e->getMessage());
          }
        }
        
        // funcion para guardar datos es de ayuda
        private function ejecucion_sql($tmp,$name,$size,$type){
 

          $fecha = date("Y-m-d");
        //  a($tmp);
          for($i = 0 ; $i < count($tmp) ; $i++){ 

            
            $ruta = "archivos/user" . $this->session."/".$name[$i];
            $filename  =  pathinfo($name[$i], PATHINFO_FILENAME);                
            $extension = pathinfo($name[$i], PATHINFO_EXTENSION);
            
                   $rutas = $this->revisar_duplicados();
                          foreach($rutas as $ruta_d){ 

                            if($ruta == $ruta_d->ruta){

                              $filas = $this->getfilas($filename)->filas;

                              if($filas > 0){
                                    $ruta = "archivos/user" . $this->session."/". $filename."(Copy)(" . $filas . ")."."$extension";

                              }
                          }
                          }
            
            if(move_uploaded_file($tmp[$i],$ruta)){
              
                        $size[$i] = ($size[$i] * 0.000001) / 1;   
                        $stmt = $this->dbh->prepare("INSERT INTO Archivo values(?,?,?,?,?,?,?)");
                        $stmt->execute(array(null,
                                         $this->session,
                                         $ruta,
                                         $size[$i],
                                         $type[$i],
                                         1,
                                         $fecha));
              if($i == (count($tmp) - 1)){
                return true;
              }
          
                }else{
          
                  return false;
 
                }
           
         
          }
        }
           public function revisar_duplicados()
         {
            try{
               $sql = "SELECT ruta FROM Archivo WHERE id_usuario_FK = ? AND estado = 1";
               $stmt = $this->dbh->prepare($sql);
               $stmt->execute(array($this->session));

              return $stmt->fetchAll();
           }catch(Exception $e){
                 exit($e->getMessage());
              } 
         }
        
         private function getfilas($filename){
           try{
                   $sql = "SELECT count(*) as filas FROM Archivo WHERE ruta like '%' ? '%' AND id_usuario_FK  = ?";
                   $stmt = $this->dbh->prepare($sql);
                   $stmt->execute(array($filename,$this->session));

                   return $stmt->fetch();

          }catch(Exception $e){
             exit("Error: " . $e->getMessage());
         } 
         } 
         
         
      
      
        public function getone($id){
        try{
        
        $sql = "SELECT * FROM Archivo WHERE id_archivo_PK = ? AND id_usuario_FK = ? AND estado = 1";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute(array($id,$this->session));
        
        return $stmt->fetch();

      }catch(Exception $e){
            exit("Error: " . $e->getMessage());
         } 
     }

     public function getoneCompartido($id){
      try{
      
      $sql = "SELECT * FROM Archivo WHERE id_archivo_PK = ? AND estado = 1";
      $stmt = $this->dbh->prepare($sql);
      $stmt->execute(array($id));
      
      return $stmt->fetch();

    }catch(Exception $e){
          exit("Error: " . $e->getMessage());
       } 
   }

   public function deleteCompartido($id){
    try{
      $sql = "DELETE FROM Archivo_Compartido WHERE id_archivo_compartido_PK = ?";
      $stmt = $this->dbh->prepare($sql);
      $stmt->execute(array($id));
      
     return true;
    }catch(Exception $e){
       exit($e->getMessage());
    }
  }


 public function delete($id){
   try{
     $sql = "UPDATE Archivo SET estado = 0 where id_archivo_PK = ? and id_usuario_FK = ?";
     $stmt = $this->dbh->prepare($sql);
     $stmt->execute(array($id,$this->session));
     
    return true;
   }catch(Exception $e){
      exit($e->getMessage());
   }
 }

}
?>