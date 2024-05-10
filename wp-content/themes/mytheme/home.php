<?php
/**
 * Template Name: Recent Posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package YourThemeName
 */

get_header();
?>

<main id="primary" class="content-area">
    <div class="container">
  
        <div class="post-list">
            <?php
            // Hämta alla inlägg
            $args = array(
                'post_type'      => 'post',
                'posts_per_page' => -1,
            );
            $posts_query = new WP_Query( $args );

            // Loopa igenom inläggen
            if ( $posts_query->have_posts() ) :
                while ( $posts_query->have_posts() ) :
                    $posts_query->the_post();
                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class( 'post-item' ); ?>>
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="post-thumbnail">
                                <?php the_post_thumbnail( 'medium' ); ?>
                            </div>
                        <?php endif; ?>
                        <div class="post-content">
                            <header class="entry-header">
                                <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                
                            </header><!-- .entry-header -->
                            <div class="entry-content">
                                <?php
                                // Custom excerpt length
                                $excerpt_length = 30; // Number of words to display
                                $excerpt = wp_trim_words( get_the_excerpt(), $excerpt_length, '' );
                                echo $excerpt . '...';
                                ?>
                                <a href="<?php the_permalink(); ?>" class="read-more"> Read More</a>
                            </div><!-- .entry-content -->
                            <div class="entry-meta">
                                    <span class="posted-on">Publicerat <?php echo get_the_date(); ?></span>
                                    <span class="byline">av <?php the_author_posts_link(); ?></span>
                                </div>
                        </div><!-- .post-content -->
                    </article><!-- #post-<?php the_ID(); ?> -->
                    <?php
                endwhile;
                wp_reset_postdata();
            else :
                // Om inga inlägg hittades
                ?>
                <p><?php esc_html_e( 'Inga inlägg hittades.', 'your-theme-textdomain' ); ?></p>
                <?php
            endif;
            ?>
        </div><!-- .post-list -->
    </div><!-- .container -->
</main><!-- #primary -->

<?php
get_footer();
?>
