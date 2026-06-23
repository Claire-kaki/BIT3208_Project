<?php
include("connection.php");

// --- 1. CREATE OPERATION (Adding New Records) ---
$feedback_msg = "";

if (isset($_POST['add_product'])) {
    $name  = trim($_POST['product_name']);
    $desc  = trim($_POST['description']);
    $price = $_POST['price'];
    $stock = $_POST['stock_quantity'];

    // Input Validation check
    if (empty($name) || empty($price) || empty($stock)) {
        $feedback_msg = "<p style='color: #dc2626; font-weight: bold;'>Error: All primary fields are required!</p>";
    } else {
        // Prepared statement pattern to secure incoming parameters
        $stmt = $conn->prepare("INSERT INTO products (product_name, description, price, stock_quantity) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssdi", $name, $desc, $price, $stock);
        
        if ($stmt->execute()) {
            $feedback_msg = "<p style='color: #16a34a; font-weight: bold;'>Success: Product Catalog Record Saved!</p>";
        } else {
            $feedback_msg = "<p style='color: #dc2626; font-weight: bold;'>Execution error encountered.</p>";
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>E-Commerce Inventory Manager</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; margin: 40px; background: #f8fafc; color: #1e293b; }
        .container { max-width: 1000px; margin: 0 auto; }
        .form-box { background: white; padding: 25px; border-radius: 8px; margin-bottom: 30px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        input, textarea { width: 100%; padding: 10px; margin: 8px 0 15px 0; border: 1px solid #cbd5e1; border-radius: 4px; box-sizing: border-box; }
        button { background: #2b5a9e; color: white; padding: 12px 20px; border: none; border-radius: 4px; font-weight: bold; cursor: pointer; }
        table { width: 100%; border-collapse: collapse; background: white; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border-radius: 8px; overflow: hidden; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #e2e8f0; }
        th { background-color: #2b5a9e; color: white; }
        .btn-edit { color: #2563eb; text-decoration: none; font-weight: bold; margin-right: 12px; }
        .btn-delete { color: #dc2626; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <h2>🛒 Store Inventory Catalog (Week 6 CRUD)</h2>
        
        <?php echo $feedback_msg; ?>

        <div class="form-box">
            <h3>Add New Product</h3>
            <form method="POST" action="products.php">
                <input type="text" name="product_name" placeholder="Product Name" required>
                <textarea name="description" placeholder="Product Specifications..."></textarea>
                <input type="number" step="0.01" name="price" placeholder="Price (KES)" required>
                <input type="number" name="stock_quantity" placeholder="Available Stock Units" required>
                <button type="submit" name="add_product">Save Product</button>
            </form>
        </div>

        <h3>Live Inventory Dashboard</h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Item Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Stock Level</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = mysqli_query($conn, "SELECT * FROM products ORDER BY product_id DESC");
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>#{$row['product_id']}</td>
                            <td><strong>" . htmlspecialchars($row['product_name']) . "</strong></td>
                            <td>" . htmlspecialchars($row['description']) . "</td>
                            <td>KES " . number_format($row['price'], 2) . "</td>
                            <td>{$row['stock_quantity']} units</td>
                            <td>
                                <a class='btn-edit' href='edit.php?id={$row['product_id']}'>Edit</a>
                                <a class='btn-delete' href='delete.php?id={$row['product_id']}' onclick='return confirm(\"Remove item?\");'>Delete</a>
                            </td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>