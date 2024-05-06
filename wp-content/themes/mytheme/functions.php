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
