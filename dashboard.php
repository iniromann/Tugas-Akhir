<!DOCTYPE html>
<html lang="id">
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
        h2, h4 {
            font-weight: 600;
        }
        h2 {
            color: #007bff;
            margin-bottom: 20px;
        }
        .table-responsive {
            margin-top: 20px;
            overflow-x: auto;
        }
        .table {
            width: 100%;
            table-layout: fixed; 
        }
        .table th, .table td {
            vertical-align: middle;
            padding: 8px 10px; 
            font-size: 0.9rem; 
        }
        .table th {
            font-size: 1rem;
        }
        .table-hover tbody tr:hover {
            background-color: #f1f3f5; 
            transform: scale(1.02); 
            transition: all 0.3s ease;
        }
        .img-thumbnail {
            width: 40px; 
            height: 40px;
            object-fit: cover;
            border-radius: 5px;
        }
        .btn {
            font-size: 0.85rem; 
            padding: 6px 12px; 
        }
        .btn-dark {
            background: linear-gradient(45deg, #343a40, #555);
            color: #fff;
        }
        .btn-dark:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3);
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
        .icon-header {
            width: 1.2em; /* Mengurangi ukuran ikon */
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <div class="header text-center">
        <h2>Dashboard Pendataan Sparepart</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="Home.php" class="text-white">Home</a></li>
                <li class="breadcrumb-item"><a href="Dashboard.php" class="text-white">Dashboard</a></li>
            </ol>
        </nav>
        <p>Selamat datang di Sistem Manajemen Sparepart!</p>
    </div>

    <div class="container">
        <?php if (isset($_GET['added']) && $_GET['added'] == 'true'): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Sparepart berhasil ditambahkan!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['deleted']) && $_GET['deleted'] == 'true'): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Sparepart berhasil dihapus!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['edited']) && $_GET['edited'] == 'true'): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Sparepart berhasil diubah!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?> 

        <form method="GET" action="dashboard.php" class="d-flex mb-4">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari Sparepart" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            <button type="submit" class="btn btn-primary">Cari</button>
            <a href='tambah_sparepart.php' class='btn btn-success'>Tambah</a>
        </form>

        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered text-center">
                <thead class="table-dark">
                    <tr>
                        <th><i class="fas fa-image icon-header"></i> Gambar</th>  
                        <th><i class="fas fa-tools icon-header"></i> Nama Sparepart</th>  
                        <th><i class="fas fa-th-list icon-header"></i> Kategori</th>
                        <th><i class="fas fa-tag icon-header"></i> Harga</th>
                        <th><i class="fas fa-box icon-header"></i> Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                require_once('koneksi.php');

                $search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
                if ($search) {
                    $sql = "SELECT * FROM spare_parts WHERE nama LIKE '%$search%' OR kategori LIKE '%$search%'";
                } else {
                    $sql = "SELECT * FROM spare_parts";
                }
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td><img src='" . htmlspecialchars($row['gambar']) . "' class='img-thumbnail' alt='Gambar Sparepart'></td>
                                <td>" . htmlspecialchars($row['nama']) . "</td>
                                <td>" . htmlspecialchars($row['kategori']) . "</td>
                                <td>Rp" . number_format($row['harga'], 0, ',', '.') . "</td>
                                <td>" . htmlspecialchars($row['stok']) . "</td>
                                <td>
                                    <a href='#' class='btn btn-dark' data-bs-toggle='modal' data-bs-target='#deleteModal' data-id='" . $row['id'] . "'>Hapus</a>
                                    <a href='edit_sparepart.php?id=" . $row['id'] . "' class='btn btn-primary'>Edit</a>
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Tidak ada data sparepart ditemukan.</td></tr>";
                }

                $conn->close();
                ?>
                </tbody>
            </table>
        </div>
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus sparepart ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-danger" id="confirmDelete">Hapus</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Sistem Manajemen Sparepart. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let deleteId;
        const deleteModal = document.getElementById('deleteModal');
        deleteModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            deleteId = button.getAttribute('data-id');
        });

        document.getElementById('confirmDelete').addEventListener('click', function () {
            window.location.href = `hapus_sparepart.php?id=${deleteId}`;
        });
    </script>
</body>
</html>
