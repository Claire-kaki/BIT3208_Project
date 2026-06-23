<?php
session_start();
include("../week6/connection.php");

$error_msg = "";

if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {
        // Safe parameter identification via prepared selection criteria
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($user = $result->fetch_assoc()) {
            // Check password against the stored database hash
            if (password_verify($password, $user['password'])) {
                // Initialize Session Variables
                $_SESSION['user'] = $user['fullname'];
                $_SESSION['email'] = $user['email'];
                
                header("Location: dashboard.php");
                exit();
            } else {
                $error_msg = "Invalid Password.";
            }
        } else {
            $error_msg = "No account found with that email.";
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Login</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f1f5f9; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
        .auth-card { background: white; width: 100%; max-width: 400px; padding: 35px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); }
        h2 { margin-top: 0; color: #1e293b; text-align: center; }
        input { width: 100%; padding: 12px; margin: 8px 0 20px 0; border: 1px solid #cbd5e1; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 12px; border: none; border-radius: 4px; background: #10b981; color: white; font-weight: bold; cursor: pointer; font-size: 15px; }
        button:hover { background: #059669; }
        .error { color: #dc2626; font-weight: bold; text-align: center; }
        p { text-align: center; }
    </style>
</head>
<body>

<div class="auth-card">
    <h2>Secure Sign In</h2>
    <?php if(!empty($error_msg)) { echo "<p class='error'>$error_msg</p>"; } ?>
    <form method="POST" action="login.php">
        <label>Email Address</label>
        <input type="email" name="email" placeholder="name@example.com" required>
        
        <label>Password</label>
        <input type="password" name="password" placeholder="Enter password" required>
        
        <button type="submit" name="login">Login</button>
    </form>
    <p>Don't have an account? <a href="register.php">Register here</a></p>
</div>

</body>
</html>