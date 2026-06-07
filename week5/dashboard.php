<?php
session_start();
require_once 'db_connect.php';

// Route back to sign-in page if session token is missing
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$current_user = $_SESSION['user'];
// Determine user type: Admin vs regular customer
$is_admin = ($current_user === 'admin@elechub.com');

// Initialize form placeholder variables for Admin CRUD
$edit_mode = false; $edit_id = ""; $update_name = ""; $update_category = ""; $update_price = ""; $update_stock = "";

// 🟩 ADMIN PRIVILEGE: Process Form Submissions (Create / Update)
if ($_SERVER["REQUEST_METHOD"] == "POST" && $is_admin) {
    if (isset($_POST['action']) && $_POST['action'] == 'update') {
        $id = intval($_POST['id']);
        $name = mysqli_real_escape_string($conn, $_POST['product_name']);
        $category = mysqli_real_escape_string($conn, $_POST['category']);
        $price = floatval($_POST['price']);
        $stock = intval($_POST['stock_quantity']);
        mysqli_query($conn, "UPDATE products SET product_name='$name', category='$category', price='$price', stock_quantity='$stock' WHERE id=$id");
        header("Location: dashboard.php?msg=Record Updated Successfully"); exit();
    } elseif (isset($_POST['product_name'])) {
        $name = mysqli_real_escape_string($conn, $_POST['product_name']);
        $category = mysqli_real_escape_string($conn, $_POST['category']);
        $price = floatval($_POST['price']);
        $stock = intval($_POST['stock_quantity']);
        mysqli_query($conn, "INSERT INTO products (product_name, category, price, stock_quantity) VALUES ('$name', '$category', '$price', '$stock')");
        header("Location: dashboard.php?msg=Record Created Successfully"); exit();
    }
}

// 🟨 ADMIN PRIVILEGE: Edit Handler
if (isset($_GET['edit_id']) && $is_admin) {
    $edit_mode = true; $edit_id = intval($_GET['edit_id']);
    $res = mysqli_query($conn, "SELECT * FROM products WHERE id = $edit_id");
    if ($res && mysqli_num_rows($res) > 0) {
        $item = mysqli_fetch_assoc($res);
        $update_name = $item['product_name']; $update_category = $item['category']; $update_price = $item['price']; $update_stock = $item['stock_quantity'];
    }
}

// 🟥 ADMIN PRIVILEGE: Delete Handler
if (isset($_GET['delete_id']) && $is_admin) {
    $delete_id = intval($_GET['delete_id']);
    mysqli_query($conn, "DELETE FROM products WHERE id = $delete_id");
    header("Location: dashboard.php?msg=Record Deleted Successfully"); exit();
}

// 🛒 CUSTOMER PRIVILEGE: Deduct stock quantity instantly upon clicking Buy
if (isset($_GET['purchase_id']) && !$is_admin) {
    $p_id = intval($_GET['purchase_id']);
    $stock_check = mysqli_query($conn, "SELECT stock_quantity, product_name FROM products WHERE id = $p_id");
    $product = mysqli_fetch_assoc($stock_check);
    
    if ($product && $product['stock_quantity'] > 0) {
        $new_stock = $product['stock_quantity'] - 1;
        mysqli_query($conn, "UPDATE products SET stock_quantity = $new_stock WHERE id = $p_id");
        header("Location: dashboard.php?msg=Successfully purchased " . urlencode($product['product_name']));
    } else {
        header("Location: dashboard.php?msg=Error: Item went out of stock!");
    }
    exit();
}

// 🟦 DATABASE READ QUERY: Filter rows dynamically depending on user role
if ($is_admin) {
    // Admin sees everything to manage inventory
    $records = mysqli_query($conn, "SELECT * FROM products ORDER BY id DESC");
} else {
    // Customers ONLY see what is available on sale (> 0 stock quantity)
    $records = mysqli_query($conn, "SELECT * FROM products WHERE stock_quantity > 0 ORDER BY id DESC");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Smart Electronics Hub - Workspace</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 0; background: #f4f6f9; color: #333;">

    <div style="background: #d4edda; color: #155724; text-align: center; padding: 10px; font-weight: bold; border-bottom: 1px solid #c3e6cb;">
        📢 Database String Status: Connected Successfully
    </div>

    <div style="margin: 30px;">
        <div style="background: #1a252f; color: white; padding: 20px; border-radius: 6px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-bottom: 20px;">
            <h2 style="margin: 0;">Smart Electronics Hub ⚡ <span style="font-size: 18px; font-weight: normal;">(Active User: <?php echo htmlspecialchars($current_user); ?>)</span></h2>
            <a href="login.php" style="color: #e74c3c; font-weight: bold; text-decoration: none;">[ Secure Logout ]</a>
        </div>

        <?php if (isset($_GET['msg'])) { ?>
            <div style="background-color: #d4edda; color: #155724; padding: 12px; border-radius: 4px; margin-bottom: 20px; font-weight: bold;">
                ✓ <?php echo htmlspecialchars($_GET['msg']); ?>
            </div>
        <?php } ?>

        <div style="display: flex; gap: 25px;">
            
            <!-- LEFT PANEL: Show inventory form ONLY to the administrator -->
            <?php if ($is_admin) { ?>
            <div style="background: white; padding: 25px; border-radius: 6px; width: 35%; box-shadow: 0 2px 5px rgba(0,0,0,0.05); height: fit-content;">
                <h3 style="border-bottom: 2px solid #34495e; padding-bottom: 10px; margin-top: 0;">📋 <?php echo $edit_mode ? "Modify Existing Record" : "Inventory Entry"; ?></h3>
                <form method="POST" action="dashboard.php">
                    <?php if ($edit_mode) { ?>
                        <input type="hidden" name="action" value="update"><input type="hidden" name="id" value="<?php echo $edit_id; ?>">
                    <?php } ?>
                    <label style="font-weight: bold; display: block; margin-top: 15px;">Product Name / Nomenclature:</label>
                    <input type="text" name="product_name" value="<?php echo htmlspecialchars($update_name); ?>" required style="width: 95%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px;">

                    <label style="font-weight: bold; display: block; margin-top: 15px;">Accessory Category:</label>
                    <select name="category" style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px;">
                        <option value="Phones" <?php if($update_category == 'Phones') echo 'selected'; ?>>Phones</option>
                        <option value="Chargers & Cables" <?php if($update_category == 'Chargers & Cables') echo 'selected'; ?>>Chargers & Cables</option>
                        <option value="Earphones & Headphones" <?php if($update_category == 'Earphones & Headphones') echo 'selected'; ?>>Earphones & Headphones</option>
                        <option value="Speakers" <?php if($update_category == 'Speakers') echo 'selected'; ?>>Speakers</option>
                    </select>

                    <label style="font-weight: bold; display: block; margin-top: 15px;">Price Value (KES):</label>
                    <input type="number" step="0.01" name="price" value="<?php echo htmlspecialchars($update_price); ?>" required style="width: 95%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px;">

                    <label style="font-weight: bold; display: block; margin-top: 15px;">Stock Units Available:</label>
                    <input type="number" name="stock_quantity" value="<?php echo htmlspecialchars($update_stock); ?>" required style="width: 95%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px; margin-bottom: 20px;">

                    <button type="submit" style="background: <?php echo $edit_mode ? '#2980b9' : '#2ecc71'; ?>; color: white; padding: 12px; border: none; border-radius: 4px; width: 100%; font-weight: bold; cursor: pointer;"><?php echo $edit_mode ? "Apply Changes (Update)" : "Save New Record"; ?></button>
                </form>
            </div>
            <?php } ?>

            <!-- RIGHT PANEL: Displays stock grid (Spans 100% full width for customers) -->
            <div style="background: white; padding: 25px; border-radius: 6px; width: <?php echo $is_admin ? '65%' : '100%'; ?>; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
                <h3 style="border-bottom: 2px solid #34495e; padding-bottom: 10px; margin-top: 0;">📦 <?php echo $is_admin ? "Live Storage Stock Grid (READ Control)" : "Available Electronic Store Catalog"; ?></h3>
                <table border="0" cellpadding="12" cellspacing="0" style="width: 100%; text-align: left; border-collapse: collapse;">
                    <thead>
                        <tr style="background: #111; color: white;">
                            <th style="width: 8%;">ID</th>
                            <th style="width: 35%;">Product Name</th>
                            <th style="width: 25%;">Category</th>
                            <th style="width: 15%;">Stock Level</th>
                            <th style="width: 17%; text-align: center;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (mysqli_num_rows($records) > 0) { ?>
                            <?php while ($row = mysqli_fetch_assoc($records)) { ?>
                            <tr style="border-bottom: 1px solid #e0e0e0;">
                                <td><strong><?php echo $row['id']; ?></strong></td>
                                <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                                <td><span style="background: #e1f5fe; color: #0288d1; padding: 4px 8px; border-radius: 12px; font-size: 13px; font-weight: bold;"><?php echo htmlspecialchars($row['category']); ?></span></td>
                                <td style="color: #27ae60; font-weight: bold;">KES <?php echo number_format($row['price'], 2); ?> (<?php echo $row['stock_quantity']; ?> left)</td>
                                <td style="text-align: center;">
                                    <?php if ($is_admin) { ?>
                                        <a href="dashboard.php?edit_id=<?php echo $row['id']; ?>" style="background: #f39c12; color: white; padding: 6px 12px; border-radius: 4px; text-decoration: none; font-size: 13px; margin-right: 5px;">Edit</a>
                                        <a href="dashboard.php?delete_id=<?php echo $row['id']; ?>" onclick="return confirm('Purge row permanently?')" style="background: #c0392b; color: white; padding: 6px 12px; border-radius: 4px; text-decoration: none; font-size: 13px;">Delete</a>
                                    <?php } else { ?>
                                        <a href="dashboard.php?purchase_id=<?php echo $row['id']; ?>" style="background: #2ecc71; color: white; padding: 6px 16px; border-radius: 4px; text-decoration: none; font-weight: bold; font-size: 13px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">Buy Item</a>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr><td colspan="5" style="text-align: center; color: #7f8c8d; padding: 20px;">No available stock products found on sale right now.</td></tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</body>
</html>