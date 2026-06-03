<?php
session_start();
require_once 'db_connect.php';
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        if ($password === $user['password']) {
            $_SESSION['user'] = $user['username'];
            header("Location: dashboard.php");
            exit();
        } else { 
            $error = "Invalid password!"; 
        }
    } else { 
        $error = "User not found!"; 
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ElecHub Login</title>
</head>
<body style="font-family: Arial, sans-serif; background: #2c3e50; text-align: center; padding-top: 100px; color: white;">
    <div style="background: #34495e; width: 320px; margin: 0 auto; padding: 30px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.2);">
        <h2>ElecHub Sign In</h2>
        <?php if(!empty($error)) echo "<p style='color: #e74c3c; font-weight: bold;'>$error</p>"; ?>
        <form method="POST" action="">
            <input type="text" name="username" placeholder="Username/Email" required style="width: 90%; padding: 10px; margin: 10px 0; border-radius: 4px; border: none;"><br>
            <input type="password" name="password" placeholder="Password" required style="width: 90%; padding: 10px; margin: 10px 0; border-radius: 4px; border: none;"><br>
            <button type="submit" style="background: #3498db; color: white; padding: 10px; width: 96%; font-weight: bold; cursor: pointer; border: none; border-radius: 4px; margin-top: 10px;">Login</button>
        </form>
    </div>
</body>
</html>