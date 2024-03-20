<?php
include_once '../config.php';
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "PUT") {
    $quote_id = $_GET['id'] ?? null;

    if (!empty($quote_id)) {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->quote) && !empty($data->author_id) && !empty($data->category_id)) {
            $stmt = $conn->prepare("SELECT COUNT(*) FROM authors WHERE id = :author_id");
            $stmt->bindParam(':author_id', $data->author_id);
            $stmt->execute();
            $author_exists = $stmt->fetchColumn();

            if (!$author_exists) {
                echo json_encode(array("message" => "author_id Not Found"));
            } else {
                $stmt = $conn->prepare("SELECT COUNT(*) FROM categories WHERE id = :category_id");
                $stmt->bindParam(':category_id', $data->category_id);
                $stmt->execute();
                $category_exists = $stmt->fetchColumn();

                if (!$category_exists) {
                    echo json_encode(array("message" => "category_id Not Found"));
                } else {
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
                }
            }
        } else {
            echo json_encode(array("message" => "Missing Required Parameters"));
        }
    } else {
        echo json_encode(array("message" => "Missing Required Parameters"));
    }
} else {
    echo json_encode(array("message" => "Method Not Allowed"));
}
?>
