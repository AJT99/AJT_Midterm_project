<?php
include_once '../config.php';
header('Content-Type: application/json');
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $stmt = $conn->prepare("SELECT * FROM categories WHERE id = ?");
            $stmt->execute([$id]);
            $category = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($category) {
                echo json_encode($category);
            } else {

                echo json_encode(array("message" => "Category not found."));
            }
        } else {
            $stmt = $conn->query("SELECT * FROM categories");
            $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

            echo json_encode($categories);
        }
    } catch (PDOException $e) {
        echo json_encode(array("message" => "Database error: " . $e->getMessage()));
    }
} else {
    echo json_encode(array("message" => "Method Not Allowed"));
}

?>
