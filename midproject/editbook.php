<?php
session_start();
include 'db.php';

// Pastikan pengguna sudah login
if (!isset($_SESSION['userId'])) {
    header("Location: login.php");
    exit();
}

// Pastikan ada parameter id
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

// Jika form dikirim
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['name'];
    $author = $_POST['author'];
    $publisher = $_POST['publisher'];
    $number_of_page = $_POST['number_of_page'];

    $update_query = "UPDATE book SET name = ?, author = ?, publisher = ?, number_of_page = ? WHERE id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("sssii", $name, $author, $publisher, $number_of_page, $book_id);
    
    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Gagal memperbarui buku.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
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
            <h2>Edit Book</h2>
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($book['name']); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Author</label>
                    <input type="text" name="author" class="form-control" value="<?php echo htmlspecialchars($book['author']); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Publisher</label>
                    <input type="text" name="publisher" class="form-control" value="<?php echo htmlspecialchars($book['publisher']); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Number of Pages</label>
                    <input type="number" name="number_of_page" class="form-control" value="<?php echo htmlspecialchars($book['number_of_page']); ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="index.php" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</body>
</html>
