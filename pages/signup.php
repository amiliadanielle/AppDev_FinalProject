<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sign Up Page</title>
  <link rel="icon" type="image/x-icon" href="../assets/images/logo.png">
  <link rel="stylesheet" href="../assets/css/signup.css">
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
      <a href="../pages/about.php" class="about-link">About Us</a>
      <a href="../pages/about.php" class="contact-link">Contact Us</a>
    </div>
  </div>

  <form class="signup-form" method="POST" action="../process/signup_process.php">
    <h2>Sign Up</h2>

    <?php if (isset($_SESSION['signup_error'])): ?>
      <p style="color: white;"><?= $_SESSION['signup_error'] ?></p>
      <?php unset($_SESSION['signup_error']); ?>
    <?php endif; ?>

    <div class="input-group">
      <input type="email" name="email" placeholder="Email" required>
    </div>

    <div class="input-group">
      <input type="text" name="username" placeholder="Username" required>
    </div>

    <div class="input-group">
      <input type="password" name="password" placeholder="Password" required>
    </div>

    <div class="input-group">
      <input type="password" name="confirm_password" placeholder="Confirm Password" required>
    </div>

    <p class="signup-link">Already have an account? <a href="login.php">Log In</a></p>

    <button type="submit">Sign Up</button>
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
