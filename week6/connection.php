<?php
// Central MySQL Database Link Framework
$conn = mysqli_connect("localhost", "root", "", "studentdb");

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}
?>