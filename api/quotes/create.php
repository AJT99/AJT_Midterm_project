<?php
include_once '../config.php';
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"));

    if (!empty($data->quote) && !empty($data->author_id) && !empty($data->category_id)) {
        try {
            $query = "INSERT INTO quotes (quote, author_id, category_id) VALUES (:quote, :author_id, :category_id)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':quote', $data->quote);
            $stmt->bindParam(':author_id', $data->author_id);
            $stmt->bindParam(':category_id', $data->category_id);

            if ($stmt->execute()) {
                $quote_id = $conn->lastInsertId();

                echo json_encode(array("message" => "Quote created successfully.", "quote_id" => $quote_id));
            } else {
                echo json_encode(array("message" => "Unable to create quote."));
            }
        } catch (PDOException $e) {
            echo json_encode(array("message" => "Database error: " . $e->getMessage()));
        }
    } else {
        echo json_encode(array("message" => "Missing required data."));
    }
} else {
    echo json_encode(array("message" => "Method Not Allowed"));
}

?>
