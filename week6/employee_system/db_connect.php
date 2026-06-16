<?php
if (session_status() == PHP_SESSION_NONE) { 
    session_start(); 
}

$conn = mysqli_connect("localhost", "root", "", "studentdb");

if (!$conn) { 
    die("Employee Database Connection Error: " . mysqli_connect_error()); 
}
?>