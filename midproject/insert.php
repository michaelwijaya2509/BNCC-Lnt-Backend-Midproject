<?php
    // Hubungkan ke database
    include 'db.php';

    // Periksa apakah form telah dikirim menggunakan metode POST
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
            echo "<p>Registrasi berhasil! <a href='LoginPage.php'>Login sekarang</a></p>";
        } else {
            echo "<p>Terjadi kesalahan: " . $stmt->error . "</p>";
        }

        // Tutup statement dan koneksi
        $stmt->close();
        $conn->close();
    } else {
        echo "<p>Akses ditolak. Harap isi form registrasi.</p>";
    }
?>
