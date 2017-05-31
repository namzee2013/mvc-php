<?php
require_once 'app/init.php';
$app = new App;
$controller = $app->controller->name;
$method = $app->method;

//print_r($controller.'/'.$method.'.php');
// $file = $controller .'/'. $method.'.php';
// print_r($file);
// if (file_exists($file)) {
//   echo "OK";
// }else{
//   echo "ERRRRRR";
// }
include($controller.'/'.$method.'.php');
