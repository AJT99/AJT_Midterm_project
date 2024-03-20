<?php
include_once '../config.php';

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    $query = "SELECT id FROM quotes";
    $stmt = $conn->query($query);
    $quotes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($quotes)) {
        $quote_ids = array_column($quotes, 'id');
        echo json_encode($quote_ids);
    } else {
        echo json_encode(array("message" => "No Quotes Found"));
    }
} else {
    echo json_encode(array("message" => "Method Not Allowed"));
}
?>
