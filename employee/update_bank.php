<?php
// ==============================
// Update Bank Details API
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
// Step 2: Validate Required Data
// -----------------------------
if (
    empty($data['account_holder_name']) ||
    empty($data['account_number']) ||
    empty($data['ifsc_code'])
) {
    echo json_encode([
        'success' => false,
        'message' => 'Account holder name, account number and IFSC code are required'
    ]);
    exit();
}

try {
    // -----------------------------
    // Step 3: Update Bank Details
    // -----------------------------
    $stmt = $conn->prepare("
        UPDATE user_db SET 
            account_holder_name = ?, 
            account_number      = ?, 
            ifsc_code           = ?, 
            bank_name           = ?, 
            branch_name         = ?
        WHERE id = ?
    ");
    $stmt->bind_param(
        "sssssi",
        $data['account_holder_name'],
        $data['account_number'],
        $data['ifsc_code'],
        $data['bank_name'],
        $data['branch_name'],
        $user_id
    );

    $success = $stmt->execute();

    if ($success) {
        echo json_encode(['success' => true, 'message' => 'Bank details updated successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update bank details']);
    }

    $stmt->close();
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}

$conn->close();
?>