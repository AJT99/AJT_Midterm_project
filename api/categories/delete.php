<?php
include_once '../config.php';

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    if (isset($_GET['id'])) {
        $category_id = $_GET['id'];

        $query = "DELETE FROM categories WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $category_id);

        if ($stmt->execute()) {
            echo json_encode(array("message" => "Category deleted successfully."));
        } else {
            echo json_encode(array("message" => "Unable to delete category."));
        }
    } else {
        echo json_encode(array("message" => "Category ID parameter is missing."));
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET" && $_SERVER["REQUEST_URI"] == "/categories/") {
    $query = "SELECT id FROM categories";
    $stmt = $conn->query($query);
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($categories) > 0) {
        echo json_encode($categories);
    } else {
        echo json_encode(array("message" => "No Categories Found"));
    }
} else {
    echo json_encode(array("message" => "Method Not Allowed"));
}
?>
