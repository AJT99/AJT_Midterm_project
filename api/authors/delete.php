<?php
include_once '../config.php';

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

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
} elseif ($_SERVER["REQUEST_METHOD"] == "GET" && $_SERVER["REQUEST_URI"] == "/authors/") {
    $query = "SELECT id FROM authors";
    $stmt = $conn->query($query);
    $authors = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($authors) > 0) {
        echo json_encode($authors);
    } else {
        echo json_encode(array("message" => "No Authors Found"));
    }
} else {
    echo json_encode(array("message" => "Method Not Allowed"));
}
?>
