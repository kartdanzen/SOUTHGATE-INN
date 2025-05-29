// Room Booking Functions
document.addEventListener('DOMContentLoaded', function() {
    // Utility Functions for Date Formatting
    const formatDate = (date) => {
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    };

    // Reset date inputs to current date
    function resetDateInputs() {
        const checkInInput = document.getElementById('check-in');
        const checkOutInput = document.getElementById('check-out');

        if (checkInInput && checkOutInput) {
            // Get fresh current date to ensure it's today
            const currentDate = new Date();
            const nextDate = new Date(currentDate);
            nextDate.setDate(currentDate.getDate() + 3);

            // Set check-in to today
            checkInInput.value = formatDate(currentDate);
            checkInInput.min = formatDate(currentDate);

            // Set check-out to today + 3
            checkOutInput.value = formatDate(nextDate);

            // Set check-out minimum to tomorrow
            const tomorrow = new Date(currentDate);
            tomorrow.setDate(currentDate.getDate() + 1);
            checkOutInput.min = formatDate(tomorrow);
        }
    }

    // Reset dates on page load
    resetDateInputs();

    // Set up event listener for check-in date changes
    const checkInInput = document.getElementById('check-in');
    const checkOutInput = document.getElementById('check-out');

    if (checkInInput && checkOutInput) {
        checkInInput.addEventListener('change', function() {
            const checkInDate = new Date(this.value);
            const nextDay = new Date(checkInDate);
            nextDay.setDate(checkInDate.getDate() + 1);

            // Update minimum checkout date
            checkOutInput.min = formatDate(nextDay);

            // If current checkout date is now invalid, update it
            if (new Date(checkOutInput.value) <= checkInDate) {
                checkOutInput.value = formatDate(nextDay);
            }
        });
    }

    // Room availability popup
    const bookingForm = document.getElementById('booking-form');
    const availabilityPopup = document.getElementById('availability-popup');
    const popupClose = document.getElementById('popup-close');
    const availableRoomsContainer = document.querySelector('.available-rooms');

    // Sample room data
    const roomsData = [
        {
            name: "Standard Room",
            price: "₱1,900/night",
            image: "rooms/DELUXE ROOM.jpg",
            features: "1 Queen Bed • Free WiFi • Air Conditioning",
            link: "/room?type=standard"
        },
        {
            name: "Deluxe Room",
            price: "₱2,400/night",
            image: "rooms/featured room.jpg",
            features: "1 King Bed • Free WiFi • Air Conditioning • City View",
            link: "/room?type=deluxe"
        },
        {
            name: "Suite Room",
            price: "₱3,100/night",
            image: "rooms/room1.jpg",
            features: "2 Queen Beds • Free WiFi • Air Conditioning • Bathtub",
            link: "/room?type=family"
        },
        {
            name: "Superior Room",
            price: "₱2,700/night",
            image: "rooms/room3.jpg",
            features: "1 Queen Bed • Free WiFi • Air Conditioning • Bathtub • City View",
            link: "/room?type=superior"
        },
        {
            name: "Family Deluxe",
            price: "₱2,500/night",
            image: "rooms/DELUXE ROOM.jpg",
            features: "1 Queen Bed • Free WiFi • Air Conditioning",
            link: "/room?type=family deluxe"
        },
        {
            name: "Single Room",
            price: "₱1,700/night",
            image: "rooms/room4.jpg",
            features: "1 Single Bed • Free WiFi • Air Conditioning • TV",
            link: "/room?type=single"
        }
    ];

    // Helper function to generate amenity icons
    function generateAmenityIcons(featuresString) {
        const features = featuresString.split('•').map(f => f.trim()).filter(f => f);
        let iconsHTML = '';

        features.forEach(feature => {
            let icon = 'fa-star';

            if (feature.includes('Queen Bed') || feature.includes('King Bed')) {
                icon = 'fa-bed';
            } else if (feature.includes('WiFi')) {
                icon = 'fa-wifi';
            } else if (feature.includes('Air Conditioning')) {
                icon = 'fa-snowflake';
            } else if (feature.includes('City View')) {
                icon = 'fa-city';
            } else if (feature.includes('Bathtub') || feature.includes('Jacuzzi')) {
                icon = 'fa-bath';
            }

            iconsHTML += `<div class="amenity"><i class="fas ${icon}"></i>${feature}</div>`;
        });

        return iconsHTML;
    }

    function generateRoomCards() {
        availableRoomsContainer.innerHTML = '';

        // Calculate stay duration
        const checkIn = new Date(document.getElementById('check-in').value);
        const checkOut = new Date(document.getElementById('check-out').value);
        const stayDuration = Math.floor((checkOut - checkIn) / (1000 * 60 * 60 * 24));

        // Simulate checking room availability based on dates
        const isWeekend = checkIn.getDay() === 0 || checkIn.getDay() === 6;
        const noRoomsAvailable = isWeekend;

        if (noRoomsAvailable) {
            // Display no availability message
            const noRoomsMessage = document.createElement('div');
            noRoomsMessage.className = 'no-rooms-message';
            noRoomsMessage.innerHTML = `
                <i class="fas fa-calendar-times"></i>
                <p>We're sorry, no rooms are available for the selected dates. Please try another date.</p>
                <button class="try-other-dates" id="try-other-dates">Try Different Dates</button>
            `;
            availableRoomsContainer.appendChild(noRoomsMessage);

            // Add event listener to the button
            setTimeout(() => {
                document.getElementById('try-other-dates').addEventListener('click', function() {
                    availabilityPopup.classList.remove('active');
                    document.body.classList.remove('menu-open');
                    // Focus on the check-in date input
                    setTimeout(() => {
                        document.getElementById('check-in').focus();
                    }, 400);
                });
            }, 0);

            return;
        }

        // Filter available rooms
        roomsData.forEach(room => {
            const roomCard = document.createElement('div');
            roomCard.className = 'room-card';

            roomCard.innerHTML = `
                <a href="${room.link}" class="room-image-link">
                    <img src="${room.image}" alt="${room.name}" class="room-image">
                </a>
                <div class="room-details">
                    <h3 class="room-name">${room.name}</h3>
                    <div class="room-price">
                        <span>₱${parseInt(room.price.replace(/[^\d]/g, '')).toLocaleString()}<span class="night-rate">/night</span></span>
                        <span class="total-price">Total: ₱${(parseInt(room.price.replace(/[^\d]/g, '')) * stayDuration).toLocaleString()}</span>
                    </div>
                    <div class="room-features">
                        ${generateAmenityIcons(room.features)}
                    </div>
                    <a href="${room.link}" class="room-select"><i class="fas fa-check-circle"></i> SELECT ROOM</a>
                </div>
            `;

            availableRoomsContainer.appendChild(roomCard);
        });
    }

    if (bookingForm) {
        bookingForm.addEventListener('submit', function(e) {
            e.preventDefault();

            // Get form data
            const formData = new FormData(this);

            // Submit form using fetch
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    // Clear previous room cards
                    availableRoomsContainer.innerHTML = '';

                    // Add available rooms to the popup
                    data.available_rooms.forEach(room => {
                        const roomCard = document.createElement('div');
                        roomCard.className = 'room-card';

                        // Create a proper URL-friendly room type for routing
                        let roomType = room.name.toLowerCase().replace(/\s+/g, '-');

                        // Handle specific room types to match expected URL patterns
                        if (room.name === 'Family Deluxe') {
                            roomType = 'family';
                        } else if (room.name === 'Standard Room') {
                            roomType = 'standard';
                        } else if (room.name === 'Suite Room') {
                            roomType = 'suite';
                        } else if (room.name === 'Deluxe Room') {
                            roomType = 'deluxe';
                        } else if (room.name === 'Single Room') {
                            roomType = 'single';
                        } else if (room.name === 'Superior Room') {
                            roomType = 'superior';
                        }

                        const roomLink = `/room?type=${roomType}`;

                        roomCard.innerHTML =
                            '<a href="' + roomLink + '" class="room-image-link">' +
                                '<img src="' + room.image + '" alt="' + room.name + '" class="room-image">' +
                            '</a>' +
                            '<div class="room-details">' +
                                '<h3 class="room-name">' + room.name + '</h3>' +
                                '<div class="room-price">' +
                                    '<span>' + room.price + '<span class="night-rate">/night</span></span>' +
                                '</div>' +
                                '<div class="room-features">' +
                                    room.features.map(feature =>
                                        '<div class="amenity"><i class="fas fa-check"></i>' + feature + '</div>'
                                    ).join('') +
                                '</div>' +
                                '<a href="' + roomLink + '" class="room-select">' +
                                    '<i class="fas fa-check-circle"></i> SELECT ROOM' +
                                '</a>' +
                            '</div>';

                        availableRoomsContainer.appendChild(roomCard);
                    });

                    // Show the popup
                    availabilityPopup.classList.add('active');
                    document.body.classList.add('menu-open');
                } else {
                    // Show error message
                    alert(data.message || 'An error occurred while checking availability.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while checking availability. Please try again.');
            });
        });
    }

    if (popupClose) {
        popupClose.addEventListener('click', function() {
            availabilityPopup.classList.remove('active');
            document.body.classList.remove('menu-open');
        });
    }

    // Close popup when clicking outside of it
    if (availabilityPopup) {
        availabilityPopup.addEventListener('click', function(e) {
            if (e.target === availabilityPopup) {
                availabilityPopup.classList.remove('active');
                document.body.classList.remove('menu-open');
            }
        });
    }

    // Room Selection Modal
    const roomModal = document.getElementById('room-selection-modal');
    const modalClose = document.getElementById('modal-close');
    const modalRoomType = document.getElementById('modal-room-type');
    const modalCheckin = document.getElementById('modal-checkin');
    const modalCheckout = document.getElementById('modal-checkout');
    const modalDuration = document.getElementById('modal-duration');
    const modalPrice = document.getElementById('modal-price');
    const modalRoomImage = document.getElementById('modal-room-image');
    const proceedBtn = document.getElementById('proceed-btn');
    const viewOtherBtn = document.getElementById('view-other-btn');
    const cancelBtn = document.getElementById('cancel-btn');

    // Room details data
    const roomDetailsData = {
        "Deluxe Room": {
            image: "rooms/DELUXE ROOM.jpg",
            price: "₱2,400/night",
            description: "Spacious and elegant room with modern amenities and stunning views of the city. Our Deluxe Rooms are perfect for travelers seeking comfort and style during their stay. Each room features premium bedding, a work desk, and a seating area where you can relax after a day of exploring.",
            capacity: "2 Guests",
            bed: "1 King Bed",
            size: "35 m²",
            view: "City View",
            amenities: [
                {icon: "fas fa-wifi", name: "Free High-Speed WiFi"},
                {icon: "fas fa-snowflake", name: "Air Conditioning"},
                {icon: "fas fa-tv", name: "42\" Smart TV"},
                {icon: "fas fa-coffee", name: "Coffee Machine"},
                {icon: "fas fa-bath", name: "En-Suite Bathroom"},
                {icon: "fas fa-shower", name: "Rainfall Shower"},
                {icon: "fas fa-concierge-bell", name: "Room Service"},
                {icon: "fas fa-phone-alt", name: "Direct Dial Phone"},
                {icon: "fas fa-lock", name: "In-Room Safe"},
                {icon: "fas fa-tshirt", name: "Ironing Facilities"}
            ]
        },
        "Family Deluxe": {
            image: "rooms/featured room.jpg",
            price: "₱2,500/night",
            description: "Specially designed for families, our Family Suite offers ample space and comfort for both parents and children. The suite features a master bedroom with a queen bed and a separate area with twin beds, making it perfect for a family getaway. Enjoy quality time together in the spacious living area with comfortable seating and entertainment options.",
            capacity: "4 Guests",
            bed: "1 Queen Bed + 2 Twin Beds",
            size: "45 m²",
            view: "Garden View",
            amenities: [
                {icon: "fas fa-wifi", name: "Free High-Speed WiFi"},
                {icon: "fas fa-snowflake", name: "Air Conditioning"},
                {icon: "fas fa-tv", name: "Two 42\" Smart TVs"},
                {icon: "fas fa-bath", name: "Bathtub & Shower"},
                {icon: "fas fa-couch", name: "Separate Living Area"},
                {icon: "fas fa-utensils", name: "Mini Kitchenette"},
                {icon: "fas fa-concierge-bell", name: "Room Service"},
                {icon: "fas fa-baby", name: "Baby Crib Available"},
                {icon: "fas fa-lock", name: "In-Room Safe"},
                {icon: "fas fa-gamepad", name: "Games & Activities"}
            ]
        },

     "Standard Room": {
        image: "rooms/featured room.jpg",
        price: "₱1,900/night",
        description: "Specially designed for families, our Family Suite offers ample space and comfort for both parents and children. The suite features a master bedroom with a queen bed and a separate area with twin beds, making it perfect for a family getaway. Enjoy quality time together in the spacious living area with comfortable seating and entertainment options.",
        capacity: "4 Guests",
        bed: "1 Queen Bed + 2 Twin Beds",
        size: "45 m²",
        view: "Garden View",
        amenities: [
            {icon: "fas fa-wifi", name: "Free High-Speed WiFi"},
            {icon: "fas fa-snowflake", name: "Air Conditioning"},
            {icon: "fas fa-tv", name: "Two 42\" Smart TVs"},
            {icon: "fas fa-bath", name: "Bathtub & Shower"},
            {icon: "fas fa-couch", name: "Separate Living Area"},
            {icon: "fas fa-utensils", name: "Mini Kitchenette"},
            {icon: "fas fa-concierge-bell", name: "Room Service"},
            {icon: "fas fa-baby", name: "Baby Crib Available"},
            {icon: "fas fa-lock", name: "In-Room Safe"},
            {icon: "fas fa-gamepad", name: "Games & Activities"}
        ]
    },
        "Suite Room": {
            image: "rooms/room1.jpg",
            price: "₱3,100/night",
            description: "Experience luxury living in our Executive Suite, designed for discerning travelers who appreciate elegant surroundings and premium amenities. This spacious suite features a separate bedroom and living area, allowing you to work, relax, and entertain in complete comfort. Floor-to-ceiling windows offer breathtaking panoramic views of the city skyline.",
            capacity: "2 Guests",
            bed: "1 King Bed",
            size: "55 m²",
            view: "Panoramic City View",
            amenities: [
                {icon: "fas fa-wifi", name: "Premium WiFi"},
                {icon: "fas fa-bath", name: "Luxury Bathroom"},
                {icon: "fas fa-glass-martini-alt", name: "Complimentary Mini Bar"},
                {icon: "fas fa-tv", name: "55\" Smart TV"},
                {icon: "fas fa-spa", name: "Premium Toiletries"},
                {icon: "fas fa-concierge-bell", name: "24/7 Butler Service"},
                {icon: "fas fa-coffee", name: "Espresso Machine"},
                {icon: "fas fa-briefcase", name: "Executive Work Desk"},
                {icon: "fas fa-utensils", name: "Dining Area"},
            ]
        },
        "Superior Room": {
            image: "rooms/room3.jpg",
            price: "₱2,700/night",
            description: "Our Superior Rooms offer an elevated experience with premium amenities and thoughtful design. These spacious rooms feature elegant furnishings, a comfortable queen bed, and a private bathroom with bathtub. Perfect for couples or business travelers seeking extra comfort and style.",
            capacity: "2 Guests",
            bed: "1 Queen Bed",
            size: "30 m²",
            view: "City View",
            amenities: [
                {icon: "fas fa-wifi", name: "Free High-Speed WiFi"},
                {icon: "fas fa-snowflake", name: "Air Conditioning"},
                {icon: "fas fa-tv", name: "40\" Smart TV"},
                {icon: "fas fa-coffee", name: "Coffee Maker"},
                {icon: "fas fa-bath", name: "Bathtub"},
                {icon: "fas fa-shower", name: "Rainfall Shower"},
                {icon: "fas fa-concierge-bell", name: "Room Service"},
                {icon: "fas fa-phone-alt", name: "Direct Dial Phone"},
                {icon: "fas fa-lock", name: "In-Room Safe"},
                {icon: "fas fa-tshirt", name: "Ironing Facilities"}
            ]
        },
        "Single Room": {
            image: "rooms/room4.jpg",
            price: "₱1,700/night",
            description: "Perfect for solo travelers, our Single Rooms provide all the essential amenities in a compact, comfortable space. Each room features a cozy single bed, modern furnishings, and a private bathroom. Ideal for business travelers or those seeking an affordable yet comfortable stay.",
            capacity: "1 Guest",
            bed: "1 Single Bed",
            size: "20 m²",
            view: "City View",
            amenities: [
                {icon: "fas fa-wifi", name: "Free WiFi"},
                {icon: "fas fa-snowflake", name: "Air Conditioning"},
                {icon: "fas fa-tv", name: "32\" TV"},
                {icon: "fas fa-coffee", name: "Tea/Coffee Maker"},
                {icon: "fas fa-bath", name: "Private Bathroom"},
                {icon: "fas fa-shower", name: "Shower"},
                {icon: "fas fa-concierge-bell", name: "Room Service"},
                {icon: "fas fa-phone-alt", name: "Direct Dial Phone"},
                {icon: "fas fa-lock", name: "In-Room Safe"},
                {icon: "fas fa-tshirt", name: "Ironing Facilities"}
            ]
        }
    };

    // Function to show the modal with the selected room details
    function showRoomModal(roomData, checkIn, checkOut, duration) {
        // Format dates for display
        const checkInDate = new Date(checkIn);
        const checkOutDate = new Date(checkOut);
        const formattedCheckIn = checkInDate.toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
        const formattedCheckOut = checkOutDate.toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });

        // Calculate total price
        const price = parseInt(roomData.price.replace(/[^\d]/g, ''));
        const totalPrice = price * duration;

        // Update modal content
        modalRoomType.textContent = roomData.name;
        modalCheckin.textContent = formattedCheckIn;
        modalCheckout.textContent = formattedCheckOut;
        modalDuration.textContent = `${duration} Night${duration > 1 ? 's' : ''}`;
        modalPrice.textContent = `₱${totalPrice.toLocaleString()}`;

        // Update room image
        if (roomDetailsData[roomData.name] && roomDetailsData[roomData.name].image) {
            modalRoomImage.src = roomDetailsData[roomData.name].image;
        }

        // Set room highlight tag based on room type
        const highlightTag = document.querySelector('.room-highlight-tag');
        if (highlightTag) {
            if (roomData.name === 'Deluxe Room') {
                highlightTag.textContent = 'Most Popular';
                highlightTag.style.background = 'linear-gradient(135deg, #ff6b6b, #ff9e7d)';
            } else if (roomData.name === 'Family Suite') {
                highlightTag.textContent = 'Family Favorite';
                highlightTag.style.background = 'linear-gradient(135deg, #4facfe, #00f2fe)';
            } else if (roomData.name === 'Executive Suite') {
                highlightTag.textContent = 'Premium Choice';
                highlightTag.style.background = 'linear-gradient(135deg, #f6d365, #fda085)';
            }
        }

        // Update feature badges based on room type
        const featuresGrid = document.querySelector('.room-features-grid');
        if (featuresGrid && roomDetailsData[roomData.name]) {
            // Clear existing features
            featuresGrid.innerHTML = '';

            // Get top 4 amenities for this room type
            const topAmenities = roomDetailsData[roomData.name].amenities.slice(0, 4);

            // Add each amenity as a feature badge
            topAmenities.forEach(amenity => {
                const featureBadge = document.createElement('div');
                featureBadge.className = 'feature-badge';
                featureBadge.innerHTML = `<i class="${amenity.icon}"></i> ${amenity.name}`;
                featuresGrid.appendChild(featureBadge);
            });
        }

        // Show modal with animation
        roomModal.classList.add('active');
        document.body.classList.add('menu-open');
    }

    // Close modal functions
    function closeRoomModal() {
        roomModal.classList.remove('active');
        document.body.classList.remove('menu-open');
    }

    if (modalClose) {
        modalClose.addEventListener('click', closeRoomModal);
    }

    if (cancelBtn) {
        cancelBtn.addEventListener('click', closeRoomModal);
    }

    // Redirect buttons
    if (proceedBtn) {
        proceedBtn.addEventListener('click', function() {
            const roomType = modalRoomType.textContent;
            const checkIn = modalCheckin.textContent;
            const checkOut = modalCheckout.textContent;
            const duration = modalDuration.textContent;

            // Get the per-night price from the room details data
            let nightlyPrice = 0;
            if (roomDetailsData[roomType]) {
                nightlyPrice = parseInt(roomDetailsData[roomType].price.replace(/[^\d]/g, ''));
            }

            // Get the total price from the modal
            const totalPrice = modalPrice.textContent.replace(/[^\d]/g, '');

            // Encode parameters
            const params = new URLSearchParams({
                roomType: roomType,
                checkIn: checkIn,
                checkOut: checkOut,
                duration: duration,
                nightlyPrice: nightlyPrice,
                totalPrice: totalPrice,
                autoOpen: 'true'
            });

            // Redirect to room route with parameters
            window.location.href = `/room?${params.toString()}`;
        });
    }

    if (viewOtherBtn) {
        viewOtherBtn.addEventListener('click', function() {
            window.location.href = '/room';
        });
    }

    // Handle room selection from popup
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('room-select') || e.target.closest('.room-select')) {
            e.preventDefault();

            // Find the room card that was clicked
            const roomCard = e.target.closest('.room-card');
            if (!roomCard) return;

            // Find which room was clicked from our data
            const roomName = roomCard.querySelector('.room-name').textContent;
            const selectedRoom = roomsData.find(room => room.name === roomName);

            // Get current check-in/out dates
            const checkIn = document.getElementById('check-in').value;
            const checkOut = document.getElementById('check-out').value;

            // Calculate duration
            const checkInDate = new Date(checkIn);
            const checkOutDate = new Date(checkOut);
            const duration = Math.floor((checkOutDate - checkInDate) / (1000 * 60 * 60 * 24));

            // Show the modal
            showRoomModal(selectedRoom, checkIn, checkOut, duration);
        }
    });

    // Close modal when clicking outside
    if (roomModal) {
        roomModal.addEventListener('click', function(e) {
            if (e.target === roomModal) {
                closeRoomModal();
            }
        });
    }

    // Room Details Popup
    const roomDetailsPopup = document.getElementById('room-details-popup');
    const detailsPopupClose = document.getElementById('details-popup-close');
    const popupRoomImage = document.getElementById('popup-room-image');
    const popupRoomTitle = document.getElementById('popup-room-title');
    const popupRoomPrice = document.getElementById('popup-room-price');
    const popupRoomDescription = document.getElementById('popup-room-description');
    const popupRoomCapacity = document.getElementById('popup-room-capacity');
    const popupRoomBed = document.getElementById('popup-room-bed');
    const popupRoomSize = document.getElementById('popup-room-size');
    const popupRoomAmenities = document.getElementById('popup-room-amenities');
    const popupBookNow = document.getElementById('popup-book-now');

    function showRoomDetails(roomName) {
        const roomData = roomDetailsData[roomName];
        if (!roomData) return;

        // Update popup content
        popupRoomImage.src = roomData.image;
        popupRoomTitle.textContent = roomName;
        popupRoomPrice.textContent = roomData.price;
        popupRoomDescription.textContent = roomData.description;
        popupRoomCapacity.textContent = roomData.capacity;
        popupRoomBed.textContent = roomData.bed;
        popupRoomSize.textContent = roomData.size;

        // Generate amenities
        popupRoomAmenities.innerHTML = '';
        roomData.amenities.forEach(amenity => {
            const amenityElement = document.createElement('div');
            amenityElement.className = 'room-details-amenity';
            amenityElement.innerHTML = `<i class="${amenity.icon}"></i> ${amenity.name}`;
            popupRoomAmenities.appendChild(amenityElement);
        });

        // Show popup
        roomDetailsPopup.classList.add('active');
        document.body.classList.add('menu-open');
    }

    // Close room details popup
    function closeRoomDetails() {
        roomDetailsPopup.classList.remove('active');
        document.body.classList.remove('menu-open');
    }

    if (detailsPopupClose) {
        detailsPopupClose.addEventListener('click', closeRoomDetails);
    }

    // Close popup when clicking outside
    if (roomDetailsPopup) {
        roomDetailsPopup.addEventListener('click', function(e) {
            if (e.target === roomDetailsPopup) {
                closeRoomDetails();
            }
        });
    }

    // Book Now button in popup
    if (popupBookNow) {
        popupBookNow.addEventListener('click', function() {
            // Get room name
            const roomName = popupRoomTitle.textContent;
            const roomData = roomsData.find(room => room.name === roomName) || {
                name: roomName,
                price: popupRoomPrice.textContent
            };

            // Close details popup
            closeRoomDetails();

            // Show booking modal
            const checkIn = document.getElementById('check-in').value;
            const checkOut = document.getElementById('check-out').value;
            const checkInDate = new Date(checkIn);
            const checkOutDate = new Date(checkOut);
            const duration = Math.floor((checkOutDate - checkInDate) / (1000 * 60 * 60 * 24)) || 3;

            showRoomModal(roomData, checkIn, checkOut, duration);
        });
    }

    // Handle view details button clicks
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('view-room-btn') || e.target.closest('.view-room-btn')) {
            e.preventDefault();

            // Find the room card that was clicked
            const roomCard = e.target.closest('.featured-room');
            if (!roomCard) return;

            // Get room name
            const roomName = roomCard.querySelector('.room-title').textContent;

            // Show room details
            showRoomDetails(roomName);
        }
    });

    // Parse URL parameters to handle room links
    function handleRoomURLParameters() {
        const params = new URLSearchParams(window.location.search);
        const roomType = params.get('type');

        if (roomType) {
            // Match URL parameter to room name
            let roomName;
            switch(roomType) {
                case 'standard':
                    roomName = 'Standard Room';
                    break;
                case 'deluxe':
                    roomName = 'Deluxe Room';
                    break;
                case 'family':
                    roomName = 'Family Suite';
                    break;
                case 'executive':
                    roomName = 'Executive Suite';
                    break;
                case 'superior':
                    roomName = 'Superior Room';
                    break;
                case 'single':
                    roomName = 'Single Room';
                    break;
            }

            // If we have a matching room, show its details
            if (roomName && roomDetailsData[roomName]) {
                // Wait a bit for the DOM to be fully loaded
                setTimeout(() => {
                    showRoomDetails(roomName);
                }, 500);
            }
        }
    }

    // Check for room parameters when page loads
    handleRoomURLParameters();

    // Parallax Effect for Featured Rooms
    const featuredRooms = document.querySelectorAll('.featured-grid .featured-room');
    if (featuredRooms.length >= 3) {
        // Set initial transform for each room
        featuredRooms[0].style.transform = 'translateX(-80px)';
        featuredRooms[1].style.transform = 'translateY(80px)';
        featuredRooms[2].style.transform = 'translateX(80px)';
        featuredRooms[0].style.opacity = '0';
        featuredRooms[1].style.opacity = '0';
        featuredRooms[2].style.opacity = '0';

        // Add transition
        [0,1,2].forEach(i => {
            featuredRooms[i].style.transition = 'transform 1s cubic-bezier(0.22, 1, 0.36, 1), opacity 1s';
        });

        // Intersection Observer to trigger animation
        const observer = new window.IntersectionObserver((entries, obs) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const idx = Array.from(featuredRooms).indexOf(entry.target);
                    entry.target.style.transform = 'translateX(0) translateY(0)';
                    entry.target.style.opacity = '1';
                    obs.unobserve(entry.target);
                }
            });
        }, { threshold: 0.4 });

        [0,1,2].forEach(i => observer.observe(featuredRooms[i]));
    }
});
