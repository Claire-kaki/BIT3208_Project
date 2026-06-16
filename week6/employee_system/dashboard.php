<?php
include 'db_connect.php';

// Route back to login page if session is missing
if (!isset($_SESSION['user'])) { 
    header("Location: /BIT3208_Project/week6/employee_system/login.php"); 
    exit(); 
}

$msg = "";

// 1. Create and Update Operation Form Handling
if (isset($_POST['save_employee'])) {
    $name = mysqli_real_escape_string($conn, trim($_POST['emp_name']));
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $dept = mysqli_real_escape_string($conn, trim($_POST['department']));
    $id = intval($_POST['id']);

    // Bonus Feature: Server-Side Email Syntax Validation Engine
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msg = "<p style='color:red; font-weight:bold;'>Error: Invalid email format syntax.</p>";
    } else {
        if ($id > 0) {
            // Update action
            mysqli_query($conn, "UPDATE employees SET emp_name='$name', email='$email', department='$dept' WHERE emp_id=$id");
            $msg = "<p style='color:green; font-weight:bold;'>Employee profile updated!</p>";
        } else {
            // Insert action
            mysqli_query($conn, "INSERT INTO employees (emp_name, email, department) VALUES ('$name', '$email', '$dept')");
            $msg = "<p style='color:green; font-weight:bold;'>Employee registered successfully!</p>";
        }
    }
}

// 2. Delete Operation Handling
if (isset($_GET['del'])) {
    $id = intval($_GET['del']);
    mysqli_query($conn, "DELETE FROM employees WHERE emp_id=$id");
    header("Location: /BIT3208_Project/week6/employee_system/dashboard.php");
    exit();
}

// 3. Edit Record Fetcher Block
$e_id = $e_name = $e_mail = $e_dept = "";
if (isset($_GET['edit'])) {
    $id = intval($_GET['edit']);
    $res = mysqli_query($conn, "SELECT * FROM employees WHERE emp_id=$id");
    if ($row = mysqli_fetch_assoc($res)) {
        $e_id = $row['emp_id']; 
        $e_name = $row['emp_name']; 
        $e_mail = $row['email']; 
        $e_dept = $row['department'];
    }
}

// 4. Read Operation with Bonus Search Filtering
$search = "";
$sql = "SELECT * FROM employees";
if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
    $search = mysqli_real_escape_string($conn, trim($_GET['search']));
    // Filter records dynamically based on name or department metrics match
    $sql .= " WHERE emp_name LIKE '%$search%' OR department LIKE '%$search%'";
}
$sql .= " ORDER BY emp_id DESC";
$employees = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management Dashboard</title>
    <style>
        body { font-family: system-ui, sans-serif; background: #f8fafc; margin: 0; }
        .header { background: #0f172a; color: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; }
        .grid { display: flex; flex-wrap: wrap; gap: 25px; padding: 30px; max-width: 1200px; margin: auto; }
        .card { background: white; padding: 25px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); flex: 1 1 350px; }
        .table-card { flex: 2 1 600px; }
        input { width: 100%; padding: 12px; margin: 8px 0; border: 1px solid #cbd5e1; border-radius: 6px; box-sizing: border-box; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { padding: 12px; border-bottom: 1px solid #e2e8f0; text-align: left; }
        th { background: #f1f5f9; color: #475569; }
        .btn-save { background:#16a34a; color:white; padding:12px 20px; border:none; border-radius:6px; cursor:pointer; font-weight:bold; }
        @media(max-width: 768px) { .grid { flex-direction: column; } } /* Responsive Design Rule */
    </style>
</head>
<body>

<div class="header">
    <span>Active Operator Account: <b><?php echo htmlspecialchars($_SESSION['user']); ?></b></span>
    <a href="/BIT3208_Project/week6/employee_system/logout.php" style="color:#ef4444; text-decoration:none; font-weight:bold;">Sign Out</a>
</div>

<div class="grid">
    <div class="card">
        <h3><?php echo $e_id ? "Modify Employee File" : "Register Employee Profile"; ?></h3>
        <?php echo $msg; ?>
        <form method="POST" action="dashboard.php">
            <input type="hidden" name="id" value="<?php echo $e_id; ?>">
            
            <label>Employee Name</label>
            <input type="text" name="emp_name" value="<?php echo htmlspecialchars($e_name); ?>" required>
            
            <label>Corporate Email</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($e_mail); ?>" required>
            
            <label>Department</label>
            <input type="text" name="department" value="<?php echo htmlspecialchars($e_dept); ?>" required>
            
            <button type="submit" name="save_employee" class="btn-save">Commit Record</button>
            <?php if($e_id): ?>
                <a href="dashboard.php" style="margin-left:10px; color:#64748b; text-decoration:none;">Cancel</a>
            <?php endif; ?>
        </form>
    </div>

    <div class="card table-card">
        <h3>Master Operational Directory</h3>
        
        <form method="GET" action="dashboard.php" style="display:flex; gap:10px; margin-bottom:15px;">
            <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Search rows by keyword name or dept..." style="margin:0;">
            <button type="submit" style="background:#2563eb; color:white; border:none; padding:12px 20px; border-radius:6px; font-weight:bold; cursor:pointer;">Search</button>
        </form>

        <table>
            <thead>
                <tr><th>Name</th><th>Email</th><th>Department</th><th>Management Actions</th></tr>
            </thead>
            <tbody>
                <?php if(mysqli_num_rows($employees) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($employees)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['emp_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['department']); ?></td>
                        <td>
                            <a href="dashboard.php?edit=<?php echo $row['emp_id']; ?>" style="color:#2563eb; text-decoration:none; font-weight:bold; margin-right:10px;">Edit</a>
                            <a href="dashboard.php?del=<?php echo $row['emp_id']; ?>" style="color:#ef4444; text-decoration:none; font-weight:bold;" onclick="return confirm('Drop this employee row file data?')">Delete</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="4" style="text-align:center; color:#64748b;">No matching employee records cataloged.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>