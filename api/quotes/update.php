<?php
include_once '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "PUT") {
    $quote_id = isset($_GET['id']) ? $_GET['id'] : null;

    if (!empty($quote_id)) {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->quote) && !empty($data->author_id) && !empty($data->category_id)) {
            try {
                $query = "UPDATE quotes SET quote = :quote, author_id = :author_id, category_id = :category_id WHERE id = :id";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':quote', $data->quote);
                $stmt->bindParam(':author_id', $data->author_id);
                $stmt->bindParam(':category_id', $data->category_id);
                $stmt->bindParam(':id', $quote_id);

                if ($stmt->execute()) {
                    echo json_encode(array("message" => "Quote updated successfully."));
                } else {
                    echo json_encode(array("message" => "Unable to update quote."));
                }
            } catch (PDOException $e) {
                echo json_encode(array("message" => "Database error: " . $e->getMessage()));
            }
        } else {
            echo json_encode(array("message" => "Missing required data."));
        }
    } else {
        echo json_encode(array("message" => "Quote ID parameter is missing."));
    }
} else {
    echo json_encode(array("message" => "Method Not Allowed"));
}

?>
