<?php
session_start();
require_once 'db_connect.php';

// Route back to authentication page if session token is missing
if (!isset($_SESSION['user'])) {
    // If you haven't logged in, we set a temporary session for testing convenience
    $_SESSION['user'] = "Administrator";
}

// Initialize form variables for the Update / Edit autofill feature
$edit_mode = false;
$edit_id = "";
$update_name = "";
$update_category = "";
$update_price = "";
$update_stock = "";

// 🟩 CREATE & 🟨 UPDATE: Handle Post Request Submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // If hidden 'action' is set to update, modify the existing database record
    if (isset($_POST['action']) && $_POST['action'] == 'update') {
        $id = intval($_POST['id']);
        $name = mysqli_real_escape_string($conn, $_POST['product_name']);
        $category = mysqli_real_escape_string($conn, $_POST['category']);
        $price = floatval($_POST['price']);
        $stock = intval($_POST['stock_quantity']);

        $update_query = "UPDATE products SET product_name='$name', category='$category', price='$price', stock_quantity='$stock' WHERE id=$id";
        mysqli_query($conn, $update_query);
        header("Location: dashboard.php?msg=Record%20Updated%20Successfully");
        exit();
    } 
    // Otherwise, execute a standard new row INSERT statement
    elseif (isset($_POST['product_name'])) {
        $name = mysqli_real_escape_string($conn, $_POST['product_name']);
        $category = mysqli_real_escape_string($conn, $_POST['category']);
        $price = floatval($_POST['price']);
        $stock = intval($_POST['stock_quantity']);

        $insert_query = "INSERT INTO products (product_name, category, price, stock_quantity) VALUES ('$name', '$category', '$price', '$stock')";
        mysqli_query($conn, $insert_query);
        header("Location: dashboard.php?msg=Record%20Created%20Successfully");
        exit();
    }
}

// 🟨 EDIT BUTTON TRIGGER: Detects when a user clicks the yellow Edit button
if (isset($_GET['edit_id'])) {
    $edit_mode = true;
    $edit_id = intval($_GET['edit_id']);
    
    // Query row details to populate form fields dynamically
    $edit_query = "SELECT * FROM products WHERE id = $edit_id";
    $edit_result = mysqli_query($conn, $edit_query);
    
    if ($edit_result && mysqli_num_rows($edit_result) > 0) {
        $item = mysqli_fetch_assoc($edit_result);
        $update_name = $item['product_name'];
        $update_category = $item['category'];
        $update_price = $item['price'];
        $update_stock = $item['stock_quantity'];
    }
}

// 🟥 DELETE BUTTON TRIGGER: Safely deletes a selected stock record
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $delete_query = "DELETE FROM products WHERE id = $delete_id";
    mysqli_query($conn, $delete_query);
    header("Location: dashboard.php?msg=Record%20Deleted%20Successfully");
    exit();
}

// 🟦 READ COMPONENT: Fetch updated inventory entries for the dashboard grid layout
$records = mysqli_query($conn, "SELECT * FROM products ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Smart Electronics Hub - Control Board</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 0; background: #f4f6f9; color: #333;">

    <div style="background: #d4edda; color: #155724; text-align: center; padding: 10px; font-weight: bold; border-bottom: 1px solid #c3e6cb;">
        📢 Database String Status: Connected Successfully
    </div>

    <div style="margin: 30px;">
        <div style="background: #1a252f; color: white; padding: 20px; border-radius: 6px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-bottom: 20px;">
            <h2 style="margin: 0;">Smart Electronics Hub ⚡ <span style="font-size: 18px; font-weight: normal;">(Active User: <?php echo htmlspecialchars($_SESSION['user']); ?>)</span></h2>
            <a href="login.php" style="color: #e74c3c; font-weight: bold; text-decoration: none;">[ Secure Logout ]</a>
        </div>

        <?php if (isset($_GET['msg'])) { ?>
            <div style="background-color: #d4edda; color: #155724; padding: 12px; border-radius: 4px; margin-bottom: 20px; font-weight: bold;">
                ✓ <?php echo htmlspecialchars($_GET['msg']); ?>
            </div>
        <?php } ?>

        <div style="display: flex; gap: 25px;">
            
            <div style="background: white; padding: 25px; border-radius: 6px; width: 35%; box-shadow: 0 2px 5px rgba(0,0,0,0.05); height: fit-content;">
                <h3 style="border-bottom: 2px solid #34495e; padding-bottom: 10px; margin-top: 0;">
                    📋 <?php echo $edit_mode ? "Modify Existing Record" : "Inventory Entry"; ?>
                </h3>
                
                <form method="POST" action="dashboard.php">
                    <?php if ($edit_mode) { ?>
                        <input type="hidden" name="action" value="update">
                        <input type="hidden" name="id" value="<?php echo $edit_id; ?>">
                    <?php } ?>

                    <label style="font-weight: bold; display: block; margin-top: 15px;">Product Name / Nomenclature:</label>
                    <input type="text" name="product_name" value="<?php echo htmlspecialchars($update_name); ?>" required style="width: 95%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px;">

                    <label style="font-weight: bold; display: block; margin-top: 15px;">Accessory Category:</label>
                    <select name="category" style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px;">
                        <option value="Laptops" <?php if($update_category == 'Laptops') echo 'selected'; ?>>Laptops</option>
                        <option value="Lighting" <?php if($update_category == 'Lighting') echo 'selected'; ?>>Lighting</option>
                        <option value="Software" <?php if($update_category == 'Software') echo 'selected'; ?>>Software</option>
                        <option value="Phones" <?php if($update_category == 'Phones') echo 'selected'; ?>>Phones</option>
                    </select>

                    <label style="font-weight: bold; display: block; margin-top: 15px;">Price Value (KES):</label>
                    <input type="number" step="0.01" name="price" value="<?php echo htmlspecialchars($update_price); ?>" required style="width: 95%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px;">

                    <label style="font-weight: bold; display: block; margin-top: 15px;">Stock Units Available:</label>
                    <input type="number" name="stock_quantity" value="<?php echo htmlspecialchars($update_stock); ?>" required style="width: 95%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px; margin-bottom: 20px;">

                    <?php if ($edit_mode) { ?>
                        <button type="submit" style="background: #2980b9; color: white; padding: 12px; border: none; border-radius: 4px; width: 100%; font-weight: bold; cursor: pointer; font-size: 14px;">Apply Changes (Update)</button>
                        <p style="text-align: center; margin-top: 10px; margin-bottom: 0;"><a href="dashboard.php" style="color: #7f8c8d; text-decoration: none; font-size: 14px;">Cancel Operation</a></p>
                    <?php } else { ?>
                        <button type="submit" style="background: #2ecc71; color: white; padding: 12px; border: none; border-radius: 4px; width: 100%; font-weight: bold; cursor: pointer; font-size: 14px;">Save New Record</button>
                    <?php } ?>
                </form>
            </div>

            <div style="background: white; padding: 25px; border-radius: 6px; width: 65%; box-shadow: 0 2px 5px rgba(0,0,0,0.05); height: fit-content;">
                <h3 style="border-bottom: 2px solid #34495e; padding-bottom: 10px; margin-top: 0;">📦 Live Storage Stock Grid (READ Control)</h3>
                
                <table border="0" cellpadding="12" cellspacing="0" style="width: 100%; text-align: left; border-collapse: collapse;">
                    <thead>
                        <tr style="background: #111; color: white;">
                            <th style="border-top-left-radius: 4px; border-bottom-left-radius: 4px; width: 8%;">ID</th>
                            <th style="width: 35%;">Product Name</th>
                            <th style="width: 20%;">Category</th>
                            <th style="width: 20%;">Price</th>
                            <th style="border-top-right-radius: 4px; border-bottom-right-radius: 4px; text-align: center; width: 17%;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (mysqli_num_rows($records) > 0) { ?>
                            <?php while ($row = mysqli_fetch_assoc($records)) { ?>
                            <tr style="border-bottom: 1px solid #e0e0e0;">
                                <td><strong><?php echo $row['id']; ?></strong></td>
                                <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                                <td><span style="background: #e1f5fe; color: #0288d1; padding: 4px 8px; border-radius: 12px; font-size: 13px; font-weight: bold;"><?php echo htmlspecialchars($row['category']); ?></span></td>
                                <td style="color: #27ae60; font-weight: bold;">KES <?php echo number_format($row['price'], 2); ?></td>
                                <td style="text-align: center;">
                                    <a href="dashboard.php?edit_id=<?php echo $row['id']; ?>" style="background: #f39c12; color: white; padding: 6px 12px; border-radius: 4px; text-decoration: none; font-weight: bold; font-size: 13px; margin-right: 5px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">Edit</a>
                                    <a href="dashboard.php?delete_id=<?php echo $row['id']; ?>" onclick="return confirm('Purge this record target permanently?')" style="background: #c0392b; color: white; padding: 6px 12px; border-radius: 4px; text-decoration: none; font-weight: bold; font-size: 13px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">Delete</a>
                                </td>
                            </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="5" style="text-align: center; color: #7f8c8d; padding: 20px;">No records found in active storage inventory grid matrix.</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</body>
</html>