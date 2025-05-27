<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Southgate Room</title>
    <!--Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!--Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="icon" href="{{ asset('images/tab.png') }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- External CSS -->
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/room.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <style>
        /* Inline styles for terms modal to ensure it works */
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
    </style>
</head>
<body>
    <!-- Header Section -->
    <header class="header">
        @include('nav')
    </header>
    <div class="menu-overlay"></div>

    <!-- Hero Section -->
    <section class="page-hero">
        <div class="marquee-overlay"></div>
        <div class="marquee-container">
            <div class="marquee-slider">
                <!-- First set of slides -->
                <div class="marquee-slide">
                    <img src="{{ asset('rooms/room1.jpg') }}" alt="Deluxe Room">
                </div>
                <div class="marquee-slide">
                    <img src="{{ asset('rooms/room2.jpg') }}" alt="Family Suite">
                </div>
                <div class="marquee-slide">
                    <img src="{{ asset('rooms/room3.jpg') }}" alt="Premium Room">
                </div>
                <div class="marquee-slide">
                    <img src="{{ asset('rooms/room4.jpg') }}" alt="Executive Suite">
                </div>
                <div class="marquee-slide">
                    <img src="{{ asset('rooms/DELUXE ROOM.jpg') }}" alt="Standard Room">
                </div>
                <div class="marquee-slide">
                    <img src="{{ asset('rooms/featured room.jpg') }}" alt="Twin Room">
                </div>

                <!-- Duplicate for loop-->
                <div class="marquee-slide">
                    <img src="{{ asset('rooms/room1.jpg') }}" alt="Deluxe Room">
                </div>
                <div class="marquee-slide">
                    <img src="{{ asset('rooms/room2.jpg') }}" alt="Family Suite">
                </div>
                <div class="marquee-slide">
                    <img src="{{ asset('rooms/room3.jpg') }}" alt="Premium Room">
                </div>
                <div class="marquee-slide">
                    <img src="{{ asset('rooms/room4.jpg') }}" alt="Executive Suite">
                </div>
                <div class="marquee-slide">
                    <img src="{{ asset('rooms/DELUXE ROOM.jpg') }}" alt="Standard Room">
                </div>
                <div class="marquee-slide">
                    <img src="{{ asset('rooms/featured room.jpg') }}" alt="Twin Room">
                </div>
            </div>
        </div>
        <div class="hero-content">
            <h1 class="page-title">Our Rooms & Suites</h1>
            <p class="page-subtitle">Experience luxurious comfort and modern amenities in our thoughtfully designed accommodations.</p>
        </div>
    </section>

    <!-- Room Listing Section -->
    <section class="room-listing-container">
        <!-- Room Filters -->
        <div class="room-filters">
            <div class="filter-group">
                <label for="check-in-filter" class="filter-label">Check-in Date</label>
                <input type="date" id="check-in-filter" class="filter-input">
            </div>

            <div class="filter-group">
                <label for="check-out-filter" class="filter-label">Check-out Date</label>
                <input type="date" id="check-out-filter" class="filter-input">
            </div>

            <div class="filter-group">
                <label for="guests-filter" class="filter-label">Guests</label>
                <select id="guests-filter" class="filter-input">
                    <option value="1">1 Guest</option>
                    <option value="2" selected>2 Guests</option>
                    <option value="3">3 Guests</option>
                    <option value="4">4 Guests</option>
                    <option value="5">5+ Guests</option>
                </select>
            </div>

            <button id="apply-filters" class="filter-button">
                <i class="fas fa-search"></i>
                Search Availability
            </button>
        </div>

        <!-- Room Grid -->
        <div class="room-grid">
            <!-- Deluxe Room -->
            <div class="room-card">
                <div class="room-image-container">
                    <img src="{{ asset('rooms/room1.jpg') }}" alt="Deluxe Room" class="room-image">
                    <div class="room-price-tag">₱2,400/night</div>
                </div>
                <div class="room-details">
                    <h3 class="room-name">Deluxe Room</h3>
                    <p class="room-description">Our spacious deluxe rooms offer modern comfort with elegant furnishings and all essential amenities for a relaxing stay.</p>

                    <div class="room-features">
                        <span class="feature"><i class="fas fa-user-friends"></i> 2 Guests</span>
                        <span class="feature"><i class="fas fa-bed"></i> Queen Bed</span>
                        <span class="feature"><i class="fas fa-ruler-combined"></i> 28m²</span>
                    </div>

                    <div class="room-amenities">
                        <div class="amenity"><i class="fas fa-wifi"></i> Free High-Speed WiFi</div>
                        <div class="amenity"><i class="fas fa-snowflake"></i> Air Conditioning</div>
                        <div class="amenity"><i class="fas fa-tv"></i> 42" LED Smart TV</div>
                        <div class="amenity"><i class="fas fa-coffee"></i> Coffee Maker</div>
                    </div>

                    <button class="select-room-btn" data-room-type="Deluxe Room" data-price="2400" data-image="{{ asset('rooms/room1.jpg') }}">Select Room</button>
                </div>
            </div>

            <!-- Superior -->
            <div class="room-card">
                <div class="room-image-container">
                    <img src="{{ asset('rooms/room3.jpg') }}" alt="Superior Room" class="room-image">
                    <div class="room-price-tag">₱2,500/night</div>
                </div>
                <div class="room-details">
                    <h3 class="room-name">Family Deluxe</h3>
                    <p class="room-description">Experience enhanced comfort in our premium rooms featuring upscale amenities and beautiful city views.</p>

                    <div class="room-features">
                        <span class="feature"><i class="fas fa-user-friends"></i> 2 Guests</span>
                        <span class="feature"><i class="fas fa-bed"></i> King Bed</span>
                        <span class="feature"><i class="fas fa-ruler-combined"></i> 32m²</span>
                    </div>

                    <div class="room-amenities">
                        <div class="amenity"><i class="fas fa-wifi"></i> Free High-Speed WiFi</div>
                        <div class="amenity"><i class="fas fa-snowflake"></i> Air Conditioning</div>
                        <div class="amenity"><i class="fas fa-tv"></i> 50" LED Smart TV</div>
                        <div class="amenity"><i class="fas fa-coffee"></i> Premium Coffee Machine</div>
                        <div class="amenity"><i class="fas fa-bath"></i> Luxury Bathroom</div>
                    </div>

                    <button class="select-room-btn" data-room-type="Premium Room" data-price="2700" data-image="{{ asset('rooms/room3.jpg') }}">Select Room</button>
                </div>
            </div>

            <!-- Suite Room -->
            <div class="room-card">
                <div class="room-image-container">
                    <img src="{{ asset('rooms/room2.jpg') }}" alt="Family Suite" class="room-image">
                    <div class="room-price-tag">₱3,100/night</div>
                </div>
                <div class="room-details">
                    <h3 class="room-name">Suite Room</h3>
                    <p class="room-description">Perfect for families, our spacious suites feature separate living areas and two bedrooms for ultimate comfort and privacy.</p>

                    <div class="room-features">
                        <span class="feature"><i class="fas fa-users"></i> 4 Guests</span>
                        <span class="feature"><i class="fas fa-bed"></i> King & Twin Beds</span>
                        <span class="feature"><i class="fas fa-ruler-combined"></i> 45m²</span>
                    </div>

                    <div class="room-amenities">
                        <div class="amenity"><i class="fas fa-wifi"></i> Free High-Speed WiFi</div>
                        <div class="amenity"><i class="fas fa-snowflake"></i> Air Conditioning</div>
                        <div class="amenity"><i class="fas fa-tv"></i> Two 50" LED Smart TVs</div>
                        <div class="amenity"><i class="fas fa-coffee"></i> Premium Coffee Machine</div>
                        <div class="amenity"><i class="fas fa-couch"></i> Separate Living Area</div>
                        <div class="amenity"><i class="fas fa-bath"></i> Luxury Bathroom</div>
                    </div>

                    <button class="select-room-btn" data-room-type="Suite Room" data-price="3100" data-image="{{ asset('rooms/room2.jpg') }}">Select Room</button>
                </div>
            </div>

            <!-- Superior Room -->
            <div class="room-card">
                <div class="room-image-container">
                    <img src="{{ asset('rooms/room4.jpg') }}" alt="Executive Suite" class="room-image">
                    <div class="room-price-tag">₱2,700/night</div>
                </div>
                <div class="room-details">
                    <h3 class="room-name">Superior Room</h3>
                    <p class="room-description">Our finest accommodations offering luxurious furnishings, panoramic views, and exclusive amenities for a truly exceptional stay.</p>

                    <div class="room-features">
                        <span class="feature"><i class="fas fa-user-friends"></i> 2 Guests</span>
                        <span class="feature"><i class="fas fa-bed"></i> Super King Bed</span>
                        <span class="feature"><i class="fas fa-ruler-combined"></i> 55m²</span>
                    </div>

                    <div class="room-amenities">
                        <div class="amenity"><i class="fas fa-wifi"></i> Free High-Speed WiFi</div>
                        <div class="amenity"><i class="fas fa-snowflake"></i> Climate Control</div>
                        <div class="amenity"><i class="fas fa-tv"></i> 65" OLED Smart TV</div>
                        <div class="amenity"><i class="fas fa-coffee"></i> Premium Coffee Machine</div>
                        <div class="amenity"><i class="fas fa-couch"></i> Luxury Living Area</div>
                        <div class="amenity"><i class="fas fa-bath"></i> Marble Bathroom</div>
                        <div class="amenity"><i class="fas fa-concierge-bell"></i> Butler Service</div>
                    </div>

                    <button class="select-room-btn" data-room-type="Superior Room" data-price="2700" data-image="{{ asset('rooms/room4.jpg') }}">Select Room</button>
                </div>
            </div>

            <!-- Standard Room -->
            <div class="room-card">
                <div class="room-image-container">
                    <img src="{{ asset('rooms/DELUXE ROOM.jpg') }}" alt="Standard Room" class="room-image">
                    <div class="room-price-tag">₱1,900/night</div>
                </div>
                <div class="room-details">
                    <h3 class="room-name">Standard Room</h3>
                    <p class="room-description">Comfortable and well-appointed rooms featuring essential amenities for a pleasant and affordable stay.</p>

                    <div class="room-features">
                        <span class="feature"><i class="fas fa-user-friends"></i> 2 Guests</span>
                        <span class="feature"><i class="fas fa-bed"></i> Double Bed</span>
                        <span class="feature"><i class="fas fa-ruler-combined"></i> 24m²</span>
                    </div>

                    <div class="room-amenities">
                        <div class="amenity"><i class="fas fa-wifi"></i> Free WiFi</div>
                        <div class="amenity"><i class="fas fa-snowflake"></i> Air Conditioning</div>
                        <div class="amenity"><i class="fas fa-tv"></i> 32" LED TV</div>
                        <div class="amenity"><i class="fas fa-coffee"></i> Coffee Facilities</div>
                    </div>

                    <button class="select-room-btn" data-room-type="Standard Room" data-price="1900" data-image="{{ asset('rooms/DELUXE ROOM.jpg') }}">Select Room</button>
                </div>
            </div>

            <!-- Single Room -->
            <div class="room-card">
                <div class="room-image-container">
                    <img src="{{ asset('rooms/featured room.jpg') }}" alt="Twin Room" class="room-image">
                    <div class="room-price-tag">₱1,700/night</div>
                </div>
                <div class="room-details">
                    <h3 class="room-name">Single Room</h3>
                    <p class="room-description">Ideal for friends or colleagues, featuring two comfortable single beds with all the essential amenities for a relaxing stay.</p>

                    <div class="room-features">
                        <span class="feature"><i class="fas fa-user-friends"></i> 2 Guests</span>
                        <span class="feature"><i class="fas fa-bed"></i> Twin Beds</span>
                        <span class="feature"><i class="fas fa-ruler-combined"></i> 26m²</span>
                    </div>

                    <div class="room-amenities">
                        <div class="amenity"><i class="fas fa-wifi"></i> Free WiFi</div>
                        <div class="amenity"><i class="fas fa-snowflake"></i> Air Conditioning</div>
                        <div class="amenity"><i class="fas fa-tv"></i> 42" LED TV</div>
                        <div class="amenity"><i class="fas fa-coffee"></i> Coffee Facilities</div>
                    </div>

                    <button class="select-room-btn" data-room-type="Single Room" data-price="1700" data-image="{{ asset('rooms/featured room.jpg') }}">Select Room</button>
                </div>
            </div>
        </div>
    </section>

        <!-- Footer Section -->
        @include('components.footer')

    <!-- Booking Modal -->
    <div class="booking-overlay"></div>
    <div class="booking-modal">
        <div class="booking-content">
            <button class="booking-close-btn" aria-label="Close booking form"><i class="fas fa-times"></i></button>
            <h2>Complete Your Reservation</h2>

            <div class="booking-columns">
                <div class="booking-summary">
                    <div class="summary-header">
                        <h3>Booking Summary</h3>
                        <div class="room-preview-image">
                            <img id="booking-preview-image" src="{{ asset('rooms/room1.jpg') }}" alt="Room Preview">
                        </div>
                    </div>

                    <div class="summary-details">
                        <div class="summary-item">
                            <span class="summary-label"><i class="fas fa-hotel"></i> Room Type:</span>
                            <span class="booking-room-type">Deluxe Room</span>
                        </div>
                        <div class="summary-item">
                            <span class="summary-label"><i class="fas fa-calendar-check"></i> Check-in:</span>
                            <span class="booking-checkin">April 21, 2025</span>
                        </div>
                        <div class="summary-item">
                            <span class="summary-label"><i class="fas fa-calendar-minus"></i> Check-out:</span>
                            <span class="booking-checkout">April 24, 2025</span>
                        </div>
                        <div class="summary-item">
                            <span class="summary-label"><i class="fas fa-tag"></i> Room Rate:</span>
                            <span class="booking-price">₱2,500/night</span>
                        </div>
                        <div class="summary-item">
                            <span class="summary-label"><i class="fas fa-moon"></i> Length of Stay:</span>
                            <span><span class="booking-nights">3</span> nights</span>
                        </div>
                    </div>

                    <div class="summary-total">
                        <span class="summary-label">Total Amount:</span>
                        <span class="booking-total">₱7,500</span>
                    </div>

                    <div class="booking-perks">
                        <h4>Included in Your Stay</h4>
                        <ul class="perks-list">
                            <li><i class="fas fa-wifi"></i> Free High-Speed WiFi</li>
                            <li><i class="fas fa-coffee"></i> Complimentary Breakfast</li>
                            <li><i class="fas fa-concierge-bell"></i> Daily Housekeeping</li>
                            <li><i class="fas fa-parking"></i> Free Parking</li>
                        </ul>
                    </div>
                </div>

                <form id="booking-form" class="booking-form" method="POST" action="{{ route('room.booking') }}">
                    @csrf
                    <h3>Guest Information</h3>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="guest-first-name">First Name <span class="required">*</span></label>
                            <input type="text" id="guest-first-name" name="guest_first_name" required>
                            @error('guest_first_name')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="guest-last-name">Last Name <span class="required">*</span></label>
                            <input type="text" id="guest-last-name" name="guest_last_name" required>
                            @error('guest_last_name')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="guest-email">Email Address <span class="required">*</span></label>
                            <input type="email" id="guest-email" name="guest_email" required>
                            <small class="form-hint">We'll send your booking confirmation here</small>
                            @error('guest_email')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="guest-phone">Phone Number <span class="required">*</span></label>
                            <div class="phone-input-wrapper">
                                <span class="country-code">+63</span>
                                <input type="tel" id="guest-phone" name="guest_phone" placeholder="9XX XXX XXXX" required>
                            </div>
                            @error('guest_phone')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <input type="hidden" name="room_type" id="booking-room-type">
                    <input type="hidden" name="check_in" id="booking-check-in">
                    <input type="hidden" name="check_out" id="booking-check-out">
                    <input type="hidden" name="room_price" id="booking-room-price">
                    <input type="hidden" name="total_price" id="booking-total-price">

                    <div class="form-group">
                        <label for="special-requests">Special Requests</label>
                        <textarea id="special-requests" name="special_requests" rows="3" placeholder="Let us know if you have any special requests or requirements for your stay"></textarea>
                        @error('special_requests')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group payment-notice">
                        <div class="payment-message">
                            <i class="fas fa-info-circle"></i>
                            <div class="payment-text">
                                <strong>Payment Information:</strong>
                                <span>Payment will be collected at the hotel during check-in. We accept cash, credit cards, and digital payment methods.</span>
                            </div>
                        </div>
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

                    <div class="form-actions">
                        <button type="button" class="booking-back-btn"><i class="fas fa-arrow-left"></i> Back</button>
                        <button type="submit" class="booking-submit-btn">Complete Reservation <i class="fas fa-arrow-right"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Confirmation Popup -->
    <div class="confirmation-popup">
        <div class="confirmation-content">
            <button class="confirmation-close-btn"><i class="fas fa-times"></i></button>
            <div class="confirmation-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <h2>Booking Confirmed!</h2>
            <p class="booking-id">Booking ID: SGI-20250421-DEL123</p>

            <div class="confirmation-details">
                <div class="confirmation-item">
                    <span class="confirmation-label">Room:</span>
                    <span class="confirm-room">Deluxe Room</span>
                </div>
                <div class="confirmation-item">
                    <span class="confirmation-label">Check-in:</span>
                    <span class="confirm-checkin">April 21, 2025</span>
                </div>
                <div class="confirmation-item">
                    <span class="confirmation-label">Check-out:</span>
                    <span class="confirm-checkout">April 24, 2025</span>
                </div>
                <div class="confirmation-item">
                    <span class="confirmation-label">Rate:</span>
                    <span class="confirm-price">₱2,500/night</span>
                </div>
            </div>

            <p class="confirmation-message">Thank you for choosing Southgate Inn. We have sent a confirmation email with all the details of your reservation. We look forward to welcoming you!</p>

            <div class="confirmation-actions">
                <button class="confirmation-btn secondary-btn">
                    Continue exploring
                </button>
            </div>
        </div>
    </div>

    <!-- Terms and Conditions Popup -->
    <div id="termsPopup">
        <div class="terms-popup-content">
            <button class="terms-close" onclick="hideTermsPopup()"><i class="fas fa-times"></i></button>
            <h2 class="terms-popup-title">Terms and Conditions</h2>

            <div class="terms-popup-body">
                <section class="terms-popup-section">
                    <h3>1. Booking and Reservation Policy</h3>
                    <p>1.1. All reservations must be guaranteed with a valid credit card or by advance payment.</p>
                    <p>1.2. Rates are quoted per room per night, and are subject to availability and seasonal variations.</p>
                    <p>1.3. Room rates include accommodations for the specified number of guests. Additional guests may be subject to extra charges.</p>
                    <p>1.4. Reservations are confirmed upon receipt of a confirmation number or email from Southgate Inn.</p>
                </section>

                <section class="terms-popup-section">
                    <h3>2. Check-in and Check-out</h3>
                    <p>2.1. Standard check-in time is 2:00 PM and check-out time is 12:00 PM.</p>
                    <p>2.2. Early check-in and late check-out are subject to availability and may incur additional charges.</p>
                    <p>2.3. A valid government-issued photo ID is required at check-in.</p>
                </section>

                <section class="terms-popup-section">
                    <h3>3. Cancellation and Modification Policy</h3>
                    <p>3.1. Cancellations must be made at least 24 hours prior to the scheduled arrival date to avoid charges.</p>
                    <p>3.2. Cancellations made less than 24 hours before arrival will incur a charge equivalent to one night's stay.</p>
                    <p>3.3. No-shows will be charged for the first night of the reservation.</p>
                    <p>3.4. Modifications to reservations are subject to availability and may result in rate changes.</p>
                </section>

                <section class="terms-popup-section">
                    <h3>4. Payment Policy</h3>
                    <p>4.1. Full payment is due upon check-in.</p>
                    <p>4.2. We accept major credit cards, cash, and select digital payment methods.</p>
                    <p>4.3. A credit card authorization or cash deposit may be required upon check-in for incidentals.</p>
                </section>

                <section class="terms-popup-section">
                    <h3>5. Hotel Policies</h3>
                    <p>5.1. Southgate Inn is a non-smoking establishment. Smoking in rooms will result in a cleaning fee.</p>
                    <p>5.2. Pets are not allowed, with the exception of service animals.</p>
                    <p>5.3. Guests are liable for any damage caused to hotel property during their stay.</p>
                    <p>5.4. The hotel reserves the right to refuse service to anyone for legitimate reasons.</p>
                </section>

                <section class="terms-popup-section">
                    <h3>6. Privacy Policy</h3>
                    <p>6.1. Personal information collected during the reservation process is used solely for the purpose of processing and managing your booking.</p>
                    <p>6.2. We do not sell, share, or distribute your personal information to third parties except as necessary to provide the requested services.</p>
                </section>

                <section class="terms-popup-section">
                    <h3>7. General Provisions</h3>
                    <p>7.1. These terms and conditions are subject to change without notice.</p>
                    <p>7.2. By making a reservation at Southgate Inn, you agree to abide by all terms and policies in effect at the time of your stay.</p>
                </section>
            </div>

            <div class="terms-popup-footer">
                <span class="terms-date">Last updated: May 15, 2024</span>
                <button class="terms-accept-btn" onclick="acceptTerms()">I Understand and Accept</button>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="{{ asset('js/navbar.js') }}"></script>
    <script src="{{ asset('js/room.js') }}"></script>

    <script>
        // Direct inline scripts for terms modal to ensure it works
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

    @if($autoOpen == 'true' && $roomType)
    <script>
        // Pass PHP variables to JavaScript
        document.addEventListener('DOMContentLoaded', function() {
            const roomData = {
                name: "{{ $roomType }}",
                price: "₱{{ $price }}/night",
                image: "{{ asset('rooms/DELUXE ROOM.jpg') }}" // Use a default image or modify as needed
            };

            const checkIn = "{{ $checkIn }}";
            const checkOut = "{{ $checkOut }}";
            const checkInDate = new Date(checkIn);
            const checkOutDate = new Date(checkOut);

            // Use provided duration if available, otherwise calculate it
            let duration = {{ $duration ? (int)preg_replace('/[^0-9]/', '', $duration) : 3 }};
            if (!duration && checkInDate && checkOutDate && !isNaN(checkInDate) && !isNaN(checkOutDate)) {
                duration = Math.floor((checkOutDate - checkInDate) / (1000 * 60 * 60 * 24));
            }

            // Ensure  na may valid duration (at least 1 night)
            duration = duration || 1;

            // Delay to ensure the DOM is fully loaded
            setTimeout(() => {
                if (typeof showRoomModal === 'function') {
                    showRoomModal(roomData, checkInDate, checkOutDate, duration);
                }
            }, 700);
        });
    </script>
    @endif
</body>
</html>
