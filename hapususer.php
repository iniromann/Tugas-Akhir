<?php
// delete_user.php

require_once('koneksi.php');

class UserManagement {
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function deleteUser($userId) {
        $stmt = $this->conn->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $userId); // 'i' untuk integer

        if ($stmt->execute()) {
            return true;
        } else {
            return false; 
        }
    }

    public function closeConnection() {
        $this->conn->close();
    }
}

$userManagement = new UserManagement($conn);

// Cek apakah ada ID yang diberikan dalam URL
if (isset($_GET['id'])) {
    $userId = (int)$_GET['id']; // Pastikan ID adalah integer

    // Coba untuk menghapus pengguna
    if ($userManagement->deleteUser($userId)) {
        header("Location: dashboard_admin.php?deleted=true");
    } else {
        header("Location: dashboard_admin.php?deleted=false");
    }
}

$userManagement->closeConnection();
?>
