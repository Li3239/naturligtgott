<?php
//-------------------------------
// Ship to a different address
//-------------------------------
add_filter('woocommerce_ship_to_different_address_checked', '__return_false');

function custom_free_shipping($rates, $package)
{
    $free_shipping_amount = 0;
    $cart_total = WC()->cart->cart_contents_total;

    // get all shipping areas
    $shipping_zones = WC_Shipping_Zones::get_zones();

    // get free shipping Minimum order amount from Woocommerce / setting / shipping / free shipping
    foreach ($shipping_zones as $zone_data) {
        // Get a specific shipping zone instance using zone_id
        $zone = WC_Shipping_Zones::get_zone($zone_data['zone_id']);

        foreach ($zone->get_shipping_methods(true) as $shipping_method) {
            if ($shipping_method->id === 'free_shipping') {
                // output
                // echo 'Zone Name: ' . $zone->get_zone_name() . '<br>';
                // echo 'Zone ID: ' . $zone->get_id() . '<br>';
                // echo 'Free Shipping Minimum Order: ' . $shipping_method->min_amount . '<br>';
                $free_shipping_amount = $shipping_method->min_amount;
                break;
            }
        }
    }

    foreach ($rates as $rate_id => $rate) {
        if ('free_shipping' === $rate->method_id) {
            if ($cart_total >= $free_shipping_amount) {
                // When the total amount of the shopping cart reaches the free shipping standard, only the free shipping option will be retained
                return array($rate_id => $rate);
            } else {
                // Remove the free shipping option when the total shopping cart amount does not meet the free shipping criteria
                unset($rates[$rate_id]);
                break; 
            }
        }
    }
    // Return to modified shipping options
    return $rates;
}
add_filter('woocommerce_package_rates', 'custom_free_shipping', 10, 2);



// function check_free_shipping($available_shipping_methods, $package)
// {
//     // Get all shipping zones
//     $zones = WC_Shipping_Zones::get_zones();
//     $package_zone = null;

//     foreach ($zones as $zone_data) {
//         $zone = new WC_Shipping_Zone($zone_data['zone_id']);
//         $shipping_methods = $zone->get_shipping_methods(true);

//         foreach ($shipping_methods as $shipping_method) {
//             if ($shipping_method->is_available($package)) {
//                 // Check if this is the free shipping method and if the package matches the zone
//                 if ('free_shipping' === $shipping_method->id) {
//                     // Get the minimum amount necessary for free shipping
//                     $min_amount = $shipping_method->get_option('min_amount');
//                     if (WC()->cart->cart_contents_total >= $min_amount) {
//                         // Ensure that only free shipping is available if the criteria are met
//                         return array_filter($available_shipping_methods, function ($method) use ($shipping_method) {
//                             return $method->id === $shipping_method->get_instance_id();
//                         });
//                     }
//                 }
//             }
//         }
//     }

//     // Remove free shipping if not eligible
//     foreach ($available_shipping_methods as $key => $method) {
//         if ('free_shipping' === $method->method_id) {
//             unset($available_shipping_methods[$key]);
//         }
//     }

//     return $available_shipping_methods;
// }

// add_filter('woocommerce_package_rates', 'check_free_shipping', 10, 2);


