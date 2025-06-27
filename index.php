<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>JUNO Hotel</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=person" />
</head>
<body>

    <header class="hero">
        <div class="topbar" id="navbar">
            <a href="../index.php">
              <img src="assets/images/logo.png" alt="Juno Logo" class="logo">
            </a>

            <div class="nav-links">
                <a href="pages/about.php" class="about-link">About Us</a>
                <a href="login.php" class="login-link">
                    <span class="material-symbols-outlined">person</span> Log In
                </a>
            </div>
        </div>
        <div class="hero-text">
            <h1>Make your stay <br> memorable</h1>
            <p>
                Welcome to JUNO Hotel, your perfect urban oasis located in the heart of Manila, Philippines.
                We offer a luxurious and comfortable retreat designed to make your stay unforgettable.
                Whether you're here for business or leisure, Juno Hotel provides an ideal blend of modern amenities,
                exceptional service, and convenient access to Manila’s vibrant attractions.
                Experience the warmth of Filipino hospitality and discover a sanctuary where every detail is crafted for your utmost comfort and satisfaction.
            </p>
            <a href="./pages/about.php" class="hero-button">More about Juno</a>
        </div>
    </header>

    <!-- Facilities Section -->
   <section class="facilities">
        <h2>Facilities</h2>
        <p>Manila explored from JUNO Hotel is a place of new experiences and life-affirming adventures.</p>
        <div class="facility-grid">
            <div class="facility-card" style="background-image: url('assets/images/pool.jpg');">
                <div class="facility-overlay">
                    <h3>Pool</h3>
                    <p>Dive into serenity at our illuminated outdoor pool, surrounded by lush palms and luxurious cabanas – the perfect escape day or night.</p>
                </div>
            </div>
            <div class="facility-card" style="background-image: url('assets/images/gym.jpg');">
                <div class="facility-overlay">
                    <h3>Fitness Gym</h3>
                    <p>Stay energized in our state-of-the-art fitness center equipped with modern machines and a calming ambiance to elevate your workout experience.</p>
                </div>
            </div>
            <div class="facility-card" style="background-image: url('assets/images/spa.jpg');">
                <div class="facility-overlay">
                    <h3>Spa</h3>
                    <p>Rejuvenate your senses at the Juno Spa, where expert therapists and tranquil surroundings offer a sanctuary of relaxation and renewal.</p>
                </div>
            </div>
            <div class="facility-card" style="background-image: url('assets/images/cafe.jpg');">
                <div class="facility-overlay">
                    <h3>Café</h3>
                    <p>Savor artisanal flavors at our cozy café, serving freshly brewed coffee, gourmet pastries, and light bites in a stylish, welcoming setting.</p>
                </div>
            </div>
        </div>
    </section>


    <!-- Mission & Vision -->
    <section class="mission-vision">
        <div class="mission">
            <img src="./assets/images/mission.jpg" alt="Mission Image">
            <div>
                <h2>Our Mission</h2>
                <p>
                    At Juno Hotel, our mission is to provide an exceptional hospitality experience that blends elegance, comfort, and personalized service.
                    We are committed to creating a tranquil escape where every guest feels valued, relaxed, and inspired.
                </p>
            </div>
        </div>
        <div class="vision">
            <div>
                <h2>Our Vision</h2>
                <p>
                    To be the premier destination for luxury and serenity in the heart of the city, known for our impeccable service, breathtaking ambiance, and unforgettable guest experiences.
                </p>
            </div>
            <img src="./assets/images/vision.jpg" alt="Vision Image">
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-left">
            <img src="./assets/images/junologo.png" alt="Juno Footer Logo">
            <p>© 2025 Juno Hotel. All rights reserved.</p>
        </div>
        <div class="footer-right">
            <p><a href="#">Contact Us</a></p>
            <p>📞 <u><a href="tel:+63281234567">(02) 8123 4567</a></u></p>
            <p>✉️ <u><a href="mailto:info@junohotel.com">info@junohotel.com</a></u></p>
            <p><a href="#">About Us</a></p>
            <p><a href="#">FAQs</a></p>
        </div>
    </footer>

     <script src="./assets/js/main.js"></script>
    

</body>
</html>
