<?php
require __DIR__ . "/bootstrap.php";
require __DIR__ . "/routes.php";
require PROJECT_ROOT_PATH . "/Controller/ClienteController.php";
require PROJECT_ROOT_PATH . "/Controller/TelefonoController.php";
 
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

if(count($uri) > 4){
    $route = IdentifyRoute($uri);
    if(count($route) > 0 ){
        CallAction($route);
    }else{
        NotFoundRequest();
    }
}else{
    NotFoundRequest();
}

function NotFoundRequest(){
    header("HTTP/1.1 404 Not Found");
    exit();
}

function IdentifyRoute($uri = []){
    $CurrentAction = $uri[count($uri) - 1];
    $CurrentModel = $uri[count($uri) - 2];
    $ActiveRoute = [];
    foreach (PROJECT_ROUTES as $IterateRoute) {
        if(strtolower($IterateRoute["Accion"]) == strtolower($CurrentAction) &&  strtolower($IterateRoute["Model"]) == strtolower($CurrentModel)){   
            $ActiveRoute = $IterateRoute;
            break;
        }
    }

    return $ActiveRoute;
}


function CallAction($route = []){
    $controllerName =ucfirst($route["Model"])."Controller";
    $instanceController = new $controllerName();
    $strMethodName = ucfirst($route["Accion"]) . ucfirst($route["Model"]);
    $instanceController->{$strMethodName}();

}




/*Ejercicio para Backend : 
Hacer un API REST (preferiblemente sin usar a un framework) para manejar una lista de contactos.
Tenemos que poder agregar nuevos contactos (nombre, apellido, email), listar los contactos y eliminar un contacto.


Recomendación: La API tiene que seguir las buenas prácticas de arquitectura en capa para separar el acceso a los datos.
Bonus 1 : Agregar reglas de validación para no permitir de ingresar a datos vacías
Bonus 2: Permitir agregar uno o varios números de teléfono a cada contacto.
La API se llama desde una herramienta como Postman */

