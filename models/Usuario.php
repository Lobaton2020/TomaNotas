<?php
class Usuario{

    private $dbh;

    public function __construct(){

        $this->dbh = Database::Connect();
    }

    public function login($user,$pass){
    
        $stmt = $this->dbh->prepare("SELECT * FROM Usuario WHERE nickname = ? and estado = 1");
        $stmt->execute(array($user));
        $resp = $stmt->fetch();

        if($resp){
            if(password_verify($pass,$resp->clave)){

                $_SESSION["id_user"] = $resp->id_usuario_PK;
                $_SESSION["rol_user"] = $resp->id_rol_FK;
                $_SESSION["nickname_user"] = $resp->nickname;
                $_SESSION["correo_user"] = $resp->correo;
                $_SESSION["name"] = $resp->nombre;
                $_SESSION["lastname"] = $resp->apellido;

   
                 return true;
             }else{
                 return false;
             }
         }else{
             return false;
         }
    }

    

    public function getone($id)
    {
     try{
         $sql = "SELECT * FROM Usuario WHERE id_usuario_PK = ? AND estado = 1";
         $stmt = $this->dbh->prepare($sql);
         $stmt->execute(array($id));
   
          return $stmt->fetch();
   
         
       }catch(Exception $e){
           exit($e->getMessage());
        } 
    }

    public function insert($data){

        $stmt = $this->dbh->prepare("SELECT correo from Usuario where estado = 1");
        $stmt->execute();
        $response = $stmt->fetchAll();
        try{
        
          foreach($response as $res){               
           if($res->correo == $data["correo"]){
               return false;
           }
        }    
            $fecha = date("Y-m-d"); 
            $stmt = $this->dbh->prepare("INSERT INTO Usuario values (?,?,?,?,?,?,?,?,?,?)");
            $stmt->execute(array(null,
                                 ($data["correo"] == "andrespipe021028@gmail.com" || $data["correo"] == "aflobaton@misena.edu.co") ? 1 : 2,
                                 $data["nombre"],
                                 $data["apellido"],
                                 $data["correo"],
                                 $data["nickname"],
                                 password_hash($data["clave"],PASSWORD_BCRYPT),
                                 1,
                                 $data["fecha_nacimiento"],
                                 $fecha
          ));

          $stmt = $this->dbh->prepare("SELECT id_usuario_PK FROM Usuario WHERE correo = ? AND estado = 1");
          $stmt->execute(array($data["correo"]));
    
          $array = [true,$stmt->fetch()->id_usuario_PK];
          return $array;

        }catch(Exception $e){
          exit($e->getMessage());
        }
    }

    

    public function updatePass($data)
    {   
      try{

        $pass = password_hash($data["clave"],PASSWORD_BCRYPT);
        $stmt = $this->dbh->prepare("UPDATE Usuario SET clave = ? WHERE id_usuario_PK = ? AND estado = 1");
        $stmt->execute(array($pass,$data["id"]));

       return true;

      }catch(Exception $e){
         exit($e->getMessage());
      }
    

    }



    public function updateUser($data)
    {   



        try{
          $sql = "UPDATE Usuario set  nombre   = ? ,
                                      apellido = ? ,
                                      correo   = ? ,
                                      nickname = ? ,
                                      fecha_nacimiento = ?

                    where id_usuario_PK = ?";



            $stmt = $this->dbh->prepare($sql);
            $stmt->execute(array($data["nombre"],
                                 $data["apellido"],
                                 $data["correo"],
                                 $data["nickname"],
                                 $data["fecha_nacimiento"],
                                 $data["id"]
          ));
          
          return true;

        }catch(Exception $e){
          exit($e->getMessage());
        }
    }
   

    public function actulizarDatos($id){
        try{
          $sql = "SELECT * FROM Usuario WHERE id_usuario_PK = ? AND estado = 1 ";
          $stmt = $this->dbh->prepare($sql);
          $stmt->execute(array($id));
          $resp = $stmt->fetch();
          if($resp)
          {
            $_SESSION["nickname_user"] = $resp->nickname;
            $_SESSION["correo_user"] = $resp->correo;
          }
         return true;
        }catch(Exception $e){
           exit($e->getMessage());
        }
    }


    public function delete($id){
        try{
          $sql = "UPDATE Usuario SET estado = 0 WHERE id_usuario_PK = ? ";
          $stmt = $this->dbh->prepare($sql);
          $stmt->execute(array($id));
          
         return true;
        }catch(Exception $e){
           exit($e->getMessage());
        }
      }

      public function forgot_pass($correo){
        try{
          $sql = "SELECT *  FROM Usuario WHERE correo = ? and estado = 1";
          $stmt = $this->dbh->prepare($sql);
          $stmt->execute(array($correo));
          $usuario = $stmt->fetch();

          if($usuario->correo !== $correo){
 
            return "NO_EXIST";
          }else{

            $new_clave = random_int(100000,999999);


            $contenido =   '<!DOCTYPE html>';
            $contenido .= '<html lang="en">';
            $contenido .= '<head>';
            $contenido .= '	<meta charset="UTF-8">';
            $contenido .= '	<title>Recuperacion Contraseña | Andres Lobaton</title>';
            $contenido .= '	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>';
            $contenido .= '    <meta name="viewport" content="width=device-width, user-scalable=no">';
            $contenido .= '    <meta http-equiv="X-UA-Compatible" content="IE=edge"> ';
            $contenido .= '    <!-- mas contenido del auto y  de posissionamiento -->';
            $contenido .= '	<link rel="stylesheet" href="libs/fontawesome/css/all.css">';
            $contenido .= '	<link href="libs/bootstrap/css/bootstrap.min.css" rel="stylesheet" >';
            $contenido .= '    <link class="icon" rel=icon sizes="32x32" type="image/png" href="assets/img/logo.png">';
            $contenido .= '    <link rel="stylesheet" href="assets/css/estilos.css">';
            $contenido .= '</head>';
            $contenido .= '<body>';
            $contenido .= '';
            $contenido .= '<div class="container">';
            $contenido .= '  <p>Hola <b>'. $usuario->nombre ." ". $usuario->apellido .'.</b></p>';
            $contenido .= '  <p>Usted solicitó un restablecimiento de contraseña para su cuenta <br> <b>'. $usuario->nickname .' </b> en TomaNotas - Andres Lobaton.</p>';
            $contenido .= '  <p>El codigo para la recuperacion de tu cuenta es: <h2>'.$new_clave .'</h2></p>';
            $contenido .= '  ';
            $contenido .= '  <p class="text-">- Deber ingresar como contraseña el pin anterior,';
            $contenido .=   ' y como usuario el Nickname de tu cuenta <b>'. $usuario->nickname.'</b>, <br> y luego cambiar inmediatamente tu contraseña.</p>';
            $contenido .= '';
            $contenido .= '<h4>Click en el sigiente link:</h4>';
            $contenido .= '  <p><a href="http://andreslobaton.000webhostapp.com/?c=auth&o&user='. $usuario->nickname .'">http://andreslobaton.000webhostapp.com/?c=auth&user='. $usuario->nickname .'</a></p>';
            $contenido .= '   ';
            $contenido .= '     <div id="<?php echo $e; ?>footer_ver" class="container-fluid nav navbar navbar-default fixed-bottom  bg-primary ">';
            $contenido .= '         <div class="container text-light">';
            $contenido .= '         	<p class="parrafo">&#169; '. date("Y") .' Andres Lobaton - TomaNota |<span class="small"> Version 3.0</small></p>   ';
            $contenido .= '        </div>';
            $contenido .= '    </div>';
            $contenido .= '';
            $contenido .= '  </body></html>';

    


    
            $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
            $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            
            // Cabeceras adicionales
            $cabeceras .= 'To: '. $usuario->nombre .' '. $usuario->apellido .' <'.$usuario->correo.'>' . "\r\n";
            $cabeceras .= 'From: TomaNotas - Andres lobaton <andrespipe021028@gmail.com>' . "\r\n";
            $titulo = "Recuperacion de contraseña | TomaNotas ";
               if(mail($usuario->correo,$titulo,$contenido,$cabeceras)){

                      $stmt = $this->dbh->prepare("UPDATE Usuario SET clave = ? WHERE correo = ? AND id_usuario_PK = ? and estado = 1");
                      $stmt->execute(array(
                        password_hash($new_clave,PASSWORD_BCRYPT),
                        $usuario->correo,
                        $usuario->id_usuario_PK
                       ));

                  $stmt = $this->dbh->prepare("SELECT id_usuario_PK FROM Usuario WHERE correo = ? AND estado = 1");
                  $stmt->execute(array($usuario->correo));
            
                  $array = ["SENT",$stmt->fetch()->id_usuario_PK];
                  return $array;
                }else{
                  return false;

                }
              }
        }catch(Exception $e){
           exit($e->getMessage());
        }
      }

      
    
}

?>