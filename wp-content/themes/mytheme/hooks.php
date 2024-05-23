<?php
require_once(__DIR__ . "/includes/checkout-page-hooks.php");
require_once(__DIR__ . "/includes/add-to-cart-hook.php");

// CHANGES BREADCRUMB DELIMITER
function change_breadcrumb_delimiter( $defaults ) {
    // GET URL FOR THE ICON FROM MEDIA LIBRARY
    $icon_url = 'http://naturligtgott.test/wp-content/uploads/2024/05/breadcrumbarrow.png';

    // REPLACE DELIMITER WITH ICON
    $defaults['delimiter'] = '<img src="' . esc_url( $icon_url ) . '" alt="Breadcrumb Icon" class="breadcrumb-icon">';

    return $defaults;
}


add_action('woocommerce_after_single_product_summary', 'add_custom_separator_before_sku', 20);

function add_custom_separator_before_sku() {
    ?>
    <script>
        jQuery(function($) {
            $(document).ready(function() {
                $('.sku_wrapper').before('<div style="width: 405px; height: 1px; background-color: #D9D9D9; margin-bottom: 20px;"></div>');
            });
        });
    </script>
    <?php
}
add_action( 'woocommerce_product_meta_end', 'add_custom_separator_after_product_meta' );

function add_custom_separator_after_product_meta() {
    ?>
    <div class="custom-separator"></div>
    <?php
}

// Change text on Home page on Add to cart btn
function custom_woocommerce_product_add_to_cart_text() {
    return __( 'Lägg till', 'woocommerce' ); // Change 'Custom Text' to your desired button text
}
add_filter( 'woocommerce_product_add_to_cart_text', 'custom_woocommerce_product_add_to_cart_text' ); // For product archives
add_filter( 'woocommerce_product_single_add_to_cart_text', 'custom_woocommerce_product_add_to_cart_text' ); // For single product pages

add_action( 'woocommerce_after_shop_loop_item_title', 'add_custom_rating_pro', 5 );

function add_custom_rating_pro() {
    global $product;

    if ( $product->get_review_count() > 0 ) {
        $average_rating = $product->get_average_rating();
        $rating_count = $product->get_review_count();

        $output = '<div class="woocommerce-product-rating">';

        for ($i = 1; $i <= 5; $i++) {
     
            if ($i <= $average_rating) {
            
                $output .= '<img src="' . get_template_directory_uri() . '/resources/images/full_star.png" alt="fullstar">';
            } else if ($i - 0.5 <= $average_rating) {
            
                $output .= '<img src="' . get_template_directory_uri() . '/resources/images/half_star.png" alt="halfstar">';
            } else {
         
                $output .= '<img src="' . get_template_directory_uri() . '/resources/images/empty_star.png" alt="emptystar">';
            }
        }

        $output .= '</div>';
        echo $output;
    }
}

add_action( 'woocommerce_single_product_summary', 'add_custom_rating_pro_single', 11 );

function add_custom_rating_pro_single() {
    global $product;

    if ( $product->get_review_count() > 0 ) {
        $average_rating = $product->get_average_rating();
        $rating_count = $product->get_review_count();

        $output = '<div class="woocommerce-product-rating">';

        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $average_rating) {
                $output .= '<img src="' . get_template_directory_uri() . '/resources/images/full_star.png" alt="fullstar">';
            } else if ($i - 0.5 <= $average_rating) {
                $output .= '<img src="' . get_template_directory_uri() . '/resources/images/half_star.png" alt="halfstar">';
            } else {
                $output .= '<img src="' . get_template_directory_uri() . '/resources/images/empty_star.png" alt="emptystar">';
            }
        }

        $output .= '</div>';
        echo $output;
    }
}