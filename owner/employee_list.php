<?php
include("../config.php");
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'owner') {
    echo json_encode(['success' => false, 'message' => 'Not authorized']);
    exit();
}

try {
    $stmt = $conn->prepare("
        SELECT id, name, email, phone, gender, role 
        FROM user_db 
        WHERE role = 'employee'
        ORDER BY name
    ");

    if (!$stmt) {
        throw new Exception("Prepare failed: " . $conn->error);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    $employees = [];
    while ($row = $result->fetch_assoc()) {
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

    echo json_encode(["success" => true, "data" => $employees]);
    $stmt->close();
} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => "Error: " . $e->getMessage()]);
}
?>