<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "awtproject";

// Create database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if connection failed
if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}
?>