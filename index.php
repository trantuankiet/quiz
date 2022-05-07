<?php
require('system/autoload.php');

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

$controllerName = $uri[2];
if (isset($uri[3])) {
  $actionName = $uri[3];
} else {
  $actionName = "";
}

$input = (array) json_decode(file_get_contents('php://input'), TRUE);

if (class_exists($controllerName)) {
  $controller = new $controllerName();

  if ($actionName && method_exists($controller, $actionName)) {
    $controller->$actionName();
  } else {
    $controller->index();
  }
} else {

}
