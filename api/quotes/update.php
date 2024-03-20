<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../config.php';
include_once '../models/Quote.php';

$database = new Database();
$conn = $database->connect();

$quote = new Quote($conn);

$data = json_decode(file_get_contents("php://input"));

$quote->id = $data->id;

$quote->quote = $data->quote;
$quote->author_id = $data->author_id;
$quote->category_id = $data->category_id;

if ($quote->update()) {
    echo json_encode(array('message' => 'Quote updated'));
} else {
    echo json_encode(array('message' => 'Quote NOT updated'));
}
?>
