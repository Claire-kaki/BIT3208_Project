<?php
// Database Connection Parameters
$db_host     = "localhost";     // Local XAMPP server address
$db_username = "root";          // Default XAMPP superuser
$db_password = "";              // Default XAMPP password is empty
$db_name     = "week1db";       // Target schema identity matching phpMyAdmin

// Execute connection request
$conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);

// Fail-safe validation barrier block
if (!$conn) {
    die("<div style='background-color: #fed7d7; color: #742a2a; padding: 12px; font-weight: bold;'>
            ❌ Critical: System Database Connection Unreachable! " . mysqli_connect_error() . "
         </div>");
}

// Banner helper used for status display
$db_status_banner = "
    <div style='background-color: #c6f6d5; color: #22543d; border: 1px solid #9ae6b4; 
                padding: 10px; border-radius: 4px; text-align: center; font-weight: bold; margin-bottom: 20px;'>
        📡 Database String Status: Connected Successfully
    </div>";
?>