<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
        }
        .content-box {
            background: rgba(255, 255, 255, 0.2);
            padding: 20px;
            border-radius: 10px;
            backdrop-filter: blur(10px);
            text-align: center;
        }
        .navbar {
            background: rgba(0, 0, 0, 0.7);
        }
        .table-container {
            background: rgba(255, 255, 255, 0.2);
            padding: 20px;
            border-radius: 10px;
            backdrop-filter: blur(10px);
        }
        .fade-out {
            opacity: 0;
            transition: opacity 0.5s ease-out;
        }
    </style>
</head>
<body>
<?php
        session_start();
        include 'db.php';

        // Pastikan pengguna sudah login
        if (isset($_SESSION['userId'])) {
            $user_id = $_SESSION['userId'];
            $query = "SELECT id, username FROM user WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
        } else {
            header("Location: login.php"); // Redirect ke halaman login jika belum login
            exit();
        }

        // Ambil data buku berdasarkan user yang login
        $bookQuery = "SELECT * FROM book WHERE user_id = ?";
        $stmt = $conn->prepare($bookQuery);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $books = $stmt->get_result();
    ?>
    <div class="overlay"></div>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <button class="btn btn-outline-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#profileSidebar">Profil</button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="profileSidebar" aria-labelledby="profileSidebarLabel">
            <div class="offcanvas-header">
                <h5 id="profileSidebarLabel">Profil Pengguna</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <p><strong>Nama:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
                <p><strong>ID:</strong> <?php echo htmlspecialchars($user['id']); ?></p>
                <a href="LoginPage.php" class="btn btn-danger">Logout</a>
            </div>
        </div>

    <div class="container mt-4">
        <div class="table-container">
            <h2 class="text-center">Your Book Info</h2>
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Publisher</th>
                        <th>Number of Page</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($book = $books->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($book['id']); ?></td>
                        <td><?php echo htmlspecialchars($book['name']); ?></td>
                        <td><?php echo htmlspecialchars($book['author']); ?></td>
                        <td><?php echo htmlspecialchars($book['publisher']); ?></td>
                        <td><?php echo htmlspecialchars($book['number_of_page']); ?></td>
                        <td><a href="viewbook.php?id=<?php echo $book['id']; ?>" class="btn btn-info">View</a></td>
                        <td><a href="editbook.php?id=<?php echo $book['id']; ?>" class="btn btn-warning">Edit</a></td>
                        <td><a href="deletebook.php?id=<?php echo $book['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure?');">Delete</a></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

            <div class="d-flex justify-content-end">
                <a href="addbook.php" class="btn btn-secondary" id="addNewBookButton">Add New Book</a>
            </div>
        </div>
    </div>

    <footer class="text-center py-3 mt-4" style="background: rgba(0, 0, 0, 0.7);">
        <p>&copy; 2025 Michael & Frizzia Website. All Rights Reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.getElementById('addNewBookButton').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent instant navigation
        document.body.classList.add('fade-out'); // Apply fade effect
        setTimeout(() => {
            window.location.href = this.href; // Redirect after animation
        }, 500); // Matches the CSS transition duration
    });
    </script>
</body>
</html>
