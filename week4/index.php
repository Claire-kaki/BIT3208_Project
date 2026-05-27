<?php
include 'includes/header.php';

$error_message = "";

// Check if form data was sent to the server via POST method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Week 4 Syllabus Target: Simple Backend Hardcoded Authentication Check
    if ($username === "admin@elechub.com" && $password === "123456") {
        $_SESSION['user'] = "Administrator";
        $_SESSION['role'] = "Store Manager";
        
        // Redirect directly to the secure dashboard zone
        header("Location: dashboard.php");
        exit();
    } else {
        $error_message = "❌ Access Denied: Invalid Username or Password!";
    }
}
?>

<div class="container" style="margin-top: 60px;">
    <div class="card">
        <h3>System Access Authentication</h3>
        
        <?php if(!empty($error_message)): ?>
            <div class="alert alert-danger"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <form action="index.php" method="POST">
            <div class="form-group">
                <label>Username / Staff Email Identifier</label>
                <input type="email" name="username" class="form-control" placeholder="Enter admin@elechub.com" required>
            </div>
            <div class="form-group">
                <label>Security Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter 123456" required>
            </div>
            <button type="submit" class="btn">Authenticate Access</button>
        </form>
    </div>
</div>

</body>
</html>