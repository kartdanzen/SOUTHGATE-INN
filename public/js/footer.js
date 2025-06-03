
// Parallax and fade-in for footer columns
function animateFooterColumns() {
    const columns = [
        ...document.querySelectorAll('.footer-contact'),
        ...document.querySelectorAll('.footer-links'),
        ...document.querySelectorAll('.footer-services'),
        ...document.querySelectorAll('.footer-column:not(.footer-contact):not(.footer-links):not(.footer-services)')
    ];
    const windowHeight = window.innerHeight;
    columns.forEach((col, i) => {
        const rect = col.getBoundingClientRect();
        if (rect.top < windowHeight - 50) {
            // Parallax effect: move up slightly based on scroll, fade in
            const scrollY = window.scrollY || window.pageYOffset;
            col.style.transform = `translateY(${Math.max(0, 40 - (windowHeight - rect.top) * 0.15)}px)`;
            col.style.opacity = '1';
            col.style.transition = 'transform 3.7s cubic-bezier(0.22, 1, 0.36, 1), opacity 0.7s';
        } else {
            // Reset when out of view
            col.style.transform = 'translateY(40px)';
            col.style.opacity = '0';
            col.style.transition = 'none';
        }
    });
}

window.addEventListener('scroll', animateFooterColumns);
window.addEventListener('resize', animateFooterColumns);
document.addEventListener('DOMContentLoaded', animateFooterColumns);
