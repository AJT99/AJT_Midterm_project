<?php
// Retrieve database connection details from environment variables
$db_host = getenv('DATABASE_HOST');
$db_port = getenv('DATABASE_PORT');
$db_name = getenv('DATABASE_NAME');
$db_user = getenv('DATABASE_USERNAME');
$db_pass = getenv('DATABASE_PASSWORD');

// Establish database connection
$conn = new PDO("pgsql:host=$db_host;port=$db_port;dbname=$db_name", $db_user, $db_pass);

// Check connection
if (!$conn) {
    die("Connection failed: " . pg_last_error());
}

echo "Connected successfully";
?>