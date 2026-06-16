<?php
include 'db_connect.php';

// Inspect incoming data requests for matching parameters
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Perform row target purge matching index tracking number 
    $delete_query = "DELETE FROM students WHERE id = $id";
    
    if (mysqli_query($conn, $delete_query)) {
        header("Location: /BIT3208_Project/week6/index.php");
        exit();
    } else {
        echo "Critical Error during record deletion lifecycle: " . mysqli_error($conn);
    }
} else {
    header("Location: /BIT3208_Project/week6/index.php");
    exit();
}
?>