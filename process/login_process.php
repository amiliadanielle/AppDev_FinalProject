<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["login"])) {
    $username_email = $_POST["username_email"];
    $password = $_POST["password"];

    // DB connection
    require_once("../includes/db.php");

    // Check user by username or email
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username_email, $username_email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        if (password_verify($password, $user['password'])) {
            // Login successful
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["username"] = $user["username"];
            $_SESSION["role"] = $user["role"];

            // Redirect based on role
            if ($user['role'] === 'admin') {
                header("Location: ../pages/admin/dashboard.php");
            } else {
                header("Location: ../pages/profile.php");
            }
            exit;
        } else {
            $_SESSION["login_error"] = "Invalid password.";
        }
    } else {
        $_SESSION["login_error"] = "User not found.";
    }

    // Redirect back to login page with error
    header("Location: ../pages/login.php");
    exit;
} else {
    // If accessed directly without POST
    header("Location: ../pages/login.php");
    exit;
}
?>
