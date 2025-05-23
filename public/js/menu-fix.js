// Direct fix for hamburger menu issues
document.addEventListener('DOMContentLoaded', function() {
    console.log('Menu fix script loaded');
    
    // Get menu elements
    const menuToggle = document.querySelector('.menu-toggle');
    const nav = document.querySelector('.nav');
    const menuOverlay = document.querySelector('.menu-overlay');
    let closeBtn = document.querySelector('.mobile-close-btn');
    
    // Create close button if it doesn't exist
    if (!closeBtn && nav) {
        closeBtn = document.createElement('button');
        closeBtn.className = 'mobile-close-btn';
        closeBtn.setAttribute('aria-label', 'Close menu');
        
        const icon = document.createElement('i');
        icon.className = 'fas fa-times';
        closeBtn.appendChild(icon);
        
        nav.appendChild(closeBtn);
        console.log('Created missing close button');
    }
    
    console.log('Menu elements:', {
        toggle: menuToggle ? true : false,
        nav: nav ? true : false,
        overlay: menuOverlay ? true : false,
        closeBtn: closeBtn ? true : false
    });
    
    // Fix menu overlay styles
    if (menuOverlay) {
        // Force initial styles
        menuOverlay.style.display = 'none';
        menuOverlay.style.position = 'fixed';
        menuOverlay.style.top = '0';
        menuOverlay.style.left = '0';
        menuOverlay.style.width = '100%';
        menuOverlay.style.height = '100%';
        menuOverlay.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
        menuOverlay.style.zIndex = '999';
        menuOverlay.style.backdropFilter = 'blur(3px)';
    }
    
    // Ensure toggle button is working
    if (menuToggle) {
        // Remove previous event listeners by cloning and replacing
        const newMenuToggle = menuToggle.cloneNode(true);
        menuToggle.parentNode.replaceChild(newMenuToggle, menuToggle);
        
        // Add event listener to the new button
        newMenuToggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            console.log('Menu toggle clicked');
            this.classList.toggle('active');
            
            if (nav) {
                nav.classList.toggle('open');
                console.log('Nav toggled:', nav.classList.contains('open'));
            }
            
            if (menuOverlay) {
                menuOverlay.classList.toggle('active');
                
                // Force display property
                if (menuOverlay.classList.contains('active')) {
                    menuOverlay.style.display = 'block';
                } else {
                    setTimeout(() => {
                        if (!menuOverlay.classList.contains('active')) {
                            menuOverlay.style.display = 'none';
                        }
                    }, 300);
                }
            }
            
            document.body.classList.toggle('menu-open');
        });
    }
    
    // Fix close button if present
    if (closeBtn) {
        // Remove previous event listeners
        const newCloseBtn = closeBtn.cloneNode(true);
        closeBtn.parentNode.replaceChild(newCloseBtn, closeBtn);
        
        // Add new event listener
        newCloseBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            console.log('Close button clicked');
            if (menuToggle) menuToggle.classList.remove('active');
            if (nav) nav.classList.remove('open');
            if (menuOverlay) {
                menuOverlay.classList.remove('active');
                setTimeout(() => {
                    if (!menuOverlay.classList.contains('active')) {
                        menuOverlay.style.display = 'none';
                    }
                }, 300);
            }
            
            document.body.classList.remove('menu-open');
        });
    }
    
    // Fix overlay click behavior
    if (menuOverlay) {
        // Remove previous event listeners
        const newMenuOverlay = menuOverlay.cloneNode(true);
        menuOverlay.parentNode.replaceChild(newMenuOverlay, menuOverlay);
        
        // Add new event listener
        newMenuOverlay.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            console.log('Overlay clicked');
            if (menuToggle) menuToggle.classList.remove('active');
            if (nav) nav.classList.remove('open');
            newMenuOverlay.classList.remove('active');
            
            setTimeout(() => {
                if (!newMenuOverlay.classList.contains('active')) {
                    newMenuOverlay.style.display = 'none';
                }
            }, 300);
            
            document.body.classList.remove('menu-open');
        });
    }
});     