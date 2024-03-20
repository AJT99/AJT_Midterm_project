<?php
include_once '../config.php';

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "PUT") {
    $quote_id = isset($_GET['id']) ? $_GET['id'] : null;

    if (!empty($quote_id)) {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->quote) && !empty($data->author_id) && !empty($data->category_id)) {
            try {
                $author_exists = checkIfExists($conn, 'authors', 'id', $data->author_id);
                $category_exists = checkIfExists($conn, 'categories', 'id', $data->category_id);

                if (!$author_exists) {
                    echo json_encode(array("message" => "author_id Not Found"));
                } elseif (!$category_exists) {
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
            } catch (PDOException $e) {
                echo json_encode(array("message" => "Database error: " . $e->getMessage()));
            }
        } else {
            echo json_encode(array("message" => "Missing required data."));
        }
    } else {
        echo json_encode(array("message" => "Quote ID parameter is missing."));
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET" && $_SERVER["REQUEST_URI"] == "/quotes/") {
    $query = "SELECT id, quote, author_id, category_id FROM quotes";
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

function checkIfExists($conn, $table, $field, $value)
{
    $query = "SELECT * FROM $table WHERE $field = :value";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':value', $value);
    $stmt->execute();
    return $stmt->rowCount() > 0;
}
?>
