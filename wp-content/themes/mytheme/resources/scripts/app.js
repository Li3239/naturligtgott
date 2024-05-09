document.addEventListener('DOMContentLoaded', function() {
    var burgerMenuDiv = document.querySelector('.burger-menu-div');
    var mobileMenu = document.querySelector('.mobile-menu');

    // Open mobile menu when burger menu is clicked
    burgerMenuDiv.addEventListener('click', function(event) {
        mobileMenu.classList.toggle('show');
        event.stopPropagation(); // Prevents the click event from reaching the document body
    });

    // Close mobile menu when clicking outside of it
    document.body.addEventListener('click', function(event) {
        if (!mobileMenu.contains(event.target) && !burgerMenuDiv.contains(event.target)) {
            mobileMenu.classList.remove('show');
        }
    });
});