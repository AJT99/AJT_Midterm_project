<?php
include_once '../config.php';
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"));

    if (!empty($data->quote) && !empty($data->author_id) && !empty($data->category_id)) {
        $quote = htmlspecialchars(strip_tags($data->quote));
        $author_id = htmlspecialchars(strip_tags($data->author_id));
        $category_id = htmlspecialchars(strip_tags($data->category_id));

        $author_exists = checkIfExists($conn, 'authors', 'id', $author_id);
        $category_exists = checkIfExists($conn, 'categories', 'id', $category_id);

        if (!$author_exists) {
            echo json_encode(array("message" => "author_id Not Found"));
        } elseif (!$category_exists) {
            echo json_encode(array("message" => "category_id Not Found"));
        } else {
            try {
                $query = "INSERT INTO quotes (quote, author_id, category_id) VALUES (:quote, :author_id, :category_id)";
                $stmt = $conn->prepare($query);

                $stmt->bindParam(':quote', $quote);
                $stmt->bindParam(':author_id', $author_id);
                $stmt->bindParam(':category_id', $category_id);

                if ($stmt->execute()) {
                    echo json_encode(array("message" => "Quote created successfully."));
                } else {
                    echo json_encode(array("message" => "Unable to create quote."));
                }
            } catch (PDOException $e) {
                echo json_encode(array("message" => "Database error: " . $e->getMessage()));
            }
        }
    } else {
        echo json_encode(array("message" => "Missing Required Parameters"));
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET" && $_SERVER["REQUEST_URI"] == "/quotes/") {
    $query = "SELECT id, quote, author_id, category_id FROM quotes";
    $stmt = $conn->query($query);
    $quotes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($quotes);
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
