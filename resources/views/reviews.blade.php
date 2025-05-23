<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Southgate Inn Reviews</title>
    <!-- Add Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Add Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="icon" href="{{ asset('images/tab.png') }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- External CSS -->
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/reviews.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
</head>
<body>
    <!-- Header -->
    <header class="header">
        @include('nav')
    </header>

    <!-- Reviews Section -->
    <section class="reviews-section">
        <div class="reviews-container">
            <h2 class="section-title">Sharing Stories of Comfort & Elegance</h2>
            <p class="section-subtitle">Discover why Southgate Inn feels like home.</p>

            <!-- Reviews Filter Section -->
            <div class="reviews-filter">
                <button class="filter-btn active" data-rating="all">All Reviews</button>
                <button class="filter-btn" data-rating="5">5 Star</button>
                <button class="filter-btn" data-rating="4">4 Star</button>
                <button class="filter-btn" data-rating="3">3 Star</button>
                <button class="filter-btn" data-rating="recent">Most Recent</button>
            </div>

            <!-- Reviews List -->
            <div class="reviews-list">
                @forelse($reviews as $review)
                <div class="review-card" data-rating="{{ $review->rating }}" style="--index: {{ $loop->index }}">
                    <div class="review-quote">&ldquo;</div>
                    <div class="review-header">
                        <div class="reviewer-avatar">
                            @if($review->reviewer_avatar)
                                <img src="{{ asset('storage/'.$review->reviewer_avatar) }}" alt="{{ $review->reviewer_name }}" class="reviewer-image">
                            @else
                                <i class="fas fa-user-circle reviewer-image"></i>
                            @endif
                        </div>
                        <div class="reviewer-info">
                            <h3 class="reviewer-name">{{ $review->reviewer_name }}</h3>
                            <p class="review-date">{{ $review->created_at->format('F d, Y') }}</p>
                            <div class="review-rating">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $review->rating)
                                        <i class="fas fa-star"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor
                            </div>
                        </div>
                    </div>
                    <div class="review-content">
                        <p>{{ $review->content }}</p>
                        <p class="review-highlight">"{{ $review->title }}"</p>
                        <div class="review-content-gradient"></div>
                    </div>
                    <button class="see-more-btn">See more</button>
                    <!-- Debug: {{ $review->images->count() }} images found for this review -->
                    @if($review->images->count() > 0)
                    <div class="review-images">
                        <div class="review-image-thumbnails">
                            @foreach($review->images as $image)
                            <!-- Debug: Image ID: {{ $image->id }}, Filename: {{ $image->filename }} -->
                            <img src="{{ route('reviews.image', $image->id) }}"
                                alt="Review Image"
                                class="review-image-thumb"
                                onclick="openImageGallery(this)">
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
                @empty
                @endforelse
            </div>
            
            @if(count($reviews) == 0)
            <div class="no-reviews">
                <p>No reviews available yet. All submissions are reviewed for appropriate language. Be the first to share your experience! </p>
            </div>
            @endif
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="stats-container">
            <h2 class="section-title">Our Hospitality in Numbers</h2>
            <p class="section-subtitle">We're proud of the experiences we create for our guests, and our numbers speak for themselves.</p>

            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-icon"><i class="fas fa-users"></i></div>
                    <div class="stat-number">15,000+</div>
                    <div class="stat-label">Happy Guests</div>
                </div>
                
                <div class="stat-item">
                    <div class="stat-icon"><i class="fas fa-calendar-check"></i></div>
                    <div class="stat-number">5,200+</div>
                    <div class="stat-label">Successful Stays</div>
                </div>

                <div class="stat-item">
                    <div class="stat-icon"><i class="fas fa-star"></i></div>
                    <div class="stat-number">4.8</div>
                    <div class="stat-label">Average Rating</div>
                </div>

                <div class="stat-item">
                    <div class="stat-icon"><i class="fas fa-redo"></i></div>
                    <div class="stat-number">70%</div>
                    <div class="stat-label">Return Rate</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Write Review Section -->
    <section class="write-review-section">
        <div class="write-review-container">
            <h2 class="section-title">Share Your Experience</h2>
            <p class="section-subtitle">We value your feedback. Tell us about your stay at Southgate Inn and help future guests make informed decisions.</p>

            <form class="review-form" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="reviewerName" class="form-label">Your Name</label>
                    <input type="text" id="reviewerName" class="form-control" placeholder="Enter your full name" required>
                </div>

                <div class="form-group">
                    <label for="reviewerEmail" class="form-label">Your Email</label>
                    <input type="email" id="reviewerEmail" class="form-control" placeholder="Enter your email" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Your Rating</label>
                    <div class="rating-input">
                        <input type="radio" id="star1" name="rating" value="1" hidden>
                        <label for="star1" data-value="1"><i class="fas fa-star"></i></label>

                        <input type="radio" id="star2" name="rating" value="2" hidden>
                        <label for="star2" data-value="2"><i class="fas fa-star"></i></label>

                        <input type="radio" id="star3" name="rating" value="3" hidden>
                        <label for="star3" data-value="3"><i class="fas fa-star"></i></label>

                        <input type="radio" id="star4" name="rating" value="4" hidden>
                        <label for="star4" data-value="4"><i class="fas fa-star"></i></label>

                        <input type="radio" id="star5" name="rating" value="5" hidden>
                        <label for="star5" data-value="5"><i class="fas fa-star"></i></label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="reviewTitle" class="form-label">Review Title</label>
                    <input type="text" id="reviewTitle" class="form-control" placeholder="Summarize your experience" required>
                </div>

                <div class="form-group">
                    <label for="reviewContent" class="form-label">Your Review</label>
                    <textarea id="reviewContent" class="form-control" rows="5" placeholder="Tell us about your stay..." required maxlength="200"></textarea>
                    <div class="char-counter"><span id="charCount">0</span>/200 characters</div>
                </div>

                <div class="form-group">
                    <label for="reviewImages" class="form-label">Upload Photos (Max 10)</label>
                    <div class="image-upload-container">
                        <div class="image-upload-preview" id="imagePreviewContainer"></div>
                        <div class="image-upload-controls">
                            <input type="file" id="reviewImages" class="image-upload-input" accept="image/*" multiple>
                            <label for="reviewImages" class="image-upload-btn"><i class="fas fa-camera"></i> Choose Photos</label>
                            <p class="image-upload-info">You can upload up to 10 images (max 5MB each)</p>
                        </div>
                    </div>
                </div>

                <button type="submit" class="submit-btn">Submit Review</button>
            </form>
        </div>
    </section>

    <!-- Review Submission Popup -->
    <div class="review-popup">
        <div class="review-popup-content">
            <span class="review-popup-close">&times;</span>
            <div class="review-popup-icon"><i class="fas fa-clock"></i></div>
            <h3 class="review-popup-title">Review Pending</h3>
            <p class="review-popup-message">Thank you for your feedback! Your review is currently pending approval. We will review it shortly and publish it on our website.</p>
            <button class="review-popup-btn">OK</button>
        </div>
    </div>

    <!-- Footer Section -->
    @include('components.footer')

    <!-- Image Gallery Modal -->
    <div class="image-gallery-modal" id="imageGalleryModal">
        <div class="gallery-content">
            <img src="" alt="Full size image" class="gallery-image" id="galleryImage">
            <div class="gallery-close" onclick="closeImageGallery()">&times;</div>
            <div class="gallery-prev" onclick="changeGalleryImage(-1)"><i class="fas fa-chevron-left"></i></div>
            <div class="gallery-next" onclick="changeGalleryImage(1)"><i class="fas fa-chevron-right"></i></div>
        </div>
    </div>

    <!--JavaScript -->
    <script src="{{ asset('js/navbar.js') }}"></script>
    <script src="{{ asset('js/reviews.js') }}"></script>
</body>
</html>







