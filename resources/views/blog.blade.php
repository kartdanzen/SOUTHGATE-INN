<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Southgate Blog</title>
    <!--Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!--Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="icon" href="{{ asset('images/tab.png') }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!--External CSS -->
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/blog.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
</head>
<body>
    <!-- Header -->
    <header class="header">
        @include('nav')
    </header>
    <div class="menu-overlay"></div>

    <!-- Blog Hero Section -->
    <section class="blog-hero">
        <div class="blog-hero-content">
            <h1 class="blog-hero-title">Our Blog</h1>
            <p class="blog-hero-subtitle">Stay updated with the latest news, travel tips, and special offers from Southgate Inn</p>
        </div>
    </section>

    <!-- Blog Content -->
    <div class="blog-container">
        <main class="blog-main">
            <!-- Featured Post -->
            <article class="blog-featured">
                <div class="blog-featured-img">
                    <span class="blog-category">Featured</span>
                    <img src="{{ asset('images/sinulog1.jpg') }}" alt="Southgate Inn Celebrates 10 Years of Excellence">
                </div>
                <div class="blog-featured-content">
                    <div class="blog-date"><i class="far fa-calendar-alt"></i> May 15, 2025</div>
                    <h2 class="blog-title"><a href="#">Southgate Inn Celebrates 10 Years of Excellence in Hospitality</a></h2>
                    <p class="blog-excerpt">Join us as we celebrate a decade of providing exceptional hospitality experiences to our guests. We're taking a look back at our journey, sharing memorable stories, and announcing exciting plans for the future.</p>
                    <div class="blog-card-footer">
                        <div class="blog-author">
                            <img src="{{ asset('images/H3.png') }}" alt="John Smith" class="blog-author-img">
                            <span class="blog-author-name">John Smith</span>
                        </div>
                        <a href="#" class="blog-read-more">Read More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </article>

            <!--Regular Blog Posts -->
            <article class="blog-card">
                <div class="blog-card-img">
                    <span class="blog-category">Travel Tips</span>
                    <img src="{{ asset('images/magaso1.jpg') }}" alt="Hidden Gems Near Kabankalan City">
                </div>
                <div class="blog-card-content">
                    <div class="blog-date"><i class="far fa-calendar-alt"></i> April 28, 2025</div>
                    <h2 class="blog-title"><a href="#">5 Hidden Gems to Explore Near Kabankalan City</a></h2>
                    <p class="blog-excerpt">Discover the lesser-known but breathtaking attractions just a short drive from our hotel. From serene waterfalls to historic sites, these spots are perfect for day trips during your stay.</p>
                    <div class="blog-card-footer">
                        <div class="blog-author">
                            <img src="{{ asset('images/H3.png') }}" alt="Maria Santos" class="blog-author-img">
                            <span class="blog-author-name">Author</span>
                        </div>
                        <a href="#" class="blog-read-more">Read More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </article>

            <article class="blog-card">
                <div class="blog-card-img">
                    <span class="blog-category">Dining</span>
                    <img src="{{ asset('images/eating.jpg') }}" alt="Seasonal Menu Updates">
                </div>
                <div class="blog-card-content">
                    <div class="blog-date"><i class="far fa-calendar-alt"></i> April 15, 2025</div>
                    <h2 class="blog-title"><a href="#">Our Chef Introduces New Seasonal Menu Inspired by Local Ingredients</a></h2>
                    <p class="blog-excerpt">Experience the flavors of the Philippines with our new menu featuring locally-sourced ingredients. Our executive chef shares insights on the inspiration behind these delicious new dishes.</p>
                    <div class="blog-card-footer">
                        <div class="blog-author">
                            <img src="{{ asset('images/H3.png') }}" alt="Chef Antonio" class="blog-author-img">
                            <span class="blog-author-name">Author</span>
                        </div>
                        <a href="#" class="blog-read-more">Read More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </article>

            <article class="blog-card">
                <div class="blog-card-img">
                    <span class="blog-category">Events</span>
                    <img src="{{ asset('images/events.jpg') }}" alt="Wedding Trends">
                </div>
                <div class="blog-card-content">
                    <div class="blog-date"><i class="far fa-calendar-alt"></i> March 30, 2025</div>
                    <h2 class="blog-title"><a href="#">Wedding Trends: Planning Your Perfect Day at Southgate Inn</a></h2>
                    <p class="blog-excerpt">From intimate ceremonies to grand celebrations, our event planning team shares the latest wedding trends and how we can help create your dream wedding at our venue.</p>
                    <div class="blog-card-footer">
                        <div class="blog-author">
                            <img src="{{ asset('images/H3.png') }}" alt="Elena Cruz" class="blog-author-img">
                            <span class="blog-author-name">Author</span>
                        </div>
                        <a href="#" class="blog-read-more">Read More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </article>

            <article class="blog-card">
                <div class="blog-card-img">
                    <span class="blog-category">Wellness</span>
                    <img src="{{ asset('images/rf.jpg') }}" alt="Wellness Retreat">
                </div>
                <div class="blog-card-content">
                    <div class="blog-date"><i class="far fa-calendar-alt"></i> March 12, 2025</div>
                    <h2 class="blog-title"><a href="#">Unwind and Rejuvenate: Our New Wellness Retreat Package</a></h2>
                    <p class="blog-excerpt">Experience ultimate relaxation with our specially designed wellness retreat package. Learn about our spa treatments, meditation sessions, and healthy dining options.</p>
                    <div class="blog-card-footer">
                        <div class="blog-author">
                            <img src="{{ asset('images/H3.png') }}" alt="Sarah Kim" class="blog-author-img">
                            <span class="blog-author-name">Author</span>
                        </div>
                        <a href="#" class="blog-read-more">Read More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </article>

            <article class="blog-card">
                <div class="blog-card-img">
                    <span class="blog-category">Accommodations</span>
                    <img src="{{ asset('images/hand.jpg') }}" alt="Suite Renovation">
                </div>
                <div class="blog-card-content">
                    <div class="blog-date"><i class="far fa-calendar-alt"></i> February 28, 2025</div>
                    <h2 class="blog-title"><a href="#">Introducing Our Newly Renovated Luxury Suites</a></h2>
                    <p class="blog-excerpt">Take a tour of our redesigned luxury suites featuring modern amenities, stylish décor, and enhanced comfort. See what makes these accommodations truly special.</p>
                    <div class="blog-card-footer">
                        <div class="blog-author">
                            <img src="{{ asset('images/H3.png') }}" alt="David Chen" class="blog-author-img">
                            <span class="blog-author-name">Author</span>
                        </div>
                        <a href="#" class="blog-read-more">Read More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </article>

            <!-- Pagination/pages -->
            <div class="blog-pagination">
                <a href="#" class="pagination-item active">1</a>
                <a href="#" class="pagination-item">2</a>
                <a href="#" class="pagination-item">3</a>
                <a href="#" class="pagination-item"><i class="fas fa-chevron-right"></i></a>
            </div>
        </main>

        <!-- Sidebar -->
        <aside class="blog-sidebar">
            <!-- Categories Widget -->
            <div class="sidebar-widget">
                <h3 class="widget-title">Categories</h3>
                <ul class="category-list">
                    <li class="category-item">
                        <a href="#" class="category-link">
                            Travel Tips
                            <span class="category-count">8</span>
                        </a>
                    </li>
                    <li class="category-item">
                        <a href="#" class="category-link">
                            Dining
                            <span class="category-count">5</span>
                        </a>
                    </li>
                    <li class="category-item">
                        <a href="#" class="category-link">
                            Events
                            <span class="category-count">12</span>
                        </a>
                    </li>
                    <li class="category-item">
                        <a href="#" class="category-link">
                            Accommodations
                            <span class="category-count">7</span>
                        </a>
                    </li>
                    <li class="category-item">
                        <a href="#" class="category-link">
                            Wellness
                            <span class="category-count">4</span>
                        </a>
                    </li>
                    <li class="category-item">
                        <a href="#" class="category-link">
                            Local Culture
                            <span class="category-count">6</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Recent Posts Widget -->
            <div class="sidebar-widget">
                <h3 class="widget-title">Recent Posts</h3>
                <div class="recent-post">
                    <div class="recent-post-img">
                        <img src="{{ asset('images/rf.jpg') }}" alt="Wellness Retreat">
                    </div>
                    <div class="recent-post-content">
                        <h4 class="recent-post-title"><a href="#">Unwind and Rejuvenate: Our New Wellness Retreat Package</a></h4>
                        <div class="recent-post-date"><i class="far fa-calendar-alt"></i> March 12, 2025</div>
                    </div>
                </div>
                <div class="recent-post">
                    <div class="recent-post-img">
                        <img src="{{ asset('images/events.jpg') }}" alt="Wedding Trends">
                    </div>
                    <div class="recent-post-content">
                        <h4 class="recent-post-title"><a href="#">Wedding Trends: Planning Your Perfect Day at Southgate Inn</a></h4>
                        <div class="recent-post-date"><i class="far fa-calendar-alt"></i> March 30, 2025</div>
                    </div>
                </div>
                <div class="recent-post">
                    <div class="recent-post-img">
                        <img src="{{ asset('images/eating.jpg') }}" alt="Seasonal Menu">
                    </div>
                    <div class="recent-post-content">
                        <h4 class="recent-post-title"><a href="#">Our Chef Introduces New Seasonal Menu Inspired by Local Ingredients</a></h4>
                        <div class="recent-post-date"><i class="far fa-calendar-alt"></i> April 15, 2025</div>
                    </div>
                </div>
            </div>

            <!-- Tags Widget -->
            <div class="sidebar-widget">
                <h3 class="widget-title">Tags</h3>
                <div class="tags-list">
                    <a href="#" class="tag-link">Travel</a>
                    <a href="#" class="tag-link">Dining</a>
                    <a href="#" class="tag-link">Accommodation</a>
                    <a href="#" class="tag-link">Wedding</a>
                    <a href="#" class="tag-link">Tips</a>
                    <a href="#" class="tag-link">Philippines</a>
                    <a href="#" class="tag-link">Local</a>
                    <a href="#" class="tag-link">Luxury</a>
                    <a href="#" class="tag-link">Wellness</a>
                    <a href="#" class="tag-link">Vacation</a>
                </div>
            </div>
        </aside>
    </div>

    <!-- Footer -->
       @include('components.footer')

    <!-- Blog Modal -->
    <div class="blog-modal" id="blogModal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-category" id="modalCategory">Category</span>
                <img src="" alt="" id="modalImage">
                <div class="modal-close" id="modalClose">&times;</div>
            </div>
            <div class="modal-body">
                <div class="modal-meta">
                    <div class="modal-date" id="modalDate"><i class="far fa-calendar-alt"></i> Date</div>
                    <div class="modal-author">
                        <img src="" alt="" class="modal-author-img" id="modalAuthorImg">
                        <span class="modal-author-name" id="modalAuthorName">Author Name</span>
                    </div>
                </div>
                <h2 class="modal-title" id="modalTitle">Blog Post Title</h2>
                <div class="modal-content-text" id="modalContent">
                    <!-- Blog post content will be loaded here dynamically -->
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="{{ asset('js/navbar.js') }}"></script>
    <script src="{{ asset('js/blog.js') }}"></script>
</body>
</html>







