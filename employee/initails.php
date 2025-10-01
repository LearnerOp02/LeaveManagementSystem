<?php
// ==============================
// Get User Initials API
// ==============================
session_start();
include("../config.php");

header('Content-Type: application/json');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not authenticated']);
    exit();
}

$user_id = $_SESSION['user_id'];

try {
    // Fetch user name
    $stmt = $conn->prepare("SELECT name FROM user_db WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        $name = trim($user['name']);

        // Generate initials
        $names = explode(' ', $name);
        if (count($names) === 1) {
            $initials = substr($names[0], 0, 2);
        } else {
            $initials = $names[0][0] . $names[count($names) - 1][0];
        }
        $initials = strtoupper($initials);

        echo json_encode(['success' => true, 'name' => $name, 'initials' => $initials]);
    } else {
        echo json_encode(['success' => false, 'message' => 'User not found']);
    }

    $stmt->close();
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}

$conn->close();
?>