document.addEventListener('DOMContentLoaded', function() {
    // Function to handle section titles on resize
    function handleSectionTitles() {
        const sectionTitles = document.querySelectorAll('.section-title');
        const viewportWidth = window.innerWidth;
        
        sectionTitles.forEach(title => {
            // Reset font size first to get accurate measurements
            title.style.fontSize = '';
            
            // Check if title text is too long for the container
            if (title.scrollWidth > title.clientWidth) {
                if (viewportWidth <= 400) {
                    // For extra small screens
                    title.style.fontSize = '22px';
                } else if (viewportWidth <= 576) {
                    // For very small screens
                    title.style.fontSize = '26px';
                } else if (viewportWidth <= 768) {
                    // For small screens
                    title.style.fontSize = '28px';
                } else if (viewportWidth <= 992) {
                    // For medium screens
                    title.style.fontSize = '32px';
                } else {
                    // Reset font size for larger screens
                    title.style.fontSize = '';
                }
            }
        });
    }
    
    // Function to handle the "See more/See less" functionality
    function setupReviewContentToggle() {
        const reviewContents = document.querySelectorAll('.review-content');
        const charLimit = 100; // Reduced limit to show initially (so "See more" will appear for 200-char reviews)
        
        reviewContents.forEach(content => {
            const paragraph = content.querySelector('p');
            if (!paragraph) return;
            
            const fullText = paragraph.textContent;
            const seeMoreBtn = content.parentElement.querySelector('.see-more-btn');
            
            // Check if the content is long enough to need truncation
            if (fullText.length > charLimit) {
                // Store the full text as a data attribute
                paragraph.setAttribute('data-full-text', fullText);
                
                // Create the truncated version with ellipsis
                const truncatedText = fullText.substring(0, charLimit).trim() + '...';
                paragraph.textContent = truncatedText;
                
                // Show the "See more" button
                seeMoreBtn.style.display = 'block';
                
                // Set up event listener for the button
                seeMoreBtn.addEventListener('click', function() {
                    const isExpanded = content.classList.contains('expanded');
                    
                    if (isExpanded) {
                        // Collapse - show truncated version
                        content.classList.remove('expanded');
                        paragraph.textContent = truncatedText;
                        seeMoreBtn.textContent = 'See more';
                        
                        // Remove expanded class from review card
                        const reviewCard = content.closest('.review-card');
                        reviewCard.classList.remove('expanded');
                        
                        // Scroll back to the top of the card
                        reviewCard.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    } else {
                        // Expand - show full text
                        content.classList.add('expanded');
                        paragraph.textContent = fullText;
                        seeMoreBtn.textContent = 'See less';
                        
                        // Add expanded class to review card
                        const reviewCard = content.closest('.review-card');
                        reviewCard.classList.add('expanded');
                        
                        // Ensure images (if any) are properly positioned after expansion
                        const reviewImages = reviewCard.querySelector('.review-images');
                        if (reviewImages) {
                            reviewImages.style.display = 'block';
                        }
                    }
                });
            }
        });
    }
    
    // Run on page load
    handleSectionTitles();
    setupReviewContentToggle();
    setupCharacterCounter();
    
    // Run on window resize with debounce
    let resizeTimer;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(handleSectionTitles, 100);
    
        // Also adjust gallery for orientation changes
        adjustGalleryForOrientation();
    });
    
    // Character counter functionality
    function setupCharacterCounter() {
        const textarea = document.getElementById('reviewContent');
        const charCount = document.getElementById('charCount');
        const charCounter = document.querySelector('.char-counter');
        
        if (textarea && charCount) {
            // Update on input
            textarea.addEventListener('input', function() {
                const remainingChars = this.value.length;
                charCount.textContent = remainingChars;
                
                // Change color when approaching limit
                if (remainingChars >= 180) {
                    charCounter.classList.add('limit-near');
                    
                    if (remainingChars >= 195) {
                        charCounter.classList.add('limit-reached');
                    } else {
                        charCounter.classList.remove('limit-reached');
                    }
                } else {
                    charCounter.classList.remove('limit-near', 'limit-reached');
                }
            });
            
            // Initialize counter
            charCount.textContent = textarea.value.length;
        }
    }
    
    // Review Filtering
    const filterButtons = document.querySelectorAll('.filter-btn');
    const reviewCards = document.querySelectorAll('.review-card');
    
    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Remove active class from all buttons
            filterButtons.forEach(btn => btn.classList.remove('active'));
            
            // Add active class to clicked button
            button.classList.add('active');
            
            // Get the filter value
            const filterValue = button.getAttribute('data-rating');
            
            // Filter the reviews
            reviewCards.forEach(card => {
                const rating = card.getAttribute('data-rating');
                
                if (filterValue === 'all' || filterValue === rating || (filterValue === 'recent' && parseInt(card.style.getPropertyValue('--index')) < 3)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });

    // Star Rating 
    const stars = document.querySelectorAll('.rating-input label');
    const ratingInputs = document.querySelectorAll('.rating-input input');
    
    // Function to color stars from left to right by position
    function colorStarsByPosition(position, color) {
        // Stars in natural order (1-5 left to right)
        stars.forEach((star, index) => {
            if (index <= position) {
                star.style.color = color;
            } else {
                star.style.color = '#ddd';
            }
        });
    }
    
    // Set up hover and click events
    stars.forEach((star, index) => {
        // Get the value from the star's data attribute
        const starValue = parseInt(star.getAttribute('data-value'));
        
        // Hover effects - color stars up to this position
        star.addEventListener('mouseenter', () => {
            colorStarsByPosition(index, '#ffc107');
        });
        
        star.addEventListener('mouseleave', () => {
            // Reset to previously selected or all gray
            const checkedInput = document.querySelector('.rating-input input:checked');
            if (checkedInput) {
                // Find the index of the checked input to color up to that position
                const checkedIndex = Array.from(ratingInputs).indexOf(checkedInput);
                colorStarsByPosition(checkedIndex, '#ffc107');
            } else {
                // Reset all stars to gray
                stars.forEach(s => s.style.color = '#ddd');
            }
        });
        
        // Click effect
        star.addEventListener('click', () => {
            // Find the input and check it
            const inputId = star.getAttribute('for');
            const input = document.getElementById(inputId);
            if (input) {
                input.checked = true;
                console.log('Selected rating value:', input.value);
            }
            
            // Color stars up to this position
            colorStarsByPosition(index, '#ffc107');
        });
    });
    
    // Initialize the rating-input container hover leave event
    const ratingContainer = document.querySelector('.rating-input');
    if (ratingContainer) {
        ratingContainer.addEventListener('mouseleave', () => {
            // Reset to previously selected or all gray
            const checkedInput = document.querySelector('.rating-input input:checked');
            if (checkedInput) {
                const checkedIndex = Array.from(ratingInputs).indexOf(checkedInput);
                colorStarsByPosition(checkedIndex, '#ffc107');
            } else {
                stars.forEach(star => star.style.color = '#ddd');
            }
        });
    }
    
    // Submit Review Form
    const reviewForm = document.querySelector('.review-form');
    const reviewPopup = document.querySelector('.review-popup');
    const closePopup = document.querySelector('.review-popup-close');
    const popupBtn = document.querySelector('.review-popup-btn');
    
    if (reviewForm) {
        reviewForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Create FormData object
            const formData = new FormData();
            
            // Add form data from our form fields
            formData.append('reviewerName', document.getElementById('reviewerName').value);
            formData.append('reviewerEmail', document.getElementById('reviewerEmail').value);
            
            // Get selected rating
            const ratingInput = document.querySelector('input[name="rating"]:checked');
            if (ratingInput) {
                formData.append('rating', ratingInput.value);
                console.log('Submitting rating:', ratingInput.value, '- Input ID:', ratingInput.id);
            } else {
                formData.append('rating', "0");
                console.log('No rating selected, using default 0');
            }
            
            formData.append('reviewTitle', document.getElementById('reviewTitle').value);
            formData.append('reviewContent', document.getElementById('reviewContent').value);
            
            // Add CSRF token
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
            
            // Add files if any
            const fileInput = document.getElementById('reviewImages');
            console.log('File input element:', fileInput);
            console.log('Files property:', fileInput.files);
            
            if (fileInput && fileInput.files && fileInput.files.length > 0) {
                console.log('Files detected:', fileInput.files.length);
                for (let i = 0; i < fileInput.files.length; i++) {
                    console.log('Adding file:', fileInput.files[i].name, 'size:', fileInput.files[i].size);
                    formData.append('reviewImages[]', fileInput.files[i]);
                }
            } else {
                console.log('No files detected in the form submission');
            }
            
            // Debug the FormData content
            for (let pair of formData.entries()) {
                console.log(pair[0], pair[1]);
            }
            
            // Send AJAX request
            fetch('/reviews/store', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    // Don't set Content-Type here as FormData will set it with the boundary
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.errors) {
                    // Handle validation errors
                    let errorMessage = 'Please correct the following errors:\n';
                    for (let field in data.errors) {
                        errorMessage += `- ${data.errors[field].join('\n- ')}\n`;
                    }
                    alert(errorMessage);
                } else {
                    // Show success popup
                    reviewPopup.style.display = 'flex';
                    reviewPopup.style.zIndex = '10002';
            
            // Reset form
            reviewForm.reset();
                    
                    // Clear image previews
                    if (previewContainer) {
                        previewContainer.innerHTML = '';
                        uploadedImages = [];
                    }
            
            // Reset stars
            stars.forEach(star => {
                star.style.color = '#ddd';
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('There was an error submitting your review. Please try again later.');
            });
        });
    }
    
    // Close popup when clicking close button
    if (closePopup) {
        closePopup.addEventListener('click', function() {
            reviewPopup.style.display = 'none';
        });
    }
    
    // Close popup when clicking OK button
    if (popupBtn) {
        popupBtn.addEventListener('click', function() {
            reviewPopup.style.display = 'none';
        });
    }
    
    // Close popup when clicking outside
    if (reviewPopup) {
        reviewPopup.addEventListener('click', function(e) {
            if (e.target === reviewPopup) {
                reviewPopup.style.display = 'none';
            }
        });
    }

    // Image Upload Preview
    const imageInput = document.getElementById('reviewImages');
    const previewContainer = document.getElementById('imagePreviewContainer');
    let uploadedImages = [];
    
    if (imageInput) {
        imageInput.addEventListener('change', function() {
            if (this.files) {
                const filesArray = Array.from(this.files);
                
                // Check if more than 10 images are being uploaded
                if (uploadedImages.length + filesArray.length > 10) {
                    alert('You can upload a maximum of 10 images, lihog lang gid.');
                    return;
                }
                
                // Process each file
                filesArray.forEach(file => {
                    // Check file size (5MB max)
                    if (file.size > 5 * 1024 * 1024) {
                        alert(`Image ${file.name} exceeds the 5MB limit.`);
                        return;
                    }
                    
                    // Create preview
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        const previewItem = document.createElement('div');
                        previewItem.className = 'image-preview-item';
                        previewItem.innerHTML = `
                            <img src="${e.target.result}" alt="Preview">
                            <div class="image-preview-remove"><i class="fas fa-times"></i></div>
                        `;
                        
                        // Add to preview container
                        previewContainer.appendChild(previewItem);
                        
                        // Add to uploaded images array
                        uploadedImages.push({
                            file: file,
                            element: previewItem,
                            src: e.target.result
                        });
                        
                        // Add remove functionality
                        const removeBtn = previewItem.querySelector('.image-preview-remove');
                        removeBtn.addEventListener('click', function() {
                            previewItem.remove();
                            uploadedImages = uploadedImages.filter(img => img.element !== previewItem);
                        });
                    };
                    
                    reader.readAsDataURL(file);
                });
            }
        });
    }
    
    // Gallery functionality for review images
    let currentGalleryImages = [];
    let currentImageIndex = 0;
    
    // Add direct click event listeners to all thumbnails
    const reviewImageThumbs = document.querySelectorAll('.review-image-thumb');
    
    reviewImageThumbs.forEach(thumb => {
        // Ensure the cursor shows it's clickable
        thumb.style.cursor = 'pointer';
        
        // Add direct event listener in addition to the onclick attribute
        thumb.addEventListener('click', function() {
            console.log('Thumbnail clicked directly:', this.src);
            openImageGallery(this);
        });
    });
    
    // Initialize gallery elements
    const galleryModal = document.getElementById('imageGalleryModal');
    const galleryImage = document.getElementById('galleryImage');
    const galleryClose = document.querySelector('.gallery-close');
    const galleryPrev = document.querySelector('.gallery-prev');
    const galleryNext = document.querySelector('.gallery-next');
    
    // Make openImageGallery accessible globally but define it here
    window.openImageGallery = function(imageElement) {
        console.log('Opening gallery with image:', imageElement.src);
        
        try {
            // Get the containing review card
            const reviewCard = imageElement.closest('.review-card');
            
            if (reviewCard) {
                // If inside a review card, get all images in that card
                const allImages = reviewCard.querySelectorAll('.review-image-thumb');
                currentGalleryImages = Array.from(allImages).map(img => img.src);
                currentImageIndex = currentGalleryImages.indexOf(imageElement.src);
            } else {
                // If not in a review card, just open this single image
                currentGalleryImages = [imageElement.src];
                currentImageIndex = 0;
            }
            
            // Open the modal with the image
            if (galleryModal && galleryImage) {
                galleryImage.src = imageElement.src;
                galleryModal.style.display = 'block';
                
                // Show/hide navigation buttons based on number of images
                if (galleryPrev && galleryNext) {
                    if (currentGalleryImages.length <= 1) {
                        galleryPrev.style.display = 'none';
                        galleryNext.style.display = 'none';
                    } else {
                        galleryPrev.style.display = 'flex';
                        galleryNext.style.display = 'flex';
                    }
                }
                
                // Prevent scrolling when gallery is open
                document.body.style.overflow = 'hidden';
                
                // Adjust for current orientation
                adjustGalleryForOrientation();
            } else {
                console.error("Gallery modal elements not found");
            }
        } catch (error) {
            console.error("Error opening image gallery:", error);
        }
    };
    
    // Define closeImageGallery function and make it globally accessible
    window.closeImageGallery = function() {
        console.log('Closing gallery');
        if (galleryModal) {
            galleryModal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }
    };
    
    // Define changeGalleryImage function and make it globally accessible
    window.changeGalleryImage = function(direction) {
        currentImageIndex = (currentImageIndex + direction + currentGalleryImages.length) % currentGalleryImages.length;
        if (galleryImage) {
            galleryImage.src = currentGalleryImages[currentImageIndex];
        }
    };
    
    // Add direct event listeners to gallery controls
    if (galleryClose) {
        galleryClose.addEventListener('click', function() {
            closeImageGallery();
        });
    }
    
    if (galleryPrev) {
        galleryPrev.addEventListener('click', function() {
            changeGalleryImage(-1);
        });
    }
    
    if (galleryNext) {
        galleryNext.addEventListener('click', function() {
            changeGalleryImage(1);
        });
    }
    
    // Close gallery with escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeImageGallery();
        } else if (e.key === 'ArrowLeft') {
            changeGalleryImage(-1);
        } else if (e.key === 'ArrowRight') {
            changeGalleryImage(1);
        }
    });
    
    // Handle Mobile Touch Swipe for Gallery
    const galleryImageElement = document.getElementById('galleryImage');
    let touchStartX = 0;
    let touchEndX = 0;
    
    if (galleryImageElement) {
        galleryImageElement.addEventListener('touchstart', function(e) {
            touchStartX = e.changedTouches[0].screenX;
        }, { passive: true });
        
        galleryImageElement.addEventListener('touchend', function(e) {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        }, { passive: true });
    }
    
    // Handle the swipe direction
    function handleSwipe() {
        // Minimum distance for swipe
        const minDistance = 50;
        
        if (touchEndX < touchStartX - minDistance) {
            // Swiped left - next image
            changeGalleryImage(1);
        }
        
        if (touchEndX > touchStartX + minDistance) {
            // Swiped right - previous image
            changeGalleryImage(-1);
        }
    }
    
    // Make gallery full screen in mobile landscape mode
    function adjustGalleryForOrientation() {
        if (galleryModal && galleryModal.style.display === 'block') {
            if (window.matchMedia("(orientation: landscape) and (max-width: 900px)").matches) {
                // Landscape mode on mobile - maximize the image
                if (galleryImage) {
                    galleryImage.style.maxHeight = '90vh';
                }
                const galleryContent = document.querySelector('.gallery-content');
                if (galleryContent) {
                    galleryContent.style.padding = '0';
                }
            } else {
                // Portrait mode or desktop - reset
                if (galleryImage) {
                    galleryImage.style.maxHeight = '';
                }
                const galleryContent = document.querySelector('.gallery-content');
                if (galleryContent) {
                    galleryContent.style.padding = '';
                }
            }
        }
    }
    
    // Run on orientation change
    window.addEventListener('orientationchange', adjustGalleryForOrientation);
});
