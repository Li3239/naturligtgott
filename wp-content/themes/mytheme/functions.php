<?php

if (!defined('ABSPATH')) {
    exit;
}

require_once(__DIR__ . "/init.php");


// support woocommerce
function mytheme_add_woocommerce_support()
{
    add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'mytheme_add_woocommerce_support');

function custom_modify_homepage_query( $query ) {
    // Check if it's the main query and on the homepage
    if ( $query->is_main_query() && $query->is_home() ) {
        // Limit the query to retrieve only one post
        $query->set( 'posts_per_page', 1 );
    }
}
add_action( 'pre_get_posts', 'custom_modify_homepage_query' );

add_filter( 'woocommerce_page_title', 'custom_modify_page_title', 10, 1 );
function custom_modify_page_title( $page_title ) {
    // Check if it's the product listing page
    if ( is_shop() ) {
        // Return an empty string to remove the title
        return '';
    }

    // For other pages, return the original page title
    return $page_title;
}