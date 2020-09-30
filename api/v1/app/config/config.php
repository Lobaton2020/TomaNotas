<?php
// Constantes de nuestra base de datos
define("DBHOST", "localhost");
define("DBNAME", "tomanotas");
define("DBUSER", "root");
define("DBPASWORD", "12345");
define("DBDRIVER", "mysql");
define("DBCHARSET", "utf8");
// alternative to get all data
define("DBNAMEALTERNATIVE", "tomanotas_old");
// Constantes de nuestro servidor de correo
define("SMTPHOST", "mail.socialnet.ibx.lat");
define("SMTPUSER", "_mainaccount@socialnet.ibx.lat");
define("SMTPASSWORD", "34234hkhkj@@@");
define("SMTPPORT", 465);
// PRODUCTION or DEVELOP
define("STATE_APP", "DEVELOP");
// datos del servidor
define("SEPARATOR", "\\");
define("APP_PATH", dirname(dirname(__FILE__)) . "\\");
define("SYS_PATH", dirname(dirname(dirname(__FILE__))) . "\\core\\");

// @ for the execute un console
@define("URL_PROJECT",  $_SERVER["REQUEST_SCHEME"] . '://' . $_SERVER["HTTP_HOST"] . str_replace(basename($_SERVER["PHP_SELF"]), "", $_SERVER["PHP_SELF"]));
@define("URL_APP",  $_SERVER["REQUEST_SCHEME"] . '://' . $_SERVER["HTTP_HOST"] . dirname(str_replace(basename($_SERVER["PHP_SELF"]), "", $_SERVER["PHP_SELF"])) . "/app/");
