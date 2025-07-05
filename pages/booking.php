<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Your Stay - Juno Hotel</title>
    <link rel="stylesheet" href="../assets/css/booking.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=person" />
</head>
<body>
    <?php
	session_start();
    // (1) Database connection - Replace with your actual database credentials
	// temporary lang tong may @ | it should be the actual account
    $host = 'localhost';
    $dbname = 'juno_hotel_db';
    $username = 'root'; //@
    $password = ''; //@
    
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    // (2) Fetch room data from database
    $sql = "SELECT 
            room_type,
            MIN(id) AS id,
            MIN(room_number) AS room_number,
            MIN(description) AS description,
            MIN(price) AS price,
            MIN(image) AS image,
            COUNT(*) AS available_rooms,
            MAX(status) AS status
        FROM rooms
        WHERE status = 'available'
        GROUP BY room_type
        LIMIT 5";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // (3) Fetch booking data if session exists
    $bookingData = null;
    if (isset($_SESSION['booking_data'])) {
        $bookingData = $_SESSION['booking_data'];
    }
    ?> 

    <header class="hero" id="about">
        <div class="hero-background">
            <div class="hero-overlay"></div>
            <div class="topbar" id="navbar">
                <a href="../index.php">
                    <img src="../assets/images/logo.png" alt="Juno Logo" class="logo">
                </a>
                <div class="nav-links">
                    <a href="../pages/about.php" class="about-link">About Us</a>
                    <a href="../pages/about.php" class="contact-link">Contact Us</a>
                    <span class="material-symbols-outlined user-icon">person</span>
                </div>
            </div>
            
            <div class="hero-content">
                <img src="../assets/images/junologo.png" alt="Juno Hotel & Suites" class="hero-logo">
                <div class="booking-bar">
                    <div class="booking-input">
                        <label>*Date</label>
                        <input type="date" id="checkin-date" required>
                    </div>
                    <div class="booking-input">
                        <label>*Guests</label>
                        <select id="guests" required>
                            <option value="">Select guests</option>
                            <option value="1">1 Guest</option>
                            <option value="2">2 Guests</option>
                            <option value="3">3 Guests</option>
                            <option value="4">4 Guests</option>
                        </select>
                    </div>
                    <button class="book-now-btn" type="button">BOOK NOW</button>
                </div>
            </div>
        </div>
    </header>

    <main class="booking-main">
        <div class="container">
            <h1>Choose your accommodation</h1>
            
            <div class="filter-section">
                <div class="filter-group">
                    <label>View by:</label>
                    <select id="view-filter">
                        <option value="all">All Rooms</option>
                        <option value="rooms">Rooms</option>
                        <option value="suites">Suites</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label>Sort by:</label>
                    <select id="sort-filter">
                        <option value="recommended">Recommended</option>
                        <option value="price-low">Price: Low to High</option>
                        <option value="price-high">Price: High to Low</option>
                        <option value="capacity">Capacity</option>
                    </select>
                </div>
            </div>

            <div class="booking-content">
                <div class="rooms-section" id="rooms-container">
                    <?php 
                    // (4) Display rooms from database
                    if ($rooms): 
                        foreach ($rooms as $room): 
                    ?>
                    <div class="room-card" data-room-type="<?php echo strtolower($room['room_type']); ?>" data-price="<?php echo $room['price']; ?>">
                        <div class="room-image">
                            <img src="../assets/images/<?php echo $room['image']; ?>" alt="<?php echo htmlspecialchars($room['room_type']); ?>">
                        </div>
                        <div class="room-details">
                            <h3><?php echo htmlspecialchars($room['room_type']); ?></h3>
                            <div class="room-info">
                                <span class="room-size">-- SQM</span> 
                                <span class="room-capacity">Sleeps --</span> 
                            </div>
                            <p class="room-description">
                                <?php echo htmlspecialchars($room['description']); ?>
                            </p>
                            <div class="room-actions">
                                <button class="view-details-btn" data-room-id="<?php echo $room['id']; ?>">View Details</button>
                                <button class="check-availability-btn" data-room-id="<?php echo $room['id']; ?>">Check Availability</button>
                            </div>
                        </div>
                        <div class="room-pricing">
                            <div class="price-info">    
                                <span class="starting-from">Starting from</span>
                                <span class="price">₱<?php echo number_format($room['price']); ?></span>
                                <span class="per-night">Daily <?php echo $room['available_rooms']; ?> room available</span>
                            </div>
                        </div>
                    </div>
                 <?php 
                        endforeach; 
                    else: 
                    ?>
                    <!-- Fallback static rooms if database is not available  //temporary lang to unless static ang preferred nyo...-->
                    <div class="room-card" data-room-type="room" data-price="11250" data-capacity="1">
                        <div class="room-image">
                            <img src="../assets/images/solo_nook.jpg" alt="Solo Nook Room">
                        </div>
                        <div class="room-details">
                            <h3>Solo Nook Room</h3>
                            <div class="room-info">
                                <span class="room-size">60 SQM</span>
                                <span class="room-capacity">Sleeps 1</span>
                            </div>
                            <p class="room-description">
                                A cozy, stylish retreat for the solo traveler.
                            </p>
                            <div class="room-actions">
                                <button class="view-details-btn">View Details</button>
                                <button class="check-availability-btn">Check Availability</button>
                            </div>
                        </div>
                        <div class="room-pricing">
                            <div class="price-info">
                                <span class="starting-from">Starting from</span>
                                <span class="price">₱11,250</span>
                                <span class="per-night">Daily 10 room available</span>
                            </div>
                        </div>
                    </div>
                    <!-- Room 2 -->					
					<div class="room-card" data-room-type="room" data-price="16250" data-capacity="2">
                        <div class="room-image">
                            <img src="../assets/images/twin_horizon.jpg" alt="Twin Horizon Room">
                        </div>
                        <div class="room-details">
                            <h3>Twin Horizon Room</h3>
                            <div class="room-info">
                                <span class="room-size">120 SQM</span>
                                <span class="room-capacity">Sleeps 2</span>
                            </div>
                            <p class="room-description">
                                Designed for comfort and space of two people.
                            </p>
                            <div class="room-actions">
                                <button class="view-details-btn">View Details</button>
                                <button class="check-availability-btn">Check Availability</button>
                            </div>
                        </div>
                        <div class="room-pricing">
                            <div class="price-info">
                                <span class="starting-from">Starting from</span>
                                <span class="price">₱16,250</span>
                                <span class="per-night">Daily 5 room available</span>
                            </div>
                        </div>
                    </div>
                    <!-- Room 3 or "suite 3" -->						
					<div class="room-card" data-room-type="suite" data-price="18250" data-capacity="2">
                        <div class="room-image">
                            <img src="../assets/images/queen_serenity.jpg" alt="Queen Serenity Suite">
                        </div>
                        <div class="room-details">
                            <h3>Queen Serenity Suite</h3>
                            <div class="room-info">
                                <span class="room-size">120 SQM</span>
                                <span class="room-capacity">Sleeps 2</span>
                            </div>
                            <p class="room-description">
                                Enjoy luxurious sleep in a queen-sized bed surrounded by ambient lighting and calming textures.
                            </p>
                            <div class="room-actions">
                                <button class="view-details-btn">View Details</button>
                                <button class="check-availability-btn">Check Availability</button>
                            </div>
                        </div>
                        <div class="room-pricing">
                            <div class="price-info">
                                <span class="starting-from">Starting from</span>
                                <span class="price">₱18,250</span>
                                <span class="per-night">Daily 5 room available</span>
                            </div>
                        </div>
                    </div>
					<!-- Room 4 or "suite 4" -->						
					<div class="room-card" data-room-type="suite" data-price="20000" data-capacity="4">
                        <div class="room-image">
                            <img src="../assets/images/signature_king.jpg" alt="Juno Signature King Suite">
                        </div>
                        <div class="room-details">
                            <h3>Juno Signature King Suite</h3>
                            <div class="room-info">
                                <span class="room-size">150 SQM</span>
                                <span class="room-capacity">Sleeps 4</span>
                            </div>
                            <p class="room-description">
                                Balance luxury and mindfulness in this calming suite inspired with our signature style king suite.
                            </p>
                            <div class="room-actions">
                                <button class="view-details-btn">View Details</button>
                                <button class="check-availability-btn">Check Availability</button>
                            </div>
                        </div>
                        <div class="room-pricing">
                            <div class="price-info">
                                <span class="starting-from">Starting from</span>
                                <span class="price">₱20,000</span>
                                <span class="per-night">Daily 2 room available</span>
                            </div>
                        </div>
                    </div>
					<!-- Room 5 or "suite 5" -->						
					<div class="room-card" data-room-type="suite" data-price="25000" data-capacity="5">
                        <div class="room-image">
                            <img src="../assets/images/courtyard_haven.jpg" alt="Courtyard Family Haven Suite">
                        </div>
                        <div class="room-details">
                            <h3>Courtyard Family Haven Suite</h3>
                            <div class="room-info">
                                <span class="room-size">160 SQM</span>
                                <span class="room-capacity">Sleeps 5</span>
                            </div>
                            <p class="room-description">
                                Experience contemporary comfort and breathtaking views overlooking the Gulf in this Suite.
                            </p>
                            <div class="room-actions">
                                <button class="view-details-btn">View Details</button>
                                <button class="check-availability-btn">Check Availability</button>
                            </div>
                        </div>
                        <div class="room-pricing">
                            <div class="price-info">
                                <span class="starting-from">Starting from</span>
                                <span class="price">₱25,000</span>
                                <span class="per-night">Daily 2 room available</span>
                            </div>
                        </div>
                    </div>
					
                    <!-- Add other static rooms here, incase na gusto nyo pa  -->
                    <?php endif; ?>
                </div>

                <div class="booking-sidebar">
                    <div class="your-stay-card">
                        <h3>Your Stay</h3>
                        <div class="stay-details" id="booking-summary">
                            <?php if ($bookingData): ?>
                            <!-- (5) Display dynamic booking data from database/session -->
                            <div class="stay-item">
                                <span class="item-name"><?php echo htmlspecialchars($bookingData['room_name']); ?></span>
                                <span class="item-quantity">x<?php echo $bookingData['quantity']; ?></span>
                            </div>
                            <div class="stay-dates">
                                <span>Breakfast Included</span>
                                <span class="date-badge"><?php echo $bookingData['breakfast'] ? 'Yes' : 'No'; ?></span>
                            </div>
                            <div class="stay-dates">
                                <span>📅 <?php echo date('d M Y', strtotime($bookingData['checkin_date'])); ?> - <?php echo date('d M Y', strtotime($bookingData['checkout_date'])); ?></span>
                            </div>
                            <div class="stay-guests">
                                <span>👤 <?php echo $bookingData['adults']; ?> Adults<?php echo $bookingData['children'] > 0 ? ', ' . $bookingData['children'] . ' Child' . ($bookingData['children'] > 1 ? 'ren' : '') : ''; ?></span>
                            </div>
                            <div class="total-section">
                                <div class="total-price">
                                    <span class="total-label">Total:</span>
                                    <span class="total-amount">PHP <?php echo number_format($bookingData['total_price']); ?></span>
                                </div>
                            </div>
                            <?php else: ?>
                            <!-- Default content when no booking data -->
                            <div class="stay-item">
                                <span class="item-name">No room selected</span>
                                <span class="item-quantity">x0</span>
                            </div>
                            <div class="stay-dates">
                                <span>Breakfast Included</span>
                                <span class="date-badge">No</span>
                            </div>
                            <div class="stay-dates">
                                <span>📅 Select dates</span>
                            </div>
                            <div class="stay-guests">
                                <span>👤 Select guests</span>
                            </div>
                            <div class="total-section">
                                <div class="total-price">
                                    <span class="total-label">Total:</span>
                                    <span class="total-amount">PHP 0</span>
                                </div>
                            </div>
                            <?php endif; ?>
                            
                            <div class="guarantee-section">
                                <h4>Best Price Guarantee</h4>
                                <p>We guarantee you won't find a better price for these dates and room type. If you find a lower price, we'll match it and give you our best publicly available rate.</p>
                            </div>
                            <button class="continue-payment-btn">Continue to Payment →</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Room Selection Modal -->
    <div id="roomModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Select Your Preferred Room(s):</h3>
                <span class="close-modal">&times;</span>
            </div>
            <div class="modal-body">
                <div class="room-quantity-section">
                    <label>Room Quantity:</label>
                    <div class="quantity-controls">
                        <button type="button" class="quantity-btn" id="decrease-qty">-</button>
                        <span id="room-quantity">1</span>
                        <button type="button" class="quantity-btn" id="increase-qty">+</button>
                    </div>
                </div>

                <div class="room-preferences">
                    <h4>Select Your Preferred Room(s):</h4>
                    <p>Note that when each check indicates to 1 room equivalent.</p>
                    
                    <div class="preference-options">
                        <?php 
                        // (6) Generate room preferences from database
                        if ($rooms):
                            foreach ($rooms as $room):
                        ?>
                        <label class="preference-item">
                            <input type="checkbox" name="room-preference" value="<?php echo $room['id']; ?>">
                            <span><?php echo htmlspecialchars($room['room_name']); ?></span>
                        </label>
                        <?php 
                            endforeach;
                        else:
                        ?>
                        <!-- Fallback static options -->
                        <label class="preference-item">
                            <input type="checkbox" name="room-preference" value="solo-nook">
                            <span>Solo Nook</span>
                        </label>
                        <label class="preference-item">
                            <input type="checkbox" name="room-preference" value="twin-horizon">
                            <span>Twin Horizon</span>
                        </label>
                        <label class="preference-item">
                            <input type="checkbox" name="room-preference" value="queen-serenity">
                            <span>Queen Serenity</span>
                        </label>
                        <label class="preference-item">
                            <input type="checkbox" name="room-preference" value="signature-king">
                            <span>Signature King</span>
                        </label>
                        <label class="preference-item">
                            <input type="checkbox" name="room-preference" value="courtyard-haven" checked>
                            <span>Courtyard Haven</span>
                        </label>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="room-details-section" id="room-details-container">
                    <!-- Room details will be dynamically generated by JavaScript -->
                </div>

                <div class="modal-footer">
                    <button class="confirm-btn" type="button">Confirm</button>
                </div>
            </div>
        </div>
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

    <script src="../assets/js/booking.js"></script>
</body>
</html>