<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://kit.fontawesome.com/f14b07e4b8.js" crossorigin="anonymous"></script>



    <title><?= get_option('blogname'); ?></title>
    <?php wp_head(); ?>
</head>

<body>
    <?php wp_body_open(); ?>

    <div class="mobile-menu">
        <div class="mobile-logo-div">
            <a href="/">
                <img src="<?php echo get_stylesheet_directory_uri() . '/resources/images/logo.png'; ?>" alt="Logo">
            </a>
        </div>
        <?php
        $menu = array(
            'theme_location' => 'main_menu',
            'container' => 'nav',
            'container_class' => 'menu-mobile'
        );
        wp_nav_menu($menu);

        $menu = array(
            'theme_location' => 'main_menu_icons',
            'container' => 'nav',
            'container_class' => 'icon-menu-mobile'
        );
        wp_nav_menu($menu);

        ?>
        <div class="mobile-search-input">
            <?php echo do_shortcode('[mobile_live_search]'); ?>
        </div>
    </div>

    <header id="stickyheading" class="header nav-head">
        <div class="logo-div">
            <a href="/">
                <img src="<?php echo get_stylesheet_directory_uri() . '/resources/images/logo.png'; ?>" alt="Logo">
            </a>
        </div>
        <!-- Main menu -->
        <div class="main-menu-div">
            <?php
            $menu = array(
                'theme_location' => 'main_menu',
                'menu_id' => 'primary-menu',
                'container' => 'nav',
                'container_class' => 'menu'
            );
            wp_nav_menu($menu);
            ?>
        </div>
        <!-- Main menu icons -->
        <div class="menu-logo-div">
            <?php
            $menu = array(
                'theme_location' => 'main_menu_icons',
                'menu_id' => 'secondary-menu',
                'container' => 'nav',
                'container_class' => 'menu'
            );
            wp_nav_menu($menu);
            ?>
            <div class="burger-menu-div">
                <img src="<?php echo get_stylesheet_directory_uri() . '/resources/images/menu.svg'; ?>" alt="Logo">
            </div>
        </div>

    </header>
    <div class="subheader">
        <a href="https://naturligtgott.test/shop/">
            <h4>ALLA PRODUKTER</h4>
        </a>
        <a href="https://naturligtgott.test/bastsaljare/">
            <h4>BÄST SÄLJARE</h4>
        </a>
        <a href="https://naturligtgott.test/product-category/nyheter/" class="nyheter-cat">
            <h4>NYHETER</h4>
        </a>
        <a href="https://naturligtgott.test/product-category/ekologisk/" class="eko-cat">
            <h4>EKOLOGIST</h4>
        </a>
        <a href="https://naturligtgott.test/product-category/hallbart/" class="sustain-cat">
            <h4>HÅLLBARA PRODUKTER</h4>
        </a>
        <a href="https://naturligtgott.test/product-category/rea/">
            <h4>REA</h4>
        </a>
    </div>
    <div class="usp">
        <span><i class="fa-solid fa-truck"></i>Gratis leverens över 300SEK</span>
        <span><i class="fa-regular fa-face-smile"></i>30 dagar retur</span>
        <span><i class="fa-regular fa-credit-card"></i>Snabbt leverens</span>
    </div>
    <div class="search_input" style="display: none;">
        <?php echo do_shortcode('[live_search]'); ?>
    </div>