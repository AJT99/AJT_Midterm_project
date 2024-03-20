<?php
include_once '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['id'])) {
        $author_id = $_GET['id'];
        
        try {
            $query = "SELECT * FROM authors WHERE id = :author_id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':author_id', $author_id);
            
            $stmt->execute();
            
            $author = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($author) {
                echo json_encode($author);
            } else {
                echo json_encode(array("message" => "Author not found."));
            }
        } catch (PDOException $e) {
            echo json_encode(array("message" => "Database error: " . $e->getMessage()));
        }
    } else {
        echo json_encode(array("message" => "Missing author_id parameter."));
    }
} else {
    echo json_encode(array("message" => "Method Not Allowed"));
}

?>
