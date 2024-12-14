<?php
session_start(); // Start the session

// Clear all session variables
session_unset();

// Destroy the session
session_destroy();

// Optionally, redirect to the login page or homepage
header("Location: login.php");
exit();
?>