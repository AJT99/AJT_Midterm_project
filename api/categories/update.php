<?php
include_once '../config.php';
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "PUT") {
    if (isset($_GET['id'])) {
        $category_id = $_GET['id'];

        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->category)) {
            $query = "UPDATE categories SET category = :category WHERE id = :id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':category', $data->category);
            $stmt->bindParam(':id', $category_id);
            if ($stmt->execute()) {
                echo json_encode(array("message" => "Category updated successfully."));
            } else {
                echo json_encode(array("message" => "Unable to update category."));
            }
        } else {
            echo json_encode(array("message" => "Missing Required Parameters"));
        }
    } else {
        echo json_encode(array("message" => "Missing Required Parameters"));
    }
} else {
    $stmt = $conn->query("SELECT COUNT(*) FROM categories");
    $category_count = $stmt->fetchColumn();
    if ($category_count === 0) {
        echo json_encode(array("message" => "No Categories Found"));
    } else {
        echo json_encode(array("message" => "Method Not Allowed"));
    }
}
?>
