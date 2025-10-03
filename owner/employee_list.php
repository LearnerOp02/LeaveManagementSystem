<?php
include("../config.php");
session_start();
header('Content-Type: application/json');

// Check if user is logged in and is an owner
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'owner') {
    echo json_encode(['success' => false, 'message' => 'Access denied. Owners only.']);
    exit();
}

// Get all employees from database
$sql = "SELECT id, name, email, phone, gender, role FROM user_db WHERE role = 'employee' ORDER BY name";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

$employees = [];
while ($row = $result->fetch_assoc()) {
    // Generate initials from name (e.g., "John Doe" → "JD")
    $words = explode(" ", $row['name']);
    $initials = "";
    foreach ($words as $w) {
        if (!empty($w)) {
            $initials .= strtoupper($w[0]);
        }
    }

    $employees[] = [
        "id" => $row['id'],
        "name" => $row['name'],
        "email" => $row['email'],
        "initials" => $initials,
        "phone" => $row['phone'],
        "gender" => $row['gender'],
        "role" => $row['role']
    ];
}

echo json_encode([
    "success" => true,
    "data" => $employees,
    "user_role" => $_SESSION['role'] // Also return current user's role
]);

$stmt->close();
$conn->close();
?>