<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="script.js"></script>
    <style>
        body {
            background: url('bg1.jpg') no-repeat center center fixed;
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
        .form-container {
            background: rgba(255, 255, 255, 0.2);
            padding: 20px;
            border-radius: 10px;
            backdrop-filter: blur(10px);
        }
        .fade-out {
            opacity: 0;
            transition: opacity 0.5s ease-out;
        }
        .fade-in {
    opacity: 0;
    animation: fadeInAnimation 0.5s ease-in forwards;
}

.fade-out {
    opacity: 0;
    transition: opacity 0.5s ease-out;
}

@keyframes fadeInAnimation {
    from { opacity: 0; }
    to { opacity: 1; }
}

    </style>
</head>
<body class="fade-in">
    <div class="overlay"></div>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="col-md-6 form-container">
            <h1 class="text-center">Login</h1>
            <form action="login.php" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Username: </label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password: </label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-secondary w-100" id="loginButton">Login</button>
            </form>
            <div class="text-center mt-3">
                <a href="register.php" class="text-white" id="registerHere">Don't have an account? Register here</a>
            </div>
        </div>
    </div>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        // Transisi untuk semua tautan (a) agar smooth
        document.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', function(event) {
                if (!this.href.includes('#')) { // Hindari anchor links
                    event.preventDefault(); // Cegah navigasi langsung
                    document.body.classList.add('fade-out'); // Efek fade-out
                    setTimeout(() => {
                        window.location.href = this.href; // Redirect setelah animasi selesai
                    }, 500);
                }
            });
        });

        // Transisi untuk form (agar saat klik Register/Login ada efek fade-out)
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Cegah submit langsung
                document.body.classList.add('fade-out'); // Tambahkan efek fade-out
                setTimeout(() => {
                    this.submit(); // Kirim form setelah animasi selesai
                }, 500); // Sama dengan durasi CSS
            });
        });
    });
</script>
</body>
</html>
