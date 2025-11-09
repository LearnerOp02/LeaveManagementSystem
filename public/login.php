<?php
// Start session to store user data
session_start();

// Include database configuration
require_once '../config/config.php';

// Check if form was submitted via POST method
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Get and sanitize user input
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validate required fields
    if (empty($email) || empty($password)) {
        header("Location: index.php?error=Please fill in all fields");
        exit();
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: index.php?error=Invalid email format");
        exit();
    }

    // Additional input validation
    if (strlen($email) > 100 || strlen($password) > 255) {
        header("Location: index.php?error=Invalid input length");
        exit();
    }

    // Prepare SQL query to find user by email
    $stmt = $conn->prepare("SELECT id, name, email, password, role FROM user_db WHERE email = ?");

    if (!$stmt) {
        error_log("Prepare failed: " . $conn->error);
        header("Location: index.php?error=System error. Please try again.");
        exit();
    }

    $stmt->bind_param("s", $email);

    if (!$stmt->execute()) {
        error_log("Execute failed: " . $stmt->error);
        header("Location: index.php?error=System error. Please try again.");
        exit();
    }

    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verify password against hashed password in database
        if (password_verify($password, $user['password'])) {

            // Regenerate session ID to prevent session fixation
            session_regenerate_id(true);

            // Login successful - store user data in session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['login_time'] = time(); // Track login time for session expiration

            // Redirect based on user role
            if ($user['role'] === 'owner') {
                header("Location: owner/dashboard.php");
            } else {
                header("Location: employee/dashboard.php");
            }
            exit();

        } else {
            // Wrong password - generic error message for security
            header("Location: index.php?error=Invalid credentials");
            exit();
        }
    } else {
        // No user found - generic error message for security
        header("Location: index.php?error=Invalid credentials");
        exit();
    }

    // Clean up
    $stmt->close();
}

// Close database connection
$conn->close();
?>