<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Pendataan Sparepart</title>
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
            max-width: 900px;
            margin: 50px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }
        h2 {
            color: #007bff;
            margin-bottom: 20px;
        }
        footer {
            text-align: center;
            margin-top: 50px;
            font-size: 0.9rem;
            color: #777;
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header text-center">
        <h2><b>Dashboard Pendataan Sparepart</b></h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="Home.php" class="text-white">Home</a></li>
                <li class="breadcrumb-item"><a href="Dashboard.php" class="text-white">Dashboard</a></li>
            </ol>
        </nav>
        <p>Selamat datang di Sistem Manajemen Sparepart!</p>
    </div>

    <div class="container">
        <h4>Selamat Datang !</h4>
        <p>Anda dapat menggunakan sistem ini untuk mengelola data sparepart Anda dengan mudah dan efisien.</p>

        <h5>Fitur Utama:</h5>
        <ul>
            <li><strong>Manajemen Data Sparepart:</strong> Tambah, edit, dan hapus data sparepart dengan cepat.</li>
            <li><strong>Pencarian Sparepart:</strong> Temukan sparepart dengan mudah menggunakan fitur pencarian.</li>
            <li><strong>Statistik dan Laporan:</strong> Dapatkan laporan mengenai jumlah sparepart dan stok yang tersedia.</li>
        </ul>

        <h5>Tips Menggunakan Website Ini !!:</h5>
        <ul>
            <li>Gunakan fitur pencarian untuk menemukan sparepart dengan cepat.</li>
            <li>Pastikan untuk memperbarui stok secara berkala.</li>
            <li>Jangan ragu untuk menghubungi admin jika Anda mengalami kesulitan.</li>
        </ul>

        <div class="text-end mb-4">
            <a href="login.php" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Sistem Manajemen Sparepart. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
