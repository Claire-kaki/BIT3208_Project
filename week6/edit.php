<?php
include("connection.php");

// Fetch active row fields into inputs
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $result = mysqli_query($conn, "SELECT * FROM products WHERE product_id = $id");
    $product = mysqli_fetch_assoc($result);
}

// --- 3. UPDATE OPERATION (Modifying Existing Data) ---
if (isset($_POST['update_product'])) {
    $id    = intval($_POST['product_id']);
    $name  = trim($_POST['product_name']);
    $desc  = trim($_POST['description']);
    $price = $_POST['price'];
    $stock = $_POST['stock_quantity'];

    // FIXED: Correct binding specifier format string (ssdii)
    $stmt = $conn->prepare("UPDATE products SET product_name=?, description=?, price=?, stock_quantity=? WHERE product_id=?");
    $stmt->bind_param("ssdii", $name, $desc, $price, $stock, $id);
    
    if ($stmt->execute()) {
        header("Location: products.php");
        exit();
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product Properties</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f8fafc; padding: 40px; }
        .edit-box { background: white; padding: 30px; border-radius: 8px; max-width: 500px; margin: 0 auto; box-shadow: 0 4px 10px rgba(0,0,0,0.05); }
        input, textarea { width: 100%; padding: 10px; margin: 10px 0 20px 0; border: 1px solid #cbd5e1; border-radius: 4px; box-sizing: border-box; }
        button { background: #10b981; color: white; padding: 12px 20px; border: none; border-radius: 4px; font-weight: bold; cursor: pointer; }
    </style>
</head>
<body>
    <div class="edit-box">
        <h2>✏️ Modify Product Information</h2>
        <form method="POST" action="edit.php">
            <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
            
            <label>Product Name</label>
            <input type="text" name="product_name" value="<?php echo htmlspecialchars($product['product_name']); ?>" required>

            <label>Description</label>
            <textarea name="description"><?php echo htmlspecialchars($product['description']); ?></textarea>

            <label>Price (KES)</label>
            <input type="number" step="0.01" name="price" value="<?php echo $product['price']; ?>" required>

            <label>Stock Quantity</label>
            <input type="number" name="stock_quantity" value="<?php echo $product['stock_quantity']; ?>" required>

            <button type="submit" name="update_product">Update Adjustments</button>
            <a href="products.php" style="margin-left: 15px; color: #64748b; text-decoration: none;">Cancel</a>
        </form>
    </div>
</body>
</html>