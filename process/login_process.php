<?php
session_start();
require_once("../includes/db.php");

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["login"])) {
    $input = trim($_POST["email_or_username"]);
    $password = $_POST["password"];

    // Check if input exists in DB
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $input, $input);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Check password correctly
        if (password_verify($password, $user["password"])) {
            // Save session only if password is correct
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["username"] = $user["username"];
            $_SESSION["role"] = $user["role"];
            
            // Redirect to homepage
            header("Location: ../index.php");
            exit;
        } else {
            $_SESSION["login_error"] = "Incorrect password.";
            header("Location: ../pages/login.php");
            exit;
        }
    } else {
        $_SESSION["login_error"] = "No account found with that username or email.";
        header("Location: ../pages/login.php");
        exit;
    }
} else {
    header("Location: ../pages/login.php");
    exit;
}
