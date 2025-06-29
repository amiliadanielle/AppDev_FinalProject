// booking.js

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
    const room2Details = document.getElementById('room2-details');
    
    let currentQuantity = 1;
    
    // Open modal when "Check Availability" is clicked
    checkAvailabilityBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            modal.style.display = 'block';
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
    
    // Quantity controls
    decreaseBtn.addEventListener('click', function() {
        if (currentQuantity > 1) {
            currentQuantity--;
            quantityDisplay.textContent = currentQuantity;
            updateRoomDetails();
        }
    });
    
    increaseBtn.addEventListener('click', function() {
        if (currentQuantity < 5) { // Maximum 5 rooms
            currentQuantity++;
            quantityDisplay.textContent = currentQuantity;
            updateRoomDetails();
        }
    });
    
    // Update room details based on quantity
    function updateRoomDetails() {
        if (currentQuantity >= 2) {
            room2Details.style.display = 'block';
        } else {
            room2Details.style.display = 'none';
        }
        
        // Add more room detail sections if needed
        // This can be extended for more than 2 rooms
    }
    
    // Confirm button
    confirmBtn.addEventListener('click', function() {
        // Get selected preferences
        const selectedPreferences = [];
        const preferenceCheckboxes = document.querySelectorAll('input[name="room-preference"]:checked');
        preferenceCheckboxes.forEach(checkbox => {
            selectedPreferences.push(checkbox.value);
        });
        
        // Get breakfast options
        const breakfast1 = document.querySelector('input[name="breakfast1"]:checked')?.value;
        const breakfast2 = document.querySelector('input[name="breakfast2"]:checked')?.value;
        
        // Get special requests
        const specialRequests = document.querySelectorAll('.special-requests textarea');
        const requests = Array.from(specialRequests).map(textarea => textarea.value);
        
        // Here you would typically send this data to the server
        console.log('Booking Details:', {
            quantity: currentQuantity,
            preferences: selectedPreferences,
            breakfast: [breakfast1, breakfast2],
            specialRequests: requests
        });
        
        // For now, just close the modal and show a success message
        modal.style.display = 'none';
        alert('Room preferences saved! Continue to payment.');
    });
    
    // Set today's date as minimum for date input
    const checkinDate = document.getElementById('checkin-date');
    if (checkinDate) {
        const today = new Date().toISOString().split('T')[0];
        checkinDate.min = today;
        checkinDate.value = today;
    }
    
    // Handle guest selection
    const guestsSelect = document.getElementById('guests');
    if (guestsSelect) {
        guestsSelect.addEventListener('change', function() {
            console.log('Guests selected:', this.value);
        });
    }
    
    // Handle book now button
    const bookNowBtn = document.querySelector('.book-now-btn');
    if (bookNowBtn) {
        bookNowBtn.addEventListener('click', function() {
            const checkinValue = checkinDate?.value;
            const guestsValue = guestsSelect?.value;
            
            if (!checkinValue || !guestsValue) {
                alert('Please select check-in date and number of guests.');
                return;
            }
            
            // Scroll to room selection or handle booking logic
            document.querySelector('.booking-main').scrollIntoView({ 
                behavior: 'smooth' 
            });
        });
    }
    
    // Handle continue to payment button
    const continuePaymentBtn = document.querySelector('.continue-payment-btn');
    if (continuePaymentBtn) {
        continuePaymentBtn.addEventListener('click', function() {
            // Here you would redirect to payment page
            alert('Redirecting to payment page...');
            // window.location.href = 'payment.php';
        });
    }
    
    // Handle view details buttons
    const viewDetailsBtns = document.querySelectorAll('.view-details-btn');
    viewDetailsBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Here you would show room details
            alert('Room details would be displayed here.');
        });
    });
    
    // Handle filter changes
    const viewFilter = document.getElementById('view-filter');
    const sortFilter = document.getElementById('sort-filter');
    
    if (viewFilter) {
        viewFilter.addEventListener('change', function() {
            console.log('View filter changed to:', this.value);
            // Here you would filter the rooms
        });
    }
    
    if (sortFilter) {
        sortFilter.addEventListener('change', function() {
            console.log('Sort filter changed to:', this.value);
            // Here you would sort the rooms
        });
    }
    
    // Smooth scrolling for navigation links
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
    
    // Update sidebar totals (placeholder functionality)
    function updateSidebarTotals() {
        // This would calculate and update the booking totals
        // based on selected rooms, dates, and preferences
        console.log('Updating sidebar totals...');
    }
    
    // Initialize any default values
    updateRoomDetails();
});