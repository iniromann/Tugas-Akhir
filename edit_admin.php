<?php
require_once('koneksi.php');

$sparepart = null;

if (isset($_GET['id'])) {
    $sparepartId = $_GET['id'];
    $sql = "SELECT * FROM spare_parts WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $sparepartId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $sparepart = $result->fetch_assoc();
    } else {
        header("Location: dashboard_admin.php");
        exit;
    }
}

if (isset($_POST['update_sparepart']) && $sparepart !== null) {
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];

    $updateQuery = "UPDATE spare_parts SET nama = ?, kategori = ?, harga = ? WHERE id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("ssdi", $nama, $kategori, $harga, $sparepartId);

    if ($stmt->execute()) {
        header("Location: dashboard_admin.php?edited=true");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Sparepart</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6f9;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 40px;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        h4 {
            color: #2c3e50;
            font-weight: 600;
        }
        .btn {
            border-radius: 30px;
            padding: 10px 20px;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <div class="container">
        <h4>Edit Sparepart</h4>
        <form method="post">
            <?php if ($sparepart): ?>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Sparepart</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo htmlspecialchars($sparepart['nama']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="kategori" class="form-label">Kategori</label>
                    <input type="text" class="form-control" id="kategori" name="kategori" value="<?php echo htmlspecialchars($sparepart['kategori']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" class="form-control" id="harga" name="harga" value="<?php echo htmlspecialchars($sparepart['harga']); ?>" required>
                </div>
                <button type="submit" class="btn btn-primary" name="update_sparepart">Simpan Perubahan</button>
            <?php else: ?>
                <p>Data sparepart tidak ditemukan.</p>
            <?php endif; ?>
            <a href="dashboard_admin.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
