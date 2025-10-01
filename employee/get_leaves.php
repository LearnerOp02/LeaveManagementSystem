<?php
// ==============================
// Get Leave Applications API
// ==============================
session_start();
include("../config.php");

header('Content-Type: application/json');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not authenticated']);
    exit();
}

try {
    // Fetch all leave applications for the user
    $stmt = $conn->prepare("
        SELECT 
            id, title, leave_type, 
            from_date AS start_date, 
            to_date AS end_date, 
            reason, status, created_at
        FROM leave_applications 
        WHERE user_id = ?
        ORDER BY from_date DESC
    ");
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();

    $leaves = [];
    while ($row = $result->fetch_assoc()) {
        $leaves[] = $row;
    }

    echo json_encode(['success' => true, 'leaves' => $leaves]);

    $stmt->close();
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}

$conn->close();
?>