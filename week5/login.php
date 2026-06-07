<?php
session_start();
require_once 'db_connect.php';

$error_msg = "";

// Handle the Form POST submission request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user inputs to prevent basic SQL injection issues
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Query the users table for matching credentials
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        // Logged in successfully! Save user to session global tracking
        $_SESSION['user'] = $username;
        
        // Redirect right away to your role-based dashboard interface
        header("Location: dashboard.php");
        exit();
    } else {
        // Flash warning indicator on screen if record doesn't match
        $error_msg = "User not found!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ElecHub Login</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #2c3e50; margin: 0; padding: 0; display: flex; justify-content: center; align-items: center; height: 100vh; color: #fff;">

    <div style="background-color: #34495e; padding: 40px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.3); width: 100%; max-width: 400px; text-align: center;">
        
        <h2 style="margin-bottom: 10px; font-size: 28px; font-weight: bold;">ElecHub Sign In</h2>
        <p style="color: #bdc3c7; margin-bottom: 25px; font-size: 14px;">Access your active digital storefront panel</p>

        <?php if (!empty($error_msg)) { ?>
            <div style="background-color: #e74c3c; color: white; padding: 10px; border-radius: 4px; margin-bottom: 20px; font-weight: bold; font-size: 14px;">
                ⚠️ <?php echo htmlspecialchars($error_msg); ?>
            </div>
        <?php } ?>

        <form method="POST" action="login.php">
            <div style="text-align: left; margin-bottom: 15px;">
                <label style="display: block; font-size: 13px; color: #bdc3c7; margin-bottom: 5px; font-weight: bold;">Username / Email:</label>
                <input type="text" name="username" placeholder="e.g., customer@elechub.com" required style="width: 90%; padding: 12px; border: 1px solid #2c3e50; border-radius: 4px; background-color: #ecf0f1; color: #2c3e50; font-size: 14px; outline: none;">
            </div>

            <div style="text-align: left; margin-bottom: 25px;">
                <label style="display: block; font-size: 13px; color: #bdc3c7; margin-bottom: 5px; font-weight: bold;">Password:</label>
                <input type="password" name="password" placeholder="••••••••" required style="width: 90%; padding: 12px; border: 1px solid #2c3e50; border-radius: 4px; background-color: #ecf0f1; color: #2c3e50; font-size: 14px; outline: none;">
            </div>

            <button type="submit" style="width: 100%; padding: 12px; background-color: #3498db; color: white; border: none; border-radius: 4px; font-size: 16px; font-weight: bold; cursor: pointer; transition: background 0.2s ease;">
                Login
            </button>
        </form>

    </div>

</body>
</html>