<?php
session_start();

// Authorization Gatekeeping check routine
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Storefront Dashboard</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f8fafc; padding: 40px; text-align: center; }
        .panel { background: white; max-width: 550px; margin: 50px auto; padding: 40px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .links-container { margin: 25px 0; padding: 15px; background: #f1f5f9; border-radius: 6px; text-align: left; display: inline-block; width: 100%; box-sizing: border-box; }
        .links-container a { display: block; margin: 10px 0; color: #2b5a9e; font-weight: bold; text-decoration: none; }
        .links-container a:hover { text-decoration: underline; }
        .btn-logout { display: inline-block; margin-top: 15px; background: #dc2626; color: white; padding: 10px 20px; border-radius: 4px; font-weight: bold; text-decoration: none; }
        .btn-logout:hover { background: #b91c1c; }
    </style>
</head>
<body>

    <div class="panel">
        <h2>🛍️ Customer Storefront Dashboard</h2>
        <p style="font-size: 18px;">Welcome back, <strong><?php echo htmlspecialchars($_SESSION['user']); ?></strong>!</p>
        <p style="color: #64748b;">Your application session is encrypted and securely authenticated.</p>
        
        <div class="links-container">
            <span style="color: #64748b; font-size: 14px; font-weight: bold; text-transform: uppercase;">Navigation Menu:</span>
            <a href="profile.php">👤 Manage My Account Profile (Bonus Feature)</a>
            <a href="../week6/products.php">🛒 Browse Product Inventory Catalog</a>
        </div>
        
        <br>
        <a href="logout.php" class="btn-logout">Sign Out of Account</a>
    </div>

</body>
</html>