<?php
// FrontController
require_once "models/Database.php";
session_start();

 $controller = "Auth"."Controller";

  if(!isset($_REQUEST["c"])){
                 
       $controller = ucwords($controller);
       require_once "controllers/{$controller}.php";
       $controller = new $controller();
       $controller->index();

   }else{
       $controller = ucwords($_REQUEST["c"])."Controller";
       $method = isset($_REQUEST["m"]) ? $_REQUEST["m"] : "index"; 
       
       if(file_exists("controllers/{$controller}.php")){
             require_once "controllers/{$controller}.php";

               if(class_exists($controller)){
                     $controller = new $controller();

                      if(method_exists($controller,$method)){
                         call_user_func(array($controller,$method));

                      }else{
                        header("location:?method_not_found");
                     }
               }else{
                 header("location:?class_not_found");        
               }
       }else{
           header("location:?file_not_found");
       }
    }

?>