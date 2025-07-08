<?php
session_start();

// --- Example Inputs (replace with actual values from your database or session) ---
$customerName = "Amilia Tanajura";
$reservationDate = "2025-07-22"; // Format: yyyy-mm-dd
$roomType = "Fictional Room";    // Example room type
$reservationCount = 1;           // Increment this value based on actual reservations

// --- Generate Transaction ID ---
function generateTransactionID($customerName, $reservationDate, $roomType, $reservationCount) {
    $prefix = strtoupper(substr(preg_replace('/\s+/', '', $customerName), 0, 2)); // First 2 letters
    $month = strtoupper(date('M', strtotime($reservationDate))); // Month of reservation (3-letter)
    $dayAdded = date('d'); // Current day
    $dayOfMonth = date('d', strtotime($reservationDate)); // Day from reservation date
    $year = date('y', strtotime($reservationDate)); // Last 2 digits of year
    $monthYear = substr($month, 0, 1) . $dayOfMonth . $year; // e.g., F0802

    $roomCode = strtoupper(substr(preg_replace('/[^A-Za-z]/', '', $roomType), 0, 3)); // First 3 letters of room type
    $count = str_pad($reservationCount, 5, '0', STR_PAD_LEFT); // e.g., 00001

    return "{$prefix}{$month}{$dayAdded}{$monthYear}-{$roomCode}{$count}";
}

$transactionID = generateTransactionID($customerName, $reservationDate, $roomType, $reservationCount);

// --- Reservation Data ---
$reservation = [
    'transaction_id' => $transactionID,
    'room' => 'Queen Serenity Suite',
    'checkin' => 'July 8, 2025',
    'checkout' => 'July 11, 2025',
    'guests' => '2 Adults, 1 Child',
    'services' => 'Breakfast',
    'service_price' => '500',
    'total' => '18750'
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Checkout - Juno Hotel</title>
  <link rel="stylesheet" href="../assets/css/payment.css">
  <link rel="stylesheet" href="../assets/css/checkout.css">
  <link rel="icon" href="../assets/images/logo.png">
  <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&family=Montserrat&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
<header class="hero" id="about">
  <div class="topbar" id="navbar">
    <a href="../index.php">
      <img src="../assets/images/logo.png" alt="Juno Logo" class="logo">
    </a>
    <div class="nav-links">
      <a href="../index.php" class="home-link">Home</a>
      <?php if (isset($_SESSION["username"])): ?>
        <span class="nav-username">Hello, <?= htmlspecialchars($_SESSION["username"]) ?></span>
        <div class="profile-dropdown">
          <button class="profile-btn" id="profileToggle">
            <span class="material-symbols-outlined">account_circle</span>
          </button>
          <div class="dropdown-menu" id="dropdownMenu">
            <a href="profile.php">Profile Settings</a>
            <a href="booking.php">My Bookings</a>
            <a href="../process/logout.php">Log Out</a>
          </div>
        </div>
      <?php else: ?>
        <a href="login.php" class="login-link">
          <span class="material-symbols-outlined">account_circle</span> Log In
        </a>
      <?php endif; ?>
    </div>
  </div>
</header>

<!-- Header with background -->
<div class="header">
  <div class="overlay">
    <h1>CHECK OUT</h1>
  </div>
</div>

<!-- Main Checkout Section -->
<div class="checkout-container">
  <!-- Left: Reservation Summary -->
  <div class="card reservation">
    <h2>Your Reservation</h2>
    <div class="info-item" style="flex-direction: column; align-items: flex-start;">
  <span class="info-label">Transaction ID:</span>
  <span class="info-value" style="text-align: left; width: 100%;"><?= $reservation['transaction_id'] ?></span>
    </div>

    <div class="info-item"><strong><?= $reservation['room'] ?></strong></div>
    <div class="info-item"><span class="info-label">Check In:</span> <?= $reservation['checkin'] ?></div>
    <div class="info-item"><span class="info-label">Check Out:</span> <?= $reservation['checkout'] ?></div>
    <div class="info-item"><span class="info-label">Guests:</span> <?= $reservation['guests'] ?></div>
    <div class="info-item"><span class="info-label">Services:</span> <?= $reservation['services'] ?> <br>PHP <?= $reservation['service_price'] ?></div>
    <!-- Divider before Total -->
<div class="divider"></div>

<!-- Total at the bottom -->
<div class="info-item" style="margin-top: 15px;">
  <span class="info-label">Total Amount:</span><br>
  <strong>PHP <?= number_format($reservation['total']) ?></strong>
</div>

  </div>

  <!-- Right: Contact & Payment Form -->
  <form class="card payment" method="POST" action="process_payment.php">
    <h2>Contact Information</h2>
    <div class="form-section">
      <div class="form-group">
        <label for="fname" placeholder="First Name"></label>
        <input type="text" placeholder="First Name" name="fname" required>
      </div>
      <div class="form-group">
        <label for="lname"></label>
        <input type="text" placeholder="Last Name" name="lname" required>
      </div>
      <div class="form-group">
        <label for="email"></label>
        <input type="email" placeholder="Email" name="email" required>
      </div>
      <div class="form-group">
        <label for="email2"></label>
        <input type="email" placeholder="Re-type Email" name="email2" required>
      </div>
    </div>

    <h2>Payment</h2>
    <div class="form-section">
      <div class="form-group">
        <label for="card_fname"></label>
        <input type="text" placeholder="First Name" name="card_fname" required>
      </div>
      <div class="form-group">
        <label for="card_lname"></label>
        <input type="text" placeholder="Last Name" name="card_lname" required>
      </div>
      <div class="form-group">
        <label for="card_number"></label>
        <input type="text" placeholder="Card Number" name="card_number" maxlength="16" required>
      </div>
      <div class="form-group">
        <label for="cvv"></label>
        <input type="text" placeholder="CVV" name="cvv" maxlength="4" required>
      </div>
    </div>

    <div class="form-section">
      <div class="form-group">
        <label for="exp_month"></label>
        <input type="text" name="exp_month" placeholder="Valid Until: MM" maxlength="2" required>
      </div>
      <div class="form-group">
        <label for="exp_year"></label>
        <input type="text" name="exp_year" placeholder="YYYY" maxlength="4" required>
      </div>
    </div>

    <div class="payment-icons">
      <img src="../assets/images/visa.png" alt="Visa">
      <img src="../assets/images/mastercard.png" alt="Mastercard">
      <img src="../assets/images/amex.png" alt="Amex">
      <img src="../assets/images/jcb.jpeg" alt="JCB">
      <img src="../assets/images/paypal.png" alt="PayPal">
    </div>

    <button type="submit" class="submit-btn">Confirm Payment</button>
  </form>
</div>

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
