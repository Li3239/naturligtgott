<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script
      src="https://kit.fontawesome.com/f14b07e4b8.js"
      crossorigin="anonymous"
    ></script>

    
    
    <title><?=get_option('blogname');?></title>
    <?php wp_head(); ?>
</head>

<body>
    <?php wp_body_open(); ?>

    <header class="header">
        <div class="logo-div">
        <img src="<?php echo get_stylesheet_directory_uri() . '/resources/images/logo.png'; ?>" alt="Logo">
        </div>
        <div class="main-menu-div">
        <?php 
            $menu = array(
                'theme_location' => 'main_menu',
                'menu_id' => 'primary-menu',
                'container' => 'nav',
                'container_class' => 'menu'
            );
            
            wp_nav_menu($menu); ?> 
        </div>
        <div class="menu-logo-div">
        <?php 
            $menu = array(
                'theme_location' => 'main_menu_icons',
                'menu_id' => 'secondary-menu',
                'container' => 'nav',
                'container_class' => 'menu'
            );
            
            wp_nav_menu($menu); ?>  
        </div>
       
    </header>
    <div class="subheader">
        <a href=""><h4>ALLA PRODUKTER</h4></a>
        <a href=""><h4>BÄST SÄLJARE</h4></a>
        <a href="" class="nyheter-cat"><h4>NYHETER</h4></a>
        <a href="" class="eko-cat"><h4>EKOLOGIST</h4></a>
        <a href="" class="sustain-cat"><h4>HÅLLBARA PRODUKTER</h4></a>
        <a href=""><h4>REA</h4></a>
    </div>
    <div class="usp">
        <span><i class="fa-solid fa-truck"></i>Gratis leverens över 300SEK</span>
        <span><i class="fa-regular fa-face-smile"></i>30 dagar retur</span>
        <span><i class="fa-regular fa-credit-card"></i>Snabbt leverens</span>
    </div>