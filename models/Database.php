<?php
class Database
{
    public static function Connect()
    {
      try{
           $dbhost = "localhost";
           $dbuser = "root";
           $dbpass = "";
           $dbname = "tomanotas";
         
           $dsn = "mysql:host={$dbhost};dbname={$dbname};charset=utf8";
           $dbh = new PDO($dsn,$dbuser,$dbpass);
           $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
           $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);

           return $dbh;
      }catch(PDOException $e){
        exit($e->getMessage());
      }
    
    }   
}

?>