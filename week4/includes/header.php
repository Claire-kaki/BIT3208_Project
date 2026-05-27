<?php
// Start the core PHP session engine to track users across pages
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Electronics Hub - Admin Portal</title>
    <style>
        :root {
            --primary-color: #2c3e50;
            --accent-color: #3498db;
            --bg-color: #f8f9fa;
            --card-bg: #ffffff;
        }
        body { font-family: 'Segoe UI', Arial, sans-serif; background-color: var(--bg-color); margin: 0; padding: 0; }
        .navbar { background-color: var(--primary-color); padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; color: white; }
        .navbar h2 { margin: 0; font-size: 1.4rem; }
        .nav-links a { color: #edf2f7; text-decoration: none; margin-left: 20px; font-weight: 500; }
        .container { max-width: 1100px; margin: 40px auto; padding: 0 20px; }
        .card { background: var(--card-bg); padding: 30px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border-top: 4px solid var(--accent-color); max-width: 450px; margin: 0 auto; }
        .card h3 { margin-top: 0; color: var(--primary-color); border-bottom: 2px solid #f1f3f5; padding-bottom: 10px; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: bold; color: #4a5568; }
        .form-control { width: 100%; padding: 10px; border: 1px solid #cbd5e0; border-radius: 4px; box-sizing: border-box; }
        .btn { background-color: var(--accent-color); color: white; border: none; padding: 12px 20px; font-weight: bold; border-radius: 4px; cursor: pointer; width: 100%; }
        .alert { padding: 12px; border-radius: 4px; margin-bottom: 20px; font-weight: bold; }
        .alert-danger { background-color: #fed7d7; color: #742a2a; border: 1px solid #feb2b2; }
        .alert-success { background-color: #c6f6d5; color: #22543d; border: 1px solid #9ae6b4; }
    </style>
</head>
<body>

    <div class="navbar">
        <h2>Smart Electronics Hub ⚡</h2>
        <div class="nav-links">
            <a href="index.php">Login Gateway</a>
            <?php if(isset($_SESSION['user'])): ?>
                <a href="dashboard.php" style="color: #63b3ed;">Admin Panel</a>
                <a href="logout.php" style="color: #feb2b2;">Logout (<?php echo htmlspecialchars($_SESSION['user']); ?>)</a>
            <?php endif; ?>
        </div>
    </div>