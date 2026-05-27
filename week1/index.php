<?php
// Establish connection using mysqli
$conn = mysqli_connect("localhost", "root", "", "week1db");

$db_status = "Connected Successfully";
$bg_color = "#cce5ff";
$text_color = "#004085";

if (!$conn) {
    $db_status = "Connection Failed: " . mysqli_connect_error();
    $bg_color = "#f8d7da";
    $text_color = "#721c24";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart E-Commerce - Week 1</title>
</head>
<body style="font-family: Arial, sans-serif; text-align: center; margin-top: 80px; background-color: #f8f9fa;">
    
    <h1 style="color: #2c3e50;">Smart E-Commerce Web Application</h1>
    <p style="color: #7f8c8d; font-size: 1.2em;">BIT3208 Capstone Project Baseline</p>
    
    <div style="margin-top: 40px;">
        <div style="display: inline-block; padding: 15px 25px; margin: 10px; background-color: #d4edda; color: #155724; border-radius: 5px; font-weight: bold; border: 1px solid #c3e6cb;">
            ✅ Apache & PHP Environment: Active (Hello World)
        </div>

        <div style="display: inline-block; padding: 15px 25px; margin: 10px; background-color: <?php echo $bg_color; ?>; color: <?php echo $text_color; ?>; border-radius: 5px; font-weight: bold; border: 1px solid #b8daff;">
            MySQL Status: <?php echo $db_status; ?>
        </div>
    </div>

</body>
</html>