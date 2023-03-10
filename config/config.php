<?php

$env = file_get_contents("./.env");
if (!$env) {
    exit("ENVIROMENT FILE NOT FOUND");
}
foreach (explode("\n", $env) as $dotenven) {
    if (strlen($dotenven) > 3) {
        $key = explode("=", $dotenven)[0];
        $value = explode("=", $dotenven)[1];
        $_ENV[$key] = $value;
    }
}
define("DBHOST", trim($_ENV["DB_HOST"]));
define("DBNAME", trim($_ENV["DB_NAME"]));
define("DBUSER", trim($_ENV["DB_USER"]));
define("DBPASWORD", trim($_ENV["DB_PASWORD"]));
