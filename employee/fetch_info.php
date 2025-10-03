<?php
session_start();
include("../config.php");
header('Content-Type: application/json');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Please login first']);
    exit();
}

$user_id = $_SESSION['user_id'];

// Get user details from database
$sql = "SELECT 
    name, email, phone, date_of_birth, gender,
    account_holder_name, account_number, ifsc_code, bank_name, branch_name
    FROM user_db 
    WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    echo json_encode([
        'success' => true,
        'user' => $user
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'User not found'
    ]);
}

$stmt->close();
$conn->close();
?>