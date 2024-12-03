<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "stocksparepart";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function close_connection() {
    global $conn;
    $conn->close();
}
?>