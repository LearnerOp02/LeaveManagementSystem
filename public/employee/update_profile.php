<?php
session_start();
include("../../config/config.php");
header('Content-Type: application/json');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Please login first']);
    exit();
}

$user_id = $_SESSION['user_id'];
$data = json_decode(file_get_contents('php://input'), true);

// Validate required fields
if (empty($data['name']) || empty($data['email'])) {
    echo json_encode(['success' => false, 'message' => 'Name and email are required']);
    exit();
}

// Start building the SQL query
$sql = "UPDATE user_db SET 
    name = ?, 
    email = ?, 
    phone = ?, 
    date_of_birth = ?, 
    gender = ?";

// Parameters for the query
$params = [
    $data['name'],
    $data['email'],
    $data['phone'] ?? '',
    $data['date_of_birth'] ?? '',
    $data['gender'] ?? 'male'
];
$types = "sssss"; // string, string, string, string, string

// Add password to update if provided
if (!empty($data['password'])) {
    $sql .= ", password = ?";
    $params[] = password_hash($data['password'], PASSWORD_DEFAULT);
    $types .= "s"; // add one more string
}

// Complete the query
$sql .= " WHERE id = ?";
$params[] = $user_id;
$types .= "i"; // add integer for user ID

// Execute the update
$stmt = $conn->prepare($sql);
$stmt->bind_param($types, ...$params);

if ($stmt->execute()) {
    // Update session with new name if changed
    $_SESSION['name'] = $data['name'];

    echo json_encode([
        'success' => true,
        'message' => 'Profile updated successfully'
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Failed to update profile'
    ]);
}

$stmt->close();
$conn->close();
?>