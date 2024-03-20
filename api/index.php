<?php
include_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
    exit();
}

$request_method = $_SERVER["REQUEST_METHOD"];

switch ($request_method) {
    case 'GET':
        break;
    case 'POST':
        include_once 'handle_post.php'; 
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
