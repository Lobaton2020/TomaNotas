<?php
// controlador de errores
function a($param)
{
    echo "<pre>";
    echo var_dump($param);
    echo "/<pre>";
    exit();
}
session_name("PHP_SESSION_CUSTOM_1");
// FrontController
session_start();
require_once "config/config.php";
require_once "models/Database.php";
date_default_timezone_set("America/Bogota");

$controller = "Auth" . "Controller";

if (!isset($_REQUEST["c"])) {

    $controller = ucwords($controller);
    require_once "controllers/{$controller}.php";
    $controller = new $controller();
    $controller->index();

} else {
    $controller = ucwords($_REQUEST["c"]) . "Controller";
    $method = isset($_REQUEST["m"]) ? $_REQUEST["m"] : "index";

    if (file_exists("controllers/{$controller}.php")) {
        require_once "controllers/{$controller}.php";

        if (class_exists($controller)) {
            $controller = new $controller();

            if (method_exists($controller, $method)) {
                call_user_func(array($controller, $method));

            } else {
                header("location:?method_not_found");
            }
        } else {
            header("location:?class_not_found");
        }
    } else {
        header("location:?file_not_found");
    }
}
