<?php
include_once '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"));

    if (!empty($data->category)) {
        $query = "INSERT INTO categories (category) VALUES (:category)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':category', $data->category);

        if ($stmt->execute()) {
            $category_id = $conn->lastInsertId();

            echo json_encode(array("message" => "Category created successfully.", "category_id" => $category_id));
        } else {
            echo json_encode(array("message" => "Unable to create category."));
        }
    } else {
        echo json_encode(array("message" => "Missing required data."));
    }
} else {
    echo json_encode(array("message" => "Method Not Allowed"));
}

?>
