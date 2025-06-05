document.addEventListener('DOMContentLoaded', function() {
    // Mobile Menu Toggle
    const menuToggle = document.querySelector('.menu-toggle');
    const nav = document.querySelector('.nav');
    const menuOverlay = document.querySelector('.menu-overlay');
    const closeBtn = document.querySelector('.mobile-close-btn');
    const navItems = document.querySelectorAll('.nav-item');

    console.log('Menu elements loaded:', {
        toggle: menuToggle ? true : false,
        nav: nav ? true : false,
        overlay: menuOverlay ? true : false,
        closeBtn: closeBtn ? true : false,
        navItems: navItems.length
    });

    // Function to force display of menu overlay
    function forceShowOverlay() {
        if (menuOverlay) {
            menuOverlay.style.display = 'block';
            menuOverlay.style.opacity = '1';
            menuOverlay.style.visibility = 'visible';
            document.body.style.overflow = 'hidden';
        }
    }

    // Function to force hide of menu overlay
    function forceHideOverlay() {
        if (menuOverlay) {
            // Reset body overflow FIRST before any other actions
            document.body.style.overflow = '';
            menuOverlay.style.opacity = '0';
            menuOverlay.style.visibility = 'hidden';

            setTimeout(() => {
                if (!menuOverlay.classList.contains('active')) {
                    menuOverlay.style.display = 'none';
                }
            }, 300);
        }
    }

    function closeMenu() {
        console.log('Closing menu');
        // Reset body overflow FIRST
        document.body.style.overflow = '';

        if (menuToggle) menuToggle.classList.remove('active');
        if (nav) {
            nav.style.right = '-100%';
            nav.classList.remove('open');
        }
        if (menuOverlay) {
            menuOverlay.classList.remove('active');
            forceHideOverlay();
        }
        document.body.classList.remove('menu-open');
    }

    if (menuToggle) {
        menuToggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            console.log('Menu toggle clicked');

            const isOpening = !this.classList.contains('active');
            this.classList.toggle('active');

            if (nav) {
                if (isOpening) {
                    nav.style.display = 'flex';
                    // Force a reflow
                    nav.offsetHeight;
                    nav.classList.add('open');
                    nav.style.right = '0';
                } else {
                    nav.classList.remove('open');
                    nav.style.right = '-100%';
                }
                console.log('Nav toggled:', nav.classList.contains('open'));
            }

            if (menuOverlay) {
                if (isOpening) {
                    menuOverlay.style.display = 'block';
                    // Force a reflow
                    menuOverlay.offsetHeight;
                    menuOverlay.classList.add('active');
                    forceShowOverlay();
                } else {
                    menuOverlay.classList.remove('active');
                    forceHideOverlay();
                }
                console.log('Overlay toggled:', menuOverlay.classList.contains('active'));
            }

            document.body.classList.toggle('menu-open');

            if (isOpening) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
            }
        });
    }

    if (closeBtn) {
        closeBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            closeMenu();
        });
    }

    if (menuOverlay) {
        menuOverlay.addEventListener('click', function(e) {
            if (e.target === menuOverlay) {
                e.preventDefault();
                e.stopPropagation();
                closeMenu();
            }
        });
    }

    // Add document-wide click handler to close menu when clicking outside
    document.addEventListener('click', function(e) {
        // If menu is open and click is outside the menu
        if (document.body.classList.contains('menu-open') &&
            nav && !nav.contains(e.target) &&
            menuToggle && !menuToggle.contains(e.target)) {
            closeMenu();
        }
    });

    // Add escape key handler to close menu
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && document.body.classList.contains('menu-open')) {
            closeMenu();
        }
    });

    // Failsafe to ensure body overflow is reset
    window.addEventListener('resize', function() {
        if (window.innerWidth > 1200 && document.body.style.overflow === 'hidden') {
            document.body.style.overflow = '';
        }
    });

    // Close menu when clicking on nav items in mobile view
    navItems.forEach(item => {
        item.addEventListener('click', function() {
            if (window.innerWidth <= 1200) {
                closeMenu();
            }
        });
    });

    // Ripple effect for nav items
    navItems.forEach(navItem => {
        navItem.addEventListener('click', createRipple);
    });

    function createRipple(event) {
        const navItem = event.currentTarget;
        const ripple = navItem.querySelector('.ripple');

        if (!ripple) return;

        // Reset any existing animation
        ripple.style.animation = 'none';

        // Calculate position relative to the button
        const rect = navItem.getBoundingClientRect();
        const x = event.clientX - rect.left;
        const y = event.clientY - rect.top;

        // Set ripple position
        ripple.style.top = `${y}px`;
        ripple.style.left = `${x}px`;

        // Trigger reflow and start animation
        ripple.offsetWidth;
        ripple.style.animation = 'ripple 1s ease-out';
    }

    // Hover effect enhancement for desktop only
    if (window.innerWidth > 1200) {
        navItems.forEach(navItem => {
            const hoverBg = navItem.querySelector('.hover-bg');

            if (!hoverBg) return;

            navItem.addEventListener('mouseenter', () => {
                // Add a slight bounce effect when hovering
                navItem.style.transform = 'translateY(-4px)';
                setTimeout(() => {
                    navItem.style.transform = 'translateY(-2px)';
                }, 150);
            });

            navItem.addEventListener('mouseleave', () => {
                navItem.style.transform = '';
            });
        });
    }

    // Only create menu-overlay if there isn't one already in the DOM
    if (!menuOverlay) {
        ensureMobileMenuElements();
    }

    // Function to ensure all mobile menu elements exist
    function ensureMobileMenuElements() {
        // Only create a new menu overlay if there isn't one
        if (!document.querySelector('.menu-overlay') && document.body) {
            console.log('Creating missing menu overlay');
            const overlay = document.createElement('div');
            overlay.className = 'menu-overlay';
            overlay.style.display = 'none';
            overlay.style.position = 'fixed';
            overlay.style.top = '0';
            overlay.style.left = '0';
            overlay.style.width = '100%';
            overlay.style.height = '100%';
            overlay.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
            overlay.style.zIndex = '999';
            overlay.style.backdropFilter = 'blur(3px)';
            overlay.style.opacity = '0';
            overlay.style.visibility = 'hidden';
            overlay.style.transition = 'opacity 0.3s ease, visibility 0.3s ease';

            document.body.appendChild(overlay);

            // Add event listener to close menu when clicking the overlay
            overlay.addEventListener('click', function(e) {
                if (e.target === overlay) {
                    closeMenu();
                }
            });
        }
    }

    // Prevent the overflow hidden issue by checking and fixing on page load
    if (document.body.style.overflow === 'hidden' && !document.body.classList.contains('menu-open')) {
        document.body.style.overflow = '';
    }

    // Double check for page usability after a delay
    setTimeout(function() {
        if (document.body.style.overflow === 'hidden' && !document.body.classList.contains('menu-open')) {
            document.body.style.overflow = '';
        }
    }, 1000);
});
