<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test</title>
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
?>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
                </li>
            </ul>
        </div>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
