<?php
include_once 'config.php';
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$request_uri = $_SERVER['REQUEST_URI'];

$base_path = "/api";

$endpoint = substr($request_uri, strlen($base_path));

switch ($endpoint) {
    case '/authors':
        include "authors/index.php";
        break;
    case '/categories':
        include "categories/index.php";
        break;
    case '/quotes':
        include "quotes/index.php";
        break;
    default:
        http_response_code(404);
        echo json_encode(array("message" => "Endpoint not found"));
        break;
}

?>
