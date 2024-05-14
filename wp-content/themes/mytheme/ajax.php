<?php

define("PRODUCT_QUANTITY_PER_PAGE", 6);

//-----------------------------
// add script dependency
//-----------------------------
function my_theme_enqueue_scripts()
{
    wp_enqueue_script("mytheme_lazy_load", get_template_directory_uri() . "/resources/scripts/ajax.js", array("jquery"), '1.0', true);

    // Localize script to include AJAX URL and nonce
    wp_localize_script('mytheme_lazy_load', 'ajax_params', array(
        //Pass the URL (admin-ajax.php) where the WordPress backend handles AJAX requests to the frontend JavaScript
        'ajax_url' => admin_url('admin-ajax.php'),
        //Created a security token called a nonce (digital signature) and passed it to the frontend
        'nonce' => wp_create_nonce('mytheme_lazy_load_nonce') 
    ));

    // transfer variable noMoreProducts to lazyload.js
    wp_localize_script('mytheme_lazy_load', 'wpSettings', array(
        'noMoreProducts' => get_option('no_more_to_load', 'Du har nått slutet av listan.') // If not set, 'Du har nått slutet av listan.' will be displayed by default.
    ));
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_scripts');

//-------------------------------
// Lazy load 
//-------------------------------
function my_load_more_products()
{
    // verify nonce
    if (
        !isset($_POST['nonce']) ||
        !wp_verify_nonce($_POST['nonce'], 'mytheme_lazy_load_nonce')
    ) {
        // verify NG
        die('Nonce verification failed.');
    }

    $args = array(
        'post_type' => 'product',  // query WooCommerce products
        'posts_per_page' => PRODUCT_QUANTITY_PER_PAGE, // load product quantity for each time
        'paged' => $_POST['page'], // The number of pages to be queried
    );

    $loop = new WP_Query($args);
    if ($loop->have_posts()) {
        while ($loop->have_posts()) {
            $loop->the_post();
            // load template, run content-product.php
            wc_get_template_part('content', 'product');
        }
    } else {
        echo 'No more products to load.';
    }

    wp_reset_postdata();
    die();
}
add_action('wp_ajax_nopriv_my_load_more_products', 'my_load_more_products');
add_action('wp_ajax_my_load_more_products', 'my_load_more_products');
