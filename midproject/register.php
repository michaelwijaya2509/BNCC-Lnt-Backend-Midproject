<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="script.js"></script>
    <style>
        .alert {
            max-width: 400px;
            margin: 10px auto;
        }
    </style>
</head>

<body onload="setRandomId()">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center mt-5">Register</h1>

                <!-- Notifikasi Error -->
                <?php if (isset($_GET['error']) && $_GET['error'] == 'username_taken'): ?>
                    <div class="alert alert-danger">Username is already taken. Please choose another one.</div>
                <?php endif; ?>

                <form action="insert.php" method="POST">
                    <input type="hidden" id="userId" name="userId">

                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Register</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
