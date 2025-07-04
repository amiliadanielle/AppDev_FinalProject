document.addEventListener('DOMContentLoaded', function() {
    // Modal elements
    const modal = document.getElementById('roomModal');
    const closeModal = document.querySelector('.close-modal');
    const confirmBtn = document.querySelector('.confirm-btn');
    const checkAvailabilityBtns = document.querySelectorAll('.check-availability-btn');

    // Quantity controls
    const decreaseBtn = document.getElementById('decrease-qty');
    const increaseBtn = document.getElementById('increase-qty');
    const quantityDisplay = document.getElementById('room-quantity');
    
    // Room details container
    const roomDetailsContainer = document.getElementById('room-details-container');
    
    // Filter elements
    const viewFilter = document.getElementById('view-filter');
    const sortFilter = document.getElementById('sort-filter');
    const roomsContainer = document.getElementById('rooms-container');

    let currentQuantity = 1;
    let selectedRooms = [];

    // Navbar scroll effect
    window.addEventListener('scroll', function() {
        const navbar = document.getElementById('navbar');
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });

    // View by filter functionality
    if (viewFilter) {
        viewFilter.addEventListener('change', function() {
            const filterValue = this.value;
            const roomCards = document.querySelectorAll('.room-card');

            roomCards.forEach(card => {
                const roomType = card.getAttribute('data-room-type');
                
                if (filterValue === 'all') {
                    card.classList.remove('hidden');
                } else if (filterValue === 'rooms' && roomType === 'room') {
                    card.classList.remove('hidden');
                } else if (filterValue === 'suites' && roomType === 'suite') {
                    card.classList.remove('hidden');
                } else {
                    card.classList.add('hidden');
                }
            });
        });
    }

    // Sort by filter functionality
    if (sortFilter) {
        sortFilter.addEventListener('change', function() {
            const sortValue = this.value;
            const roomCards = Array.from(document.querySelectorAll('.room-card'));
            
            roomCards.sort((a, b) => {
                switch (sortValue) {
                    case 'price-low':
                        return parseInt(a.getAttribute('data-price')) - parseInt(b.getAttribute('data-price'));
                    case 'price-high':
                        return parseInt(b.getAttribute('data-price')) - parseInt(a.getAttribute('data-price'));
                    case 'capacity':
                        return parseInt(a.getAttribute('data-capacity')) - parseInt(b.getAttribute('data-capacity'));
                    case 'recommended':
                    default:
                        return 0; // Keep original order for recommended
                }
            });

            // Re-append sorted elements
            roomCards.forEach(card => {
                roomsContainer.appendChild(card);
            });
        });
    }

    // Open modal when "Check Availability" is clicked
    checkAvailabilityBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            modal.style.display = 'block';
            updateRoomDetails();
        });
    });

    // Close modal
    closeModal.addEventListener('click', function() {
        modal.style.display = 'none';
    });

    // Close modal when clicking outside
    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });

    // Room quantity controls (it now supports more than 2 rooms, nays)
    decreaseBtn.addEventListener('click', function() {
        if (currentQuantity > 1) {
            currentQuantity--;
            quantityDisplay.textContent = currentQuantity;
            updateRoomDetails();
            updateQuantityButtons();
        }
    });

    increaseBtn.addEventListener('click', function() {
        if (currentQuantity < 10) { // Maximum 10 rooms (can be changed if u guys want to)
            currentQuantity++;
            quantityDisplay.textContent = currentQuantity;
            updateRoomDetails();
            updateQuantityButtons();
        }
    });

    // Updated da quantity button states
    function updateQuantityButtons() {
        decreaseBtn.disabled = currentQuantity <= 1;
        increaseBtn.disabled = currentQuantity >= 10;
    }

    // Dynamic room details generation for any quantity 
    function updateRoomDetails() {
        roomDetailsContainer.innerHTML = '';
        
        for (let i = 1; i <= currentQuantity; i++) {
            const roomDetailDiv = document.createElement('div');
            roomDetailDiv.className = 'room-detail-item';
            roomDetailDiv.innerHTML = `
                <h4>Room ${i}:</h4>
                <div class="breakfast-option">
                    <span>Breakfast Included:</span>
                    <label><input type="radio" name="breakfast${i}" value="yes" ${i === 1 ? 'checked' : ''}> Yes</label>
                    <label><input type="radio" name="breakfast${i}" value="no" ${i > 1 ? 'checked' : ''}> No</label>
                </div>
                <div class="special-requests">
                    <label>Special Requests/Notes:</label>
                    <textarea placeholder="e.g. extra bed" rows="3"></textarea>
                </div>
            `;
            roomDetailsContainer.appendChild(roomDetailDiv);
        }
    }

    // Confirm button with database integration
    confirmBtn.addEventListener('click', function() {
        // Get selected preferences
        const selectedPreferences = [];
        const preferenceCheckboxes = document.querySelectorAll('input[name="room-preference"]:checked');
        preferenceCheckboxes.forEach(checkbox => {
            selectedPreferences.push(checkbox.value);
        });

        // Get breakfast options for all rooms
        const breakfastOptions = [];
        for (let i = 1; i <= currentQuantity; i++) {
            const breakfast = document.querySelector(`input[name="breakfast${i}"]:checked`)?.value;
            breakfastOptions.push(breakfast);
        }

        // Get special requests for all rooms
        const specialRequests = [];
        const requestTextareas = document.querySelectorAll('.special-requests textarea');
        requestTextareas.forEach(textarea => {
            specialRequests.push(textarea.value);
        });

        const bookingData = {
            quantity: currentQuantity,
            preferences: selectedPreferences,
            breakfast: breakfastOptions,
            specialRequests: specialRequests,
            checkinDate: document.getElementById('checkin-date')?.value,
            guests: document.getElementById('guests')?.value
        };

        // (7) Send booking data to server via AJAX
		// pwede nyo baguhin tong part into pages/admin/ kayo na bahala (i just used api folder as an example)
		//Check that save_booking.php actually sets  $_SESSION['booking_data']  or your sidebar will always default to "No room selected"
        fetch('../api/save_booking.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(bookingData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateBookingSidebar(data.bookingDetails);
                modal.style.display = 'none';
                alert('Room preferences saved successfully!');
            } else {
                alert('Error saving booking preferences: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while saving your preferences.');
        });
    });

    // Dynamic sidebar update with database integration
    function updateBookingSidebar(bookingDetails) {
        const bookingSummary = document.getElementById('booking-summary');
        
        if (bookingDetails) {
            bookingSummary.innerHTML = `
                <div class="stay-item">
                    <span class="item-name">${bookingDetails.roomName}</span>
                    <span class="item-quantity">x${bookingDetails.quantity}</span>
                </div>
                <div class="stay-dates">
                    <span>Breakfast Included</span>
                    <span class="date-badge">${bookingDetails.breakfast ? 'Yes' : 'No'}</span>
                </div>
                <div class="stay-dates">
                    <span>📅 ${bookingDetails.checkinDate} - ${bookingDetails.checkoutDate}</span>
                </div>
                <div class="stay-guests">
                    <span>👤 ${bookingDetails.guests}</span>
                </div>
                <div class="total-section">
                    <div class="total-price">
                        <span class="total-label">Total:</span>
                        <span class="total-amount">PHP ${bookingDetails.totalPrice.toLocaleString()}</span>
                    </div>
                </div>
                <div class="guarantee-section">
                    <h4>Best Price Guarantee</h4>
                    <p>We guarantee you won't find a better price for these dates and room type. If you find a lower price, we'll match it and give you our best publicly available rate.</p>
                </div>
                <button class="continue-payment-btn">Continue to Payment →</button>
            `;
        }
    }

    // today's date as minimum
    const checkinDate = document.getElementById('checkin-date');
    if (checkinDate) {
        const today = new Date().toISOString().split('T')[0];
        checkinDate.min = today;
        checkinDate.value = today;
    }

    // handle guest selection
    const guestsSelect = document.getElementById('guests');
    if (guestsSelect) {
        guestsSelect.addEventListener('change', function() {
            console.log('Guests selected:', this.value);
            // (8) Update pricing based on guest count
            updatePricingBasedOnGuests(this.value);
        });
    }

    // handle book now button
    const bookNowBtn = document.querySelector('.book-now-btn');
    if (bookNowBtn) {
        bookNowBtn.addEventListener('click', function() {
            const checkinValue = checkinDate?.value;
            const guestsValue = guestsSelect?.value;

            if (!checkinValue || !guestsValue) {
                alert('Please select check-in date and number of guests.');
                return;
            }

            // scroll to booking section
            document.querySelector('.booking-main').scrollIntoView({ 
                behavior: 'smooth' 
            });
        });
    }

    // handle continue to payment
    const continuePaymentBtn = document.querySelector('.continue-payment-btn');
    if (continuePaymentBtn) {
        continuePaymentBtn.addEventListener('click', function() {
            // (9) Redirect to payment with booking data
            window.location.href = '../pages/payment.php';
        });
    }

    // handle view details buttons
    const viewDetailsBtns = document.querySelectorAll('.view-details-btn');
    viewDetailsBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const roomId = this.getAttribute('data-room-id');
            // (10) Fetch room details from database
            if (roomId) {
                window.location.href = `../pages/room-details.php?id=${roomId}`;
            } else {
                alert('Room details would be displayed here.');
            }
        });
    });

    // function to update pricing based on guests
    function updatePricingBasedOnGuests(guestCount) {
        // (11) Calculate dynamic pricing based on guest count
        // This would typically involve an AJAX call to get updated pricing
        console.log('Updating pricing for', guestCount, 'guests');
    }

    // smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Initialize
    updateQuantityButtons();
    updateRoomDetails();
});