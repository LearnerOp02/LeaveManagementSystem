<?php
// Database connection settings for InfinityFree
// $servername = "sql111.infinityfree.com";   // MySQL Hostname (from your InfinityFree panel)
// $username = "if0_40199087";              // Your MySQL Username
// $password = "4hBuvk6WpgIoG";    // Replace with the password shown/you created
// $dbname = "if0_40199087_awtproject";   // Your MySQL Database name

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

// Set character encoding
$conn->set_charset("utf8mb4");
?>