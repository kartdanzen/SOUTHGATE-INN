<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Southgate Inn</title>
    <!--Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!--Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="icon" href="{{ asset('images/tab.png') }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- External CSS -->
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <!-- Header -->
    <header class="header">
        @include('nav')
    </header>
    <div class="menu-overlay"></div>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1 class="hero-title">Experience Luxury & Comfort</h1>
            <p class="hero-subtitle">Book your stay with us for an unforgettable experience in the heart of the city</p>
        </div>
    </section>

    <!-- Booking Widget -->
    <div class="booking-widget">
        <form action="{{ route('room.check-availability') }}" method="POST" id="booking-form" class="booking-form-container">
            @csrf
            <div class="booking-group">
                <label for="check-in" class="booking-label">Check-in Date</label>
                <input type="date" id="check-in" name="check_in" class="booking-input" value="2025-04-21">
            </div>

            <div class="booking-group">
                <label for="check-out" class="booking-label">Check-out Date</label>
                <input type="date" id="check-out" name="check_out" class="booking-input" value="2025-04-24">
            </div>

            <button type="submit" id="check-availability" class="booking-button">
                <i class="fas fa-search"></i> CHECK AVAILABILITY
            </button>
        </form>
    </div>

    <!-- Featured Rooms Section -->
    <section class="featured-section">
        <div class="section-container">
            <div class="section-header">
                <h2 class="section-title glow-effect">Featured Rooms</h2>
                <p class="section-subtitle">Experience luxury accommodations with our finest selection of rooms designed for your comfort and relaxation</p>
            </div>

            <div class="featured-grid">
                <!-- Room 1 -->
                <div class="featured-room">
                    <div class="room-image-container">
                        <div class="room-price-tag">₱2,400/night</div>
                        <img src="{{ asset('rooms/DELUXE ROOM.jpg') }}" alt="Deluxe Room">
                    </div>
                    <div class="room-details-container">
                        <h3 class="room-title">Deluxe Room</h3>
                        <p class="room-description">Spacious and elegant room with modern amenities and stunning views, perfect for a relaxing stay.</p>
                        <div class="room-features-list">
                            <span class="feature-item"><i class="fas fa-bed"></i> King Bed</span>
                            <span class="feature-item"><i class="fas fa-wifi"></i> Free WiFi</span>
                            <span class="feature-item"><i class="fas fa-snowflake"></i> AC</span>
                            <span class="feature-item"><i class="fas fa-city"></i> City View</span>
                        </div>
                        <a href="{{ route('room', ['type' => 'deluxe']) }}" class="view-room-btn">VIEW DETAILS</a>
                    </div>
                </div>

                <!-- Room 2 -->
                <div class="featured-room">
                    <div class="room-image-container">
                        <div class="room-price-tag">₱3,100/night</div>
                        <img src="{{ asset('rooms/featured room.jpg') }}" alt="Suite Room">
                    </div>
                    <div class="room-details-container">
                        <h3 class="room-title">Suite Room</h3>
                        <p class="room-description">Comfortable suite designed for families with separate living area and all the amenities you need.</p>
                        <div class="room-features-list">
                            <span class="feature-item"><i class="fas fa-bed"></i> 2 Queen Beds</span>
                            <span class="feature-item"><i class="fas fa-wifi"></i> Free WiFi</span>
                            <span class="feature-item"><i class="fas fa-bath"></i> Bathtub</span>
                            <span class="feature-item"><i class="fas fa-tv"></i> Smart TV</span>
                        </div>
                        <a href="{{ route('room', ['type' => 'family']) }}" class="view-room-btn">VIEW DETAILS</a>
                    </div>
                </div>

                <!-- Room 3 -->
                <div class="featured-room">
                    <div class="room-image-container">
                        <div class="room-price-tag">₱2,700/night</div>
                        <img src="{{ asset('rooms/room1.jpg') }}" alt="Executive Suite Room">
                    </div>
                    <div class="room-details-container">
                        <h3 class="room-title">Superior Room</h3>
                        <p class="room-description">Luxurious suite with premium furnishings, panoramic views, and exclusive amenities for discerning guests.</p>
                        <div class="room-features-list">
                            <span class="feature-item"><i class="fas fa-bed"></i> King Bed</span>
                            <span class="feature-item"><i class="fas fa-bath"></i> Jacuzzi</span>
                            <span class="feature-item"><i class="fas fa-utensils"></i> Mini Bar</span>
                            <span class="feature-item"><i class="fas fa-concierge-bell"></i> Room Service</span>
                        </div>
                        <a href="{{ route('room', ['type' => 'executive']) }}" class="view-room-btn">VIEW DETAILS</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Events Section -->
    <section class="featured-section gray-bg">
        <div class="section-container">
            <div class="section-header">
                <h2 class="section-title glow-effect">Featured Events</h2>
                <p class="section-subtitle">Host your special occasions at Southgate Inn with our elegant venues and professional event planning services</p>
            </div>

            <div class="featured-grid">
                <!-- Event 1: Wedding -->
                <div class="event-card">
                    <div class="event-image-container">
                        <div class="event-date">
                            <i class="fas fa-heart" style="font-size: 24px;"></i>
                        </div>
                        <img src="{{ asset('images/wedding.jpg') }}" alt="Wedding Venue" class="event-image">
                    </div>
                    <div class="event-details">
                        <h3 class="event-title">Wedding Celebrations</h3>
                        <p class="event-description">Create timeless memories on your special day with our elegant ballroom and customized wedding packages.</p>
                        <div class="event-meta">
                            <span class="event-meta-item"><i class="fas fa-users"></i> Up to 300 guests</span>
                            <span class="event-meta-item"><i class="fas fa-map-marker-alt"></i> Grand Ballroom</span>
                        </div>
                        <button class="view-event-btn" data-event="wedding">VIEW PACKAGES</button>
                    </div>
                </div>

                <!-- Event 2: Corporate -->
                <div class="event-card">
                    <div class="event-image-container">
                        <div class="event-date">
                            <i class="fas fa-briefcase" style="font-size: 24px;"></i>
                        </div>
                        <img src="{{ asset('images/corporate.jpg') }}" alt="Corporate Events" class="event-image">
                    </div>
                    <div class="event-details">
                        <h3 class="event-title">Corporate Events</h3>
                        <p class="event-description">Professional meeting spaces equipped with modern technology for conferences, seminars, and business gatherings.</p>
                        <div class="event-meta">
                            <span class="event-meta-item"><i class="fas fa-users"></i> 20-150 guests</span>
                            <span class="event-meta-item"><i class="fas fa-map-marker-alt"></i> Executive Conference Center</span>
                        </div>
                        <button class="view-event-btn" data-event="corporate">VIEW PACKAGES</button>
                    </div>
                </div>

                <!-- Event 3: Birthday/Celebration -->
                <div class="event-card">
                    <div class="event-image-container">
                        <div class="event-date">
                            <i class="fas fa-birthday-cake" style="font-size: 24px;"></i>
                        </div>
                        <img src="{{ asset('images/birthday.jpg') }}" alt="Birthday Celebrations" class="event-image">
                    </div>
                    <div class="event-details">
                        <h3 class="event-title">Birthday Celebrations</h3>
                        <p class="event-description">Make your birthday unforgettable with our specially designed celebration packages and festive venues.</p>
                        <div class="event-meta">
                            <span class="event-meta-item"><i class="fas fa-users"></i> 30-150 guests</span>
                            <span class="event-meta-item"><i class="fas fa-map-marker-alt"></i> Crystal Hall</span>
                        </div>
                        <button class="view-event-btn" data-event="birthday">VIEW PACKAGES</button>
                    </div>
                </div>

                <!-- Event 4: Reunion -->
                <div class="event-card">
                    <div class="event-image-container">
                        <div class="event-date">
                            <i class="fas fa-glass-cheers" style="font-size: 24px;"></i>
                        </div>
                        <img src="{{ asset('images/reunion.jpg') }}" alt="Family Reunions" class="event-image">
                    </div>
                    <div class="event-details">
                        <h3 class="event-title">Family Reunions</h3>
                        <p class="event-description">Reconnect with loved ones in our warm and inviting spaces perfect for family gatherings and reunions.</p>
                        <div class="event-meta">
                            <span class="event-meta-item"><i class="fas fa-users"></i> 20-100 guests</span>
                            <span class="event-meta-item"><i class="fas fa-map-marker-alt"></i> Garden Pavilion</span>
                        </div>
                        <button class="view-event-btn" data-event="reunion">VIEW PACKAGES</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Availability Popup -->
    <div class="availability-popup" id="availability-popup">
        <div class="popup-content">
            <button class="popup-close" id="popup-close">&times;</button>
            <h2 class="popup-title">Available Rooms</h2>

            <div class="available-rooms">
                <!-- Room cards will display here -->
            </div>
        </div>
    </div>

    <!-- Footer Section -->
    @include('components.footer')

    <!-- Room Selection Modal -->
    <div class="room-modal" id="room-selection-modal">
        <div class="room-modal-content">
            <div class="room-modal-header">
                <h3 class="room-modal-title">Room Selection</h3>
                <button class="room-modal-close" id="modal-close" aria-label="Close">&times;</button>
            </div>
            <div class="room-modal-image-container">
                <img id="modal-room-image" src="rooms\DELUXE ROOM.jpg" alt="Room" class="room-modal-image">
                <div class="room-modal-image-overlay">
                    <div class="room-highlight-tag">Popular Choice</div>
                </div>
            </div>
            <div class="room-modal-body">
                <div class="selected-room-details">
                    <div class="detail-row">
                        <div class="detail-label"><i class="fas fa-hotel"></i> Room Type:</div>
                        <div class="detail-value" id="modal-room-type">Standard Room</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label"><i class="fas fa-calendar-check"></i> Check-in:</div>
                        <div class="detail-value" id="modal-checkin">April 29, 2025</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label"><i class="fas fa-calendar-minus"></i> Check-out:</div>
                        <div class="detail-value" id="modal-checkout">May 2, 2025</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label"><i class="fas fa-moon"></i> Duration:</div>
                        <div class="detail-value" id="modal-duration">3 Nights</div>
                    </div>
                    <div class="detail-row total-cost-row">
                        <div class="detail-label"><i class="fas fa-tags"></i> Total Cost:</div>
                        <div class="detail-value detail-price" id="modal-price">₱1,900</div>
                    </div>
                </div>

                <div class="room-features-highlight">
                    <h4><i class="fas fa-check-circle"></i> Included in your stay:</h4>
                    <div class="room-features-grid">
                        <div class="feature-badge"><i class="fas fa-wifi"></i> Free WiFi</div>
                        <div class="feature-badge"><i class="fas fa-coffee"></i> Breakfast</div>
                        <div class="feature-badge"><i class="fas fa-parking"></i> Free Parking</div>
                        <div class="feature-badge"><i class="fas fa-snowflake"></i> AC</div>
                    </div>
                </div>

                <div class="room-modal-actions">
                    <button class="modal-btn proceed-btn" id="proceed-btn"><i class="fas fa-check-circle"></i> Proceed to Booking</button>
                    <button class="modal-btn view-other-btn" id="view-other-btn"><i class="fas fa-search"></i> View Other Rooms</button>
                    <button class="modal-btn cancel-btn" id="cancel-btn"><i class="fas fa-times"></i> Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Room Details Popup -->
    <div class="room-details-popup" id="room-details-popup">
        <div class="room-details-content">
            <div class="room-details-header">
                <img src="../rooms/DELUXE ROOM.jpg" alt="Room" id="popup-room-image">
                <div class="room-details-header-overlay">
                    <h2 class="room-details-title" id="popup-room-title">Deluxe Room</h2>
                    <div class="room-details-price" id="popup-room-price">₱2,400/night</div>
                </div>
                <button class="room-details-close" id="details-popup-close">&times;</button>
            </div>
            <div class="room-details-body">
                <div class="room-details-section">
                    <h3 class="room-details-section-title">Room Overview</h3>
                    <div class="room-details-specs">
                        <div class="room-details-spec">
                            <i class="fas fa-user-friends"></i>
                            <div class="room-details-spec-title">Capacity</div>
                            <div class="room-details-spec-value" id="popup-room-capacity">2 Guests</div>
                        </div>
                        <div class="room-details-spec">
                            <i class="fas fa-bed"></i>
                            <div class="room-details-spec-title">Bed Type</div>
                            <div class="room-details-spec-value" id="popup-room-bed">1 King Bed</div>
                        </div>
                        <div class="room-details-spec">
                            <i class="fas fa-vector-square"></i>
                            <div class="room-details-spec-title">Room Size</div>
                            <div class="room-details-spec-value" id="popup-room-size">35 m²</div>
                        </div>
                        <div class="room-details-spec">
                            <i class="fas fa-mountain"></i>
                            <div class="room-details-spec-title">View</div>
                            <div class="room-details-spec-value" id="popup-room-view">City View</div>
                        </div>
                    </div>
                    <p class="room-details-description" id="popup-room-description">
                        Spacious and elegant room with modern amenities and stunning views of the city. Our Deluxe Rooms are perfect for travelers seeking comfort and style during their stay. Each room features premium bedding, a work desk, and a seating area where you can relax after a day of exploring.
                    </p>
                </div>

                <div class="room-details-section">
                    <h3 class="room-details-section-title">Amenities</h3>
                    <div class="room-details-amenities" id="popup-room-amenities">
                        <div class="room-details-amenity"><i class="fas fa-wifi"></i> Free High-Speed WiFi</div>
                        <div class="room-details-amenity"><i class="fas fa-snowflake"></i> Air Conditioning</div>
                        <div class="room-details-amenity"><i class="fas fa-tv"></i> 42" Smart TV</div>
                        <div class="room-details-amenity"><i class="fas fa-coffee"></i> Coffee Machine</div>
                        <div class="room-details-amenity"><i class="fas fa-bath"></i> En-Suite Bathroom</div>
                        <div class="room-details-amenity"><i class="fas fa-shower"></i> Rainfall Shower</div>
                        <div class="room-details-amenity"><i class="fas fa-concierge-bell"></i> Room Service</div>
                        <div class="room-details-amenity"><i class="fas fa-phone-alt"></i> Direct Dial Phone</div>
                        <div class="room-details-amenity"><i class="fas fa-lock"></i> In-Room Safe</div>
                        <div class="room-details-amenity"><i class="fas fa-tshirt"></i> Ironing Facilities</div>
                    </div>
                </div>
            </div>
            <div class="room-details-footer">
                <button class="room-book-btn" id="popup-book-now">Book Now</button>
            </div>
        </div>
    </div>

    <!-- Event Details Popup -->
    <div class="event-details-popup" id="event-details-popup">
        <div class="event-details-content">
            <div class="event-details-header">
                <img src="../images/wedding.jpg" alt="Event" id="event-details-image" class="event-details-image">
                <div class="event-details-header-overlay">
                    <h2 class="event-details-title" id="event-details-title">Wedding Celebrations</h2>
                    <div class="event-details-price" id="event-details-price">Starting at ₱75,000</div>
                </div>
                <button class="event-details-close" id="event-details-close">&times;</button>
            </div>
            <div class="event-details-body">
                <div class="event-details-section">
                    <h3 class="event-details-section-title"><i class="fas fa-info-circle"></i> Event Overview</h3>
                    <p class="event-details-description" id="event-details-description">
                        Begin your journey together in our breathtaking venues designed for unforgettable wedding celebrations. Our comprehensive packages include elegant decorations, gourmet catering options, and a dedicated wedding coordinator who will ensure every detail is perfect.
                    </p>
                </div>

                <div class="event-details-section features-section">
                    <h3 class="event-details-section-title"><i class="fas fa-list-check"></i> What's Included</h3>
                    <div class="event-details-features" id="event-details-features">
                        <div class="event-details-feature"><i class="fas fa-check-circle"></i> Exclusive venue rental (6-8 hours)</div>
                        <div class="event-details-feature"><i class="fas fa-check-circle"></i> Professional wedding coordinator</div>
                        <div class="event-details-feature"><i class="fas fa-check-circle"></i> Customizable decoration packages</div>
                        <div class="event-details-feature"><i class="fas fa-check-circle"></i> Premium sound system and mood lighting</div>
                        <div class="event-details-feature"><i class="fas fa-check-circle"></i> Gourmet menu options with tasting session</div>
                        <div class="event-details-feature"><i class="fas fa-check-circle"></i> Complimentary bridal suite for preparation</div>
                        <div class="event-details-feature"><i class="fas fa-check-circle"></i> Experienced waitstaff and security personnel</div>
                        <div class="event-details-feature"><i class="fas fa-check-circle"></i> Complete setup and cleanup services</div>
                    </div>
                </div>

                <div class="event-details-section">
                    <h3 class="event-details-section-title"><i class="fas fa-info-circle"></i> Additional Information</h3>
                    <p class="event-details-description">
                        Prices vary based on date, guest count, and specific requirements. All packages are customizable to match your vision and preferences. Contact our event planning team for personalized quotes and to schedule a venue tour.
                    </p>
                </div>
            </div>
            <div class="event-details-cta">
                <a href="#" class="event-book-btn pulse-animation" id="event-details-book">Book This Event</a>
            </div>
        </div>
    </div>

    <!-- Event Booking Confirmation Popup -->
    <div class="event-booking-confirmation" id="event-booking-confirmation">
        <div class="event-booking-content">
            <div class="event-booking-header">
                <h3 class="event-booking-title">Proceed to Event Booking</h3>
                <button class="event-booking-close" id="event-booking-close">&times;</button>
            </div>
            <div class="event-booking-body">
                <div class="event-booking-icon">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <p class="event-booking-message">
                    You are about to book the following event:
                </p>
                <div class="event-booking-details">
                    <div class="event-booking-detail">
                        <span class="event-booking-label"><i class="fas fa-glass-cheers"></i> Event Type:</span>
                        <span class="event-booking-value" id="confirm-event-type-value">Wedding Celebration</span>
                    </div>
                    <div class="event-booking-detail">
                        <span class="event-booking-label"><i class="fas fa-dollar-sign"></i> Starting Price:</span>
                        <span class="event-booking-value" id="confirm-event-price-value">₱75,000</span>
                    </div>
                </div>
                <p class="event-booking-note">
                    You will be redirected to our booking form where you can provide your details and specific requirements.
                </p>
            </div>
            <div class="event-booking-actions">
                <button class="event-booking-btn proceed-booking-btn" id="proceed-booking-btn">
                    <i class="fas fa-check-circle"></i> Proceed to Booking Form
                </button>
                <button class="event-booking-btn cancel-booking-btn" id="cancel-booking-btn">
                    <i class="fas fa-times"></i> Cancel
                </button>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="{{ asset('js/menu-fix.js') }}"></script>
    <script src="{{ asset('js/index.room.js') }}"></script>
    <script src="{{ asset('js/index.event.js') }}"></script>
</body>
</html>
