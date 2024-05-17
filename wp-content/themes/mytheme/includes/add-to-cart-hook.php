<?php

/*
** Add the cart count <span> 
** if the cart is not empty ($cart_count > 0) : display
** if the cart is empty ($cart_count = 0) : hidden
*/
function add_cart_count_to_menu_item($items, $args)
{
    // Check if it is the specified menu; adjust condition as needed
    if ($args->theme_location == 'main_menu_icons') {
        // Use DOMDocument to parse HTML
        $dom = new DOMDocument();
        $dom->loadHTML(mb_convert_encoding($items, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        // Find all <li> elements
        $xpath = new DOMXPath($dom);
        $cart_items = $xpath->query("//li[contains(@class, 'main_cart')]");

        foreach ($cart_items as $cart_item) {
            $cart_count = WC()->cart->get_cart_contents_count();
            // Create a new <span> element to hold the count of the cart
            $span = $dom->createElement('span');
            $span->setAttribute('class', 'cart-count');
            $span->setAttribute('style', 'display: none;');
            if ($cart_count > 0) {
                $span->nodeValue = (string) $cart_count;
                $span->setAttribute('style', 'display: inline;');
            }
            // Append the new <span> element to the <a> tag
            $link = $cart_item->getElementsByTagName('a')->item(0);
            $link->appendChild($span);
        }

        // Save the modified HTML
        $items = $dom->saveHTML();
    }
    return $items;
}
add_filter('wp_nav_menu_items', 'add_cart_count_to_menu_item', 10, 2);

/*
** This function handles an AJAX request to return the current count of items in the cart. 
** It is triggered by the get_cart_contents_count AJAX action,
** which matches the action used in update-cart-count.js
*/
function get_cart_contents_count()
{
    echo WC()->cart->get_cart_contents_count();
    wp_die();  // Make sure Ajax terminates after calling
}
add_action('wp_ajax_get_cart_contents_count', 'get_cart_contents_count');
add_action('wp_ajax_nopriv_get_cart_contents_count', 'get_cart_contents_count');

/*
** This function updates the cart based on 
** the product_id and quantity sent through AJAX. 
*/
function handle_update_cart_quantity_in_cart_page()
{
    // Check if the necessary parameters are set
    if (isset($_POST['product_id'], $_POST['quantity'])) {
        $product_id = intval($_POST['product_id']);
        $quantity = intval($_POST['quantity']);

        // Update the cart
        $cart_updated = false;
        foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
            if ($cart_item['product_id'] == $product_id) {
                WC()->cart->set_quantity($cart_item_key, $quantity);
                $cart_updated = true;
                break;
            }
        }

        // Check if cart update was successful
        if ($cart_updated) {
            WC()->cart->calculate_totals();  // Recalculate totals to reflect the change
            wp_send_json_success(array('message' => 'Cart updated successfully'));
        } else {
            wp_send_json_error(array('message' => 'Failed to update cart'));
        }
    } else {
        // If product_id or quantity is not set, return an error
        wp_send_json_error(array('message' => 'Product ID or quantity not set'));
    }
}
// Hook for handling AJAX request for logged-in and not logged-in users
add_action('wp_ajax_update_cart_quantity_action', 'handle_update_cart_quantity_in_cart_page');
add_action('wp_ajax_nopriv_update_cart_quantity_action', 'handle_update_cart_quantity_in_cart_page');
