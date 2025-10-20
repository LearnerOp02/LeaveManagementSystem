<?php
session_start();
include("../../config/config.php");
header('Content-Type: application/json');

// Check if user is logged in and is an owner
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'owner') {
    echo json_encode(['success' => false, 'message' => 'Access denied. Owners only.']);
    exit();
}

// Get data from frontend
$data = json_decode(file_get_contents('php://input'), true);
$leaveId = $data['leaveId'] ?? null;
$status = $data['status'] ?? null; // 'approved' or 'rejected'

// Validate input
if (!$leaveId || !$status) {
    echo json_encode(['success' => false, 'message' => 'Leave ID and status are required']);
    exit();
}

// Update leave status in database
$sql = "UPDATE leave_applications SET status = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $status, $leaveId);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => "Leave application {$status} successfully"]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error updating leave status']);
}

$stmt->close();
$conn->close();
?>