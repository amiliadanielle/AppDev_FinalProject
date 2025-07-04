<?php
session_start();
$conn = new mysqli("localhost", "root", "", "juno_hotel_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = trim($_POST["username"]);
$email = trim(strtolower($_POST["email"]));
$password = $_POST["password"];
$confirm_password = $_POST["confirm_password"];

// Check password match
if ($password !== $confirm_password) {
    $_SESSION["signup_error"] = "Passwords do not match.";
    header("Location: ../pages/signup.php");
    exit;
}

// Check for duplicate username or email
$stmt = $conn->prepare("SELECT id FROM users WHERE email = ? OR username = ?");
$stmt->bind_param("ss", $email, $username);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $_SESSION["signup_error"] = "Username or email already exists.";
    header("Location: ../pages/signup.php");
    exit;
}
$stmt->close();

// Hash password before saving
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert new user
$stmt = $conn->prepare("INSERT INTO users (username, email, password, role, is_banned, created_at) VALUES (?, ?, ?, 'user', 0, NOW())");
$stmt->bind_param("sss", $username, $email, $hashed_password);
if ($stmt->execute()) {
    $user_id = $stmt->insert_id;

    // Insert blank profile
    $profile_stmt = $conn->prepare("INSERT INTO user_profiles (user_id) VALUES (?)");
    $profile_stmt->bind_param("i", $user_id);
    $profile_stmt->execute();
    $profile_stmt->close();

    $_SESSION["signup_success"] = "Registration successful. Please log in.";
    header("Location: ../pages/login.php");
    exit;
} else {
    $_SESSION["signup_error"] = "Signup failed. Try again.";
    header("Location: ../pages/signup.php");
    exit;
}
?>
