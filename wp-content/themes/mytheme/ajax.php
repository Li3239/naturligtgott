<?php

use phpseclib3\Common\Functions\Strings;

define("PRODUCT_QUANTITY_PER_PAGE", 12);
define("NO_MORE_DATA_TO_LOAD", "No more products to load.");

//-----------------------------
// add script dependency
// pass parameter from php to js
//-----------------------------
function my_theme_enqueue_scripts()
{
    wp_enqueue_script("mytheme_lazy_load", get_template_directory_uri() . "/resources/scripts/ajax.js", array("jquery"), '1.0', true);

    // Localize script to include AJAX URL and nonce
    // pass PHP values(ajax_params.ajax_url, ajax_params.nonce) to ajax.js
    wp_localize_script('mytheme_lazy_load', 'ajax_params', array(
        //Pass the URL (admin-ajax.php) where the WordPress backend handles AJAX requests to the frontend JavaScript
        'ajax_url' => admin_url('admin-ajax.php'),
        //Created a security token called a nonce (digital signature) and passed it to the frontend
        'nonce' => wp_create_nonce('mytheme_lazy_load_nonce') 
    ));

    // transfer variable noMoreProducts to ajax.js
    wp_localize_script('mytheme_lazy_load', 'wpSettings', array(
        'noMoreProducts' => get_option('no_more_to_load', 'Du har nått slutet av listan.') // If not set, 'Du har nått slutet av listan.' will be displayed by default.
    ));
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_scripts');

//--------------------------------------------------------------
// Lazy load 
// when scroll down from frontend this function 
// (get from wp_ajax_nopriv_my_load_more_products) will be called
//--------------------------------------------------------------
function my_load_more_products()
{
    // verify nonce
    if (!isset($_POST['nonce']) ||
        !wp_verify_nonce($_POST['nonce'], 'mytheme_lazy_load_nonce')) {
        // verify NG
        die('Nonce verification failed.');
    }

    // get parameter "page" and category_slug which is sent from ajax.js
    $paged = !empty($_POST['page']) ? $_POST['page'] : 1; 
    $category_slug = isset($_POST['category_slug']) ? sanitize_text_field($_POST['category_slug']) : '';

    //sets up a new query for WooCommerce products,
    $args = array(
        'post_type' => 'product',  // query WooCommerce products
        'posts_per_page' => PRODUCT_QUANTITY_PER_PAGE, // load product quantity for each time
        'paged' => $paged, // The number of pages to be queried
        'orderby' => 'title',
        'tax_query' => array()
    );

    // if current page is product category page，add parameter'tax_query' into $args
    if (!empty($category_slug) && $category_slug !== 'shop') {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'product_cat',
                'field'    => 'slug',
                'terms'    => $category_slug,
            ),
        );
    }

    $loop = new WP_Query($args);
    if ($loop->have_posts()) {
        while ($loop->have_posts()) {
            $loop->the_post();

            //-----------------
            // output log
            //-----------------
            // get product ID and title
            $post_id = get_the_ID();
            $post_title = get_the_title();
            $log_message = "Produt information - ID: $post_id, Title: $post_title";
            error_log($log_message);

            // load template, run content-product.php
            wc_get_template_part('content', 'product');
        }
    } else {
        // echo 'No more products to load.';
        echo NO_MORE_DATA_TO_LOAD;
    }
    // reset original query
    wp_reset_postdata();
    die();
}
add_action('wp_ajax_nopriv_my_load_more_products', 'my_load_more_products');
add_action('wp_ajax_my_load_more_products', 'my_load_more_products');