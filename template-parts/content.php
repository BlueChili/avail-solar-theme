<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package avasol
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
    <?php // get_template_part( 'template-parts/schema/NewsArticle' ); ?>
    <header class="entry-header">
    <?php
    if (is_singular() && has_post_thumbnail()):
        $img_id = get_post_thumbnail_id();
        ?>
        <div class="entry-image vh-100 mh-50">
            <div class="imagecontainer">
                <?php echo avasol_lazy_image($img_id, 'medium_large', 'img-fluid') ?>
                <div class="container position-absolute top-0 bottom-0 start-0 end-0 d-flex justify-content-center flex-column">
                <?php
                    the_title('<h1 class="entry-title">', '</h1>');
                    if ('post' === get_post_type()):
                    ?>
                    <div class="entry-meta">
                    <?php
                        avasol_posted_on();
                        avasol_posted_by();
                        ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    <?php else: ?>

    <div class="container">
        <?php
            if (is_singular()):
                the_title('<h1 class="entry-title pt-6">', '</h1>');
            else:
                the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
            endif;

            if ('post' === get_post_type()):
                ?>
                <div class="entry-meta">
                <?php
                    avasol_posted_on();
                    avasol_posted_by();
                    ?>
                </div>
                <?php endif; ?>
        </div>
    <?php
    endif;
    if (is_singular()) {
        add_filter('the_content', 'avasol_toc');
    } 
    ?>
    </header>

    <div class="container pt-0">
        <div class="entry-content">
<?php
the_content(sprintf(
    wp_kses(
        /* translators: %s: Name of current post. Only visible to screen readers */
        __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'avasol'),
        array(
            'span' => array(
                'class' => array(),
            ),
        )
    ),
    get_the_title()
));

wp_link_pages(array(
    'before' => '<div class="page-links">' . esc_html__('Pages:', 'avasol'),
    'after' => '</div>',
));
?>
        </div>
    </div>

    <footer class="entry-footer">
        <div class="container">
            <?php
            $author_id = get_post_meta(get_the_ID(), '_post_author_id', true);

            if ($author_id) {
                $author_name = get_the_title($author_id);
                $author_link = get_permalink($author_id);
                $author_content = get_post_field('post_content', $author_id);
                $author_position = get_post_field('author_position', $author_id);
                $author_image = get_the_post_thumbnail($author_id, 'thumbnail'); // Assuming authors have featured images
                echo '<div class="post-author">';
                if ($author_image) {
                    echo $author_image;
                }
                echo '<div style="position: relative">';
                echo '<h4><label for="author-description" class="post-author-name">' . esc_html($author_name) . '</label></h4>';
                if ($author_position) {
                   echo '<p class="post-author-position">' . $author_position . '</p>';
                }
                echo '<input name="author-description" id="author-description" type="checkbox"/>';
                echo '<div class="post-author-description-content"><p>' . $author_content . '</p></div>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>

        <div class="container">
            <?php avasol_entry_footer(); ?>
        </div>
    </footer>
</article>
