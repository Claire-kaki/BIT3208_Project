<?php
include 'db_connect.php';

if (isset($_GET['id'])) {
    $book_id = intval($_GET['id']);
    
    if (mysqli_query($conn, "DELETE FROM books WHERE book_id = $book_id")) {
        header("Location: /BIT3208_Project/week6/library_system/index.php");
        exit();
    }
} else {
    header("Location: /BIT3208_Project/week6/library_system/index.php");
    exit();
}
?>