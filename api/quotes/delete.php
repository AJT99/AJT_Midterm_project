<?php
include_once '../config.php';

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    if (isset($_GET['id'])) {
        $quote_id = $_GET['id'];
        $query = "DELETE FROM quotes WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $quote_id);
        
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                echo json_encode(array("message" => "Quote deleted successfully."));
            } else {
                echo json_encode(array("message" => "Quote not found."));
            }
        } else {
            echo json_encode(array("message" => "Unable to delete quote."));
        }
    } else {
        echo json_encode(array("message" => "Quote ID parameter is missing."));
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET" && $_SERVER["REQUEST_URI"] == "/quotes/") {
    $query = "SELECT id FROM quotes";
    $stmt = $conn->query($query);
    $quotes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($quotes) > 0) {
        echo json_encode($quotes);
    } else {
        echo json_encode(array("message" => "No Quotes Found"));
    }
} else {
    echo json_encode(array("message" => "Method Not Allowed"));
}
?>
