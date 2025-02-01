<?php
    session_start();
    include 'db.php';

    // Pastikan pengguna sudah login
    if (!isset($_SESSION['userId'])) {
        header("Location: login.php");
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $author = $_POST['author'];
        $publisher = $_POST['publisher'];
        $number_of_page = $_POST['number_of_page'];
        $user_id = $_SESSION['userId'];

        $query = "INSERT INTO book (name, author, publisher, number_of_page, user_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssii", $name, $author, $publisher, $number_of_page, $user_id);

        if ($stmt->execute()) {
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">Add New Book</h2>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Book Title</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Author</label>
                <input type="text" name="author" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Publisher</label>
                <input type="text" name="publisher" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Number of Pages</label>
                <input type="number" name="number_of_page" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Book</button>
            <a href="index.php" class="btn btn-secondary">Back</a>
        </form>
    </div>
</body>
</html>
