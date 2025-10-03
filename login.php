<?php
// Start session to store user data
session_start();

// Include database configuration
require_once("config.php");

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

    // Prepare SQL query to find user by email
    $stmt = $conn->prepare("SELECT id, name, email, password, role FROM user_db WHERE email = ?");
    $stmt->bind_param("s", $email);  // 's' means string parameter
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();  // Get user data as associative array
        
        // Verify password against hashed password in database
        if (password_verify($password, $user['password'])) {
            
            // Login successful - store user data in session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];

            // Redirect based on user role
            if ($user['role'] === 'owner') {
                header("Location: owner/ownerlanding.html");
            } else {
                header("Location: employee/emplanding.html");
            }
            exit();
            
        } else {
            // Wrong password
            header("Location: index.php?error=Invalid password");
            exit();
        }
    } else {
        // No user found with this email
        header("Location: index.php?error=No user found with that email");
        exit();
    }

    // Clean up
    $stmt->close();
}

// Close database connection
$conn->close();
?>