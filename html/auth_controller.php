<?php
/**
 * Created by PhpStorm.
 * User: allar
 * Date: 5.12.15
 * Time: 22:14
 */
// Holds data like $baseUrl etc.
include "config.php";
include "id_card_utils.php";

$requestUrl = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
//$baseUrl = url();
echo $baseUrl;
$requestString = substr($requestUrl, strlen($baseUrl));

$urlParams = explode('/', $requestString);

$controllerName = ucfirst(array_shift($urlParams)) . 'Controller';
$actionName = strtolower(array_shift($urlParams)) . 'Action';

// Here you should probably gather the rest as params

// Call the action
$controller = new $controllerName;
$controller->$actionName();