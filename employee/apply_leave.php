<?php
// ==============================
// Apply for Leave API
// ==============================
session_start();
include("../config.php");

header('Content-Type: application/json');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not authenticated']);
    exit();
}

// Get JSON input
$data = json_decode(file_get_contents('php://input'), true);

// Validate required fields
if (
    empty($data['title']) || empty($data['leave_type']) || empty($data['reason']) ||
    empty($data['start_date']) || empty($data['end_date'])
) {
    echo json_encode(['success' => false, 'message' => 'All fields are required']);
    exit();
}

// Validate date range
if (strtotime($data['end_date']) < strtotime($data['start_date'])) {
    echo json_encode(['success' => false, 'message' => 'End date must be after start date']);
    exit();
}

try {
    // Insert new leave application
    $stmt = $conn->prepare("
        INSERT INTO leave_applications (
            user_id, title, leave_type, from_date, to_date, reason
        ) VALUES (?, ?, ?, ?, ?, ?)
    ");
    $stmt->bind_param(
        "isssss",
        $_SESSION['user_id'],
        $data['title'],
        $data['leave_type'],
        $data['start_date'],
        $data['end_date'],
        $data['reason']
    );
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo json_encode([
            'success' => true,
            'message' => 'Leave application submitted successfully',
            'leave_id' => $stmt->insert_id
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to submit leave application']);
    }

    $stmt->close();
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}

$conn->close();
?>