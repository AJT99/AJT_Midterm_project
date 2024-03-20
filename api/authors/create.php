<?php
include_once '../config.php';

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"));

    if (!empty($data->author)) {
        try {
            $query = "INSERT INTO authors (author) VALUES (:author)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':author', $data->author);

            if ($stmt->execute()) {
                $author_id = $conn->lastInsertId();
                echo json_encode(array("message" => "Author created successfully.", "author_id" => $author_id));
            } else {
                echo json_encode(array("message" => "Unable to create author."));
            }
        } catch (PDOException $e) {
            echo json_encode(array("message" => "Database error: " . $e->getMessage()));
        }
    } else {
        echo json_encode(array("message" => "Missing Required Parameters"));
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET" && $_SERVER["REQUEST_URI"] == "/authors/") {
    $query = "SELECT id, author FROM authors";
    $stmt = $conn->query($query);
    $authors = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($authors);
} else {
    echo json_encode(array("message" => "Method Not Allowed"));
}
?>
