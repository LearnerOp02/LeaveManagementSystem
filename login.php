<?php
session_start();
require_once("config.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        header("Location: index.php?error=Please fill in all fields&email=" . urlencode($email));
        exit();
    }

    $stmt = $conn->prepare("SELECT id, name, email, password, role FROM user_db WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] === 'owner') {
                header("Location: owner/ownerlanding.html");
            } else {
                header("Location: employee/emplanding.html");
            }
            exit();
        } else {
            header("Location: index.php?error=Invalid password&email=" . urlencode($email));
            exit();
        }
    } else {
        header("Location: index.php?error=No user found with that email&email=" . urlencode($email));
        exit();
    }

    $stmt->close();
}
?>