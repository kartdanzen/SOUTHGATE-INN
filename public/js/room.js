document.addEventListener('DOMContentLoaded', function() {
    // Set up dynamic dates for check-in and check-out filters
    function setupDateFilters() {
        // Get current date
        const today = new Date();
        const checkoutDate = new Date(today);
        checkoutDate.setDate(today.getDate() + 3); // Default 3-day stay
        
        // Format date for input (YYYY-MM-DD)
        const formatInputDate = (date) => {
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        };
        
        // Set check-in to today
        const checkInFilter = document.getElementById('check-in-filter');
        if (checkInFilter) {
            checkInFilter.value = formatInputDate(today);
            checkInFilter.min = formatInputDate(today);

            // Add event listener to update check-out minimum date
            checkInFilter.addEventListener('change', function() {
                const checkInDate = new Date(this.value);
                const nextDay = new Date(checkInDate);
                nextDay.setDate(checkInDate.getDate() + 1);
                
                // Update minimum checkout date
                checkOutFilter.min = formatInputDate(nextDay);
                
                // If current checkout date is now invalid, update it
                if (new Date(checkOutFilter.value) <= checkInDate) {
                    checkOutFilter.value = formatInputDate(nextDay);
                }
            });
        }
        
        // Set check-out to today + 3 days
        const checkOutFilter = document.getElementById('check-out-filter');
        if (checkOutFilter) {
            checkOutFilter.value = formatInputDate(checkoutDate);
            
            // Set check-out minimum to tomorrow
            const tomorrow = new Date(today);
            tomorrow.setDate(today.getDate() + 1);
            checkOutFilter.min = formatInputDate(tomorrow);
        }
    }
    
    // Call the function to set up date filters
    setupDateFilters();
    
    // Terms and Conditions Modal Functionality
    const termsModal = document.querySelector('.terms-modal');
    const termsLinks = document.querySelectorAll('.terms-link');
    const termsCloseBtn = document.querySelector('.terms-close-btn');
    const termsAcceptBtn = document.querySelector('.terms-accept-btn');
    
    // Log whether elements were found
    console.log('Terms modal found:', termsModal ? 'Yes' : 'No');
    console.log('Terms links found:', termsLinks.length);
    console.log('Terms close button found:', termsCloseBtn ? 'Yes' : 'No');
    console.log('Terms accept button found:', termsAcceptBtn ? 'Yes' : 'No');
    
    // Open terms modal function
    function openTermsModal() {
        if (!termsModal) {
            console.error('Terms modal element not found');
            return;
        }
        
        console.log('Opening terms modal');
        termsModal.style.display = 'flex';
        
        // Force reflow before adding active class for smooth animation
        void termsModal.offsetWidth;
        
        termsModal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    
    // Close terms modal function
    function closeTermsModal() {
        if (!termsModal) return;
        
        console.log('Closing terms modal');
        termsModal.classList.remove('active');
        
        // Wait for animation to complete before hiding
        setTimeout(() => {
            if (!termsModal.classList.contains('active')) {
                termsModal.style.display = 'none';
            }
            document.body.style.overflow = '';
        }, 300);
    }
    
    // Make functions globally available
    window.openTermsModal = openTermsModal;
    window.closeTermsModal = closeTermsModal;
    
    // Add click event listeners to all terms links
    termsLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            console.log('Terms link clicked');
            openTermsModal();
        });
    });
    
    // Close button functionality
    if (termsCloseBtn) {
        termsCloseBtn.addEventListener('click', function(e) {
            e.preventDefault();
            closeTermsModal();
        });
    }
    
    // Accept button functionality
    if (termsAcceptBtn) {
        termsAcceptBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Check the terms checkbox
            const termsCheckbox = document.querySelector('input[name="terms_agreement"]');
            if (termsCheckbox) {
                termsCheckbox.checked = true;
                console.log('Terms checkbox checked');
            }
            
            closeTermsModal();
        });
    }
    
    // Close when clicking outside modal content
    if (termsModal) {
        termsModal.addEventListener('click', function(e) {
            if (e.target === termsModal) {
                closeTermsModal();
            }
        });
    }
    
    // Handle Search Availability button click
    const applyFiltersBtn = document.getElementById('apply-filters');
    if (applyFiltersBtn) {
         applyFiltersBtn.addEventListener('click', function() {
            // Get filter values
            const checkInDate = document.getElementById('check-in-filter').value;
            const checkOutDate = document.getElementById('check-out-filter').value;
            const guestsCount = document.getElementById('guests-filter').value;
            
            // Calculate date difference
            const startDate = new Date(checkInDate);
            const endDate = new Date(checkOutDate);
            const duration = Math.floor((endDate - startDate) / (1000 * 60 * 60 * 24));
            
            // For now, just scroll to room listings and highlight them
            const roomGrid = document.querySelector('.room-grid');
            if (roomGrid) {
                roomGrid.scrollIntoView({ behavior: 'smooth' });
                roomGrid.classList.add('highlight');
                setTimeout(() => {
                    roomGrid.classList.remove('highlight');
                }, 1000);
            }
            
            // Optional: Filter rooms based on guest count
            const roomCards = document.querySelectorAll('.room-card');
            roomCards.forEach(card => {
                const roomCapacity = parseInt(card.querySelector('.feature:first-child').textContent.match(/\d+/)[0]);
                if (roomCapacity < parseInt(guestsCount)) {
                    card.style.opacity = '0.5';
                } else {
                    card.style.opacity = '1';
                }
            });
            
            console.log(`Searching rooms for ${guestsCount} guests from ${checkInDate} to ${checkOutDate} (${duration} nights)`);
        });
    }
    
    // Check URL parameters for booking info
    function checkURLParameters() {
        const params = new URLSearchParams(window.location.search);
        const autoOpen = params.get('autoOpen');
        
        if (autoOpen === 'true') {
            const roomType = params.get('roomType');
            const checkIn = params.get('checkIn');
            const checkOut = params.get('checkOut');
            const nightlyPrice = params.get('nightlyPrice');
            const totalPrice = params.get('totalPrice');
            const duration = params.get('duration');
            const imageUrl = params.get('image');
            
            // If we have all required parameters
            if (roomType && checkIn && checkOut) {
                // Parse dates
                const checkInDate = new Date(checkIn);
                const checkOutDate = new Date(checkOut);
                
                // Calculate or use provided duration
                let stayDuration = 3; // Default
                if (duration) {
                    // Extract numeric value from duration (e.g., "3 Nights" -> 3)
                    stayDuration = parseInt(duration.match(/\d+/)[0]) || 3;
                } else if (checkInDate && checkOutDate && !isNaN(checkInDate) && !isNaN(checkOutDate)) {
                    stayDuration = Math.floor((checkOutDate - checkInDate) / (1000 * 60 * 60 * 24));
                }
                
                // Use nightly price if available, otherwise calculate from total
                let perNightPrice;
                if (nightlyPrice) {
                    perNightPrice = nightlyPrice;
                } else if (totalPrice && stayDuration > 0) {
                    perNightPrice = Math.round(parseInt(totalPrice) / stayDuration);
                } else {
                    // Fallback to a default price if all else fails
                    perNightPrice = '2000';
                }
                
                // Prepare room data with the per-night price
                const roomData = {
                    name: roomType,
                    price: '₱' + perNightPrice + '/night',
                    image: imageUrl
                };
                
                // Show booking modal with a slight delay to ensure DOM is fully loaded
                setTimeout(() => {
                    showRoomModal(roomData, checkInDate, checkOutDate, stayDuration);
                    
                    // Clear URL parameters after opening the modal to prevent reopening on refresh
                    const cleanURL = window.location.pathname;
                    window.history.replaceState({}, document.title, cleanURL);
                }, 500);
            }
        }
    }
    
    // Booking Modal Variables
    const bookingModal = document.querySelector('.booking-modal');
    const bookingOverlay = document.querySelector('.booking-overlay');
    const bookingCloseBtn = document.querySelector('.booking-close-btn');
    const bookingForm = document.getElementById('booking-form');
    const confirmationPopup = document.querySelector('.confirmation-popup');
    const confirmationCloseBtn = document.querySelector('.confirmation-close-btn');
    const bookingBackBtn = document.querySelector('.booking-back-btn');
    
    // Booking details spans
    const bookingRoomType = document.querySelector('.booking-room-type');
    const bookingCheckin = document.querySelector('.booking-checkin');
    const bookingCheckout = document.querySelector('.booking-checkout');
    const bookingPrice = document.querySelector('.booking-price');
    const bookingNights = document.querySelector('.booking-nights');
    const bookingTotal = document.querySelector('.booking-total');
    
    // Confirmation details spans
    const confirmRoom = document.querySelector('.confirm-room');
    const confirmCheckin = document.querySelector('.confirm-checkin');
    const confirmCheckout = document.querySelector('.confirm-checkout');
    const confirmPrice = document.querySelector('.confirm-price');
    
    // Form input elements - moved up to avoid reference before declaration
    const firstNameInput = document.getElementById('guest-first-name');
    const lastNameInput = document.getElementById('guest-last-name');
    const phoneInput = document.getElementById('guest-phone');
    
    // Format date for display
    function formatDate(dateString) {
        const options = { year: 'numeric', month: 'long', day: 'numeric' };
        const date = new Date(dateString);
        return date.toLocaleDateString('en-US', options);
    }
    
    // Show Room Modal Function
    function showRoomModal(roomData, checkIn, checkOut, duration) {
        // Update modal content
        document.querySelector('.booking-room-type').textContent = roomData.name;
        document.querySelector('.booking-price').textContent = roomData.price;
        document.getElementById('booking-room-type').value = roomData.name;
        
        // Set the modal image if available
        const modalImage = document.getElementById('booking-preview-image');
        if (modalImage && roomData.image) {
            modalImage.src = roomData.image;
        }
        
        // Set check-in and check-out dates
        document.querySelector('.booking-checkin').textContent = formatDate(checkIn);
        document.querySelector('.booking-checkout').textContent = formatDate(checkOut);
        
        // Calculate and set total
        const priceValue = parseInt(roomData.price.replace(/[^\d]/g, ''));
        const total = priceValue * duration;
        document.querySelector('.booking-nights').textContent = duration;
        document.querySelector('.booking-total').textContent = `₱${total.toLocaleString()}`;
        
        // Set the price values in the hidden inputs
        document.getElementById('booking-room-price').value = priceValue;
        document.getElementById('booking-total-price').value = total;
        
        // Show the modal
        bookingModal.classList.add('active');
        document.body.classList.add('menu-open');
        bookingOverlay.style.display = 'block';
        
        // Save room data for booking
        window.currentBooking = {
            room: roomData.name,
            image: roomData.image,
            checkIn: checkIn,
            checkOut: checkOut,
            price: priceValue, // Store the numeric price value
            duration: duration,
            total: total
        };
        
        // Format the phone input field
        if (phoneInput) {
            setupPhoneInput();
        }
    }
    
    // Setup Philippine phone number input field
    function setupPhoneInput() {
        phoneInput.addEventListener('input', function() {
            // Remove non-numeric characters
            let value = this.value.replace(/\D/g, '');
            
            // Check if already starts with 0 or 9, adjust accordingly
            if (value.startsWith('0')) {
                value = value.substring(1);
            } else if (value.startsWith('63')) {
                value = value.substring(2);
            }
            
            // Format the phone number with spaces: 9XX XXX XXXX
            if (value.length > 0) {
                if (value.length <= 3) {
                    this.value = value;
                } else if (value.length <= 6) {
                    this.value = value.substring(0, 3) + ' ' + value.substring(3);
                } else {
                    this.value = value.substring(0, 3) + ' ' + value.substring(3, 6) + ' ' + value.substring(6, 10);
                }
            } else {
                this.value = '';
            }
        });
    }
    
    // Close Booking Modal Function
    function closeBookingModal() {
        bookingModal.classList.remove('active');
        document.body.classList.remove('menu-open');
        bookingOverlay.style.display = 'none';
        
        // Reset form if needed
        if (bookingForm) {
            bookingForm.reset();
        }
    }
        
    // Close confirmation function
    function closeConfirmation() {
        confirmationPopup.classList.remove('active');
        document.body.classList.remove('menu-open');
        bookingOverlay.style.display = 'none';
        
        // Reset the booking form to clear previous data
        if (bookingForm) {
            bookingForm.reset();
        }
        
        // Reset currentBooking data
        window.currentBooking = null;
    }
    
    // Add input validation for name fields
    function validateNameInput(e) {
        this.value = this.value.replace(/[^A-Za-z\s]/g, '');
    }
    
    if (firstNameInput) {
        firstNameInput.addEventListener('input', validateNameInput);
    }
    
    if (lastNameInput) {
        lastNameInput.addEventListener('input', validateNameInput);
    }
    
    // Handle room selection
    document.querySelectorAll('.select-room-btn').forEach(button => {
        button.addEventListener('click', function() {
            const roomType = this.dataset.roomType;
            const price = this.dataset.price;
            const image = this.dataset.image;
            
            // Get current filter values
            const checkIn = document.getElementById('check-in-filter').value;
            const checkOut = document.getElementById('check-out-filter').value;
            
            // Calculate duration
            const startDate = new Date(checkIn);
            const endDate = new Date(checkOut);
            const duration = Math.floor((endDate - startDate) / (1000 * 60 * 60 * 24));
            
            // Show booking modal
            showRoomModal({
                name: roomType,
                price: '₱' + price + '/night',
                image: image
            }, startDate, endDate, duration);
        });
    });
    
    // Handle form submission
    bookingForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Ensure hidden inputs are set
        document.getElementById('booking-room-type').value = window.currentBooking.room;
        document.getElementById('booking-room-price').value = window.currentBooking.price;
        document.getElementById('booking-total-price').value = window.currentBooking.total;

        // Get check-in and check-out dates from the filter inputs
        const checkIn = document.getElementById('check-in-filter').value;
        const checkOut = document.getElementById('check-out-filter').value;

        // Update hidden form fields
        document.getElementById('booking-check-in').value = checkIn;
        document.getElementById('booking-check-out').value = checkOut;

        // Create form data
        const formData = new FormData(this);
        
        // Log the form data for debugging
        console.log('Submitting form with data:', {
            room_type: document.getElementById('booking-room-type').value,
            room_price: document.getElementById('booking-room-price').value,
            total_price: document.getElementById('booking-total-price').value,
            check_in: document.getElementById('booking-check-in').value,
            check_out: document.getElementById('booking-check-out').value
        });

        // Submit form using fetch
        fetch(this.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            if (!response.ok) {
                return response.text().then(text => {
                    console.error('Error response:', text);
                    throw new Error('Network response was not ok');
                });
            }
            return response.json();
        })
        .then(data => {
            console.log('Response data:', data);
            if (data.status === 'success') {
                // Update confirmation popup
                document.querySelector('.booking-id').textContent = 'Booking ID: ' + data.booking_id;
                document.querySelector('.confirm-room').textContent = data.booking_details.room_type;
                document.querySelector('.confirm-checkin').textContent = data.booking_details.check_in;
                document.querySelector('.confirm-checkout').textContent = data.booking_details.check_out;
                document.querySelector('.confirm-price').textContent = data.booking_details.price;
            
                // Hide booking modal and show confirmation
                bookingModal.classList.remove('active');
                confirmationPopup.classList.add('active');
            } else {
                // Handle validation errors
                console.error('Validation errors:', data.errors);
                const errors = data.errors;
                Object.keys(errors).forEach(field => {
                    const input = document.querySelector(`[name="${field}"]`);
                    if (input) {
                        input.classList.add('error');
                        const errorMessage = document.createElement('span');
                        errorMessage.className = 'error-message';
                        errorMessage.textContent = errors[field][0];
                        input.parentNode.appendChild(errorMessage);
                    }
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while processing your booking. Please try again. Error: ' + error.message);
        });
    });
    
    // Close buttons functionality
    // Remove the existing direct event listeners that might interfere with our cleanly defined functions
    const bookingCloseButton = document.querySelector('.booking-close-btn');
    const confirmationCloseButton = document.querySelector('.confirmation-close-btn');
    const secondaryButton = document.querySelector('.confirmation-btn.secondary-btn');
    
    if (bookingCloseButton) {
        // Remove any existing listeners
        const newBookingCloseBtn = bookingCloseButton.cloneNode(true);
        bookingCloseButton.parentNode.replaceChild(newBookingCloseBtn, bookingCloseButton);
        
        // Add our clean listener
        newBookingCloseBtn.addEventListener('click', closeBookingModal);
    }
    
    if (confirmationCloseButton) {
        // Remove any existing listeners
        const newConfirmCloseBtn = confirmationCloseButton.cloneNode(true);
        confirmationCloseButton.parentNode.replaceChild(newConfirmCloseBtn, confirmationCloseButton);
        
        // Add our clean listener
        newConfirmCloseBtn.addEventListener('click', closeConfirmation);
    }
    
    if (secondaryButton) {
        // Remove any existing listeners
        const newSecondaryBtn = secondaryButton.cloneNode(true);
        secondaryButton.parentNode.replaceChild(newSecondaryBtn, secondaryButton);
        
        // Add our clean listener
        newSecondaryBtn.addEventListener('click', closeConfirmation);
    }
    
    // Back button functionality
    const backButton = document.querySelector('.booking-back-btn');
    if (backButton) {
        // Remove any existing listeners
        const newBackBtn = backButton.cloneNode(true);
        backButton.parentNode.replaceChild(newBackBtn, backButton);
        
        // Add our clean listener
        newBackBtn.addEventListener('click', closeBookingModal);
    }
    
    // Clear error messages when input changes
    if (bookingForm) {
        const inputs = bookingForm.querySelectorAll('input, textarea');
        inputs.forEach(input => {
            input.addEventListener('input', function() {
                this.classList.remove('error');
                const errorMessage = this.parentNode.querySelector('.error-message');
                if (errorMessage) {
                    errorMessage.remove();
                }
            });
        });
    }
    
    // Initialize: check URL parameters
    checkURLParameters();
});

