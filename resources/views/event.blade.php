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
                        <option value="other">Others</option>
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

                <div class="form-group terms-agreement">
                    <label class="checkbox-label">
                        <input type="checkbox" name="terms_agreement" required>
                        <span class="checkbox-custom"></span>
                        <span class="checkbox-text">I agree to the <a href="javascript:void(0);" onclick="showTermsPopup(event)" class="terms-link">terms and conditions</a> <span class="required">*</span></span>
                    </label>
                    @error('terms_agreement')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
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
                        <button class="popup-book-btn" id="booking-success-btn">Return to Page</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="popup-overlay"></div>
    </div>

    <!-- JavaScript -->
    <script src="{{ asset('js/navbar.js') }}"></script>
    <script src="{{ asset('js/event.js') }}"></script>

    <style>
        /* Terms modal styles */
        #termsPopup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background-color: rgba(0,0,0,0.8);
            backdrop-filter: blur(5px);
        }
        #termsPopup.active {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .terms-popup-content {
            background: white;
            width: 90%;
            max-width: 800px;
            max-height: 85vh;
            overflow-y: auto;
            padding: 30px;
            border-radius: 12px;
            position: relative;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }
        .terms-close {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 24px;
            cursor: pointer;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            border: none;
            background: none;
        }
        .terms-close:hover {
            background: #f5f5f5;
        }
        .terms-popup-title {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            color: #006652;
            margin-bottom: 20px;
            text-align: center;
        }
        .terms-popup-section {
            margin-bottom: 24px;
        }
        .terms-popup-section h3 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 10px;
            color: #333;
        }
        .terms-popup-section p {
            margin-bottom: 8px;
            font-size: 14px;
            line-height: 1.6;
            color: #555;
        }
        .terms-popup-footer {
            border-top: 1px solid #eee;
            padding-top: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .terms-accept-btn {
            background-color: #006652;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
        }
        .terms-accept-btn:hover {
            background-color: #00543f;
        }
        .terms-date {
            color: #888;
            font-size: 12px;
            font-style: italic;
        }
        .checkbox-label {
            display: flex;
            align-items: center;
            cursor: pointer;
            margin-bottom: 15px;
            position: relative;
        }
        .checkbox-label input[type="checkbox"] {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }
        .checkbox-custom {
            position: relative;
            height: 20px;
            width: 20px;
            background-color: #eee;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-right: 10px;
        }
        .checkbox-label:hover input ~ .checkbox-custom {
            background-color: #ccc;
        }
        .checkbox-label input:checked ~ .checkbox-custom {
            background-color: #006652;
            border-color: #006652;
        }
        .checkbox-custom:after {
            content: "";
            position: absolute;
            display: none;
            left: 7px;
            top: 3px;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }
        .checkbox-label input:checked ~ .checkbox-custom:after {
            display: block;
        }
        .checkbox-text {
            font-size: 14px;
            color: #333;
        }
        .terms-link {
            color: #006652;
            text-decoration: underline;
        }
        .required {
            color: #e74c3c;
        }
    </style>

    <!-- Terms and Conditions Popup -->
    <div id="termsPopup">
        <div class="terms-popup-content">
            <button class="terms-close" onclick="hideTermsPopup()"><i class="fas fa-times"></i></button>
            <h2 class="terms-popup-title">Event Booking Terms and Conditions</h2>

            <div class="terms-popup-body">
                <section class="terms-popup-section">
                    <h3>1. Event Booking & Reservation Policy</h3>
                    <p>1.1. All event bookings must be confirmed with a valid credit card or by advance payment.</p>
                    <p>1.2. Event packages are priced as indicated and are subject to availability and seasonal variations.</p>
                    <p>1.3. Package rates include amenities for the specified event type. Additional services may incur extra charges.</p>
                    <p>1.4. Reservations are confirmed upon receipt of a confirmation number or email from Southgate Inn.</p>
                </section>

                <section class="terms-popup-section">
                    <h3>2. Event Setup and Timing</h3>
                    <p>2.1. Standard event duration is as specified in each package.</p>
                    <p>2.2. Extended event hours are subject to availability and will incur additional charges.</p>
                    <p>2.3. Setup time before the event must be arranged in advance with the event coordinator.</p>
                </section>

                <section class="terms-popup-section">
                    <h3>3. Cancellation and Modification Policy</h3>
                    <p>3.1. Cancellations must be made at least 14 days prior to the scheduled event date to avoid charges.</p>
                    <p>3.2. Cancellations made less than 14 days before the event will incur a charge equivalent to 30% of the total booking.</p>
                    <p>3.3. Cancellations made less than 7 days before the event will incur a charge of 50% of the total booking.</p>
                    <p>3.4. Modifications to event details are subject to availability and may result in rate changes.</p>
                </section>

                <section class="terms-popup-section">
                    <h3>4. Payment Policy</h3>
                    <p>4.1. A non-refundable deposit of 20% is required to secure your booking.</p>
                    <p>4.2. Full payment is due 7 days prior to the event date.</p>
                    <p>4.3. We accept major credit cards, bank transfers, and select digital payment methods.</p>
                </section>

                <section class="terms-popup-section">
                    <h3>5. Event Policies</h3>
                    <p>5.1. Decorations must be approved in advance and must not damage the venue.</p>
                    <p>5.2. The client is responsible for the behavior of their guests and any damages caused.</p>
                    <p>5.3. Southgate Inn reserves the right to terminate any event that violates our policies or local regulations.</p>
                    <p>5.4. External vendors must be approved by Southgate Inn management.</p>
                </section>

                <section class="terms-popup-section">
                    <h3>6. Force Majeure</h3>
                    <p>6.1. Southgate Inn shall not be liable for failure to perform its obligations due to circumstances beyond its reasonable control, including but not limited to acts of God, natural disasters, pandemic restrictions, or government regulations.</p>
                </section>

                <section class="terms-popup-section">
                    <h3>7. General Provisions</h3>
                    <p>7.1. These terms and conditions are subject to change without notice.</p>
                    <p>7.2. By booking an event at Southgate Inn, you agree to abide by all terms and policies in effect at the time of your event.</p>
                </section>
            </div>

            <div class="terms-popup-footer">
                <span class="terms-date">Last updated: May 15, 2024</span>
                <button class="terms-accept-btn" onclick="acceptTerms()">I Understand and Accept</button>
            </div>
        </div>
    </div>

    <script>
        // Terms modal functions
        function showTermsPopup(event) {
            if (event) event.preventDefault();
            document.getElementById('termsPopup').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function hideTermsPopup() {
            document.getElementById('termsPopup').classList.remove('active');
            document.body.style.overflow = '';
        }

        function acceptTerms() {
            // Check the terms checkbox
            const checkbox = document.querySelector('input[name="terms_agreement"]');
            if (checkbox) checkbox.checked = true;
            hideTermsPopup();
        }

        // Close when clicking outside the modal content
        document.getElementById('termsPopup').addEventListener('click', function(e) {
            if (e.target === this) hideTermsPopup();
        });
    </script>
</body>
</html>
