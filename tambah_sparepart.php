<?php
require_once('koneksi.php');

class Sparepart
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function tambahSparepart($nama, $kategori, $harga, $stok, $gambar)
    {
        $sql = "INSERT INTO spare_parts (nama, kategori, harga, stok, gambar) VALUES (?, ?, ?, ?, ?)";

        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bind_param("ssdis", $nama, $kategori, $harga, $stok, $gambar);

            if ($stmt->execute()) {
                return true; 
            } else {
                return false; 
            }
        }
        return false; 
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
        $gambar = 'uploads/' . basename($_FILES['gambar']['name']);
        move_uploaded_file($_FILES['gambar']['tmp_name'], $gambar); 
    }
    $sparepart = new Sparepart($conn);
    if ($sparepart->tambahSparepart($nama, $kategori, $harga, $stok, $gambar)) {
        header("Location: dashboard.php?added=true"); 
        exit();
    } else {
        $error = "Gagal menambahkan sparepart.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Sparepart</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
            color: #333;
        }
        .header {
            background: linear-gradient(45deg, #007bff, #00d4ff);
            color: white;
            padding: 20px 0;
            border-radius: 0 0 30px 30px;
        }
        .header h2 {
            margin: 0;
            color: white; 
        }
        .container {
            max-width: 600px; /* Mengurangi lebar container */
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }
        h2 {
            color: #007bff;
            margin-bottom: 20px;
        }
        .form-label {
            font-weight: 600;
        }
        .form-control {
            font-size: 0.9rem; /* Mengurangi ukuran font form */
        }
        .btn {
            border-radius: 30px;
            padding: 8px 16px; /* Mengurangi padding tombol */
            font-weight: 600;
            transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        .btn-primary {
            background: linear-gradient(45deg, #007bff, #00d4ff);
            border: none;
        }
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 15px rgba(0, 123, 255, 0.3);
        }
        footer {
            text-align: center;
            margin-top: 50px;
            font-size: 0.9rem;
            color: #777;
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }
        .alert {
            margin-top: 20px;
            border-radius: 10px;
            padding: 15px;
        }
        .breadcrumb {
            background-color: transparent;
            padding-left: 0;
        }
        .breadcrumb-item a {
            color: white;
        }
        .breadcrumb-item.active {
            color: #00d4ff;
        }
    </style>
</head>
<body>

<div class="header text-center">
    <h2>Tambah Sparepart</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item"><a href="Home.php" class="text-white">Home</a></li>
            <li class="breadcrumb-item"><a href="Dashboard.php" class="text-white">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Sparepart</li>
        </ol>
    </nav>
</div>

<div class="container">
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="POST" action="tambah_sparepart.php" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Sparepart</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>
        <div class="mb-3">
            <label for="kategori" class="form-label">Kategori</label>
            <input type="text" class="form-control" id="kategori" name="kategori" required>
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" class="form-control" id="harga" name="harga" required>
        </div>
        <div class="mb-3">
            <label for="stok" class="form-label">Stok</label>
            <input type="number" class="form-control" id="stok" name="stok" required>
        </div>
        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar Sparepart</label>
            <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-primary">Tambah Sparepart</button>
    </form>
</div>

<footer>
    <p>&copy; 2024 Sistem Manajemen Sparepart. All rights reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
