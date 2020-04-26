<?php
class Database
{
    public static function Connection()
    {
        // datos con miarroba.com
        // $host = "localhost";
        // $user = "root";
        // $pass = "";
        // $dbname = "andreslobaton";
       //datos con host local 
       try {
       
        $host = "localhost";
        $user = "root";
        $pass = "";
        $dbname = "andreslobaton"; 
        
        $dsn = "mysql:host={$host};dbname={$dbname};charset=utf8";
        $dbh = new PDO($dsn,$user,$pass);
        $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
        
        return $dbh;
            
       } catch (PDOException $e) {
          exit("Error: " . $e->getMessage());
    }
    
    }   
}

?>