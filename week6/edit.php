<?php
include 'db_connect.php';

// Fetch the targeted record metrics to fill the form inputs
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $record_set = mysqli_query($conn, "SELECT * FROM students WHERE id = $id");
    $row = mysqli_fetch_assoc($record_set);
    
    if (!$row) {
        die("Record entry missing from schema rows.");
    }
}

// Handle the relational SQL UPDATE execution query when submitted
if (isset($_POST['commit_update'])) {
    $id = intval($_POST['id']);
    $fullname = mysqli_real_escape_string($conn, trim($_POST['fullname']));
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $course = mysqli_real_escape_string($conn, trim($_POST['course']));

    $update_sql = "UPDATE students SET fullname='$fullname', email='$email', course='$course' WHERE id=$id";
    
    if (mysqli_query($conn, $update_sql)) {
        header("Location: /BIT3208_Project/week6/index.php");
        exit();
    } else {
        echo "Error modifying file metrics: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Class Activity 3: Edit Student Profile Matrix</title>
    <style>
        body { font-family: system-ui, sans-serif; background-color: #f4f6f9; padding: 40px; }
        .edit-container { max-width: 500px; margin: auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        label { display: block; font-weight: bold; margin-top: 15px; margin-bottom: 5px; }
        input { width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 6px; box-sizing: border-box; }
        button { background-color: #10b981; color: white; font-weight: bold; padding: 12px 24px; border: none; border-radius: 6px; cursor: pointer; margin-top: 20px; }
    </style>
</head>
<body>

<div class="edit-container">
    <h3>Class Activity 3: Update Student Parameters</h3>
    <form method="POST" action="edit.php">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

        <label>Full Student Name</label>
        <input type="text" name="fullname" value="<?php echo htmlspecialchars($row['fullname']); ?>" required>

        <label>Academic Email Address</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required>

        <label>Assigned Academic Course Program Pathway</label>
        <input type="text" name="course" value="<?php echo htmlspecialchars($row['course']); ?>" required>

        <button type="submit" name="commit_update">Update Student Profile</button>
        <a href="/BIT3208_Project/week6/index.php" style="margin-left: 15px; color: #64748b; text-decoration: none;">Cancel Changes</a>
    </form>
</div>

</body>
</html>