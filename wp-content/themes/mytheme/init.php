<?php

require_once('hooks.php');

function mytheme_enqueue()
{
    $theme_directory_uri = get_template_directory_uri();
    wp_enqueue_style("custom-style", $theme_directory_uri . "/style.css");
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
        'footer_social_media' => 'footer_social_media',
        'footer_shopping' => 'footer_shopping',
        'footer_links' => 'footer_links',
        'footer_blog' => 'footer_blog'
    );
    register_nav_menus($menu);
}
add_action("after_setup_theme", "mytheme_init");