<?php
require_once('koneksi.php');

// Mengambil data pengguna
$sqlUsers = "SELECT * FROM users"; 
$resultUsers = $conn->query($sqlUsers);

// Mengambil data sparepart
$sqlSpareparts = "SELECT * FROM spare_parts";
$resultSpareparts = $conn->query($sqlSpareparts);

// Fungsi untuk menetapkan role berdasarkan username (atau kondisi lain)
function getRole($username) {
    if ($username == 'admin') {
        return 'Administrator';
    } elseif ($username == 'editor') {
        return 'Editor';
    } else {
        return 'User';  
    }
}

if (isset($_POST['delete_user'])) {
    $userId = $_POST['user_id'];
    $deleteUserQuery = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($deleteUserQuery);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    header("Location: " . $_SERVER['PHP_SELF']); 
}

if (isset($_POST['delete_sparepart'])) {
    $sparepartId = $_POST['sparepart_id'];
    $deleteSparepartQuery = "DELETE FROM spare_parts WHERE id = ?";
    $stmt = $conn->prepare($deleteSparepartQuery);
    $stmt->bind_param("i", $sparepartId);
    $stmt->execute();
    header("Location: " . $_SERVER['PHP_SELF']); 
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manajemen Pengguna & Sparepart</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Body & General Style */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f7f8fa;
        }

        /* Header */
        .header {
            background: linear-gradient(135deg, #6c5ce7, #00b894);
            color: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .header h2 {
            font-size: 36px;
            font-weight: 600;
        }

        .breadcrumb {
            background-color: transparent;
            margin-top: 15px;
            justify-content: center;
        }

        .breadcrumb-item a {
            color: white;
        }

        /* Tabs */
        .nav-tabs {
            margin-bottom: 20px;
        }

        .nav-link {
            font-weight: 600;
            color: #555;
        }

        .nav-link.active {
            background-color: #6c5ce7;
            color: white;
            border-radius: 50px;
        }

        /* Main Container */
        .container {
            margin-top: 30px;
        }

        /* Table */
        .table-responsive {
            margin-top: 30px;
        }

        .table th, .table td {
            text-align: center;
            vertical-align: middle;
            padding: 15px;
        }

        .table thead {
            background-color: #6c5ce7;
            color: white;
        }

        .table tbody tr:hover {
            background-color: #f1f3f5;
            transition: 0.3s;
        }

        /* Buttons */
        .btn {
            border-radius: 30px;
            padding: 10px 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: #6c5ce7;
            color: white;
            border: none;
        }

        .btn-primary:hover {
            background-color: #5e4ee3;
            transform: scale(1.05);
        }

        .btn-danger {
            background-color: #e74c3c;
            color: white;
            border: none;
        }

        .btn-danger:hover {
            background-color: #c0392b;
            transform: scale(1.05);
        }

        .btn-warning {
            background-color: #f39c12;
            color: white;
            border: none;
        }

        .btn-warning:hover {
            background-color: #e67e22;
            transform: scale(1.05);
        }

        /* Modal */
        .modal-content {
            border-radius: 8px;
        }

        .modal-header {
            background-color: #6c5ce7;
            color: white;
        }

        .modal-footer {
            border-top: 1px solid #ddd;
        }

        /* Footer */
        footer {
            text-align: center;
            font-size: 14px;
            color: #888;
            padding: 20px 0;
            background-color: #f7f8fa;
            border-top: 1px solid #ddd;
        }

        /* Responsive */
        @media (max-width: 767px) {
            .header h2 {
                font-size: 28px;
            }
            .btn {
                padding: 8px 20px;
            }
        }
    </style>
</head>

<body>

    <div class="header">
        <h2><b>Admin - Manajemen Pengguna & Sparepart</b></h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="Home_admin.php" class="text-white">Home</a></li>
                <li class="breadcrumb-item"><a href="dashboard_admin.php" class="text-white">Dashboard</a></li>
            </ol>
        </nav>
        <p>Selamat datang di panel admin, kelola pengguna dan sparepart di sini!</p>
    </div>

    <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="user-tab" data-bs-toggle="tab" href="#user" role="tab" aria-controls="user" aria-selected="true">Kelola Pengguna</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="sparepart-tab" data-bs-toggle="tab" href="#sparepart" role="tab" aria-controls="sparepart" aria-selected="false">Kelola Spareparts</a>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="user" role="tabpanel" aria-labelledby="user-tab">
                <h4>Daftar Pengguna</h4>
                <p>Kelola pengguna terdaftar dan role mereka dalam sistem.</p>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Nama Pengguna</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($resultUsers->num_rows > 0) {
                                while ($row = $resultUsers->fetch_assoc()) {
                                    $role = getRole($row['username']);
                                    echo "<tr>
                                            <td>" . htmlspecialchars($row['username']) . "</td>
                                            <td>" . htmlspecialchars($role) . "</td>
                                            <td>
                                                <button class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#deleteUserModal' data-id='" . $row['id'] . "'><i class='fas fa-trash-alt'></i> Hapus</button>
                                            </td>
                                        </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='3'>Tidak ada pengguna ditemukan.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="tab-pane fade" id="sparepart" role="tabpanel" aria-labelledby="sparepart-tab">
                <h4>Daftar Spareparts</h4>
                <p>Lihat dan kelola spareparts yang tersedia di sistem.</p>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Nama Sparepart</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($resultSpareparts->num_rows > 0) {
                                while ($row = $resultSpareparts->fetch_assoc()) {
                                    echo "<tr>
                                            <td>" . htmlspecialchars($row['nama']) . "</td>
                                            <td>" . htmlspecialchars($row['kategori']) . "</td>
                                            <td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>
                                            <td>
                                                <a href='edit_admin.php?id=" . $row['id'] . "' class='btn btn-warning'><i class='fas fa-edit'></i> Edit</a>
                                                <button class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#deleteSparepartModal' data-id='" . $row['id'] . "'><i class='fas fa-trash-alt'></i> Hapus</button>
                                            </td>
                                        </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='4'>Tidak ada spareparts ditemukan.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Hapus Pengguna -->
    <div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteUserModalLabel">Konfirmasi Hapus Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus pengguna ini?
                </div>
                <div class="modal-footer">
                    <form method="post" action="">
                        <input type="hidden" name="user_id" id="user_id" value="">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" name="delete_user" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Hapus Sparepart -->
    <div class="modal fade" id="deleteSparepartModal" tabindex="-1" aria-labelledby="deleteSparepartModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteSparepartModalLabel">Konfirmasi Hapus Sparepart</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus sparepart ini?
                </div>
                <div class="modal-footer">
                    <form method="post" action="">
                        <input type="hidden" name="sparepart_id" id="sparepart_id" value="">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" name="delete_sparepart" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <script>
        // Event listener untuk tombol Hapus Pengguna
        var deleteUserButtons = document.querySelectorAll('[data-bs-toggle="modal"][data-bs-target="#deleteUserModal"]');
        deleteUserButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var userId = this.getAttribute('data-id');
                document.getElementById('user_id').value = userId;
            });
        });

        // Event listener untuk tombol Hapus Sparepart
        var deleteSparepartButtons = document.querySelectorAll('[data-bs-toggle="modal"][data-bs-target="#deleteSparepartModal"]');
        deleteSparepartButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var sparepartId = this.getAttribute('data-id');
                document.getElementById('sparepart_id').value = sparepartId;
            });
        });
    </script>

</body>
</html>
