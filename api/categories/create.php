<?php
include_once '../config.php';

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"));

    if (!empty($data->category)) {
        try {
            $query = "INSERT INTO categories (category) VALUES (:category)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':category', $data->category);

            if ($stmt->execute()) {
                $category_id = $conn->lastInsertId();
                echo json_encode(array("message" => "Category created successfully.", "category_id" => $category_id));
            } else {
                echo json_encode(array("message" => "Unable to create category."));
            }
        } catch (PDOException $e) {
            echo json_encode(array("message" => "Database error: " . $e->getMessage()));
        }
    } else {
        echo json_encode(array("message" => "Missing Required Parameters"));
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET" && $_SERVER["REQUEST_URI"] == "/categories/") {
    $query = "SELECT id, category FROM categories";
    $stmt = $conn->query($query);
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($categories);
} else {
    echo json_encode(array("message" => "Method Not Allowed"));
}
?>
