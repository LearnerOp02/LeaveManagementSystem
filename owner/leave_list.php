<?php
session_start();
include("../config.php");
header('Content-Type: application/json');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Please login first']);
    exit();
}

// Get all leave applications with employee details
$sql = "SELECT 
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
    ORDER BY la.created_at DESC";

$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

$leaves = [];
while ($row = $result->fetch_assoc()) {
    // Generate initials for employee
    $nameParts = explode(' ', $row['employee_name']);
    $initials = '';
    if (count($nameParts) > 0) {
        $initials = strtoupper($nameParts[0][0]);
        if (count($nameParts) > 1) {
            $initials .= strtoupper($nameParts[1][0]);
        }
    }

    $row['initials'] = $initials;
    $leaves[] = $row;
}

echo json_encode(['success' => true, 'leaves' => $leaves]);
$stmt->close();
$conn->close();
?>