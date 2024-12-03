<?php
require_once('koneksi.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    if (empty($username) || empty($password)) {
        $error = "Username dan password harus diisi.";
    } elseif ($password !== $confirm_password) {
        $error = "Password dan konfirmasi password tidak cocok.";
    } else {
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error = "Username sudah terdaftar. Silakan gunakan username lain.";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $insertStmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $insertStmt->bind_param("ss", $username, $hashedPassword);
            if ($insertStmt->execute()) {
                header("Location: login.php?register=success");
                exit;
            } else {
                $error = "Terjadi kesalahan saat menyimpan data pengguna.";
            }
            $insertStmt->close();
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - Pendataan Sparepart Laptop dan Komputer</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            min-height: 100vh;
            background:linear-gradient(45deg, #007bff, #00d4ff);
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Arial', sans-serif;
        }

        .container {
            max-width: 400px;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            text-align: center;
            box-shadow: 10px 10px 20px 1px rgba(0, 0, 0, 0.8);
            -webkit-box-shadow: 10px 10px 20px 1px rgba(0, 0, 0, 0.8);
            -moz-box-shadow: 10px 10px 20px 1px rgba(0, 0, 0, 0.8);
        }

        .form-signin {
            width: 100%;
            padding: 1rem;
        }

        .form-signin input {
            height: 45px;
            margin-bottom: 15px;
            border-radius: 50px;
            padding-left: 45px;
            box-shadow: 10px 10px 20px 1px rgba(0, 0, 0, 0.8);
            -webkit-box-shadow: 10px 10px 20px 1px rgba(0, 0, 0, 0.8);
            -moz-box-shadow: 10px 10px 20px 1px rgba(0, 0, 0, 0.8);
        }

        .form-signin .form-control:focus {
            border-color: #6a11cb;
            box-shadow: 0 0 8px rgba(106, 17, 203, 0.8);
        }

        .form-signin .input-group-text {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6a11cb;
        }

        .btn-primary {
            width: 100%;
            border-radius: 50px;
            padding: 10px;
            background-color: #6a11cb;
            border: none;
            font-size: 18px;
            transition: background-color 0.3s ease;
            box-shadow: 10px 10px 20px 1px rgba(0, 0, 0, 0.8);
            -webkit-box-shadow: 10px 10px 20px 1px rgba(0, 0, 0, 0.8);
            -moz-box-shadow: 10px 10px 20px 1px rgba(0, 0, 0, 0.8);
        }

        .btn-primary:hover {
            background-color: #2575fc;
        }

        .text-danger {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="mb-4">Registrasi Pengguna Baru</h2>
        <form class="form-signin" method="POST">
            <div class="input-group mb-3 position-relative">
                <span class="input-group-text">
                    <i class="fas fa-user"></i>
                </span>
                <input type="text" id="username" name="username" class="form-control" placeholder="Username" required>
            </div>
            <div class="input-group mb-3 position-relative">
                <span class="input-group-text">
                    <i class="fas fa-lock"></i>
                </span>
                <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <div class="input-group mb-3 position-relative">
                <span class="input-group-text">
                    <i class="fas fa-lock"></i>
                </span>
                <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Konfirmasi Password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Daftar</button>
            <?php if (!empty($error)) {
                echo '<p class="text-danger">' . $error . '</p>';
            } ?>
        </form>
        <p class="mt-3">Sudah punya akun? <a href="login.php">Login di sini</a>.</p>
    </div>
</body>

</html>
