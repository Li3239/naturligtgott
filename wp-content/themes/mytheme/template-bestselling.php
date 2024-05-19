<?php

/**
 * Template Name: Bestselling Products
 * Description: A page template to display bestselling products.
 */

defined('ABSPATH') || exit;
global $total_bestselling_products;

get_header('shop');

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action('woocommerce_before_main_content');

?>
<header class="woocommerce-products-header">
    <?php if (apply_filters('woocommerce_show_page_title', true)) : ?>
        <h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
    <?php endif; ?>

    <?php
    /**
     * Hook: woocommerce_archive_description.
     *
     * @hooked woocommerce_taxonomy_archive_description - 10
     * @hooked woocommerce_product_archive_description - 10
     */
    do_action('woocommerce_archive_description');
    ?>
</header>
<div class="product-filter-div">
    <div class="filter-div">
        <?php echo do_shortcode('[br_filters_group group_id=314]'); ?>
    </div>

    <div class="product-div">

        <?php

        //--------------------------------------------
        // get bestselling product data and output
        //--------------------------------------------
        // Set up best-selling product query
        // $paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => -1,
            // 'paged' => $paged,
            'meta_key' => 'total_sales',
            'orderby' => 'meta_value_num',
            'order' => 'DESC'
        );
        $bestselling_query = new WP_Query($args);
        if ($bestselling_query->have_posts()) {
            wc_set_loop_prop('is_paginated', true);
            wc_set_loop_prop('total', $bestselling_query->found_posts);
            wc_set_loop_prop('total_pages', $bestselling_query->max_num_pages);
            wc_set_loop_prop('current_page', $bestselling_query->get('paged') ? $bestselling_query->get('paged') : 1);
            wc_set_loop_prop('per_page', $bestselling_query->found_posts);

            // $total_bestselling_products = $bestselling_query->found_posts;
            // update_option('bestselling_product_count', $total_bestselling_products, false);
            // echo "Showing all " . $total_bestselling_products . " results";

            /**
             * Hook: woocommerce_before_shop_loop.
             *
             * @hooked woocommerce_output_all_notices - 10
             * @hooked woocommerce_result_count - 20
             * @hooked woocommerce_catalog_ordering - 30
             */
            // do_action('woocommerce_before_shop_loop');


            woocommerce_product_loop_start();

            while ($bestselling_query->have_posts()) {
                $bestselling_query->the_post();

                /**
                 * Hook: woocommerce_shop_loop.
                 */
                do_action('woocommerce_shop_loop');

                wc_get_template_part('content', 'product'); // to use woocommerce product template
            }
            
            woocommerce_product_loop_end();

            // // 添加分页导航
            // woocommerce_pagination();
            // // 或者使用 paginate_links()
            // echo paginate_links();

        } else {
            /**
             * Hook: woocommerce_no_products_found.
             *
             * @hooked wc_no_products_found - 10
             */
            do_action('woocommerce_no_products_found');
        }

        wp_reset_postdata(); // Reset query data

        /**
         * Hook: woocommerce_after_shop_loop.
         *
         * @hooked woocommerce_pagination - 10
         */
        do_action('woocommerce_after_shop_loop');

        //-----------------------------------------end

        /**
         * Hook: woocommerce_after_main_content.
         *
         * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
         */
        do_action('woocommerce_after_main_content');

        /**
         * Hook: woocommerce_sidebar.
         *
         * @hooked woocommerce_get_sidebar - 10
         */
        do_action('woocommerce_sidebar');

        get_footer('shop');

        ?>
    </div>
</div>