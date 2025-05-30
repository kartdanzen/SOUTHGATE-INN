document.addEventListener('DOMContentLoaded', function() {
    // Blog Modal Functionality
    const modal = document.getElementById('blogModal');
    const modalClose = document.getElementById('modalClose');
    const readMoreLinks = document.querySelectorAll('.blog-read-more');
    
    // Special fix for 992px breakpoint - ensure featured post read more is visible same sa regular blog post
    function fixFeaturedReadMoreButton() {
        const featuredReadMore = document.querySelector('.blog-featured .blog-read-more');
        if (featuredReadMore) {
            if (window.innerWidth <= 992 && window.innerWidth >= 577) {
                featuredReadMore.style.display = 'inline-block';
                featuredReadMore.style.position = 'relative';
                featuredReadMore.style.visibility = 'visible';
                featuredReadMore.style.opacity = '1';
                featuredReadMore.style.zIndex = '100';
            }
        }
    }
    
    // Run the fix on page load
    fixFeaturedReadMoreButton();
    
    // Also run the fix when window is resized
    window.addEventListener('resize', fixFeaturedReadMoreButton);
    
    // Function to open modal with blog post content
    function openModal(postData) {
        // Update modal content with blog post data
        document.getElementById('modalCategory').textContent = postData.category;
        document.getElementById('modalImage').src = postData.image;
        document.getElementById('modalImage').alt = postData.title;
        document.getElementById('modalDate').innerHTML = `<i class="far fa-calendar-alt"></i> ${postData.date}`;
        document.getElementById('modalTitle').textContent = postData.title;
        document.getElementById('modalAuthorName').textContent = postData.author;
        document.getElementById('modalAuthorImg').src = postData.authorImg;
        
        // Generate content based on the post title (for demo purposes)
        let postContent = '';
        if (postData.title.includes('10 Years of Excellence')) {
            postContent = `
                <p>As Southgate Inn celebrates its 10th anniversary, we reflect on a remarkable journey of growth, exceptional service, and unforgettable guest experiences that have defined our establishment since 2015.</p>
                <p>Founded with a vision to provide a home away from home for travelers visiting Kabankalan City, Southgate Inn has evolved from a modest accommodation into a premier hospitality destination that stands as a testament to Filipino warmth and hospitality.</p>
                <p>Over the past decade, we have had the privilege of hosting thousands of guests from around the world, each bringing their unique stories and experiences to our doors. From business travelers and tourists to families celebrating special occasions, our guests have been the heart of our journey.</p>
                <p>"The past ten years have been an incredible adventure," shares our General Manager. "What began as a simple dream has blossomed into a thriving establishment that has become an integral part of the local community and tourism landscape."</p>
                <p>To commemorate this special milestone, we're introducing several exciting initiatives, including room upgrades, enhanced dining experiences, and special anniversary packages that will be available throughout the year.</p>
                <p>Join us in celebration as we look forward to many more years of creating memorable stays for our valued guests!</p>
            `;
        } else if (postData.title.includes('Hidden Gems')) {
            postContent = `
                <p>Beyond the bustling streets of Kabankalan City lies a treasure trove of natural wonders and cultural sites waiting to be discovered. Here are five hidden gems that deserve a spot on your itinerary during your stay at Southgate Inn:</p>
                <h3>1. Magaso Falls</h3>
                <p>Just a 30-minute drive from the city center, Magaso Falls offers a refreshing escape with its crystal-clear waters cascading over tiered rock formations. The natural pool at the base of the falls is perfect for a cooling dip, while the surrounding forest provides ample shade for picnics and relaxation.</p>
                <h3>2. Camingawan Island</h3>
                <p>This tiny uninhabited island off the coast boasts pristine white sand beaches and vibrant coral reefs. A boat ride from the mainland takes about 45 minutes, making it an ideal day trip for snorkeling and beachcombing.</p>
                <h3>3. Balicaocao Highland Resort</h3>
                <p>Perched on a hillside with panoramic views of the countryside, this highland retreat offers a cool climate and beautiful gardens. The resort's infinity pool seems to merge with the horizon, creating a perfect spot for sunset viewing.</p>
                <h3>4. Bantayan Cave</h3>
                <p>History buffs will appreciate this natural cave that served as a hideout during World War II. Guided tours explain the site's historical significance while showcasing impressive stalactite and stalagmite formations.</p>
                <h3>5. Kabankalan Heritage Houses</h3>
                <p>Take a walking tour of the city's preserved Spanish colonial-era mansions. These architectural treasures offer a glimpse into the region's rich past with their intricately carved woodwork and period furnishings.</p>
                <p>Our front desk staff would be delighted to arrange transportation and guides to any of these attractions. Just ask, and we'll help you plan an unforgettable day of exploration!</p>
            `;
        } else if (postData.title.includes('Seasonal Menu')) {
            postContent = `
                <p>We're thrilled to announce a culinary renaissance at our in-house restaurant as our Executive Chef unveils a new seasonal menu that celebrates the rich bounty of local ingredients from across the Philippines.</p>
                <p>The menu represents a thoughtful fusion of traditional Filipino flavors with contemporary culinary techniques, creating dishes that are both familiar and excitingly innovative.</p>
                <p>"I wanted to create a dining experience that tells the story of our region through food," explains our Executive Chef. "Every dish on the new menu features ingredients sourced directly from farmers and fishermen within a 50-kilometer radius of Kabankalan City."</p>
                <p>Highlights of the menu include:</p>
                <ul>
                    <li><strong>Binakol na Manok sa Buko</strong> - Chicken slowly simmered in fresh coconut water with lemongrass and native chilies</li>
                    <li><strong>Sugarcane-Smoked Lapu-Lapu</strong> - Fresh local grouper delicately smoked with sugarcane from neighboring plantations</li>
                    <li><strong>Negros Heritage Platter</strong> - A selection of provincial specialties including chicken inasal, kadios baboy langka, and pancit molo</li>
                    <li><strong>Tablea Chocolate Lava Cake</strong> - Warm chocolate cake made with locally-produced tablea, served with carabao milk ice cream</li>
                </ul>
                <p>The new menu also features a dedicated plant-based section, acknowledging the growing demand for vegetarian and vegan options among our guests.</p>
                <p>This culinary revamp underscores our commitment to sustainability and supporting local producers while offering guests an authentic taste of the region's gastronomic heritage.</p>
                <p>The seasonal menu will change quarterly to reflect the availability of fresh ingredients and to continuously surprise and delight our returning guests.</p>
            `;
        } else {
            // Default content for other articles
            postContent = `
                <p>Thank you for your interest in this article. The full content is being prepared and will be available soon.</p>
                <p>At Southgate Inn, we strive to provide valuable and engaging content for our readers. This article is currently being finalized by our team to ensure it meets our high standards for quality and accuracy.</p>
                <p>Please check back in a few days to read the complete article. In the meantime, feel free to explore other posts on our blog or contact our staff if you have any specific questions about the topic.</p>
                <p>We appreciate your patience and continued interest in Southgate Inn.</p>
            `;
        }
        
        document.getElementById('modalContent').innerHTML = postContent;
        
        // Show modal
        modal.style.display = 'block';
        document.body.style.overflow = 'hidden'; // Prevent scrolling when modal is open
    }
    
    // Close modal function
    function closeModal() {
        modal.style.display = 'none';
        document.body.style.overflow = 'auto'; // Enable scrolling again
    }
    
    // Add click event to each Read More link
    readMoreLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Get blog post data from the article
            const article = this.closest('article');
            const postData = {
                category: article.querySelector('.blog-category').textContent,
                image: article.querySelector('img').src,
                title: article.querySelector('.blog-title a').textContent,
                date: article.querySelector('.blog-date').textContent.replace('i', '').trim(),
                author: article.querySelector('.blog-author-name').textContent,
                authorImg: article.querySelector('.blog-author-img').src
            };
            
            openModal(postData);
        });
    });
    
    // Close modal when clicking close button
    modalClose.addEventListener('click', closeModal);
    
    // Close modal when clicking outside of modal content
    window.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeModal();
        }
    });
    
    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && modal.style.display === 'block') {
            closeModal();
        }
    });
    
    // Parallax  for featured post
    const featured = document.querySelector('.blog-featured');
    if (featured) {
        featured.classList.add('parallax-init');
        const observer = new window.IntersectionObserver(
            (entries, obs) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        featured.classList.add('parallax-in-left');
                        featured.classList.remove('parallax-init');
                        obs.unobserve(entry.target);
                    }
                });
            },
            { threshold: 0.2 }
        );
        observer.observe(featured);
    }
    
    // Parallax for  blog cards
    const blogCards = document.querySelectorAll('.blog-card');
    if (blogCards.length) {
        blogCards.forEach(card => card.classList.add('parallax-init'));
        const cardObserver = new window.IntersectionObserver(
            (entries, obs) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('parallax-in-left');
                        entry.target.classList.remove('parallax-init');
                        obs.unobserve(entry.target);
                    }
                });
            },
            { threshold: 0.2 }
        );
        blogCards.forEach(card => cardObserver.observe(card));
    }
});
