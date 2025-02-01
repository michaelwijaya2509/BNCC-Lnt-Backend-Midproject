<?php
    session_start();
    include 'db.php';

    // Pastikan pengguna sudah login
    if (!isset($_SESSION['userId'])) {
        header("Location: login.php");
        exit();
    }

    // Pastikan ada parameter id di URL
    if (!isset($_GET['id'])) {
        header("Location: index.php");
        exit();
    }

    $book_id = $_GET['id'];

    // Ambil data buku berdasarkan ID
    $query = "SELECT * FROM book WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $book_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $book = $result->fetch_assoc();

    if (!$book) {
        echo "Buku tidak ditemukan!";
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>View Book</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container mt-4">
            <h2>Book Details</h2>
            <p><strong>ID:</strong> <?php echo htmlspecialchars($book['id']); ?></p>
            <p><strong>Title:</strong> <?php echo htmlspecialchars($book['name']); ?></p>
            <p><strong>Author:</strong> <?php echo htmlspecialchars($book['author']); ?></p>
            <p><strong>Publisher:</strong> <?php echo htmlspecialchars($book['publisher']); ?></p>
            <p><strong>Number of Pages:</strong> <?php echo htmlspecialchars($book['number_of_page']); ?></p>
            <a href="index.php" class="btn btn-secondary">Back to Main Page</a>
        </div>
    </body>
</html>
