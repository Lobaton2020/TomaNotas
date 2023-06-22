<?php
class BaseController
{
    function __construct($session)
    {
        if (!isset($session["id_user"]) && empty($session["id_user"])) {
            echo "<script> window.location.href ='?c=auth&cod=A005';</script>";
            exit();
        }
    }
}
