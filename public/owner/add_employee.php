<?php
include("../../config/config.php");
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'owner') {
    echo json_encode(["success" => false, "message" => "Not authorized"]);
    exit();
}

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$password = password_hash($_POST['password'] ?? '', PASSWORD_DEFAULT);
$phone = $_POST['phone'] ?? '';
$gender = $_POST['gender'] ?? '';
$role = $_POST['role'] ?? 'employee';
$dob = $_POST['dob'] ?? '';
$acc_holder = $_POST['accountHolder'] ?? '';
$acc_num = $_POST['accountNumber'] ?? '';
$ifsc = $_POST['ifsc'] ?? '';
$bank = $_POST['bankName'] ?? '';
$branch = $_POST['branchName'] ?? '';

try {
    $stmt = $conn->prepare("
        INSERT INTO user_db 
        (name, email, password, phone, gender, role, date_of_birth, account_holder_name, account_number, ifsc_code, bank_name, branch_name) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    $stmt->bind_param(
        "ssssssssssss",
        $name,
        $email,
        $password,
        $phone,
        $gender,
        $role,
        $dob,
        $acc_holder,
        $acc_num,
        $ifsc,
        $bank,
        $branch
    );

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Employee added successfully"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error adding employee"]);
    }

    $stmt->close();
} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => "Database error"]);
}
?>