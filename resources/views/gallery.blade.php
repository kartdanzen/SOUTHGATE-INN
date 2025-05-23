<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Southgate Inn Gallery</title>
    <!--Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!--Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="icon" href="{{ asset('images/tab.png') }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!--External CSS -->
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/gallery.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
</head>
<body>
    <!--Header -->
    <header class="header">
        @include('nav')
    </header>
    <div class="menu-overlay"></div>

    <!-- Gallery Content -->
    <main class="gallery-container">
        <div class="gallery-header">
            <h1>Our Gallery</h1>
            <p>Explore our beautiful spaces and enjoy the stunning views of Southgate Inn</p>
        </div>

        <div class="gallery-filter">
            <button class="filter-btn active" data-filter="all">All</button>
            <button class="filter-btn" data-filter="rooms">Rooms</button>
            <button class="filter-btn" data-filter="dining">Dining</button>
            <button class="filter-btn" data-filter="amenities">Amenities</button>
            <button class="filter-btn" data-filter="events">Events</button>
        </div>

        <!-- Marquee Gallery Rows/effect ni nga daw ga slide -->
        <div class="marquee-gallery">
            <!-- Rooms Row - Left to Right -->
            <div class="marquee-row" data-direction="left">
                <div class="marquee-content rooms-content">
                    <!-- Rooms -->
                    <div class="gallery-item" data-category="rooms">
                        <img src="{{ asset('sample/kevin corado.jpg') }}" alt="test">
                        <div class="gallery-overlay">
                            <h3>test</h3>
                            <p>test</p>
                        </div>
                    </div>
                    <div class="gallery-item" data-category="rooms">
                        <img src="{{ asset('sample/Look at the sky.jpg') }}" alt="test">
                        <div class="gallery-overlay">
                            <h3>test</h3>
                            <p>test</p>
                        </div>
                    </div>
                    <div class="gallery-item" data-category="rooms">
                        <img src="sample\download (11).jpg" alt="test">
                        <div class="gallery-overlay">
                            <h3>test</h3>
                            <p>test</p>
                        </div>
                    </div>
                    <!-- Duplicated for continuous scroll effect -->
                    <div class="gallery-item" data-category="rooms">
                        <img src="sample\Piet Reunites With Oakley for a Tribute to Brazillian Subcultures.jpg" alt="test">
                        <div class="gallery-overlay">
                            <h3>test</h3>
                            <p>test</p>
                        </div>
                    </div>
                    <div class="gallery-item" data-category="rooms">
                        <img src="sample\Q.jpg" alt="test">
                        <div class="gallery-overlay">
                            <h3>test</h3>
                            <p>test</p>
                        </div>
                    </div>
                    <div class="gallery-item" data-category="rooms">
                        <img src="sample\download (10).jpg" alt="test">
                        <div class="gallery-overlay">
                            <h3>test</h3>
                            <p>test</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dining Row - Right to Left -->
            <div class="marquee-row" data-direction="right">
                <div class="marquee-content dining-content">
                    <!-- Dining -->
                    <div class="gallery-item" data-category="dining">
                        <img src="sample\download (9).jpg"  alt="test">
                        <div class="gallery-overlay">
                            <h3>test</h3>
                            <p>test</p>
                        </div>
                    </div>
                    <div class="gallery-item" data-category="dining">
                        <img src="sample\How a Successful Street Photographer Captures Life's Unseen Moments [Interview].jpg" alt="test">
                        <div class="gallery-overlay">
                            <h3>test</h3>
                            <p>test</p>
                        </div>
                    </div>
                    <div class="gallery-item" data-category="dining">
                        <img src="sample\download (7).jpg" alt="test">
                        <div class="gallery-overlay">
                            <h3>test</h3>
                            <p>test</p>
                        </div>
                    </div>
                    <!-- Duplicated for continuous scroll effect -->
                    <div class="gallery-item" data-category="dining">
                        <img src="sample\download (6).jpg" alt="test">
                        <div class="gallery-overlay">
                            <h3>test</h3>
                            <p>test</p>
                        </div>
                    </div>
                    <div class="gallery-item" data-category="dining">
                        <img src="sample\0000download (12).jpg" alt="test">
                        <div class="gallery-overlay">
                            <h3>test</h3>
                            <p>test</p>
                        </div>
                    </div>
                    <div class="gallery-item" data-category="dining">
                        <img src="sample\download (13).jpg"alt="test">
                        <div class="gallery-overlay">
                            <h3>test</h3>
                            <p>test</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Amenities Row - Left to Right -->
            <div class="marquee-row" data-direction="left">
                <div class="marquee-content amenities-content">
                    <!-- Amenities -->
                    <div class="gallery-item" data-category="amenities">
                        <img src="sample\download (14).jpg" alt="test">
                        <div class="gallery-overlay">
                            <h3>test</h3>
                            <p>test</p>
                        </div>
                    </div>
                    <div class="gallery-item" data-category="amenities">
                        <img src="sample\₊✩‧₊˚౨ৎ˚₊✩‧₊.jpg"alt="test">
                        <div class="gallery-overlay">
                            <h3>test</h3>
                            <p>test</p>
                        </div>
                    </div>
                    <div class="gallery-item" data-category="amenities">
                        <img src="sample\download (16).jpg"alt="test">
                        <div class="gallery-overlay">
                            <h3>test</h3>
                            <p>test</p>
                        </div>
                    </div>
                    <!-- Duplicated for continuous scroll effect -->
                    <div class="gallery-item" data-category="amenities">
                        <img src="sample\download (17).jpg"alt="test">
                        <div class="gallery-overlay">
                            <h3>test</h3>
                            <p>test</p>
                        </div>
                    </div>
                    <div class="gallery-item" data-category="amenities">
                        <img src="sample\download (18).jpg" alt="test">
                        <div class="gallery-overlay">
                            <h3>test</h3>
                            <p>test</p>
                        </div>
                    </div>
                    <div class="gallery-item" data-category="amenities">
                        <img src="sample\download (19).jpg"alt="test">
                        <div class="gallery-overlay">
                            <h3>test</h3>
                            <p>test</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Events Row - Right to Left -->
            <div class="marquee-row" data-direction="right">
                <div class="marquee-content events-content">
                    <!-- Events -->
                    <div class="gallery-item" data-category="events">
                        <img src="sample\download (20).jpg" alt="test">
                        <div class="gallery-overlay">
                            <h3>test</h3>
                            <p>test</p>
                        </div>
                    </div>
                    <div class="gallery-item" data-category="events">
                        <img src="sample\download (21).jpg"alt="test">
                        <div class="gallery-overlay">
                            <h3>test</h3>
                            <p>test</p>
                        </div>
                    </div>
                    <div class="gallery-item" data-category="events">
                        <img src="sample\download (22).jpg" alt="test">
                        <div class="gallery-overlay">
                            <h3>test</h3>
                            <p>test</p>
                        </div>
                    </div>
                    <!-- Duplicated for continuous scroll effect -->
                    <div class="gallery-item" data-category="events">
                        <img src="sample\download (23).jpg" alt="test">
                        <div class="gallery-overlay">
                            <h3>test</h3>
                            <p>test</p>
                        </div>
                    </div>
                    <div class="gallery-item" data-category="events">
                        <img src="sample\download (24).jpg" alt="test">
                        <div class="gallery-overlay">
                            <h3>test</h3>
                            <p>test</p>
                        </div>
                    </div>
                    <div class="gallery-item" data-category="events">
                        <img src="sample\ꜱᴀᴠᴇ = ꜰᴏʟʟᴏᴡ ᴍᴇ.jpg"alt="test">
                        <div class="gallery-overlay">
                            <h3>MeowwwTest31</h3>
                            <p>pspspsppspsspsps</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer Section -->
    @include('components.footer')

    <!-- Gallery Modal -->
    <div class="gallery-modal">
        <div class="modal-content">
            <img src="" alt="" class="modal-image">
            <div class="modal-caption">
                <h3 class="modal-title"></h3>
                <p class="modal-description"></p>
            </div>
        </div>
        <span class="modal-close">&times;</span>
        <button class="modal-nav prev-btn"><i class="fas fa-chevron-left"></i></button>
        <button class="modal-nav next-btn"><i class="fas fa-chevron-right"></i></button>
    </div>

    <!-- JavaScript -->
    <script src="{{ asset('js/navbar.js') }}"></script>
    <script src="{{ asset('js/gallery.js') }}"></script>
</body>
</html>







