<?php

require_once('hooks.php');
require_once('shortcodes.php');
require_once('vite.php');
require_once('settings.php');
require_once('ajax.php');
require_once('customemail.php');

function mytheme_enqueue()
{
    $theme_directory_uri = get_template_directory_uri();
    wp_enqueue_style("custom-style", $theme_directory_uri . "/style.css");

    wp_enqueue_style(
        'font-awesome-free', // ID
        'https://use.fontawesome.com/releases/v6.5.1/css/all.css', // Font Awesome CDN link
        array(), // dependency，nothing，null array
        '6.5.1' // version number
    );

    // Enqueue app.js
    wp_enqueue_script('custom-js', $theme_directory_uri . "/app.js", array('jquery'), '1.0', true);
    // Enqueue update-cart-count.js
    wp_enqueue_script('update-cart-count-js', $theme_directory_uri . '/resources/scripts/update-cart-count.js', array('jquery'), null, true);
}
add_action("wp_enqueue_scripts", "mytheme_enqueue");


function mytheme_init()
{
    // add theme support
    add_theme_support('post-thumbnails');

    // register MENU
    $menu = array(
        'main_menu' => 'main_menu',
        'main_menu_icons' => 'main_menu_icons',
        'footer_company_info' => 'footer_company_info',
        'footer_contact' => 'footer_contact',
        'footer_product' => 'footer_product',
        'footer_social_media' => 'footer_social_media'
    );
    register_nav_menus($menu);
}
add_action("after_setup_theme", "mytheme_init");

add_filter( 'woocommerce_breadcrumb_defaults', 'change_breadcrumb_delimiter' );

function custom_body_classes( $classes ) {
    // Check if it's the shop page
    if ( is_shop() ) {
        // Remove the existing class
        $key = array_search( 'woocommerce', $classes );
        if ( $key !== false ) {
            unset( $classes[ $key ] );
        }
        // Add the new class
        $classes[] = 'shop';
    }
    return $classes;
}
add_filter( 'body_class', 'custom_body_classes' );

// Include custom WooCommerce wrapper functions
require get_template_directory() . '/woocommerce-wrapper-functions.php';