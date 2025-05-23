document.addEventListener('DOMContentLoaded', function() {
    // Gallery filtering
    const filterButtons = document.querySelectorAll('.filter-btn');
    const galleryItems = document.querySelectorAll('.gallery-item');
    const marqueeRows = document.querySelectorAll('.marquee-row');
    
    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Remove active class from all buttons
            filterButtons.forEach(btn => btn.classList.remove('active'));
            
            // Add active class to clicked button
            button.classList.add('active');
            
            const filterValue = button.getAttribute('data-filter');
            
            if (filterValue === 'all') {
                // Show all rows
                marqueeRows.forEach(row => {
                    row.style.display = 'block';
                });
            } else {
                // Hide all rows first
                marqueeRows.forEach(row => {
                    row.style.display = 'none';
                });
                
                // Show only the rows containing the selected category
                document.querySelectorAll(`.marquee-row .gallery-item[data-category="${filterValue}"]`)
                    .forEach(item => {
                        const parentRow = item.closest('.marquee-row');
                        if (parentRow) {
                            parentRow.style.display = 'block';
                        }
                    });
            }
        });
    });
    
    // Gallery Modal Functionality
    const modal = document.querySelector('.gallery-modal');
    const modalImg = document.querySelector('.modal-image');
    const modalTitle = document.querySelector('.modal-title');
    const modalDesc = document.querySelector('.modal-description');
    const modalCloseBtn = document.querySelector('.modal-close');
    const prevBtn = document.querySelector('.prev-btn');
    const nextBtn = document.querySelector('.next-btn');
    let currentIndex = 0;
    let currentCategory = '';
    
    // Create the continuous scrolling effect by duplicating content
    document.querySelectorAll('.marquee-content').forEach(content => {
        // Clone all items and append them to create the continuous effect
        const items = content.innerHTML;
        content.innerHTML = items + items;
    });
    
    // Collect all gallery items again after duplication
    const allGalleryItems = document.querySelectorAll('.gallery-item');
    let originalItems = {}; // Store original items by category
    
    // Group original items by category (before duplication)
    allGalleryItems.forEach((item, index) => {
        const category = item.getAttribute('data-category');
        if (!originalItems[category]) {
            originalItems[category] = [];
        }
        
        // Only add items if they're unique (compare src values to avoid duplicates)
        const imgSrc = item.querySelector('img').getAttribute('src');
        const isDuplicate = originalItems[category].some(existingItem => 
            existingItem.querySelector('img').getAttribute('src') === imgSrc
        );
        
        if (!isDuplicate) {
            originalItems[category].push(item);
        }
    });
    
    // Verify we have items for each category
    console.log('Categories loaded:', Object.keys(originalItems));
    Object.keys(originalItems).forEach(cat => {
        console.log(`Category ${cat} has ${originalItems[cat].length} items`);
    });
    
    // Open modal with clicked image
    allGalleryItems.forEach((item) => {
        item.addEventListener('click', () => {
            const imgSrc = item.querySelector('img').getAttribute('src');
            const title = item.querySelector('h3').textContent;
            const description = item.querySelector('p').textContent;
            const category = item.getAttribute('data-category');
            
            modalImg.src = imgSrc;
            modalTitle.textContent = title;
            modalDesc.textContent = description;
            modal.classList.add('active');
            document.body.classList.add('modal-open');
            
            // Store category for navigation
            currentCategory = category;
            
            // Find index within the category for proper navigation
            const categoryItems = originalItems[category];
            if (!categoryItems || categoryItems.length === 0) {
                console.error(`No items found for category: ${category}`);
                return;
            }
            
            currentIndex = findImageIndex(categoryItems, imgSrc);
        });
    });
    
    // Helper function to find image index by src
    function findImageIndex(items, src) {
        for (let i = 0; i < items.length; i++) {
            if (items[i].querySelector('img').getAttribute('src') === src) {
                return i;
            }
        }
        return 0;
    }
    
    // Close modal when clicking close button
    modalCloseBtn.addEventListener('click', () => {
        modal.classList.remove('active');
        document.body.classList.remove('modal-open');
    });
    
    // Close modal when clicking outside the image
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.classList.remove('active');
            document.body.classList.remove('modal-open');
        }
    });
    
    // Navigate to previous image within the same category
    prevBtn.addEventListener('click', (e) => {
        e.stopPropagation(); // Prevent closing modal when clicking navigation buttons
        if (!currentCategory) return;
        
        const categoryItems = originalItems[currentCategory];
        if (!categoryItems || categoryItems.length === 0) return;
        
        // Calculate new index (wrap around if needed)
        currentIndex = (currentIndex - 1 + categoryItems.length) % categoryItems.length;
        
        // Update modal content
        const item = categoryItems[currentIndex];
        if (!item) return;
        
        modalImg.src = item.querySelector('img').getAttribute('src');
        modalTitle.textContent = item.querySelector('h3').textContent;
        modalDesc.textContent = item.querySelector('p').textContent;
    });
    
    // Navigate to next image within the same category
    nextBtn.addEventListener('click', (e) => {
        e.stopPropagation(); // Prevent closing modal when clicking navigation buttons
        if (!currentCategory) return;
        
        const categoryItems = originalItems[currentCategory];
        if (!categoryItems || categoryItems.length === 0) return;
        
        // Calculate new index (wrap around if needed)
        currentIndex = (currentIndex + 1) % categoryItems.length;
        
        // Update modal content
        const item = categoryItems[currentIndex];
        if (!item) return;
        
        modalImg.src = item.querySelector('img').getAttribute('src');
        modalTitle.textContent = item.querySelector('h3').textContent;
        modalDesc.textContent = item.querySelector('p').textContent;
    });
    
    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        if (modal.classList.contains('active')) {
            if (e.key === 'ArrowLeft') {
                prevBtn.click();
            } else if (e.key === 'ArrowRight') {
                nextBtn.click();
            } else if (e.key === 'Escape') {
                modal.classList.remove('active');
                document.body.classList.remove('modal-open');
            }
        }
    });
});
