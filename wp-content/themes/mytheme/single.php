<!-- single.php allows customization of the way blog posts are displayed -->

<?php get_header(); ?>
<!-- content -->
<main class="single-blogpost">
    <!--  <?= the_title() ?> -->
    <?= the_content() ?>

</main>
<?php get_footer(); ?>