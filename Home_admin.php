<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Admin - User Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
        }

        .header {
            background: linear-gradient(45deg, #3498db, #2ecc71);
            color: white;
            padding: 40px 0;
            border-radius: 0 0 30px 30px;
            text-align: center;
        }

        .header h2 {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 10px;
            letter-spacing: 1px;
        }

        .header p {
            font-size: 18px;
            font-weight: 400;
        }

        .breadcrumb {
            background-color: transparent;
            margin-top: 10px;
        }

        .breadcrumb-item a {
            color: white;
            text-decoration: none;
            transition: color 0.3s ease-in-out;
        }

        .breadcrumb-item a:hover {
            color: #f39c12;
            text-decoration: underline;
        }

        .container {
            max-width: 900px;
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

        h5 {
            color: #2980b9;
            font-weight: 500;
            margin-top: 30px;
        }

        ul {
            font-size: 16px;
            color: #34495e;
        }

        ul li {
            margin-bottom: 10px;
        }

        footer {
            text-align: center;
            margin-top: 50px;
            font-size: 14px;
            color: #777;
            padding: 20px 0;
            background-color: #ecf0f1;
            border-top: 1px solid #ddd;
        }

        .btn-logout {
            background-color: #e74c3c;
            color: white;
            font-weight: 500;
            border-radius: 25px;
            transition: all 0.3s;
            padding: 12px 30px;
            font-size: 16px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-logout:hover {
            background-color: #c0392b;
            transform: scale(1.05);
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            .header h2 {
                font-size: 24px;
            }

            .btn-logout {
                padding: 10px 25px;
            }

            h4, h5 {
                font-size: 18px;
            }
        }
    </style>
</head>

<body>

    <div class="header">
        <h2><b>Admin - Manajemen Pengguna & Sparepartt</b></h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="Home_admin.php">Home</a></li>
                <li class="breadcrumb-item"><a href="dashboard_admin.php">Dashboard</a></li>
            </ol>
        </nav>
        <p>Selamat datang di Sistem Manajemen Pengguna dan Sparepart!</p>
    </div>

    <div class="container">
        <h4>Selamat Datang, Admin!</h4>
        <p>Anda memiliki akses penuh untuk mengelola data sparepart dengan mudah dan efisien.</p>

        <h5>Fitur Utama:</h5>
        <ul>
            <li><i class="fas fa-users"></i> <strong>Manajemen Pengguna:</strong> Kelola akun pengguna dan peran mereka.</li>
            <li><i class="fas fa-chart-line"></i> <strong>Statistik dan Laporan:</strong> Dapatkan laporan mengenai jumlah sparepart dan stok yang tersedia.</li>
        </ul>
        <div class="text-end mb-4">
            <a href="login.php" class="btn btn-logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Sistem Manajemen Sparepart. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
