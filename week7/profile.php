<?php
session_start();
include("../week6/connection.php");

// Authorization Gatekeeper Check
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$feedback_msg = "";
$current_email = $_SESSION['email'];

// Handle Name Update Form Submission
if (isset($_POST['update_profile'])) {
    $new_name = trim($_POST['fullname']);

    if (!empty($new_name)) {
        // Secure Prepared Statement to update user profile details
        $stmt = $conn->prepare("UPDATE users SET fullname = ? WHERE email = ?");
        $stmt->bind_param("ss", $new_name, $current_email);
        
        if ($stmt->execute()) {
            // Update the active session name variable so the dashboard reflects the change
            $_SESSION['user'] = $new_name;
            $feedback_msg = "<p style='color: #16a34a; font-weight: bold;'>Profile updated successfully!</p>";
        } else {
            $feedback_msg = "<p style='color: #dc2626; font-weight: bold;'>Error updating profile.</p>";
        }
        $stmt->close();
    } else {
        $feedback_msg = "<p style='color: #dc2626; font-weight: bold;'>Name field cannot be empty.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Profile Management</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f8fafc; padding: 40px; text-align: center; }
        .box { background: white; max-width: 450px; margin: 40px auto; padding: 35px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); text-align: left; }
        h2 { margin-top: 0; color: #1e293b; text-align: center; }
        input { width: 100%; padding: 12px; margin: 10px 0 20px 0; border: 1px solid #cbd5e1; border-radius: 4px; box-sizing: border-box; }
        button { background: #2b5a9e; color: white; padding: 12px 20px; border: none; border-radius: 4px; font-weight: bold; cursor: pointer; width: 100%; font-size: 15px; }
        button:hover { background: #1e3f70; }
        .back-link { display: block; text-align: center; margin-top: 20px; color: #64748b; text-decoration: none; }
    </style>
</head>
<body>

    <div class="box">
        <h2>👤 User Profile Management</h2>
        <?php echo $feedback_msg; ?>
        
        <form method="POST" action="profile.php">
            <label><strong>Email Address (Account ID)</strong></label>
            <input type="email" value="<?php echo htmlspecialchars($_SESSION['email']); ?>" readonly style="background: #e2e8f0; color: #64748b;">

            <label><strong>Full Name</strong></label>
            <input type="text" name="fullname" value="<?php echo htmlspecialchars($_SESSION['user']); ?>" required>

            <button type="submit" name="update_profile">Save Changes</button>
        </form>

        <a href="dashboard.php" class="back-link">← Back to Dashboard</a>
    </div>

</body>
</html>