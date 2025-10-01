<?php
session_start();
include("../config.php");
header('Content-Type: application/json');

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'owner') {
    echo json_encode(['success' => false, 'message' => 'Not authorized']);
    exit();
}

$data = json_decode(file_get_contents('php://input'), true);
$leaveId = $data['leaveId'] ?? null;
$status = $data['status'] ?? null;

if (!$leaveId || !$status) {
    echo json_encode(['success' => false, 'message' => 'Missing parameters']);
    exit();
}

try {
    $stmt = $conn->prepare("UPDATE leave_applications SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $leaveId);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Leave status updated successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error updating leave status']);
    }

    $stmt->close();
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>