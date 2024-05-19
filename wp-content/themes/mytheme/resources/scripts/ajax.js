//-----------------------------------------------------------
// Scroll to load more products(no button needed)
//-----------------------------------------------------------
jQuery(function($) {
    let no_more_data_to_load = "No more products to load." // as same as const variable NO_MORE_DATA_TO_LOAD in ajax.php
    let page = 2; // from the second page to do lazyload
    let loading = false; // prevent repeated loading
    let max_pages = 10;
    // get current page slug, eg: slug=rea, from url: https://naturligtgott.test/product-category/rea/
    let categorySlug = window.location.pathname.split('/').filter(function(el) { return el.length != 0; }).pop();
    console.log('categorySlug = ' + categorySlug);
    
    // check if products exist
    if ($('div.product-div > ul > li').length === 0) {
        // Don't need to do lazylode if product doesn't exist
        console.log("No products available on " + categorySlug + " page initial load!");
    } else {
        // do lazyload...
        $(window).on('scroll', handleScroll);
    }

    function handleScroll() {
        // Check if the user scrolled to the bottom of the page
        if ($(window).scrollTop() + $(window).height() > $(document).height() - 500 && 
            !loading && page <= max_pages) {
            loading = true; // Prevent duplicate requests during loading
            console.log("Lazy load page = [" + page.toString() + "]");

            // parameters which will be transfered to php
            let data = {
                'action': 'my_load_more_products', // call function  my_load_more_products in ajax.php
                'page': page,
                'nonce': ajax_params.nonce, // The (digitally signed) security token passed from ajax.php
                'category_slug': categorySlug  // current category's slug
            };

            //ajax_params.ajax_url： the parameter passed to js in ajax.php so that js can send AJAX requests to the WordPress backend
            //Send a POST request to WordPress
            $.post(ajax_params.ajax_url, data, function(response) {
                if (response && response != no_more_data_to_load) {
                    $('div.product-div > ul.products.columns-3').append(response);
                    page++;
                    loading = false;
                } else {
                    $(window).off('scroll');
                    // show message
                    $('div.product-div').append('<p class="no-more-data">' + wpSettings.noMoreProducts + '</p>');
                }
            });
        }
    }
});