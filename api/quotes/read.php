<?php
include_once '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $query = "SELECT * FROM quotes";
    $stmt = $conn->query($query);

    if ($stmt->rowCount() > 0) {
        $quotes_arr = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $quote_item = array(
                "id" => $id,
                "quote" => $quote,
                "author_id" => $author_id,
                "category_id" => $category_id
            );
            array_push($quotes_arr, $quote_item);
        }

        echo json_encode($quotes_arr);
    } else {
        echo json_encode(array("message" => "No quotes found."));
    }
} else {
    echo json_encode(array("message" => "Method Not Allowed"));
}

?>
