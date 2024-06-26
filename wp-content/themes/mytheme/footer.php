<footer>
    <?php
    // get the "store_footer_image" from settings in dashboard, or use placeholder image
    $store_image = get_option('store_footer_image');
    if (!$store_image) {
        $store_image = get_template_directory_uri() . '/resources/images/placeholder.png';
    }
    ?>
    <section class="container">
        <div class="column-address">
            <a href="/">
                <img class="footer-image" src="<?= esc_url($store_image); ?>" alt="Store Image" />
            </a>
            <div class="footer-info">
                <span><?= get_option('store_footer_name'); ?></span>
                <span><?= get_option('store_footer_copyright'); ?></span>
                <span><?= get_option('store_footer_org_number'); ?></span>
            </div>
        </div>

        <div class="column-contact">
            <?php
            $menu = array(
                'theme_location' => 'footer_contact',
                'menu_id' => 'footer_contact',
                'container' => 'nav',
                'container_class' => 'menu'
            );
            wp_nav_menu($menu);
            ?>
        </div>
        <div class="column-product">
            <?php
            $menu = array(
                'theme_location' => 'footer_product',
                'menu_id' => 'footer_product',
                'container' => 'nav',
                'container_class' => 'menu'
            );
            wp_nav_menu($menu);
            ?>
        </div>
        <div class="column-social-media">
            <?php
            $menu = array(
                'theme_location' => 'footer_social_media',
                'menu_id' => 'footer_social_media',
                'container' => 'nav',
                'container_class' => 'menu'
            );
            wp_nav_menu($menu);
            ?>
        </div>
    </section>

    <!-- only for mobilephone mode -->
    <section class="container-copyright">
        <div class="site-info">
            <span><?= get_option('store_footer_name') . get_option('store_footer_copyright'); ?></span>
            <span><?= get_option('store_footer_org_number'); ?></span>
        </div>
    </section>
</footer>
<?php wp_footer(); ?>
<!-- point to the correct admin-ajax.php path which is available in update-cart-count.js -->
<script>
    let updateCartCount_ajaxUrl = '<?php echo admin_url('admin-ajax.php'); ?>';
</script>

</body>

</html>