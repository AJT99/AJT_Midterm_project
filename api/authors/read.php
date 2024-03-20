<?php
include_once '../config.php';
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try {
        $stmt = $conn->query("SELECT * FROM authors");
        $authors = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($authors);
    } catch (PDOException $e) {
        echo json_encode(array("message" => "Database error: " . $e->getMessage()));
    }
} else {
    echo json_encode(array("message" => "Method Not Allowed"));
}

?>
