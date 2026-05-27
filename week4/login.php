<?php
session_start();
require_once 'db_connect.php'; // Includes your DB connection string logic

$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']); 
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        // Verify hashed password
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user['username'];
            header("Location: dashboard.php");
            exit();
        } else { $error = "Invalid password credentials!"; }
    } else { $error = "User profile not registered!"; }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Gateway</title>
</head>
<body style="font-family: Arial, sans-serif; background: #2c3e50; color: white; text-align: center; padding-top: 100px;">
    <div style="background: #34495e; width: 350px; margin: 0 auto; padding: 30px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.3);">
        <h2>Staff Authentication</h2>
        
        <?php if($error) echo "<p style='color: #e74c3c; font-weight: bold;'>$error</p>"; ?>
        
        <form method="POST" action="">
            <input type="text" name="username" placeholder="admin@elechub.com" required 
                   style="width: 90%; padding: 10px; margin: 10px 0; border: none; border-radius: 4px;"><br>
            
            <input type="password" name="password" placeholder="Password" required 
                   style="width: 90%; padding: 10px; margin: 10px 0; border: none; border-radius: 4px;"><br>
            
            <button type="submit" style="background: #3498db; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; width: 96%; font-weight: bold;">Sign In</button>
        </form>
    </div>
</body>
</html>