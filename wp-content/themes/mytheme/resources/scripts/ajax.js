//-----------------------------------------------------------
// Scroll to load more products(no button needed)
//-----------------------------------------------------------
jQuery(function($) {
    var page = 2; // from the second page to do lazyload
    var loading = false; // prevent repeated loading
    var max_pages = 10;
    // console.log('lazyload.js loaded successfully');
    
    $(window).scroll(function() {
        // Check if the user scrolled to the bottom of the page
        if ($(window).scrollTop() + $(window).height() > $(document).height() - 500 && 
            !loading && page <= max_pages) {
            loading = true; // Prevent duplicate requests during loading
            console.log("Lazy load page = [" + page.toString() + "]");

            var data = {
                'action': 'my_load_more_products', // call function  my_load_more_products in ajax.php
                'page': page,
                'nonce': ajax_params.nonce // The (digitally signed) security token passed from ajax.php
            };

            //ajax_params.ajax_url： the parameter passed to js in ajax.php so that js can send AJAX requests to the WordPress backend
            //Send a POST request to WordPress
            $.post(ajax_params.ajax_url, data, function(response) {
                if (response && response != 'No more products to load.') {
                    $('div.product-div > ul.products.columns-4').append(response);
                    page++;
                    loading = false;
                } else {
                    $(window).off('scroll');
                    // show message
                    $('div.product-div').append('<p class="no-more-data">' + wpSettings.noMoreProducts + '</p>');
                }
            });
        }
    });
});