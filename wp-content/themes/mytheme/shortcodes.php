<?php

/* --------Header Search------------------------ */

// Shortcode for desktop search
add_shortcode('live_search', 'live_search_function');
function live_search_function() { ?>

    <input type="text" name="keyword" id="desktop-keyword" placeholder="Search" onkeyup="desktopFetch()"></input>

    <div id="desktop-productfetch"></div>

    <?php
}

// Shortcode for mobile search
add_shortcode('mobile_live_search', 'mobile_live_search_function');
function mobile_live_search_function() { ?>

    <input type="text" name="keyword" id="mobile-keyword" placeholder="Search" onkeyup="mobileFetch()"></input>

    <div id="mobile-productfetch"></div>

    <?php
}

// JavaScript function for desktop search
function desktopFetch() { ?>
    <script type="text/javascript">
        if( document.getElementById('desktop-keyword').value.trim().length == 0 ) {
            document.getElementById('desktop-productfetch').innerHTML = '';
        } else {
            jQuery.ajax( {
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                type: 'post',
                data: { action: 'desktop_data_fetch', keyword: jQuery('#desktop-keyword').val() },
                success: function(data) {
                    jQuery('#desktop-productfetch').html(data);
                }
            });
        }
    </script>
<?php
}

// JavaScript function for mobile search
function mobileFetch() { ?>
    <script type="text/javascript">
        if( document.getElementById('mobile-keyword').value.trim().length == 0 ) {
            document.getElementById('mobile-productfetch').innerHTML = '';
        } else {
            jQuery.ajax( {
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                type: 'post',
                data: { action: 'mobile_data_fetch', keyword: jQuery('#mobile-keyword').val() },
                success: function(data) {
                    jQuery('#mobile-productfetch').html(data);
                }
            });
        }
    </script>
<?php
}

// Ajax fetch for desktop search
add_action( 'wp_footer', 'desktop_ajax_fetch' );
function desktop_ajax_fetch() { ?>
    <script type="text/javascript">
        function desktopFetch() {
            if( document.getElementById('desktop-keyword').value.trim().length == 0 ) {
                document.getElementById('desktop-productfetch').innerHTML = '';
            } else {
                jQuery.ajax( {
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    type: 'post',
                    data: { action: 'desktop_data_fetch', keyword: jQuery('#desktop-keyword').val() },
                    success: function(data) {
                        jQuery('#desktop-productfetch').html(data);
                    }
                });
            }
        }
    </script>
<?php
}

// Ajax fetch for mobile search
add_action( 'wp_footer', 'mobile_ajax_fetch' );
function mobile_ajax_fetch() { ?>
    <script type="text/javascript">
        function mobileFetch() {
            if( document.getElementById('mobile-keyword').value.trim().length == 0 ) {
                document.getElementById('mobile-productfetch').innerHTML = '';
            } else {
                // Check screen width to determine number of products to fetch
                if (window.innerWidth <= 768) {
                    // Limit to one product for mobile
                    var limit = 1;
                } else {
                    // Fetch all products for desktop
                    var limit = -1;
                }

                jQuery.ajax( {
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    type: 'post',
                    data: { action: 'mobile_data_fetch', keyword: jQuery('#mobile-keyword').val(), limit: limit },
                    success: function(data) {
                        jQuery('#mobile-productfetch').html(data);
                    }
                });
            }
        }
    </script>
<?php
}

// Product fetch function for desktop search
add_action('wp_ajax_desktop_data_fetch' , 'desktop_product_fetch');
add_action('wp_ajax_nopriv_desktop_data_fetch','desktop_product_fetch');
function desktop_product_fetch() {
    $posts_per_page = isset($_POST['limit']) ? intval($_POST['limit']) : -1;
    $the_query = new WP_Query( array( 'posts_per_page' => $posts_per_page, 's' => esc_attr( $_POST['keyword'] ), 'post_type' => 'product' ) );

    if( $the_query->have_posts() ) :
        while( $the_query->have_posts() ): $the_query->the_post(); ?>
            <div class="product-li">
                <h3><a href="<?php echo esc_url( post_permalink() ); ?>"><?php the_title();?></a></h3>
                <?php
                // Get the thumbnail for the product
                $thumbnail_id = get_post_thumbnail_id();
                $image_url = wp_get_attachment_image_src($thumbnail_id, 'thumbnail');
                if ($image_url) {
                    ?>
                    <img src="<?php echo $image_url[0]; ?>" alt="<?php the_title_attribute(); ?>">
                    <?php
                }
                ?> 
            </div>
        <?php endwhile;
        wp_reset_postdata();
    endif;
    die();
}

// Product fetch function for mobile search
add_action('wp_ajax_mobile_data_fetch' , 'mobile_product_fetch');
add_action('wp_ajax_nopriv_mobile_data_fetch','mobile_product_fetch');
function mobile_product_fetch() {
    $posts_per_page = isset($_POST['limit']) ? intval($_POST['limit']) : -1;
    $the_query = new WP_Query( array( 'posts_per_page' => $posts_per_page, 's' => esc_attr( $_POST['keyword'] ), 'post_type' => 'product' ) );

    if( $the_query->have_posts() ) :
        while( $the_query->have_posts() ): $the_query->the_post(); ?>
            <div class="product-li">
                <h3><a href="<?php echo esc_url( post_permalink() ); ?>"><?php the_title();?></a></h3>
                <?php
                // Get the thumbnail for the product
                $thumbnail_id = get_post_thumbnail_id();
                $image_url = wp_get_attachment_image_src($thumbnail_id, 'thumbnail');
                if ($image_url) {
                    ?>
                    <img src="<?php echo $image_url[0]; ?>" alt="<?php the_title_attribute(); ?>">
                    <?php
                }
                ?> 
            </div>
        <?php endwhile;
        wp_reset_postdata();
    endif;
    die();
}