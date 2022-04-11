<?php
define("PROJECT_ROOT_PATH", __DIR__ . "/");

require_once PROJECT_ROOT_PATH . "config.php";


require_once PROJECT_ROOT_PATH . "Helpers/Respuesta.php";
 
// include the base controller file
require_once PROJECT_ROOT_PATH . "Controller/Controller.php";
 
// include the use model file
require_once PROJECT_ROOT_PATH . "Model/cliente.php";
require_once PROJECT_ROOT_PATH . "Model/telefono.php";
