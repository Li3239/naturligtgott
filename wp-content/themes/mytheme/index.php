<?php

/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package NaturligtGott
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

get_header();
?>

<main class="<?php echo is_single() ? 'single-blogpost' : (is_checkout() ? 'content-checkout' : (is_front_page() ? 'content' : 'content')); ?>">
    <?php
        if (!is_front_page()) {
            echo the_title();
            }
    ?>

    <?= the_content() ?>
</main>

<?php get_footer(); ?>