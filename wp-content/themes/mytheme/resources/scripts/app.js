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

    //show the search input on click 
    jQuery(document).ready(function($) {
        $('.main_search').on('click', function() {
            $('.search_input').toggle();
        });
    });
    
    jQuery(document).ready(function($) {
        // Hide the search input initially
        $('.search_input').hide();
    
        // Show or hide the search input based on focus and input content
        $('#keyword').on('focus', function() {
            $('.search_input').show();
        });
    
        $('#keyword').on('blur', function() {
            // Check if the input is empty
            if ($(this).val().trim().length === 0) {
                $('.search_input').hide();
            }
        });
    });
    
    
});