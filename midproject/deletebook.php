<?php
session_start();
include 'db.php';

// Pastikan pengguna sudah login
if (!isset($_SESSION['userId'])) {
    header("Location: login.php");
    exit();
}

// Pastikan ada parameter id yang dikirim
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$book_id = $_GET['id'];

// Hapus buku berdasarkan ID
$delete_query = "DELETE FROM book WHERE id = ?";
$stmt = $conn->prepare($delete_query);
$stmt->bind_param("i", $book_id);
$stmt->execute();

// Reset ID secara berurutan kembali
$reset_query = "
    SET @count = 0;
    UPDATE book SET id = @count := @count + 1;
    ALTER TABLE book AUTO_INCREMENT = 1;
";
$conn->multi_query($reset_query);

// Redirect ke index setelah berhasil menghapus
header("Location: index.php");
exit();
?>
