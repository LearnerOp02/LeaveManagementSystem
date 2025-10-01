<?php
session_start();
include("../config.php");
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not authenticated']);
    exit();
}

try {
    $stmt = $conn->prepare("
        SELECT 
            la.id, 
            la.title, 
            la.leave_type, 
            la.from_date AS start_date, 
            la.to_date AS end_date, 
            la.reason, 
            la.status, 
            la.created_at,
            u.name AS employee_name,
            u.email AS employee_email
        FROM leave_applications la
        INNER JOIN user_db u ON la.user_id = u.id
        ORDER BY la.created_at DESC
    ");
    $stmt->execute();
    $result = $stmt->get_result();

    $leaves = [];
    while ($row = $result->fetch_assoc()) {
        $initials = '';
        $nameParts = explode(' ', $row['employee_name']);
        if (count($nameParts) > 0) {
            $initials = strtoupper(substr($nameParts[0], 0, 1));
            if (count($nameParts) > 1) {
                $initials .= strtoupper(substr($nameParts[1], 0, 1));
            }
        }
        $row['initials'] = $initials;
        $leaves[] = $row;
    }

    echo json_encode(['success' => true, 'leaves' => $leaves]);
    $stmt->close();
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>