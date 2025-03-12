document.addEventListener('DOMContentLoaded', () => {
    const menuButton = document.getElementById('menuButton');
    const mobileMenu = document.getElementById('mobileMenu');
    
    // Toggle menu when button is clicked
    menuButton.addEventListener('click', (e) => {
        e.stopPropagation(); // Prevent click from bubbling to document
        mobileMenu.classList.toggle('hidden');
        
        // Toggle menu icon
        const menuIcon = menuButton.querySelector('i');
        if (mobileMenu.classList.contains('hidden')) {
            menuIcon.classList.remove('bi-x-lg');
            menuIcon.classList.add('bi-list');
        } else {
            menuIcon.classList.remove('bi-list');
            menuIcon.classList.add('bi-x-lg');
        }
    });

    // Close menu when clicking outside
    document.addEventListener('click', (e) => {
        if (!mobileMenu.classList.contains('hidden') && // Only if menu is open
            !menuButton.contains(e.target) && // Not clicking the button
            !mobileMenu.contains(e.target)) { // Not clicking the menu
            
            mobileMenu.classList.add('hidden');
            const menuIcon = menuButton.querySelector('i');
            menuIcon.classList.remove('bi-x-lg');
            menuIcon.classList.add('bi-list');
        }
    });

    // Prevent menu close when clicking inside menu
    mobileMenu.addEventListener('click', (e) => {
        e.stopPropagation();
    });
}); 