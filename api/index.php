<?php

include_once 'config.php';
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$request_method = $_SERVER["REQUEST_METHOD"];

switch ($request_method) {
    case 'GET':
        break;
    case 'POST':
        break;
    case 'PUT':
        break;
    case 'DELETE':
        break;
    default:
        echo json_encode(array("message" => "Method Not Allowed"));
        break;
}

?>