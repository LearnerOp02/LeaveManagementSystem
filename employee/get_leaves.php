<?php
session_start();
include("../config.php");
header('Content-Type: application/json');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Please login first']);
    exit();
}

// Get all leave applications for this user
$sql = "SELECT 
    id, title, leave_type, 
    from_date AS start_date, 
    to_date AS end_date, 
    reason, status, created_at
    FROM leave_applications 
    WHERE user_id = ?
    ORDER BY from_date DESC";  // Newest leaves first

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();

// Collect all leaves in an array
$leaves = [];
while ($row = $result->fetch_assoc()) {
    $leaves[] = $row;
}

// Return the list of leaves
echo json_encode([
    'success' => true,
    'leaves' => $leaves
]);

$stmt->close();
$conn->close();
?>