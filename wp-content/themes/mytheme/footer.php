<footer>
    <section class="container">
        <div class="column-address">
            <a href="">
                <img class="footer-image" src="<?= get_option('store_footer_image'); ?>" />
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
</footer>
<?php wp_footer(); ?>

</body>

</html>