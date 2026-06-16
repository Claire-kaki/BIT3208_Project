<?php
// Define database connection credentials
$host = "localhost";
$username = "root";
$password = "";
$database = "studentdb";

// Establish a connection socket instance
$conn = mysqli_connect($host, $username, $password, $database);

// Verify successful connection state criteria
if (!$conn) {
    die("Database Connection Failed: " . mysqli_connect_error());
}
?>