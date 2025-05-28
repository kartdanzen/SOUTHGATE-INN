// Improved hamburger menu functionality
document.addEventListener('DOMContentLoaded', function() {
    // Get menu elements
    const menuToggle = document.querySelector('.menu-toggle');
    const nav = document.querySelector('.nav');
    const menuOverlay = document.querySelector('.menu-overlay');
    
    // Function to open menu
    function openMenu() {
        menuToggle.classList.add('active');
        nav.classList.add('open');
        nav.style.right = '0';
        menuOverlay.style.display = 'block';
        menuOverlay.classList.add('active');
        document.body.classList.add('menu-open');
        document.body.style.overflow = 'hidden';
    }
    
    // Function to close menu
    function closeMenu() {
        menuToggle.classList.remove('active');
        nav.classList.remove('open');
        nav.style.right = '-100%';
        menuOverlay.classList.remove('active');
        document.body.classList.remove('menu-open');
        document.body.style.overflow = '';
        
        // Hide overlay after animation
        setTimeout(() => {
            if (!menuOverlay.classList.contains('active')) {
                menuOverlay.style.display = 'none';
            }
        }, 300);
    }
    
    // Initialize menu state
    if (menuOverlay) {
        menuOverlay.style.display = 'none';
        menuOverlay.style.position = 'fixed';
        menuOverlay.style.top = '0';
        menuOverlay.style.left = '0';
        menuOverlay.style.width = '100%';
        menuOverlay.style.height = '100%';
        menuOverlay.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
        menuOverlay.style.zIndex = '999';
        menuOverlay.style.backdropFilter = 'blur(3px)';
        menuOverlay.style.transition = 'opacity 0.3s ease';
    }
    
    // Menu toggle click handler
    if (menuToggle) {
        menuToggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            if (nav.classList.contains('open')) {
                closeMenu();
            } else {
                openMenu();
            }
        });
    }
    
    // Overlay click handler
    if (menuOverlay) {
        menuOverlay.addEventListener('click', function(e) {
            if (e.target === menuOverlay) {
                closeMenu();
            }
        });
    }
    
    // Close menu when clicking nav items
    const navItems = document.querySelectorAll('.nav-item');
    navItems.forEach(item => {
        item.addEventListener('click', () => {
            if (window.innerWidth <= 1200) {
                closeMenu();
            }
        });
    });
    
    // Close menu on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && nav.classList.contains('open')) {
            closeMenu();
        }
    });
    
    // Handle window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth > 1200) {
            closeMenu();
            document.body.style.overflow = '';
        }
    });
    
    // Double-check menu state on page load
    if (nav.classList.contains('open')) {
        openMenu();
    } else {
        closeMenu();
    }
});     