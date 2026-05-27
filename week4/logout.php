<?php
session_start();
session_unset();    // Free all active session allocation pointers
session_destroy();  // Erase data payload remnants from storage
header("Location: index.php"); // Return safely to the login interface
exit();