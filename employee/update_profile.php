<?php
// ==============================
// Update Profile API
// ==============================
session_start();
include("../config.php");

header('Content-Type: application/json');

// -----------------------------
// Step 1: Check Authentication
// -----------------------------
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not authenticated']);
    exit();
}

$user_id = $_SESSION['user_id'];
$data = json_decode(file_get_contents('php://input'), true);

// -----------------------------
// Step 2: Validate Input
// -----------------------------
if (empty($data['name']) || empty($data['email'])) {
    echo json_encode(['success' => false, 'message' => 'Name and email are required']);
    exit();
}

// -----------------------------
// Step 3: Build Dynamic Query
// -----------------------------
$query = "UPDATE user_db SET name = ?, email = ?, phone = ?, date_of_birth = ?, gender = ?";
$params = [
    $data['name'],
    $data['email'],
    $data['phone'],
    $data['date_of_birth'],
    $data['gender'] ?? 'male'
];
$types = "sssss";

// Add password update if provided
if (!empty($data['password'])) {
    $query .= ", password = ?";
    $params[] = password_hash($data['password'], PASSWORD_DEFAULT);
    $types .= "s";
}

$query .= " WHERE id = ?";
$params[] = $user_id;
$types .= "i";

try {
    // -----------------------------
    // Step 4: Execute Query
    // -----------------------------
    $stmt = $conn->prepare($query);
    $stmt->bind_param($types, ...$params);
    $success = $stmt->execute();

    if ($success) {
        // Update session name if changed
        if (isset($_SESSION['name']) && $_SESSION['name'] !== $data['name']) {
            $_SESSION['name'] = $data['name'];
        }
        echo json_encode(['success' => true, 'message' => 'Profile updated successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update profile']);
    }

    $stmt->close();
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}

$conn->close();
?>