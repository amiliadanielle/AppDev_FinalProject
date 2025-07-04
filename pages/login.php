<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Log In Page</title>
    <link rel="icon" type="image/x-icon" href="../assets/images/logo.png">
    <link rel="stylesheet" href="../assets/css/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&display=swap" rel="stylesheet">
</head>
<body>

<header class="hero" id="about">
    <div class="topbar" id="navbar">
        <a href="../index.php">
            <img src="../assets/images/logo.png" alt="Juno Logo" class="logo">
        </a>
        <div class="nav-links">
            <a href="../index.php" class="about-link">Home</a>
            <a href="../pages/about.php" class="contact-link">About Us</a>
        </div>
    </div>

    <form class="login-form" method="POST" action="../process/login_process.php">
        <h2>Log In</h2>

        <?php if (isset($_SESSION["signup_success"])): ?>
            <p class="success-message"><?= htmlspecialchars($_SESSION["signup_success"]) ?></p>
            <?php unset($_SESSION["signup_success"]); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION["login_error"])): ?>
            <p class="error-message"><?= htmlspecialchars($_SESSION["login_error"]) ?></p>
            <?php unset($_SESSION["login_error"]); ?>
        <?php endif; ?>

        <div class="input-group">
            <input type="text" name="email_or_username" placeholder="Email or Username" required>
        </div>

        <div class="input-group">
            <input type="password" name="password" placeholder="Password" required>
        </div>

        <p class="login-link">Don’t have an account? <a href="signup.php">Sign up</a></p>

        <button type="submit" name="login">Log In</button>
    </form>
</header>

<footer>
    <div class="footer-left">
        <img src="../assets/images/junologo.png" alt="Juno Footer Logo">
        <p>© 2025 Juno Hotel. All rights reserved.</p>
    </div>
    <div class="footer-right">
        <p><a href="#">Contact Us</a></p>
        <p>📞 <u><a href="tel:+63281234567">(02) 8123 4567</a></u></p>
        <p>✉️ <u><a href="mailto:info@junohotel.com">info@junohotel.com</a></u></p>
        <p><a href="about.php#about">About Us</a></p>
        <p><a href="about.php#faqs">FAQs</a></p>
    </div>
</footer>

<script src="../assets/js/main.js"></script>
</body>
</html>
