<?php
include_once '../config.php';
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $query = "SELECT * FROM categories";
    $stmt = $conn->query($query);

    if ($stmt->rowCount() > 0) {
        $categories_arr = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $category_item = array(
                "id" => $id,
                "category" => $category
            );
            array_push($categories_arr, $category_item);
        }

        echo json_encode($categories_arr);
    } else {
        echo json_encode(array("message" => "No categories found."));
    }
} else {
    echo json_encode(array("message" => "Method Not Allowed"));
}

?>