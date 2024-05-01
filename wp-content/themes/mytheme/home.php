<?php
/**
 * Template Name: Recent Posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package YourThemeName
 */

get_header();

// Hämta de senaste 10 inläggen
$posts = get_posts();

// Visa inläggen även om det inte finns några
?>
<div class="posts-list">
    <?php foreach ( $posts as $post ) : setup_postdata( $post ); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <?php if ( has_post_thumbnail() ) : ?>
                <div class="post-thumbnail">
                    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
                </div>
            <?php endif; ?>
            <header class="entry-header">
                <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            </header><!-- .entry-header -->
            <div class="entry-content">
                <?php the_excerpt(); ?>
            </div><!-- .entry-content -->
        </article><!-- #post-<?php the_ID(); ?> -->
    <?php endforeach; ?>
</div><!-- .posts-list -->

<?php
// Återställ globala postdata
wp_reset_postdata();

get_footer();
