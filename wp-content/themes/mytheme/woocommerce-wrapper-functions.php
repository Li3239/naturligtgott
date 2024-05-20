<?php


if ( ! function_exists( 'woocommerce_output_content_wrapper' ) ) {
	function woocommerce_output_content_wrapper() {
		$classes = array('site-main');

		// Add class for product listing page
		if ( is_shop() || is_product_category() || is_product_tag() ) {
			$classes[] = 'listing';
		}

		// Add class for product detail page
		if ( is_singular('product') ) {
			$classes[] = 'detail';
		}

		// Add class for cart page
		if ( is_cart() ) {
			$classes[] = 'cart';
		}

		// Add class for checkout page
		if ( is_checkout() ) {
			$classes[] = 'checkout';
		}

		// Convert the classes array to a space-separated string
		$class_string = implode(' ', $classes);

		echo '<main id="main" class="' . esc_attr($class_string) . '">';
	}
}

if ( ! function_exists( 'woocommerce_output_content_wrapper_end' ) ) {
	function woocommerce_output_content_wrapper_end() {
		echo '</main>';
	}
}

if ( ! function_exists( 'woocommerce_output_content_wrapper_end' ) ) {
	function woocommerce_output_content_wrapper_end() {
		echo '</main>';
	}
}