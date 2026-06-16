<?php
$conn = mysqli_connect("localhost", "root", "", "studentdb");
if (!$conn) {
    die("Library Database Connection Failed: " . mysqli_connect_error());
}
?>