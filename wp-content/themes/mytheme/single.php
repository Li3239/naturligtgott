<!-- single.php 是用来控制post的， 打开post：http://gritsport.test/hello-world/  hello-world 是post的slug -->

<?php get_header(); ?>
<!-- content -->
<main class="single-blogpost">
   <!--  <?= the_title() ?> -->
    <?= the_content() ?>

</main>
<?php get_footer(); ?>