<?php
$db_host = getenv('DATABASE_HOST');
$db_port = getenv('DATABASE_PORT');
$db_name = getenv('DATABASE_NAME');
$db_user = getenv('DATABASE_USERNAME');
$db_pass = getenv('DATABASE_PASSWORD');

try {
    $conn = new PDO("pgsql:host=$db_host;port=$db_port;dbname=$db_name", $db_user, $db_pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>