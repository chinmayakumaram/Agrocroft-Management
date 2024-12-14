<?php

// Database Connection
$conn = new mysqli("localhost", "root", "", "agriculture_management");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>