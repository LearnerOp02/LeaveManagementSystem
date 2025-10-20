<?php
// Start session to check if user is logged in
session_start();
include("../../config/config.php");

// Set response type to JSON
header('Content-Type: application/json');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Please login first']);
    exit();
}

// Get data from frontend (JSON format)
$input = json_decode(file_get_contents('php://input'), true);

// Check if all required fields are filled
$required_fields = ['title', 'leave_type', 'reason', 'start_date', 'end_date'];
foreach ($required_fields as $field) {
    if (empty($input[$field])) {
        echo json_encode(['success' => false, 'message' => 'Please fill all fields']);
        exit();
    }
}

// Check if end date is after start date
if (strtotime($input['end_date']) < strtotime($input['start_date'])) {
    echo json_encode(['success' => false, 'message' => 'End date cannot be before start date']);
    exit();
}

// Save leave application to database
$sql = "INSERT INTO leave_applications (user_id, title, leave_type, from_date, to_date, reason) 
        VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "isssss",
    $_SESSION['user_id'],      // Logged-in user's ID
    $input['title'],           // Leave title (e.g., "Vacation")
    $input['leave_type'],      // Leave type (e.g., "sick", "vacation")
    $input['start_date'],      // Start date of leave
    $input['end_date'],        // End date of leave  
    $input['reason']           // Reason for leave
);

if ($stmt->execute()) {
    // Success - leave application saved
    echo json_encode([
        'success' => true,
        'message' => 'Leave application submitted successfully'
    ]);
} else {
    // Error - failed to save
    echo json_encode([
        'success' => false,
        'message' => 'Failed to submit leave application'
    ]);
}

$stmt->close();
$conn->close();
?>