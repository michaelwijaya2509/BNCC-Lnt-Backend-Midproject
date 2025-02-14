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
        <style>
        body {
            background: url('bg3.jpg') no-repeat center center fixed;
            background-size: cover;
            color: white;
        }
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
        }
        .container {
            position: relative;
            z-index: 1;
            max-width: 500px;
        }
        .content-box {
            background: rgba(255, 255, 255, 0.2);
            padding: 15px;
            border-radius: 10px;
            backdrop-filter: blur(10px);
            text-align: center;
        }
        .navbar {
            background: rgba(0, 0, 0, 0.7);
        }
        .fade-out {
        opacity: 0;
        transition: opacity 0.5s ease-out;
        }
    </style>
    </head>
    <body>
        <div class="overlay"></div>
            <nav class="navbar navbar-expand-lg navbar-dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="index.php">Dashboard</a>
                </div>
            </nav>
            
        <div class="container mt-4">
            <div class="content-box">
                <h2>Book Details</h2>
                <p><strong>ID:</strong> <?php echo htmlspecialchars($book['id']); ?></p>
                <p><strong>Title:</strong> <?php echo htmlspecialchars($book['name']); ?></p>
                <p><strong>Author:</strong> <?php echo htmlspecialchars($book['author']); ?></p>
                <p><strong>Publisher:</strong> <?php echo htmlspecialchars($book['publisher']); ?></p>
                <p><strong>Number of Pages:</strong> <?php echo htmlspecialchars($book['number_of_page']); ?></p>
                <a href="index.php" class="btn btn-secondary">Back to Main Page</a>
            </div>
        </div>
    </body>
</html>
