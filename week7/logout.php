<?php
session_start();

// Clear and eliminate all session properties tracking the user state
session_unset();
session_destroy();

header("Location: login.php");
exit();
?>