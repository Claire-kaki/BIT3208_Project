<?php
include("connection.php");

// --- 4. DELETE OPERATION (Removing Records) ---
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    $stmt = $conn->prepare("DELETE FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

header("Location: products.php");
exit();
?>