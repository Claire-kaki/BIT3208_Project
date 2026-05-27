<?php
session_start();
// Security Check: Redirect to login if user session isn't active
if (!isset($_SESSION['user'])) { 
    header("Location: login.php"); 
    exit(); 
}
require_once 'db_connect.php';

// --- 1. CREATE Operation: Add Record ---
if (isset($_POST['create_product'])) {
    $name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);

    $insert_query = "INSERT INTO products (product_name, category, price) VALUES ('$name', '$category', '$price')";
    mysqli_query($conn, $insert_query);
    header("Location: dashboard.php?msg=Record Created Successfully");
    exit();
}

// --- 2. DELETE Operation: Remove Record ---
if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    mysqli_query($conn, "DELETE FROM products WHERE id = $id");
    header("Location: dashboard.php?msg=Record Deleted Successfully");
    exit();
}

// --- 3. UPDATE Operation: Save Modifications ---
if (isset($_POST['update_product'])) {
    $id = intval($_POST['product_id']);
    $name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);

    mysqli_query($conn, "UPDATE products SET product_name='$name', category='$category', price='$price' WHERE id=$id");
    header("Location: dashboard.php?msg=Record Updated Successfully");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Smart Electronics Hub - Control Panel</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 20px; background: #f4f6f9;">
    
    <?php if(isset($db_status_banner)) echo $db_status_banner; ?>

    <div style="display: flex; justify-content: space-between; align-items: center; background: #2c3e50; color: white; padding: 10px 20px; border-radius: 5px;">
        <h2>Smart Electronics Hub ⚡ (Active User: <?php echo htmlspecialchars($_SESSION['user']); ?>)</h2>
        <a href="logout.php" style="color: #e74c3c; text-decoration: none; font-weight: bold;">[ Secure Logout ]</a>
    </div>

    <?php if(isset($_GET['msg'])) echo "<p style='color: #27ae60; font-weight: bold; background: #e8f8f5; padding: 10px; border-left: 5px solid #2ecc71;'>".htmlspecialchars($_GET['msg'])."</p>"; ?>

    <div style="display: flex; gap: 20px; margin-top: 20px;">
        
        <div style="flex: 1; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); height: fit-content;">
            <h3 style="color: #2c3e50; border-bottom: 2px solid #ecf0f1; padding-bottom: 10px;">📥 Inventory Entry</h3>
            <form method="POST" action="">
                <input type="hidden" name="product_id" id="product_id">
                
                <label style="font-weight: bold; color: #555;">Product Name / Nomenclature:</label><br>
                <input type="text" name="product_name" id="product_name" required style="width: 95%; padding: 8px; margin: 8px 0; border: 1px solid #ccc; border-radius: 4px;"><br>
                
                <label style="font-weight: bold; color: #555;">Accessory Category:</label><br>
                <select name="category" id="category" style="width: 100%; padding: 8px; margin: 8px 0; border: 1px solid #ccc; border-radius: 4px;">
                    <option value="Wireless Buds">Wireless Buds</option>
                    <option value="Chargers & Cables">Chargers & Cables</option>
                    <option value="Earphones & Headphones">Earphones & Headphones</option>
                    <option value="Speakers">Speakers</option>
                </select><br>

                <label style="font-weight: bold; color: #555;">Price Value (KES):</label><br>
                <input type="number" step="0.01" name="price" id="price" required style="width: 95%; padding: 8px; margin: 8px 0; border: 1px solid #ccc; border-radius: 4px;"><br>
                
                <button type="submit" name="create_product" id="save_btn" style="background: #2ecc71; color: white; padding: 11px; width: 100%; border: none; border-radius: 4px; cursor: pointer; font-weight: bold;">Save Product Prototype Record</button>
                <button type="submit" name="update_product" id="update_btn" style="background: #3498db; color: white; padding: 11px; width: 100%; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; display: none;">Apply Changes (Update)</button>
            </form>
        </div>

        <div style="flex: 2; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
            <h3 style="color: #2c3e50; border-bottom: 2px solid #ecf0f1; padding-bottom: 10px;">📦 Live Storage Stock Grid (READ Control)</h3>
            <table border="0" style="width: 100%; border-collapse: collapse; text-align: left;">
                <tr style="background: #34495e; color: white;">
                    <th style="padding: 10px;">ID</th>
                    <th style="padding: 10px;">Product Name</th>
                    <th style="padding: 10px;">Category</th>
                    <th style="padding: 10px;">Price (KES)</th>
                    <th style="padding: 10px;">Actions</th>
                </tr>
                <?php
                // --- 4. READ Operation: Fetch and Display Data ---
                $fetch_all = mysqli_query($conn, "SELECT * FROM products ORDER BY id DESC");
                if (mysqli_num_rows($fetch_all) == 0) {
                    echo "<tr><td colspan='5' style='text-align: center; padding: 20px; color: #7f8c8d; font-style: italic;'>No records found in database.</td></tr>";
                } else {
                    while ($row = mysqli_fetch_assoc($fetch_all)) {
                        $safe_row = json_encode($row, JSON_HEX_APOS | JSON_HEX_QUOT);
                        echo "<tr style='border-bottom: 1px solid #ecf0f1;'>
                                <td style='padding: 10px;'>{$row['id']}</td>
                                <td style='padding: 10px; font-weight: bold; color: #2c3e50;'>".htmlspecialchars($row['product_name'])."</td>
                                <td style='padding: 10px;'><span style='background: #e8f4f8; color: #2980b9; padding: 3px 8px; border-radius: 10px; font-size: 12px;'>".htmlspecialchars($row['category'])."</span></td>
                                <td style='padding: 10px; font-weight: bold; color: #27ae60;'>KES " . number_format($row['price'], 2) . "</td>
                                <td style='padding: 10px;'>
                                    <button onclick='populateForm($safe_row)' style='background: #f1c40f; border: none; color: black; padding: 6px 12px; border-radius: 4px; cursor: pointer; font-weight: bold; font-size: 12px; margin-right: 5px;'>Edit</button>
                                    <a href='dashboard.php?delete_id={$row['id']}' style='background: #e74c3c; color: white; text-decoration: none; padding: 6px 12px; border-radius: 4px; display: inline-block; font-size: 12px; font-weight: bold;' onclick='return confirm(\"Delete this item?\")'>Delete</a>
                                </td>
                              </tr>";
                    }
                }
                ?>
            </table>
        </div>
    </div>

    <script>
    function populateForm(product) {
        document.getElementById('product_id').value = product.id;
        document.getElementById('product_name').value = product.product_name;
        document.getElementById('category').value = product.category;
        document.getElementById('price').value = product.price;
        
        // Hide standard save button, show the edit updates button
        document.getElementById('save_btn').style.display = 'none';
        document.getElementById('update_btn').style.display = 'block';
    }
    </script>
</body>
</html>