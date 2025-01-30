<?php
    session_start(); 

    
    include 'db.php';

    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $username = $_POST['username'];
        $password = $_POST['password'];

        
        $query = "SELECT * FROM user WHERE username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        
        if ($result->num_rows > 0) {
            
            $user = $result->fetch_assoc();

          
            if (password_verify($password, $user['password'])) {
               
                $_SESSION['userId'] = $user['id'];
                $_SESSION['username'] = $user['username'];

                
                header('Location: index.php');
                exit();
            } else {
               
                echo "<p>Password salah. Silakan coba lagi.</p>";
            }
        } else {
            
            echo "<p>Username tidak ditemukan.</p>";
        }

        $stmt->close();
        $conn->close();
    }
?>
