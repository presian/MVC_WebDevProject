<?php

include_once '/config/db.php';
include_once '/library/phpLib/database.php';
include_once '/controllers/master.php';
include_once '/models/master.php';

define('ROOT_DIR', dirname(__FILE__)) . '/';
define('ROOT_DIR_NAME', basename(dirname(__FILE__)));

$request = $_SERVER['REQUEST_URI'];

$controller = 'master';
$method = 'index';
$params = array();


if (!empty($request)) {
    $requestAsParts = explode('/', $request);
    $index = array_search(ROOT_DIR_NAME, $requestAsParts);
    $newRequstParts = array_slice($requestAsParts, $index + 1);
    $request = implode('/', $newRequstParts);
    $routPrams = explode('/', $request, 3);
    if (count($routPrams) > 1) {
        list($controller, $method) = $routPrams;
        if (isset($routPrams[2])) {
            $params = $routPrams[2];
        }
        
        include_once 'controllers/' . $controller . '.php';
        include_once 'models/' . $controller . '.php';
    }
    
    $controller_class = '\Controllers\\' . ucfirst($controller) . '_Controller';
    
    $instance = new $controller_class();
    
    if (method_exists($instance, $method)) {
        call_user_func_array(array($instance, $method), array($params));
    }
    
    $db_object = \Lib\Database::get_instance();
    $dbConnection = $db_object::getDb();
}