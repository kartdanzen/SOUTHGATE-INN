// Event Booking Functions
document.addEventListener('DOMContentLoaded', function() {
    // Utility Functions for Date Formatting
    const formatDate = (date) => {
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    };

    // Event data
    const eventData = {
        wedding: {
            title: 'Wedding Celebrations',
            price: 'Starting at ₱75,000',
            description: 'Create magical memories with our comprehensive wedding packages, including venue decoration, gourmet catering, and dedicated wedding coordinator to handle every detail. Our venue offers a beautiful backdrop for your special day with both indoor and outdoor spaces available.',
            image: 'images/wedding.jpg',
            features: [
                'Venue rental (6 hours)',
                'Professional event coordinator',
                'Basic decoration setup',
                'Sound system and lighting',
                'Customizable food and beverage',
                'Waitstaff and security',
                'Cleanup services',
                'Free parking'
            ]
        },
        birthday: {
            title: 'Birthday Celebrations',
            price: 'Starting at ₱25,000',
            description: 'Celebrate another year of life with our birthday packages, including themed decorations, custom cake, and personalized menu options for all your guests. We offer spaces for both intimate gatherings and large parties.',
            image: 'images/birthday.jpg',
            features: [
                'Venue rental (4 hours)',
                'Basic decoration setup',
                'Sound system',
                'Customizable menu options',
                'Birthday cake',
                'Waitstaff',
                'Cleanup services',
                'Free parking'
            ]
        },
        corporate: {
            title: 'Corporate Events',
            price: 'Starting at ₱35,000',
            description: 'Host professional business meetings and conferences with state-of-the-art facilities, premium catering options, and dedicated technical support. Our venues are equipped with the latest technology to ensure your event runs smoothly.',
            image: 'images/corporate.jpg',
            features: [
                'Venue rental (8 hours)',
                'Projector and screen',
                'Wi-Fi access',
                'Sound system',
                'Podium and microphone',
                'Customizable catering options',
                'Technical support',
                'Free parking'
            ]
        },
        reunion: {
            title: 'Family Reunions',
            price: 'Starting at ₱40,000',
            description: 'Reconnect with your loved ones in our spacious venues with customizable catering options and special accommodation packages for out-of-town guests. Our spaces are perfect for family gatherings, class reunions, and more.',
            image: 'images/reunion.jpg',
            features: [
                'Venue rental (5 hours)',
                'Basic decoration setup',
                'Sound system',
                'Customizable catering options',
                'Waitstaff',
                'Cleanup services',
                'Special accommodation rates',
                'Free parking'
            ]
        }
    };
    
    // Function to open event details popup
    window.openEventDetails = function(eventType) {
        const eventDetailsPopup = document.getElementById('event-details-popup');
        const eventDetailsImage = document.getElementById('event-details-image');
        const eventDetailsTitle = document.getElementById('event-details-title');
        const eventDetailsPrice = document.getElementById('event-details-price');
        const eventDetailsDescription = document.getElementById('event-details-description');
        const eventDetailsFeatures = document.getElementById('event-details-features');
        const eventDetailsBook = document.getElementById('event-details-book');
        
        const event = eventData[eventType];
        if (!event) {
            console.error("Event data not found for:", eventType);
            return;
        }
        
        // Set popup content
        eventDetailsImage.src = event.image;
        eventDetailsImage.alt = event.title;
        eventDetailsTitle.textContent = event.title;
        eventDetailsPrice.textContent = event.price;
        eventDetailsDescription.textContent = event.description;
        
        // Features 
        eventDetailsFeatures.innerHTML = '';
        event.features.forEach(feature => {
            const featureDiv = document.createElement('div');
            featureDiv.className = 'event-details-feature';
            featureDiv.innerHTML = `<i class="fas fa-check-circle"></i> ${feature}`;
            eventDetailsFeatures.appendChild(featureDiv);
        });
        
        // Update book button and open popup
        eventDetailsBook.setAttribute('data-event', eventType);
        eventDetailsPopup.classList.add('active');
        document.body.classList.add('menu-open');
    };
    
    // Setup event details close functionality
    const eventDetailsPopup = document.getElementById('event-details-popup');
    const eventDetailsClose = document.getElementById('event-details-close');
    const eventDetailsBook  = document.getElementById('event-details-book');
    
    if (eventDetailsClose) {
        eventDetailsClose.addEventListener('click', function() {
            eventDetailsPopup.classList.remove('active');
            document.body.classList.remove('menu-open');
        });
    }
    
    if (eventDetailsPopup) {
        eventDetailsPopup.addEventListener('click', function(e) {
            if (e.target === eventDetailsPopup) {
                eventDetailsPopup.classList.remove('active');
                document.body.classList.remove('menu-open');
            }
        });
    }
    
    if (eventDetailsBook) {
        eventDetailsBook.addEventListener('click', function() {
            const eventType = this.getAttribute('data-event');
            console.log("Book button clicked with eventType:", eventType);
            
            // Get event details for confirmation popup
            const eventTitle = document.getElementById('event-details-title').textContent;
            const eventPrice = document.getElementById('event-details-price').textContent;
            
            // Set values in the confirmation popup
            document.getElementById('confirm-event-type-value').textContent = eventTitle;
            document.getElementById('confirm-event-price-value').textContent = eventPrice;
            
            // Map event type to valid value for the event.html dropdown
            let mappedEventType = eventType;
            if (eventType === 'Wedding' || eventTitle.includes('Wedding')) mappedEventType = 'wedding';
            else if (eventType === 'Birthday' || eventTitle.includes('Birthday')) mappedEventType = 'birthday';
            else if (eventType === 'Corporate' || eventTitle.includes('Corporate')) mappedEventType = 'corporate';
            else if (eventType === 'Reunion' || eventTitle.includes('Reunion')) mappedEventType = 'reunion';
            else mappedEventType = 'other';
            
            console.log("Mapped eventType:", mappedEventType);
            
            // Store event type data for later use
            document.getElementById('proceed-booking-btn').setAttribute('data-event', mappedEventType);
            
            // Close event details popup
            eventDetailsPopup.classList.remove('active');
            
            // Show confirmation popup with delay for clear display
            setTimeout(() => {
                document.getElementById('event-booking-confirmation').classList.add('active');
                document.body.classList.add('menu-open');
            }, 300);
        });
    }
    
    // Handle confirmation popup actions
    const proceedBookingBtn = document.getElementById('proceed-booking-btn');
    const cancelBookingBtn = document.getElementById('cancel-booking-btn');
    const closeBookingBtn = document.getElementById('event-booking-close');
    const eventBookingConfirmation = document.getElementById('event-booking-confirmation');
    
    if (proceedBookingBtn) {
        proceedBookingBtn.addEventListener('click', function() {
            const eventType = this.getAttribute('data-event');
            console.log("Proceeding with event type:", eventType);
            
            // Make sure eventType is one of the valid options in the event dropdown
            // Valid options are: wedding, birthday, corporate, reunion, other
            const validEventType = ['wedding', 'birthday', 'corporate', 'reunion', 'other'].includes(eventType) 
                ? eventType 
                : 'other';
            
            console.log("Using eventType:", validEventType);
            
            // Redirect to the Laravel event route with the event type as a parameter
            window.location.href = `/event?eventType=${validEventType}#booking-form`;
        });
    }
    
    if (cancelBookingBtn) {
        cancelBookingBtn.addEventListener('click', function() {
            eventBookingConfirmation.classList.remove('active');
            document.body.classList.remove('menu-open');
        });
    }
    
    if (closeBookingBtn) {
        closeBookingBtn.addEventListener('click', function() {
            eventBookingConfirmation.classList.remove('active');
            document.body.classList.remove('menu-open');
        });
    }
    
    // Close confirmation popup when clicking outside of it
    if (eventBookingConfirmation) {
        eventBookingConfirmation.addEventListener('click', function(e) {
            if (e.target === eventBookingConfirmation) {
                eventBookingConfirmation.classList.remove('active');
                document.body.classList.remove('menu-open');
            }
        });
    }
    
    // Parse URL parameters to handle event-specific links
    function handleEventURLParameters() {
        const params = new URLSearchParams(window.location.search);
        const eventType = params.get('eventType');
        
        if (eventType && eventData[eventType]) {
            // Wait for DOM to be ready
            setTimeout(() => {
                openEventDetails(eventType);
            }, 500);
        }
    }
    
    // Check for event parameters when page loads
    handleEventURLParameters();
    
    // Add click handlers for event cards
    const eventCards = document.querySelectorAll('.event-card .view-event-btn');
    eventCards.forEach(card => {
        card.addEventListener('click', function(e) {
            e.preventDefault();
            const eventType = this.getAttribute('data-event');
            if (eventType && eventData[eventType]) {
                openEventDetails(eventType);
            }
        });
    });
});
