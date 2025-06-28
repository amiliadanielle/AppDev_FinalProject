
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Log In Page</title>
    <link rel="stylesheet" href="../assets/css/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=person" />
</head>
<body>

    <header class="hero" id="about">
    <div class="topbar" id="navbar">
        <a href="../index.php">
            <img src="../assets/images/logo.png" alt="Juno Logo" class="logo">
        </a>

        <div class="nav-links">
            <a href="../pages/about.php" class="about-link">About Us</a>
            <a href="../pages/about.php" class="contact-link">Contact Us</a>
        </div>
    </div>

    <form class="login-form" method="POST" action="../process/login_process.php">
      <h2>Log In</h2>
      <input type="text" name="username_email" placeholder="Username/Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <p class="signup-link">Don’t have an account? <a href="../pages/signup.php">Sign up</a></p>
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
            <p><a href="#about">About Us</a></p>
            <p><a href="#faqs">FAQs</a></p>
        </div>
    </footer>

    <script src="../assets/js/main.js"></script>
</body>
</html>
