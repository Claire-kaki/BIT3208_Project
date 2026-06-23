<?php
include("../week6/connection.php");

$feedback_msg = "";

if (isset($_POST['register'])) {
    $name = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $plain_password = $_POST['password'];

    if (empty($name) || empty($email) || empty($plain_password)) {
        $feedback_msg = "<p style='color: #dc2626; font-weight: bold;'>All fields are required.</p>";
    } else {
        // Industry Standard: Secure Password Hashing
        $hashed_password = password_hash($plain_password, PASSWORD_DEFAULT);

        // Security Best Practice: Prepared Statement to prevent SQL Injection
        $stmt = $conn->prepare("INSERT INTO users (fullname, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $hashed_password);

        if ($stmt->execute()) {
            $feedback_msg = "<p style='color: #16a34a; font-weight: bold;'>Registration Successful! <a href='login.php'>Login here</a></p>";
        } else {
            $feedback_msg = "<p style='color: #dc2626; font-weight: bold;'>Registration failed. Email might already exist.</p>";
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Registration</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f1f5f9; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
        .auth-card { background: white; width: 100%; max-width: 400px; padding: 35px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); }
        h2 { margin-top: 0; color: #1e293b; text-align: center; }
        input { width: 100%; padding: 12px; margin: 8px 0 20px 0; border: 1px solid #cbd5e1; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 12px; border: none; border-radius: 4px; background: #2b5a9e; color: white; font-weight: bold; cursor: pointer; font-size: 15px; }
        button:hover { background: #1e3f70; }
        p { text-align: center; }
    </style>
</head>
<body>

<div class="auth-card">
    <h2>Create Shop Account</h2>
    <?php echo $feedback_msg; ?>
    <form method="POST" action="register.php">
        <label>Full Name</label>
        <input type="text" name="fullname" placeholder="Enter full name" required>
        
        <label>Email Address</label>
        <input type="email" name="email" placeholder="name@example.com" required>
        
        <label>Password</label>
        <input type="password" name="password" placeholder="Create a strong password" required>
        
        <button type="submit" name="register">Register</button>
    </form>
    <p>Already have an account? <a href="login.php">Login here</a></p>
</div>

</body>
</html>