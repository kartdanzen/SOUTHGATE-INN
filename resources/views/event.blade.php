<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Southgate Event</title>
    <!--Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!--Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="icon" href="{{ asset('images/tab.png') }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- External CSS -->
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/event.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
</head>
<body>
    <!-- Header -->
    <header class="header">
        @include('nav')
    </header>
    <div class="menu-overlay"></div>

    <!-- Events Hero Section -->
    <section class="events-hero">
        <div class="hero-content">
            <h1 class="events-hero-title">Celebrate Moments</h1>
            <p class="events-hero-subtitle">Make your special occasions unforgettable with our exceptional event venues and services. From elegant weddings to corporate gatherings, we create perfect settings for your most cherished memories.</p>
        </div>
    </section>

    <!-- Event Types Section -->
    <section class="event-types-container">
        <h2 class="section-title">Extraordinary Event Packages</h2>
        <p class="section-subtitle">Choose from our selection of carefully curated event packages designed to make your special occasions truly memorable and tailored to your preferences.</p>

        <div class="event-types-grid">
            <!-- Wedding Package -->
            <div class="event-type-card">
                <div class="event-type-tag">Popular</div>
                <div class="event-type-img-container">
                    <img src="images/wedding.jpg" alt="Wedding" class="event-type-img">
                </div>
                <div class="event-type-content">
                    <h3 class="event-type-title">Elegant Weddings</h3>
                    <p class="event-type-description">Create magical memories with our comprehensive wedding packages, including venue decoration, gourmet catering, and dedicated wedding coordinator to handle every detail.</p>
                    <p class="event-type-price">Starting at ₱75,000</p>
                    <div class="event-buttons">
                        <a href="javascript:void(0)" class="event-view-btn" data-event="wedding" onclick="openEventDetails('wedding'); return false;">View Details</a>
                        <a href="#booking-form" class="event-type-btn" data-event-type="wedding">Book Now</a>
                    </div>
                </div>
            </div>

            <!-- Birthday Package -->
            <div class="event-type-card">
                <div class="event-type-img-container">
                    <img src="images/birthday.jpg" alt="Birthday" class="event-type-img">
                </div>
                <div class="event-type-content">
                    <h3 class="event-type-title">Birthday Celebrations</h3>
                    <p class="event-type-description">Celebrate another year of life with our birthday packages, including themed decorations, custom cake, and personalized menu options for all your guests.</p>
                    <p class="event-type-price">Starting at ₱25,000</p>
                    <div class="event-buttons">
                        <a href="javascript:void(0)" class="event-view-btn" data-event="birthday" onclick="openEventDetails('birthday'); return false;">View Details</a>
                        <a href="#booking-form" class="event-type-btn" data-event-type="birthday">Book Now</a>
                    </div>
                </div>
            </div>

            <!-- Corporate Package -->
            <div class="event-type-card">
                <div class="event-type-img-container">
                    <img src="images/corporate.jpg" alt="Corporate Event" class="event-type-img">
                </div>
                <div class="event-type-content">
                    <h3 class="event-type-title">Corporate Events</h3>
                    <p class="event-type-description">From professional meetings to team-building activities, our corporate packages offer a perfect blend of business functionality and relaxing atmosphere.</p>
                    <p class="event-type-price">Starting at ₱35,000</p>
                    <div class="event-buttons">
                        <a href="javascript:void(0)" class="event-view-btn" data-event="corporate" onclick="openEventDetails('corporate'); return false;">View Details</a>
                        <a href="#booking-form" class="event-type-btn" data-event-type="corporate">Book Now</a>
                    </div>
                </div>
            </div>

            <!-- Reunion Package -->
            <div class="event-type-card">
                <div class="event-type-img-container">
                    <img src="images/reunion.jpg" alt="Reunion" class="event-type-img">
                </div>
                <div class="event-type-content">
                    <h3 class="event-type-title">Family Reunions</h3>
                    <p class="event-type-description">Reconnect with loved ones in a comfortable and inviting environment. Our reunion packages include spacious venues with ample seating and customized catering options.</p>
                    <p class="event-type-price">Starting at ₱40,000</p>
                    <div class="event-buttons">
                        <a href="javascript:void(0)" class="event-view-btn" data-event="reunion" onclick="openEventDetails('reunion'); return false;">View Details</a>
                        <a href="#booking-form" class="event-type-btn" data-event-type="reunion">Book Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Booking Section -->
    <section id="bookingSection" class="booking-section">
        <div class="booking-container">
            <h2 class="section-title">Book Your Event</h2>
            <p class="section-subtitle">Fill out the form below to request your event booking. Our events team will contact you within 24 hours to confirm availability and discuss details.</p>

            <form id="booking-form" class="booking-form" action="{{ route('event.booking') }}" method="POST">
                @csrf
                <div class="form-steps" data-step="1">
                    <div class="step active">
                        <div class="step-number">1</div>
                        <div class="step-label">Event Type</div>
                    </div>
                    <div class="step">
                        <div class="step-number">2</div>
                        <div class="step-label">Personal Details</div>
                    </div>
                    <div class="step">
                        <div class="step-number">3</div>
                        <div class="step-label">Confirmation</div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="eventType" class="form-label">Type of Event</label>
                    <select id="eventType" name="eventType" class="form-control" required>
                        <option value="" selected disabled>Select an event type</option>
                        <option value="wedding">Wedding</option>
                        <option value="birthday">Birthday Celebration</option>
                        <option value="corporate">Corporate Event</option>
                        <option value="reunion">Family Reunion</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="eventDate" class="form-label">Event Date</label>
                        <input type="date" id="eventDate" name="eventDate" class="form-control" required>
                        <div id="dateAlert" class="date-alert">
                            <span id="date-alert-message"></span>
                            <button type="button" id="date-alert-close" class="date-alert-close">&times;</button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="guestCount" class="form-label">Expected Number of Guests</label>
                        <input type="number" id="guestCount" name="guestCount" min="10" max="500" class="form-control" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="firstName" class="form-label">First Name</label>
                        <input type="text" id="firstName" name="firstName" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="lastName" class="form-label">Last Name</label>
                        <input type="text" id="lastName" name="lastName" class="form-control" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="phoneNumber" class="form-label">Phone Number</label>
                        <input type="tel" id="phoneNumber" name="phoneNumber" class="form-control" placeholder="+63" required>
                        <small class="input-hint">Follow Philippine Mobile number format</small>
                    </div>
                </div>

                <div class="form-group">
                    <label for="specialRequests" class="form-label">Special Requests or Notes</label>
                    <textarea id="specialRequests" name="specialRequests" class="form-control"></textarea>
                </div>

                <button type="submit" class="submit-btn">Submit Booking Request</button>
            </form>
        </div>
    </section>

    <!-- Event Details Popup -->
    <div id="eventDetailsPopup" class="confirmation-popup">
        <div class="popup-content" style="max-width: 900px; width: 90%;">
            <div class="popup-header">
                <h2 class="popup-title"><i class="fas fa-calendar-day"></i> Event Details</h2>
                <button class="popup-close-btn" id="event-details-close">&times;</button>
            </div>
            <div class="popup-body">
                <div class="popup-image-container" style="position: relative; height: 350px; width: 100%; overflow: hidden; background-color: #f3f3f3; border-radius: 8px;">
                    <!-- Image will be dynamically created by JavaScript -->
                </div>
                <div class="popup-content-inner">
                    <h3 class="popup-event-title" id="event-details-title"></h3>
                    <p class="popup-event-price" id="event-details-price"></p>
                    <p class="popup-event-description" id="event-details-description"></p>
                </div>
                <div class="popup-features">
                    <h4>What's Included:</h4>
                    <ul class="popup-event-features" id="event-details-features"></ul>
                </div>
                <div class="popup-content-inner">
                    <div class="popup-action-container">
                        <button class="popup-book-btn" id="event-details-book" data-event="">Book This Package</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="popup-overlay"></div>
    </div>

    <!-- Footer Section -->
@include('components.footer')

    <!-- Booking Success Popup -->
    <div id="bookingSuccessPopup" class="confirmation-popup">
        <div class="popup-content">
            <div class="popup-header">
                <h2 class="popup-title"><i class="fas fa-calendar-check"></i> Booking Confirmed!</h2>
                <button class="popup-close-btn" id="booking-success-close">&times;</button>
            </div>
            <div class="popup-body">
                <div class="popup-content-inner">
                    <div class="success-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h3 class="success-title">Thank You For Your Booking</h3>
                    <p class="success-message">We've received your event booking request and our team will contact you shortly to confirm all details.</p>

                    <div class="booking-details">
                        <h4>Booking Details</h4>
                        <ul class="booking-details-list">
                            <li><strong>Event Type</strong> <span id="success-event-type"></span></li>
                            <li><strong>Date</strong> <span id="success-event-date"></span></li>
                            <li><strong>Guests</strong> <span id="success-guest-count"></span></li>
                        </ul>
                    </div>

                    <div class="popup-action-container">
                        <button class="popup-book-btn" id="booking-success-btn">Return to Home</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="popup-overlay"></div>
    </div>

    <!-- JavaScript -->
    <script src="{{ asset('js/navbar.js') }}"></script>
    <script src="{{ asset('js/event.js') }}"></script>
</body>
</html>
