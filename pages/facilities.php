<!DOCTYPE html>
<html>
<head>
    <title>Juno Hotel - Facilities</title>
    <link rel="icon" type="image/x-icon" href="../assets/images/logo.png">
    <link rel="stylesheet" href="../assets/css/facilities.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&display=swap" rel="stylesheet">
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
      <a href="booking.php" class="booking-link">Book a Hotel</a>
      <a href="../index.php" class="home-link">Home</a>

      <?php if (isset($_SESSION["username"])): ?>
      <div class="profile-combo" id="profileCombo">
        <span class="material-symbols-outlined">account_circle</span>
        <span class="nav-username">Hello, <?= htmlspecialchars($_SESSION["username"]) ?></span>
        <span class="arrow-icon material-symbols-outlined">expand_more</span>

        <div class="dropdown-menu" id="dropdownMenu">
          <a href="profile.php">Profile Settings</a>
          <a href="booking.php">My Bookings</a>
          <a href="process/logout.php">Log Out</a>
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

<!-- Hero Section -->
<section class="facilities-hero">
  <div class="hero-content">
    <p class="subtitle">FACILITIES AND AMENITIES</p>
    <h1 class="main-title">Health Club and Spa</h1>
  </div>
</section>

<!-- Facilities List -->
<section class="facilities-wrapper">
  <!-- Card 1 -->
  <div class="facility-card">
    <img src="../assets/images/spa.jpg" alt="Juno Spa">
    <div class="facility-info">
      <h2>Spa and Wellness</h2>
      <p>
        Our exclusive Spa offers relaxation with therapeutic massage services, sauna, and steam rooms. 
        Treat yourself to a rejuvenating experience in a peaceful ambiance.
      </p>
      <p><strong>Open daily from 9:00am to 10:00pm</strong></p>
    </div>
  </div>

  <!-- Card 2 -->
  <div class="facility-card">
    <img src="../assets/images/pool.jpg" alt="Juno Pool">
    <div class="facility-info">
      <h2>Infinity Pool</h2>
      <p>
        Enjoy a refreshing dip in our rooftop infinity pool overlooking the city skyline. Poolside drinks and sun loungers available.
      </p>
      <p><strong>Open daily from 6:00am to 8:00pm</strong></p>
    </div>
  </div>

  <!-- Card 3 -->
  <div class="facility-card">
    <img src="../assets/images/jacuzzi.jpg" alt="Juno Jacuzzi">
    <div class="facility-info">
      <h2>Jacuzzi Lounge</h2>
      <p>
        Melt your stress away in our indoor and outdoor jacuzzis. A perfect way to unwind after a long day of exploring or meetings.
      </p>
      <p><strong>Open daily from 10:00am to 10:00pm</strong></p>
    </div>
  </div>

  <!-- Card 4: Rooftop Café and Bar -->
<div class="facility-card">
  <img src="../assets/images/cafebar.jpg" alt="Juno Rooftop Café and Bar">
  <div class="facility-info">
    <h2>Rooftop Café and Bar</h2>
    <p>
      Enjoy stunning panoramic views of the city skyline at our Rooftop Café and Bar. 
      By day, indulge in artisanal coffee, pastries, and light meals in a cozy café ambiance. 
      As the sun sets, the space transforms into a vibrant rooftop bar offering signature cocktails, local beers, and live acoustic music.
    </p>
    <p><strong>Open daily: 8:00am – 12:00am</strong></p>
  </div>
</div>

<!-- Card 5: Gym and Sports Area -->
<div class="facility-card">
  <img src="../assets/images/gym.jpg" alt="Juno Gym and Sports Area">
  <div class="facility-info">
    <h2>Gym and Sports Area</h2>
    <p>
      Stay fit and active at our state-of-the-art gym featuring cardio and strength training equipment. 
      Our sports area includes a basketball half-court and table tennis facilities, ideal for friendly matches or personal workouts.
    </p>
    <p><strong>Open daily from 6:00am to 10:00pm</strong></p>
  </div>
</div>

</section>

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