<?php

/*
 * Custom Send Email 
 */
function my_custom_thank_you_email($order_id)
{
    $order = wc_get_order($order_id);
    if (!$order) return;

    // Set product order items list
    $order_items = $order->get_items();
    // to show order item detail (Multipule)
    $items_list = '';
    /**
     * @var WC_Order_Item_Product $item
     */
    foreach ($order_items as $item_id => $item) {
        $product_name = $item->get_name();
        $quantity = $item->get_quantity();
        $price_per_unit = $item->get_total() / $quantity;

        $items_list .= '<tr class="email-order-item">';
        $items_list .= '  <td class="column-product">' . $product_name . '</td>';
        $items_list .= '  <td class="column-quantity">' . $quantity . '</td>';
        $items_list .= '  <td class="column-price">';
        $items_list .= '     <span class="woocommerce-Price-amount amount">' . wc_price($price_per_unit) . '</span>';
        $items_list .= '  </td>';
        $items_list .= '</tr>';
    }

    // get related product  list
    $related_product_info = array();
    /**
     * @var WC_Order_Item_Product $item
     */
    foreach ($order_items as $item_id => $item) {
        $product = $item->get_product();
        $related_products = wc_get_related_products($product->get_id());
        foreach ($related_products as $related_product_id) {
            $related_product = wc_get_product($related_product_id);
            $related_product_info[] = array(
                'title' => $related_product->get_name(),
                'image' => $related_product->get_image(), // 获取产品图片
                'link' => $related_product->get_permalink(), // 获取产品链接
            );
        }
    }

    // Convert related products info to HTML
    $related_products_html = '';
    $related_product_count = 0;
    foreach ($related_product_info as $product) {
        if ($related_product_count > 3) {
            break;
        }
        $related_products_html .= '<div class="related-product">';
        $related_products_html .= '  <a href="' . $product['link'] . '">';
        $related_products_html .=       $product['image']; // $product['image']包含了整个<img>标签所需内容
        $related_products_html .= '  </a>';
        $related_products_html .= '  <h4>' . $product['title'] . '</h4>';
        $related_products_html .= '</div>';
        $related_product_count++;
    }

    // Enable output buffer
    ob_start();
    include get_stylesheet_directory() . '/email.php'; 
    // Get the output content and clear the buffer
    $email_content = ob_get_clean(); 

    // Send email
    $customer_email = $order->get_billing_email();
    $headers = array('Content-Type: text/html; charset=UTF-8');
    // All information must be packaged when sending emails, and external css and other settings are not supported.
    wp_mail($customer_email, 'Your Order Confirmation', $email_content, $headers);
}
add_action('woocommerce_order_status_completed', 'my_custom_thank_you_email');

/*
 * Inactiv Woocommerce default order completed Email 
 */
function disable_woocommerce_completed_order_email($enabled, $order)
{
    // return false to inactiv 
    return false; 
}
add_filter('woocommerce_email_enabled_customer_completed_order', 'disable_woocommerce_completed_order_email', 10, 2);


