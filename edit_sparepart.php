<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}

require_once('koneksi.php');

if (isset($_GET['id'])) {
    $id = $conn->real_escape_string($_GET['id']);
    $sql = "SELECT * FROM spare_parts WHERE id = '$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Sparepart tidak ditemukan!";
        exit;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $conn->real_escape_string($_POST['nama']);
    $kategori = $conn->real_escape_string($_POST['kategori']);
    $harga = $conn->real_escape_string($_POST['harga']);
    $stok = $conn->real_escape_string($_POST['stok']);
    $gambarLama = $row['gambar']; 

    if ($_FILES['gambar']['name']) {
        $targetDir = "uploads/"; 
        $targetFile = $targetDir . basename($_FILES['gambar']['name']);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        if (in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
            if (move_uploaded_file($_FILES['gambar']['tmp_name'], $targetFile)) {
                if (file_exists($gambarLama)) {
                    unlink($gambarLama);
                }
                $gambar = $targetFile; 
            } else {
                echo "Gagal mengunggah gambar.";
                exit;
            }
        } else {
            echo "Hanya gambar dengan format JPG, JPEG, PNG, atau GIF yang diperbolehkan.";
            exit;
        }
    } else {
        $gambar = $gambarLama; 
    }

    $sql = "UPDATE spare_parts SET nama = '$nama', kategori = '$kategori', harga = '$harga', stok = '$stok', gambar = '$gambar' WHERE id = '$id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: dashboard.php?edited=true");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Sparepart</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, rgba(0, 123, 255, 0.9), rgba(0, 212, 255, 0.9)), url('https://source.unsplash.com/1600x900/?computer');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            max-width: 450px; 
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            position: relative;
        }
        h2 {
            text-align: center;
            margin-bottom: 15px;
            color: #007bff;
            font-weight: 600;
            font-size: 1.5rem; 
        }
        .form-label {
            font-weight: 600;
            color: #333;
            font-size: 0.9rem; 
        }
        .form-control {
            border-radius: 8px; 
            padding: 8px;
            margin-bottom: 12px;
            border: none;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
            font-size: 0.875rem; 
        }
        .form-control:focus {
            box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
            outline: none;
        }
        .btn-primary {
            background: linear-gradient(45deg, #007bff, #00d4ff);
            border: none;
            padding: 10px;
            font-weight: 600;
            width: 100%;
            border-radius: 25px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 18px rgba(0, 123, 255, 0.4);
        }
        .btn-secondary {
            margin-top: 10px;
            border-radius: 25px;
            width: 100%;
            padding: 8px;
        }
        .img-thumbnail {
            width: 100px; 
            height: 100px;
            object-fit: cover;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Sparepart</h2>
        <form method="POST" action="edit_sparepart.php?id=<?php echo $id; ?>" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Sparepart</label>
                <input type="text" id="nama" name="nama" class="form-control" value="<?php echo htmlspecialchars($row['nama']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <input type="text" id="kategori" name="kategori" class="form-control" value="<?php echo htmlspecialchars($row['kategori']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" id="harga" name="harga" class="form-control" value="<?php echo htmlspecialchars($row['harga']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="stok" class="form-label">Stok (Sebelumnya: <?php echo htmlspecialchars($row['stok']); ?>)</label>
                <input type="number" id="stok" name="stok" class="form-control" value="<?php echo htmlspecialchars($row['stok']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="gambar" class="form-label">Gambar Sparepart</label>
                <input type="file" id="gambar" name="gambar" class="form-control">
                <img src="<?php echo htmlspecialchars($row['gambar']); ?>" alt="Gambar Sparepart" class="img-thumbnail mt-2">
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="dashboard.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>
