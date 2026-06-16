<?php 
// Include the database configuration wrapper
include 'db_connect.php'; 

$message = "";

// Demonstration 3 / Class Activity 1: Processing Form Data Insertion
if (isset($_POST['commit_student'])) {
    $fullname = mysqli_real_escape_string($conn, trim($_POST['fullname']));
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $course = mysqli_real_escape_string($conn, trim($_POST['course']));

    if (!empty($fullname) && !empty($email) && !empty($course)) {
        $insert_sql = "INSERT INTO students (fullname, email, course) VALUES ('$fullname', '$email', '$course')";
        if (mysqli_query($conn, $insert_sql)) {
            $message = "<p style='color: green; font-weight: bold;'>Record saved successfully!</p>";
        } else {
            $message = "<p style='color: red;'>Error saving record: " . mysqli_error($conn) . "</p>";
        }
    } else {
        $message = "<p style='color: red;'>All input blocks are required.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Week 6 Task: Web Application Database Integration & CRUD Management</title>
    <style>
        body { font-family: system-ui, sans-serif; background-color: #f4f6f9; margin: 0; padding: 40px; }
        .container { max-width: 800px; margin: auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        h2, h3 { color: #1e3a8a; }
        label { display: block; font-weight: bold; margin-top: 15px; margin-bottom: 5px; color: #334155; }
        input[type="text"], input[type="email"] { width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 6px; box-sizing: border-box; }
        button { background-color: #1d4ed8; color: white; font-weight: bold; padding: 12px 24px; border: none; border-radius: 6px; cursor: pointer; margin-top: 20px; }
        button:hover { background-color: #1e40af; }
        table { width: 100%; border-collapse: collapse; margin-top: 25px; }
        th, td { padding: 12px; border: 1px solid #e2e8f0; text-align: left; }
        th { background-color: #007bff; color: white; }
        tr:nth-child(even) { background-color: #f8fafc; }
        .btn-edit { color: #1d4ed8; text-decoration: none; font-weight: bold; margin-right: 15px; }
        .btn-delete { color: #dc2626; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>

<div class="container">
    <h2>Week 6 Task: Web Application Database Integration & CRUD Management</h2>
    
    <?php echo $message; ?>

    <form method="POST" action="index.php">
        <label>Full Student Registration Name</label>
        <input type="text" name="fullname" placeholder="e.g., John Doe" required>

        <label>Academic Email Address Anchor</label>
        <input type="email" name="email" placeholder="username@student.mku.ac.ke" required>

        <label>Assigned Academic Course Program Pathway</label>
        <input type="text" name="course" placeholder="e.g., Bachelor of Science in Information Technology" required>

        <button type="submit" name="commit_student">Commit Student Profile Entry</button>
    </form>

    <hr style="margin: 40px 0; border: 0; border-top: 2px solid #e2e8f0;">

    <h3>Dynamic Live Server Structural Logs</h3>
    <table>
        <thead>
            <tr>
                <th>System ID</th>
                <th>Full Name Row Data</th>
                <th>Verified Email Address</th>
                <th>Course Mapping</th>
                <th>Management Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Fetch live entries sorted by newest first
            $fetch_query = "SELECT * FROM students ORDER BY id DESC";
            $table_data = mysqli_query($conn, $fetch_query);

            if (mysqli_num_rows($table_data) > 0) {
                while ($row = mysqli_fetch_assoc($table_data)) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . htmlspecialchars($row['fullname']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['course']) . "</td>";
                    // Dynamic action link targets for Demonstration 5
                    echo "<td>
                            <a class='btn-edit' href='/BIT3208_Project/week6/edit.php?id=" . $row['id'] . "'>Edit</a>
                            <a class='btn-delete' href='/BIT3208_Project/week6/delete.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure you want to drop this record?\");'>Delete</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5' style='text-align: center; color: #64748b;'>No records present in the local database structure table matrix.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>