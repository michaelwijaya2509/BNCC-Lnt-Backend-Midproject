<?php
// Hubungkan ke database
include 'db.php';

// Variabel untuk menampilkan pesan
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $userId = intval($_POST['userId']); // ID dari input hidden
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Enkripsi password

    // Query untuk memasukkan data ke tabel 'users'
    $query = "INSERT INTO user (id, username, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('iss', $userId, $username, $password);

    // Eksekusi query dan periksa keberhasilannya
    if ($stmt->execute()) {
        $message = "<div class='alert alert-success'>Registrasi berhasil! <a href='LoginPage.php'>Login sekarang</a></div>";
    } else {
        $message = "<div class='alert alert-danger'>Terjadi kesalahan: " . $stmt->error . "</div>";
    }

    // Tutup statement dan koneksi
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 400px;
            margin-top: 50px;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .btn-register {
            width: 100%;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Registrasi</h2>
    
    <!-- Menampilkan pesan sukses atau error -->
    <?php echo $message; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>