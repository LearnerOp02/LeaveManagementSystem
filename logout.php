<?php
// Start session to access current session data
session_start();

// Clear all session variables
$_SESSION = array();

// Destroy the session completely
session_destroy();

// Redirect to login page with success message
header("Location: index.php?message=Logout successful");
exit();
?>