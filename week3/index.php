<?php
// Task 4: Basic PHP Database Connection String Practice
$host = "localhost";
$user = "root";
$pass = "";
$db   = "week1db"; // Uses your established local database schema

$conn = mysqli_connect($host, $user, $pass, $db);
$db_status = "Connected Successfully";
if (!$conn) {
    $db_status = "Connection Failed: " . mysqli_connect_error();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart E-Commerce - Week 3 Interactivity</title>
    <style>
        :root {
            --primary-color: #2c3e50;
            --accent-color: #3498db;
            --bg-color: #f8f9fa;
            --card-bg: #ffffff;
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: var(--bg-color);
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: var(--primary-color);
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
        }

        .navbar h2 { margin: 0; font-size: 1.4rem; }
        .nav-links a { color: #edf2f7; text-decoration: none; margin-left: 20px; font-weight: 500; }

        .container {
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .status-badge {
            background-color: #e3faf2;
            color: #0ca678;
            padding: 8px 15px;
            border-radius: 4px;
            display: inline-block;
            font-weight: bold;
            margin-bottom: 25px;
        }

        .gui-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 30px;
        }

        .card {
            background: var(--card-bg);
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            border-top: 4px solid var(--accent-color);
        }

        .card h3 { margin-top: 0; color: var(--primary-color); border-bottom: 2px solid #f1f3f5; padding-bottom: 10px; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: bold; color: #4a5568; }
        .form-control { width: 100%; padding: 10px; border: 1px solid #cbd5e0; border-radius: 4px; box-sizing: border-box; }
        
        .btn {
            background-color: var(--accent-color); color: white; border: none; padding: 12px 20px;
            font-weight: bold; border-radius: 4px; cursor: pointer; width: 100%;
        }

        /* Live Preview Styles */
        .preview-box {
            background: #fff; border: 2px dashed #cbd5e0; padding: 20px; text-align: center; border-radius: 6px; margin-top: 15px;
        }
    </style>
</head>
<body>

    <div class="navbar">
        <h2>Smart Electronics Hub</h2>
        <div class="nav-links">
            <a href="#">Home Catalog</a>
            <a href="#">Audio Accessories</a>
            <a href="#">Admin Dashboard</a>
        </div>
    </div>

    <div class="container">
        <div style="text-align: center; margin-bottom: 30px;">
            <h1>Week 3: JavaScript Programming Foundations</h1>
            <div class="status-badge">📡 Database String Status: <?php echo $db_status; ?></div>
        </div>

        <div class="gui-grid">
            <div class="card">
                <h3>User Authentication Interface</h3>
                <form id="loginForm" action="" method="POST">
                    <div class="form-group">
                        <label>Username or Staff Email Address</label>
                        <input type="text" id="adminEmail" class="form-control" placeholder="e.g., admin@elechub.com" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" id="adminPassword" class="form-control" placeholder="Enter security passphrase..." required>
                        <small id="passwordStrength" style="display:block; margin-top:5px; font-weight:bold;"></small>
                    </div>
                    <button type="submit" class="btn">Sign In to Dashboard</button>
                </form>
            </div>

            <div class="card">
                <h3>Inventory Control: Add New Accessory</h3>
                <form id="productForm" onsubmit="return false;">
                    <div class="form-group">
                        <label>Product Name / Nomenclature</label>
                        <input type="text" id="prod_name" class="form-control" placeholder="Type Charger, Earphones, Buds..." required>
                    </div>
                    <div class="form-group">
                        <label>Price Value (KES)</label>
                        <input type="number" class="form-control" placeholder="e.g., 2500" required>
                    </div>
                    <button class="btn">Save Product Prototype Record</button>
                </form>

                <div class="preview-box">
                    <p style="color:#7f8c8d; font-size:0.8rem; text-transform:uppercase; margin:0 0 5px 0;">Live Display Preview</p>
                    <h3 id="livePreviewTitle" style="color: var(--primary-color); margin:5px 0;">New Product Preview</h3>
                    <span style="background:#e3faf2; color:#0ca678; padding:3px 8px; border-radius:10px; font-size:0.75rem; font-weight:bold;">In Stock</span>
                </div>
            </div>
        </div>
    </div>

    <script src="js/validation.js"></script>
</body>
</html>