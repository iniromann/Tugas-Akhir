<?php
require_once('koneksi.php');

if (isset($_GET['id'])) {
    $id = $conn->real_escape_string($_GET['id']);
    $sql = "DELETE FROM spare_parts WHERE id = '$id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: dashboard.php?deleted=true");
        exit;
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
?>
