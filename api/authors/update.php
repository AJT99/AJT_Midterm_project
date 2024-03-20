<?php
include_once '../config.php';
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
if ($_SERVER["REQUEST_METHOD"] == "PUT") {
    $data = json_decode(file_get_contents("php://input"));

    if (!empty($data->id) && !empty($data->author)) {
        try {
            $query = "UPDATE authors SET author = :author WHERE id = :id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $data->id);
            $stmt->bindParam(':author', $data->author);

            if ($stmt->execute()) {
                echo json_encode(array("message" => "Author updated successfully."));
            } else {
                echo json_encode(array("message" => "Unable to update author."));
            }
        } catch (PDOException $e) {
            echo json_encode(array("message" => "Database error: " . $e->getMessage()));
        }
    } else {
        echo json_encode(array("message" => "Missing Required Parameters"));
    }
} else {
    echo json_encode(array("message" => "Method Not Allowed"));
}

?>
