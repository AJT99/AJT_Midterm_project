<?php
include_once 'config.php';
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method === 'OPTIONS') {
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
        exit();
    }

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
<html>
    <h1> Welcome to Avery's Quote Database</h1>
</html>