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
                    <label>View by: Rooms</label>
                    <select id="view-filter">
                        <option value="rooms">Rooms</option>
                        <option value="suites">Suites</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label>Sort by: Recommended</label>
                    <select id="sort-filter">
                        <option value="recommended">Recommended</option>
                        <option value="price-low">Price: Low to High</option>
                        <option value="price-high">Price: High to Low</option>
                    </select>
                </div>
            </div>

            <div class="booking-content">
                <div class="rooms-section">
                    <!-- Room 1 -->
                    <div class="room-card">
                        <div class="room-image">
                            <img src="../assets/images/bed_temp.jpg" alt="Duplex One Bedroom Suite">
                        </div>
                        <div class="room-details">
                            <h3>Duplex One Bedroom Suite</h3>
                            <div class="room-info">
                                <span class="room-size">770 SQM</span>
                                <span class="room-capacity">Sleeps 4</span>
                            </div>
                            <p class="room-description">
                                Experience contemporary comfort and breathtaking views overlooking the Gulf in this generously sized 770 sqm Duplex Suite.
                            </p>
                            <div class="room-actions">
                                <button class="view-details-btn">View Details</button>
                                <button class="check-availability-btn">Check Availability</button>
                            </div>
                        </div>
                        <div class="room-pricing">
                            <div class="price-info">
                                <span class="starting-from">Starting from</span>
                                <span class="price">₱21,436</span>
                                <span class="per-night">Daily 2 room available</span>
                            </div>
                        </div>
                    </div>

                    <!-- Room 2 -->
                    <div class="room-card">
                        <div class="room-image">
                            <img src="../assets/images/bed_temp.jpg" alt="Duplex One Bedroom Suite">
                        </div>
                        <div class="room-details">
                            <h3>Duplex One Bedroom Suite</h3>
                            <div class="room-info">
                                <span class="room-size">770 SQM</span>
                                <span class="room-capacity">Sleeps 4</span>
                            </div>
                            <p class="room-description">
                                Experience contemporary comfort and breathtaking views overlooking the Gulf in this generously sized 770 sqm Duplex Suite.
                            </p>
                            <div class="room-actions">
                                <button class="view-details-btn">View Details</button>
                                <button class="check-availability-btn">Check Availability</button>
                            </div>
                        </div>
                        <div class="room-pricing">
                            <div class="price-info">
                                <span class="starting-from">Starting from</span>
                                <span class="price">₱21,436</span>
                                <span class="per-night">Daily 2 room available</span>
                            </div>
                        </div>
                    </div>

                    <!-- Additional room cards would go here -->
                </div>

                <div class="booking-sidebar">
                    <div class="your-stay-card">
                        <h3>Your Stay</h3>
                        <div class="stay-details">
                            <div class="stay-item">
                                <span class="item-name">Duplex One Bedroom Suite</span>
                                <span class="item-quantity">x2</span>
                            </div>
                            <div class="stay-dates">
                                <span>Breakfast Included</span>
                                <span class="date-badge">Yes</span>
                            </div>
                            <div class="stay-dates">
                                <span>📅 10 JULY 2025 - 03 JULY 2025</span>
                            </div>
                            <div class="stay-guests">
                                <span>👤 2 Adults, 1 Child</span>
                            </div>
                            <div class="total-section">
                                <div class="total-price">
                                    <span class="total-label">Total:</span>
                                    <span class="total-amount">PHP 22,489</span>
                                </div>
                            </div>
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
                        <label class="preference-item">
                            <input type="checkbox" name="room-preference" value="sea-breeze">
                            <span>Sea Breeze</span>
                        </label>
                        <label class="preference-item">
                            <input type="checkbox" name="room-preference" value="garden-escape">
                            <span>Garden Escape</span>
                        </label>
                        <label class="preference-item">
                            <input type="checkbox" name="room-preference" value="skyline-view">
                            <span>Skyline View</span>
                        </label>
                        <label class="preference-item">
                            <input type="checkbox" name="room-preference" value="sunset-heaven">
                            <span>Sunset Heaven</span>
                        </label>
                        <label class="preference-item">
                            <input type="checkbox" name="room-preference" value="poolside-retreat" checked>
                            <span>Poolside Retreat</span>
                        </label>
                    </div>
                </div>

                <div class="room-details-section">
                    <div class="room-detail-item">
                        <h4>Room 1:</h4>
                        <div class="breakfast-option">
                            <span>Breakfast Included:</span>
                            <label><input type="radio" name="breakfast1" value="yes" checked> Yes</label>
                            <label><input type="radio" name="breakfast1" value="no"> No</label>
                        </div>
                        <div class="special-requests">
                            <label>Special Requests/Notes:</label>
                            <textarea placeholder="e.g. extra bed" rows="3"></textarea>
                        </div>
                    </div>

                    <div class="room-detail-item" id="room2-details" style="display: none;">
                        <h4>Room 2:</h4>
                        <div class="breakfast-option">
                            <span>Breakfast Included:</span>
                            <label><input type="radio" name="breakfast2" value="yes"> Yes</label>
                            <label><input type="radio" name="breakfast2" value="no" checked> No</label>
                        </div>
                        <div class="special-requests">
                            <label>Special Requests/Notes:</label>
                            <textarea placeholder="e.g. extra bed" rows="3"></textarea>
                        </div>
                    </div>
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