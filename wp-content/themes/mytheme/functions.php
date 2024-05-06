<?php

require_once(get_template_directory() . "/vite.php");
require_once(get_template_directory() . "/init.php");
require_once(get_template_directory() . "/settings.php");


if (!defined('ABSPATH')) {
    exit;
}

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