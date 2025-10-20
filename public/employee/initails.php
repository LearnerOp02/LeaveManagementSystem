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

// Get user's name from database
$stmt = $conn->prepare("SELECT name FROM user_db WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    $name = trim($user['name']);

    // Generate initials from name
    $name_parts = explode(' ', $name);

    if (count($name_parts) === 1) {
        // Single name: take first 2 letters
        $initials = substr($name_parts[0], 0, 2);
    } else {
        // Multiple names: take first letter of first and last name
        $initials = $name_parts[0][0] . $name_parts[count($name_parts) - 1][0];
    }

    // Convert to uppercase
    $initials = strtoupper($initials);

    echo json_encode([
        'success' => true,
        'name' => $name,
        'initials' => $initials
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'User not found']);
}

$stmt->close();
$conn->close();
?>