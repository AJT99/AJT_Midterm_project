<?php
include_once '../config.php';

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    $quote_id = isset($_GET['id']) ? $_GET['id'] : null;

    if (!empty($quote_id)) {
        $query = "DELETE FROM quotes WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $quote_id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo json_encode(array("message" => "Quote deleted successfully."));
        } else {
            echo json_encode(array("message" => "No Quotes Found"));
        }
    } else {
        $query = "SELECT id FROM quotes";
        $stmt = $conn->query($query);
        $quotes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($quotes) {
            echo json_encode($quotes);
        } else {
            echo json_encode(array("message" => "No Quotes Found"));
        }
    }
} else {
    echo json_encode(array("message" => "Method Not Allowed"));
}
?>
