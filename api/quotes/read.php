<?php
include_once '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $query = "SELECT q.id, q.quote, a.author, c.category
              FROM quotes q
              LEFT JOIN authors a ON q.author_id = a.id
              LEFT JOIN categories c ON q.category_id = c.id";
    $stmt = $conn->query($query);

    if ($stmt->rowCount() > 0) {
        $quotes_arr = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $quote_item = array(
                "id" => $id,
                "quote" => $quote,
                "author" => $author,
                "category" => $category
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