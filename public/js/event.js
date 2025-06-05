// Event Types Data
const eventTypes = {
    wedding: {
        image: "images/wedding.jpg",
        title: "Elegant Weddings",
        price: "Starting at ₱75,000",
        description: "Create magical memories with our comprehensive wedding packages, including venue decoration, gourmet catering, and dedicated wedding coordinator to handle every detail.",
        features: [
            "Venue rental for 8 hours",
            "Dedicated wedding coordinator",
            "Professional decoration setup",
            "Full sound and lighting system",
            "Customizable menu options",
            "Champagne toast for all guests",
            "Wedding cake service",
            "Professional waitstaff",
            "Bride's room for preparation",
            "Free parking for all guests"
        ]
    },
    birthday: {
        image: "images/corporate.jpg",
        title: "Birthday Celebration",
        price: "Starting at ₱25,000",
        description: "Make your birthday celebration unforgettable! Our birthday package includes themed decorations, a custom cake, and personalized menu options. Perfect for all ages, from children's birthdays to milestone celebrations.",
        features: [
            "Venue rental for 4 hours",
            "Basic decoration setup",
            "Sound system",
            "Customizable menu options",
            "Birthday cake",
            "Waitstaff",
            "Cleanup services",
            "Free parking"
        ]
    },
    corporate: {
        image: "images/corporate.jpg",
        title: "Corporate Event",
        price: "Starting at ₱35,000",
        description: "Host your business meetings and conferences with us. Our corporate package offers state-of-the-art facilities to ensure your event runs smoothly. From presentations to networking events, we've got you covered.",
        features: [
            "Venue rental for 8 hours",
            "Projector and screen",
            "Wi-Fi access",
            "Sound system",
            "Podium and microphone",
            "Customizable catering options",
            "Technical support",
            "Free parking"
        ]
    },
    reunion: {
        image: "images/events.jpg",
        title: "Family Reunions",
        price: "Starting at ₱40,000",
        description: "Reconnect with friends and family in a cozy atmosphere. Our reunion package is perfect for family gatherings, class reunions, or any occasion that brings people back together. Enjoy customizable catering options to suit everyone's tastes.",
        features: [
            "Venue rental for 5 hours",
            "Basic decoration setup",
            "Sound system",
            "Customizable catering options",
            "Waitstaff",
            "Cleanup services",
            "Special accommodation rates",
            "Free parking"
        ]
    }
};

// Unavailable and limited availability dates
const unavailableDates = [
    "2023-10-15", "2023-10-16", "2023-10-20", "2023-10-25",
    "2023-11-05", "2023-11-10", "2023-11-24", "2023-11-25",
    "2023-12-24", "2023-12-25", "2023-12-31",
    "2024-01-01"
];

const limitedAvailabilityDates = [
    "2023-10-10", "2023-10-22", "2023-10-29",
    "2023-11-12", "2023-11-19", "2023-11-26",
    "2023-12-10", "2023-12-17"
];

// Function to update the form step indicator
function updateFormStep(step) {
    // Update data-step attribute to trigger the CSS progress bar
    const formSteps = document.querySelector('.form-steps');
    if (formSteps) {
        formSteps.setAttribute('data-step', step);

        // Update active class on step indicators
        const steps = formSteps.querySelectorAll('.step');
        steps.forEach((stepEl, index) => {
            if (index + 1 < step) {
                stepEl.classList.add('completed');
                stepEl.classList.remove('active');
            } else if (index + 1 === step) {
                stepEl.classList.add('active');
                stepEl.classList.remove('completed');
            } else {
                stepEl.classList.remove('active', 'completed');
            }
        });
    }
}

// Event Details Popup
function openEventDetails(eventType) {
    const event = eventTypes[eventType];
    if (!event) {
        console.error(`Event type ${eventType} not found in data`);
        return;
    }

    console.log(`Opening event details for: ${eventType}`);
    console.log(`Event image path: ${event.image}`);

    // Get popup elements
    const popup = document.getElementById('eventDetailsPopup');
    const imageContainer = popup.querySelector('.popup-image-container');

    // Set basic content first
    document.getElementById('event-details-title').textContent = event.title;
    document.getElementById('event-details-price').textContent = event.price;
    document.getElementById('event-details-description').textContent = event.description;

    // Clear any existing image and content in the container
    if (imageContainer) {
        // First, set a loading background
        imageContainer.innerHTML = '';
        imageContainer.style.position = 'relative';
        imageContainer.style.backgroundColor = '#f3f3f3';

        // Create a loading indicator
        const loadingEl = document.createElement('div');
        loadingEl.textContent = 'Loading...';
        loadingEl.style.position = 'absolute';
        loadingEl.style.top = '50%';
        loadingEl.style.left = '50%';
        loadingEl.style.transform = 'translate(-50%, -50%)';
        loadingEl.style.color = '#006652';
        loadingEl.style.fontWeight = 'bold';
        imageContainer.appendChild(loadingEl);

        // Add the event type label
        const formattedEventType = eventType.charAt(0).toUpperCase() + eventType.slice(1);
        const labelEl = document.createElement('div');
        labelEl.textContent = formattedEventType;
        labelEl.style.position = 'absolute';
        labelEl.style.top = '15px';
        labelEl.style.right = '15px';
        labelEl.style.backgroundColor = '#006652';
        labelEl.style.color = 'white';
        labelEl.style.padding = '6px 12px';
        labelEl.style.borderRadius = '20px';
        labelEl.style.fontSize = '0.9rem';
        labelEl.style.fontWeight = '600';
        labelEl.style.zIndex = '2';
        labelEl.style.textTransform = 'uppercase';
        labelEl.style.boxShadow = '0 2px 10px rgba(0,0,0,0.2)';
        imageContainer.appendChild(labelEl);

        //  create and add the image
        const image = new Image();

        // Set success handler
        image.onload = function() {
            console.log(`Image loaded successfully: ${this.src}`);

            // Remove loading indicator
            if (loadingEl.parentNode) {
                loadingEl.parentNode.removeChild(loadingEl);
            }

            // Apply image styles
            image.style.width = '100%';
            image.style.height = '100%';
            image.style.objectFit = 'cover';
            image.style.transition = 'transform 0.5s ease';
            image.style.position = 'absolute';
            image.style.top = '0';
            image.style.left = '0';
            image.style.zIndex = '1';

            // Make container background transparent
            imageContainer.style.backgroundColor = 'transparent';

            // Add gradient overlay
            const overlay = document.createElement('div');
            overlay.style.position = 'absolute';
            overlay.style.bottom = '0';
            overlay.style.left = '0';
            overlay.style.width = '100%';
            overlay.style.height = '40%';
            overlay.style.background = 'linear-gradient(to top, rgba(0,0,0,0.5), transparent)';
            overlay.style.zIndex = '2';
            overlay.style.pointerEvents = 'none';
            imageContainer.appendChild(overlay);
        };

        // Set error handler
        image.onerror = function() {
            console.error(`Failed to load image: ${this.src}`);
            this.src = 'images/eventheader.jpg';

            // If error happens again with fallback, show error state
            this.onerror = function() {
                console.error('Failed to load fallback image');
                imageContainer.style.backgroundColor = '#f8d7da';

                if (loadingEl.parentNode) {
                    loadingEl.textContent = 'Image not available';
                    loadingEl.style.color = '#721c24';
                }
            };
        };

        // Set image attributes and add to container
        image.src = event.image;
        image.alt = event.title;
        image.id = 'event-details-image';
        image.className = 'popup-event-img';

        // Debug the image loading
        console.log(`Adding image to container with src: ${image.src}`);
        console.log(`Image container dimensions: ${imageContainer.offsetWidth}x${imageContainer.offsetHeight}`);

        // Make sure the container is visible
        imageContainer.style.display = 'block';
        imageContainer.style.minHeight = '300px';

        imageContainer.appendChild(image);
    } else {
        console.error("Could not find image container in popup");
    }

    // Set the book button with proper styling to ensure it's not cut off
    const bookBtn = document.getElementById('event-details-book');
    bookBtn.setAttribute('data-event', eventType);
    bookBtn.style.width = 'auto';
    bookBtn.style.display = 'inline-block';
    bookBtn.style.padding = '12px 30px';
    bookBtn.style.margin = '10px auto';

    // Set event features
    const featuresList = document.getElementById('event-details-features');
    featuresList.innerHTML = '';

    event.features.forEach(feature => {
        const li = document.createElement('li');
        li.innerHTML = `<i class="fas fa-check-circle"></i> ${feature}`;
        featuresList.appendChild(li);
    });

    // Show the popup with animation
    popup.style.display = 'flex';

    // Use setTimeout to ensure the display: flex is applied first
    setTimeout(() => {
        popup.classList.add('active');
    }, 10);

    // Prevent background scrolling
    document.body.style.overflow = 'hidden';
}

// Close popup
document.addEventListener('DOMContentLoaded', function() {
    console.log("DOM fully loaded - setting up event handlers");

    // Preload all event images
    function preloadEventImages() {
        console.log("Preloading event images...");
        // Get all unique image paths from eventTypes
        const imagePaths = [];
        for (const eventType in eventTypes) {
            if (eventTypes[eventType].image && !imagePaths.includes(eventTypes[eventType].image)) {
                imagePaths.push(eventTypes[eventType].image);
            }
        }

        // Add fallback image
        imagePaths.push('images/eventheader.jpg');

        // Preload each image
        imagePaths.forEach(path => {
            const img = new Image();
            img.onload = function() {
                console.log(`Preloaded image: ${path}`);
            };
            img.onerror = function() {
                console.error(`Failed to preload image: ${path}`);
            };
            img.src = path;
        });
    }

    // Run preload function
    preloadEventImages();

    // Debug image loading capabilities
    const testImage = new Image();
    testImage.onload = function() { console.log("Browser can load images successfully"); };
    testImage.onerror = function() { console.log("Browser has issues loading images"); };
    testImage.src = "images/eventheader.jpg";

    // Check if the popup image container exists
    const imageContainer = document.querySelector('.popup-image-container');
    console.log("Image container on page load:", imageContainer);

    // Close popup when clicking the close button or overlay
    document.querySelectorAll('#event-details-close, .popup-overlay').forEach(element => {
        element.addEventListener('click', () => {
            closeEventDetailsPopup();
        });
    });

    // Book event from popup
    document.getElementById('event-details-book').addEventListener('click', function() {
        const eventType = this.getAttribute('data-event');

        // Update the booking form with the selected event type
        const eventTypeSelect = document.getElementById('eventType');
        if (eventTypeSelect) {
            eventTypeSelect.value = eventType;

            // Trigger change event to ensure the form recognizes the selection
            const changeEvent = new Event('change');
            eventTypeSelect.dispatchEvent(changeEvent);

            console.log('Setting event type from popup to:', eventType);
        }

        // Close the popup
        closeEventDetailsPopup();

        // Scroll to booking form
        document.getElementById('bookingSection').scrollIntoView({ behavior: 'smooth' });
    });

    // Book Now buttons in event cards
    document.querySelectorAll('.event-type-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const eventType = this.getAttribute('data-event-type');

            // Update the booking form with the selected event type
            const eventTypeSelect = document.getElementById('eventType');
            if (eventTypeSelect) {
                eventTypeSelect.value = eventType;
            }

            // Scroll to booking form
            document.getElementById('bookingSection').scrollIntoView({ behavior: 'smooth' });
        });
    });

    // Check Date Availability
    const eventDateInput = document.getElementById('eventDate');
    if (eventDateInput) {
        eventDateInput.addEventListener('change', function() {
            const selectedDate = this.value;
            const today = new Date().toISOString().split('T')[0];
            const dateAlertContainer = document.getElementById('dateAlert');

            // Hide any existing alerts
            dateAlertContainer.style.display = 'none';
            dateAlertContainer.className = 'date-alert';

            // Check if selected date is in the past
            if (selectedDate < today) {
                dateAlertContainer.innerHTML = '<i class="fas fa-exclamation-circle"></i> Please select a future date.';
                dateAlertContainer.classList.add('error');
                dateAlertContainer.style.display = 'block';
                this.value = ''; // Clear the invalid date
                return;
            }

            // Check if date is unavailable
            if (unavailableDates.includes(selectedDate)) {
                dateAlertContainer.innerHTML = '<i class="fas fa-times-circle"></i> This date is already fully booked. Please select another date.';
                dateAlertContainer.classList.add('error');
                dateAlertContainer.style.display = 'block';
                return;
            }

            // Check if date has limited availability
            if (limitedAvailabilityDates.includes(selectedDate)) {
                dateAlertContainer.innerHTML = '<i class="fas fa-exclamation-triangle"></i> This date has limited availability. Please book soon to secure your spot.';
                dateAlertContainer.classList.add('warning');
                dateAlertContainer.style.display = 'block';
                return;
            }
        });
    }

    // Phone number validation (Philippine format)
    const phoneInput = document.getElementById('phoneNumber');
    if (phoneInput) {
        phoneInput.addEventListener('input', function(e) {
            // Remove the listener temporarily to prevent infinite loop
            const currentValue = this.value;

            // Store cursor position
            const cursorPos = this.selectionStart;

            // Remove all non-numeric characters for processing
            let plainNumber = currentValue.replace(/\D/g, '');

            // Don't format if empty
            if (plainNumber.length === 0) {
                return;
            }

            // If user is trying to enter a number and it's starting with 63, strip it
            // to avoid double +63 prefix
            if (plainNumber.startsWith('63')) {
                plainNumber = plainNumber.substring(2);
            }

            // Format the number
            let formattedNumber = '';

            // Add the Philippine country code if needed
            if (plainNumber.length > 0) {
                formattedNumber = '+63 ';

                // Format the rest of the number
                if (plainNumber.length <= 3) {
                    formattedNumber += plainNumber;
                } else if (plainNumber.length <= 6) {
                    formattedNumber += plainNumber.substring(0, 3) + ' ' + plainNumber.substring(3);
                } else {
                    formattedNumber += plainNumber.substring(0, 3) + ' ' +
                                       plainNumber.substring(3, 6) + ' ' +
                                       plainNumber.substring(6, 10);
                }
            }

            // Only update if the format actually changed
            if (formattedNumber !== currentValue) {
                this.value = formattedNumber;

                // Try to adjust cursor position intelligently
                // This is approximate since the formatting changes the string length
                let newCursorPos = cursorPos;
                if (currentValue.length < formattedNumber.length) {
                    // If we added characters, adjust cursor forward
                    newCursorPos += (formattedNumber.length - currentValue.length);
                }

                // Set cursor position after value update
                this.setSelectionRange(newCursorPos, newCursorPos);
            }
        });

        // Add blur (focus lost) event to ensure complete formatting
        phoneInput.addEventListener('blur', function() {
            const plainNumber = this.value.replace(/\D/g, '');

            // Format appropriately when field loses focus
            if (plainNumber.length > 0) {
                // Remove 63 prefix if entered manually to avoid duplication
                let formattedNumber = plainNumber;
                if (formattedNumber.startsWith('63')) {
                    formattedNumber = formattedNumber.substring(2);
                }

                // Ensure proper formatting on blur
                this.value = '+63 ' + formattedNumber.substring(0, 3) +
                            (formattedNumber.length > 3 ? ' ' + formattedNumber.substring(3, 6) : '') +
                            (formattedNumber.length > 6 ? ' ' + formattedNumber.substring(6, 10) : '');
            }
        });
    }

    // Setup progress indicator in the booking form
    const bookingForm = document.getElementById('booking-form');
    const formSteps = document.querySelector('.form-steps');

    if (bookingForm && formSteps) {
        const formFields = bookingForm.querySelectorAll('input, select, textarea');

        // Update steps based on field focus
        formFields.forEach(field => {
            field.addEventListener('focus', function() {
                // Determine which step we're on based on the focused field
                if (field.id === 'eventType' || field.id === 'eventDate' || field.id === 'guestCount') {
                    updateFormStep(1);
                } else if (field.id === 'firstName' || field.id === 'lastName' ||
                         field.id === 'email' || field.id === 'phoneNumber' ||
                         field.id === 'specialRequests') {
                    updateFormStep(2);
                }
            });
        });

        // Form submission handler
        bookingForm.addEventListener('submit', function(e) {
            e.preventDefault();

            // Check if terms checkbox is checked
            const termsCheckbox = document.querySelector('input[name="terms_agreement"]');
            if (termsCheckbox && !termsCheckbox.checked) {
                alert('Please agree to the terms and conditions to proceed.');
                return;
            }

            // Show loading state
            const submitBtn = bookingForm.querySelector('.submit-btn');
            const originalBtnText = submitBtn.textContent;
            submitBtn.textContent = 'Processing...';
            submitBtn.disabled = true;

            // Get form data
            const formData = new FormData(bookingForm);

            // Submit the form via AJAX
            fetch('/event/booking', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Show success popup
                    document.getElementById('success-event-type').textContent =
                        document.getElementById('eventType').options[
                            document.getElementById('eventType').selectedIndex
                        ].text;

                    document.getElementById('success-event-date').textContent =
                        formatReadableDate(document.getElementById('eventDate').value);

                    document.getElementById('success-guest-count').textContent =
                        document.getElementById('guestCount').value;

                    // Show booking popup
                    const successPopup = document.getElementById('bookingSuccessPopup');
                    successPopup.style.display = 'flex';
                    setTimeout(() => {
                        successPopup.classList.add('active');
                    }, 10);

                    // Reset form
                    bookingForm.reset();
                } else {
                    alert('There was a problem with your booking. Please try again.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('There was a problem submitting your booking. Please try again later.');
            })
            .finally(() => {
                // Reset button state
                submitBtn.textContent = originalBtnText;
                submitBtn.disabled = false;
            });
        });
    }

    // Handle success popup close button
    const successCloseBtn = document.getElementById('booking-success-close');
    if (successCloseBtn) {
        successCloseBtn.addEventListener('click', closeSuccessPopup);
    }

    // Handle return to home/event button
    const returnHomeBtn = document.getElementById('booking-success-btn');
    if (returnHomeBtn) {
        returnHomeBtn.addEventListener('click', function() {
            // Add a nice exit animation before redirecting
            const successPopup = document.getElementById('bookingSuccessPopup');
            successPopup.classList.add('exiting');

            setTimeout(() => {
                window.location.href = '/event';
            }, 300);
        });
    }

    function closeSuccessPopup() {
        const successPopup = document.getElementById('bookingSuccessPopup');

        // Add an exit animation class
        successPopup.classList.add('exiting');

        // After animation completes, hide the popup
        setTimeout(() => {
            successPopup.classList.remove('active');
            successPopup.classList.remove('exiting');
            successPopup.style.display = 'none'; // Ensure display is set to none

            // Make sure any overlay is removed or hidden
            const overlays = document.querySelectorAll('.popup-overlay');
            overlays.forEach(overlay => {
                overlay.style.display = 'none';
            });

            // Restore background scrolling
            document.body.style.overflow = 'auto';
            document.body.style.pointerEvents = 'auto'; // Ensure pointer events are enabled

            // Reset the form
            const bookingForm = document.getElementById('booking-form');
            if (bookingForm) {
                bookingForm.reset();
            }
            updateFormStep(1);
        }, 300);
    }

    // Process URL parameters for auto-selecting event type
    const urlParams = new URLSearchParams(window.location.search);
    const eventType = urlParams.get('eventType');

    if (eventType) {
        console.log('URL parameter found: eventType =', eventType);

        // Check if the event type is valid in our data
        if (eventTypes[eventType]) {
            // Set the event type in the form dropdown
            const eventTypeSelect = document.getElementById('eventType');
            if (eventTypeSelect) {
                console.log('Setting event type dropdown to:', eventType);
                eventTypeSelect.value = eventType;

                // Trigger change event to update any dependent fields
                const event = new Event('change');
                eventTypeSelect.dispatchEvent(event);

                // If we have a hash in the URL for booking section, scroll to it
                if (window.location.hash === '#booking-form' || window.location.hash === '#bookingSection') {
                    setTimeout(() => {
                        document.getElementById('bookingSection').scrollIntoView({ behavior: 'smooth' });
                    }, 500);
                }
            }
        } else {
            console.warn(`Event type '${eventType}' not found in event data`);
            // For 'other' value that may not be in eventTypes object
            const eventTypeSelect = document.getElementById('eventType');
            if (eventTypeSelect && eventType === 'other') {
                eventTypeSelect.value = 'other';
            }
        }
    }
});

// Only allow letters and spaces in name fields/strict
document.querySelectorAll('#firstName, #lastName').forEach(input => {
    input.addEventListener('input', function() {
        this.value = this.value.replace(/[^A-Za-z\s]/g, '');
    });
});

// Mobile menu toggle is handled by navbar.js

// Function to close the event details popup
function closeEventDetailsPopup() {
    const popup = document.getElementById('eventDetailsPopup');
    popup.classList.remove('active');

    // Add a delay before hiding to allow the animation to complete
    setTimeout(() => {
        popup.style.display = 'none';

        // Make sure any overlay is removed or hidden
        const overlays = document.querySelectorAll('.popup-overlay');
        overlays.forEach(overlay => {
            overlay.style.display = 'none';
        });

        // Reset the form steps if needed, but DON'T reset the form values
        const formSteps = document.querySelector('.form-steps');
        if (formSteps) {
            if (typeof updateFormStep === 'function') {
                updateFormStep(1);
            } else {
                formSteps.setAttribute('data-step', 1);
            }
        }

        // Restore background scrolling
        document.body.style.overflow = 'auto';
        document.body.style.pointerEvents = 'auto'; // Ensure pointer events are enabled
    }, 300);
}

// Format date as "Month Day, Year"
function formatReadableDate(dateString) {
    if (!dateString) return '';
    const date = new Date(dateString);
    return date.toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
}

    //Parallax Effect for Featured Events
    const parallaxEventCards = document.querySelectorAll('.event-types-grid .event-type-card');
    if (parallaxEventCards.length >= 4) {
        parallaxEventCards[0].style.transform = 'translateX(-80px)'; // left
        parallaxEventCards[1].style.transform = 'translateY(80px)'; // below
        parallaxEventCards[2].style.transform = 'translateX(80px)';  // right
        parallaxEventCards[3].style.transform = 'translateX(-80px)'; // left
        parallaxEventCards[0].style.opacity = '0';
        parallaxEventCards[1].style.opacity = '0';
        parallaxEventCards[2].style.opacity = '0';
        parallaxEventCards[3].style.opacity = '0';

        [0,1,2,3].forEach(i => {
            parallaxEventCards[i].style.transition = 'transform 1s cubic-bezier(0.22, 1, 0.36, 1), opacity 1s';
        });

        const observer = new window.IntersectionObserver((entries, obs) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.transform = 'translateX(0) translateY(0)';
                    entry.target.style.opacity = '1';
                    obs.unobserve(entry.target);
                }
            });
        }, { threshold: 0.4 });

        [0,1,2,3].forEach(i => observer.observe(parallaxEventCards[i]));
    }

