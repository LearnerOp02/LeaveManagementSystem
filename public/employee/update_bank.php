<?php
session_start();
include("../../config/config.php");
header('Content-Type: application/json');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Please login first']);
    exit();
}

$user_id = $_SESSION['user_id'];
$data = json_decode(file_get_contents('php://input'), true);

// Validate required bank fields
$required_fields = ['account_holder_name', 'account_number', 'ifsc_code'];
foreach ($required_fields as $field) {
    if (empty($data[$field])) {
        echo json_encode([
            'success' => false,
            'message' => 'Account holder name, account number and IFSC code are required'
        ]);
        exit();
    }
}

// Update bank details in database
$sql = "UPDATE user_db SET 
    account_holder_name = ?, 
    account_number = ?, 
    ifsc_code = ?, 
    bank_name = ?, 
    branch_name = ?
    WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "sssssi",
    $data['account_holder_name'],
    $data['account_number'],
    $data['ifsc_code'],
    $data['bank_name'] ,
    $data['branch_name'] ,
    $user_id
);

if ($stmt->execute()) {
    echo json_encode([
        'success' => true,
        'message' => 'Bank details updated successfully'
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Failed to update bank details'
    ]);
}

$stmt->close();
$conn->close();
?>