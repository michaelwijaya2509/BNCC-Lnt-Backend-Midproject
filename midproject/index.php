<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
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

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Tombol untuk membuka sidebar -->
            <button class="btn btn-outline-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#profileSidebar">
                Profil
            </button>
        </div>
    </nav>

    <!-- Sidebar Profil -->
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
            <a href="addbook.php" class="btn btn-secondary">Add New Book</a>
        </div>
        
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
