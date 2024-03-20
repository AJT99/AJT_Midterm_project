<?php
include_once '../config.php';

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
        echo json_encode(array("message" => "Missing required data."));
    }
} else {
    echo json_encode(array("message" => "Method Not Allowed"));
}
?>