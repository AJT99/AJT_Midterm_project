<?php
include_once '../config.php';

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$quote_id = isset($_GET['id']) ? $_GET['id'] : null;

if ($_SERVER["REQUEST_METHOD"] == "PUT") {
    if (!empty($quote_id)) {
        if (!checkIfExists($conn, 'quotes', 'id', $quote_id)) {
            echo json_encode(array("message" => "NoQuotesFound"));
            exit; 
        }

        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->quote) && !empty($data->author_id) && !empty($data->category_id)) {
            try {
                $author_exists = checkIfExists($conn, 'authors', 'id', $data->author_id);
                $category_exists = checkIfExists($conn, 'categories', 'id', $data->category_id);

                if (!$author_exists) {
                    echo json_encode(array("message" => "author_idNotFound"));
                } elseif (!$category_exists) {
                    echo json_encode(array("message" => "category_idNotFound"));
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
            } catch (PDOException $e) {
                echo json_encode(array("message" => "Database error: " . $e->getMessage()));
            }
        } else {
            echo json_encode(array("message" => "MissingRequiredParameters"));
        }
    } else {
        echo json_encode(array("message" => "Quote ID parameter is missing."));
    }
} else {
    echo json_encode(array("message" => "Method Not Allowed"));
}

function checkIfExists($conn, $table, $field, $value)
{
    $query = "SELECT * FROM $table WHERE $field = :value";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':value', $value);
    $stmt->execute();
    return $stmt->rowCount() > 0;
}
?>
