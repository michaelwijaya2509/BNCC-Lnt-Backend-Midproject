<?php
    session_start();
    include 'db.php';

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
    <script src="script.js"></script>
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
            <h2>Add New Book</h2>
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="name" class="form-label">Book Title</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="author" class="form-label">Author</label>
                    <input type="text" class="form-control" id="author" name="author" required>
                </div>
                <div class="mb-3">
                    <label for="publisher" class="form-label">Publisher</label>
                    <input type="text" class="form-control" id="publisher" name="publisher" required>
                </div>
                <div class="mb-3">
                    <label for="number_of_page" class="form-label">Number of Pages</label>
                    <input type="number" class="form-control" id="number_of_page" name="number_of_page" required>
                </div>
                <button type="submit" class="btn btn-primary">Add Book</button>
                <a href="index.php" class="btn btn-secondary" id="cancelButton">Cancel</a>
            </form>
        </div>
    </div>

    <footer class="text-center py-3 mt-4" style="background: rgba(0, 0, 0, 0.7);">
        <p>&copy; 2025 Michael & Frizzia Website. All Rights Reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.getElementById('cancelButton').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent instant navigation
        document.body.classList.add('fade-out'); // Apply fade effect
        setTimeout(() => {
            window.location.href = this.href; // Redirect after animation
        }, 500); // Matches the CSS transition duration
    });
</script>
</body>
</html>