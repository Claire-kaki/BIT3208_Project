<?php
// Database Connection Parameters
$db_host     = "localhost";
$db_username = "root";
$db_password = "";
$db_name     = "week1db";

// Execute connection request
$conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);

// Connection safety check
if (!$conn) {
    die("<div style='background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 4px; font-weight: bold;'>
            ❌ Critical System Database Connection Failed: " . mysqli_connect_error() . "
         </div>");
}
?>