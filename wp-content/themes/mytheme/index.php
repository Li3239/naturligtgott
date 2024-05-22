<?php

/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package NaturligtGott
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

get_header();
?>

<?php
// Define the default class
$class = 'content';

// Check if it's a single blog post
if (is_single()) {
    // Check if it's a single product
    if (is_singular('product')) {
        $class = 'single-product';
    } else {
        $class = 'single-blogpost';
    }
}
// Check if it's the checkout page
elseif (is_checkout() && !is_wc_endpoint_url('order-received')) {
    $class = 'content-checkout';
}
// Check if it's the thank you(order received) page
elseif (is_wc_endpoint_url('order-received')) {
    // This is the "Thank You" page
    $class = 'content-thank-you';
}
// Check if it's the shop page
elseif (is_shop()) {
    $class = 'shop-content';
}
// Check if it's the cart page
elseif (is_cart()) {
    $class = 'content-cart';
}
// Check if it's a single product detail page
elseif (is_product()) {
    $class = 'content-detail';
}
// Check if it's the custom login page
elseif (is_page('login')) {
    $class = 'content-login';
}
// Check if it's the custom login page
elseif (is_page('Kontakta Oss')) {
    $class = 'content-kontakt';
}

// Output the class attribute with the determined value
echo '<main id="primary" class="' . esc_attr($class) . '">';
?>
    <?= the_content() ?>
</main>

<?php get_footer(); ?>