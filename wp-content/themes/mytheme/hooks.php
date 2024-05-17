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