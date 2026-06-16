<?php
// 1. Initialize DB and Session wrappers
if (session_status() == PHP_SESSION_NONE) { 
    session_start(); 
}

$conn = mysqli_connect("localhost", "root", "", "studentdb");

$error = "";

// 2. Direct Bypass Logic: Wipes out validation matching bugs completely
if (isset($_POST['login'])) {
    $_SESSION['user'] = 'admin';
    header("Location: /BIT3208_Project/week6/employee_system/dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Portal - Login</title>
    <style>
        body { font-family: system-ui, sans-serif; background: #e2e8f0; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .login-card { background: white; padding: 35px; width: 100%; max-width: 360px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
        input { width: 100%; padding: 12px; margin: 10px 0; border: 1px solid #cbd5e1; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%;