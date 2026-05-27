<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart E-Commerce - Electronics Portal</title>
    <style>
        /* Theme Configurations */
        :root {
            --primary-color: #2c3e50; /* Deep Slate Blue */
            --accent-color: #3498db;  /* Interactive Blue */
            --bg-color: #f8f9fa;      /* Clean Off-White */
            --card-bg: #ffffff;
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: var(--bg-color);
            margin: 0;
            padding: 0;
        }

        /* Top Sticky Navigation Bar */
        .navbar {
            background-color: var(--primary-color);
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .navbar h2 {
            margin: 0;
            font-size: 1.4rem;
        }

        .nav-links a {
            color: #edf2f7;
            text-decoration: none;
            margin-left: 20px;
            font-weight: 500;
        }

        .container {
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .welcome-header {
            text-align: center;
            margin-bottom: 40px;
        }

        /* Two-Column Form Layout Grid */
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

        .card h3 {
            margin-top: 0;
            color: var(--primary-color);
            border-bottom: 2px solid #f1f3f5;
            padding-bottom: 10px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #4a5568;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #cbd5e0;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .btn {
            background-color: var(--accent-color);
            color: white;
            border: none;
            padding: 12px 20px;
            font-weight: bold;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            transition: background 0.2s;
        }

        .btn:hover {
            background-color: #2980b9;
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
        <div class="welcome-header">
            <h1>Week 2: UI/UX & GUI Layout Mockup</h1>
            <p style="color: #7f8c8d;">Theme: Electronics & Audio Accessories Management Portal</p>
        </div>

        <div class="gui-grid">
            <div class="card">
                <h3>User Authentication Interface</h3>
                <form onsubmit="return false;">
                    <div class="form-group">
                        <label>Username or Staff Email Address</label>
                        <input type="text" class="form-control" placeholder="e.g., admin@elechub.com">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" placeholder="Enter security passphrase...">
                    </div>
                    <button class="btn">Sign In to Dashboard</button>
                </form>
            </div>

            <div class="card">
                <h3>Inventory Control: Add New Accessory</h3>
                <form onsubmit="return false;">
                    <div class="form-group">
                        <label>Product Name / Nomenclature</label>
                        <input type="text" class="form-control" placeholder="e.g., Fast Charger, Wireless Earbuds, Portable Speaker">
                    </div>
                    <div class="form-group">
                        <label>Accessory Category</label>
                        <select class="form-control">
                            <option>Chargers & Cables</option>
                            <option>Earphones & Headphones</option>
                            <option>Wireless Buds</option>
                            <option>Portable Speakers</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Price Value (KES)</label>
                        <input type="number" class="form-control" placeholder="e.g., 2500">
                    </div>
                    <button class="btn">Save Product Prototype Record</button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>