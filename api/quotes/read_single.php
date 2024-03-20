<?php
include_once '../config.php';

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['id'])) {
        $quote_id = $_GET['id'];

        $query = "SELECT * FROM quotes WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $quote_id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            extract($row);

            $quote_item = array(
                "id" => $id,
                "quote" => $quote,
                "author_id" => $author_id,
                "category_id" => $category_id
            );

            echo json_encode($quote_item);
        } else {
            echo json_encode(array("message" => "No Quotes Found"));
        }
    } else {
        echo json_encode(array("message" => "Quote ID parameter is missing."));
    }
} else {
    echo json_encode(array("message" => "Method Not Allowed"));
}
?>
