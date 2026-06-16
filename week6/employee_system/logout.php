<?php
include 'db_connect.php';
session_destroy();
header("Location: /BIT3208_Project/week6/employee_system/login.php");
exit();
?>