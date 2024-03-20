<?php
include_once '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    $author_id = isset($_GET['id']) ? $_GET['id'] : null;

    if ($author_id !== null) {
        try {
            $query = "DELETE FROM authors WHERE id = :id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $author_id);

            if ($stmt->execute()) {
                echo json_encode(array("message" => "Author deleted successfully."));
            } else {
                echo json_encode(array("message" => "Unable to delete author."));
            }
        } catch (PDOException $e) {
            echo json_encode(array("message" => "Database error: " . $e->getMessage()));
        }
    } else {
        echo json_encode(array("message" => "Author ID is missing."));
    }
} else {
    echo json_encode(array("message" => "Method Not Allowed"));
}

?>
