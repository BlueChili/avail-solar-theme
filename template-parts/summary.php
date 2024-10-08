<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package avasol
 */

?>

<?php if (is_singular()) {
return ;
} ?>

<article id="post-<?php the_ID(); ?>" class="article-summary">
    <header class="entry-header">
        <a href="<?php the_permalink() ?>" rel="bookmark">
        <?php
            if (has_post_thumbnail()):
            $img_id = get_post_thumbnail_id();?>
            <div class="summary-image">
                <?php echo avasol_lazy_image($img_id, 'medium_large', 'img-fluid') ?>
            </div>
        <?php else : ?>
            <div class="summary-image summary-image-no-featured">
                    <img src="<?= esc_url( wp_get_attachment_url(1385) ); ?>" width="94" height="75" class="custom-logo" alt="<?php bloginfo( 'name' ); ?>">
            </div>
        <?php endif; ?>
        </a>

        <?php the_title('<h2 class="entry-title summary-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>'); ?>
    </header>

    <div class="container pt-0">
        <div class="entry-meta summary-meta">
        <?php
            avasol_posted_on();
            avasol_posted_by();
            ?>
        </div>

        <div class="entry-content summary-content">
            <?php
        $matches = [];
        $has_match = preg_match(
            '/<!--\s+(?P<closer>\/)?wp:(?P<namespace>[a-z][a-z0-9_-]*\/)?(?P<name>[a-z][a-z0-9_-]*)\s+(?P<attrs>{(?:(?:[^}]+|}+(?=})|(?!}\s+\/?-->).)*+)?}\s+)?(?P<void>\/)?-->/s',
            get_the_content(),
            $matches,
        );
        if ($has_match) {
            $block_data = json_decode($matches['attrs'], true);
            if ($block_data && isset($block_data['data'])) {
                $headline = $block_data['data']['textblock_headline'] ?? '';
                $text = $block_data['data']['textblock_field'] ?? '';
                echo '<p>' . wp_trim_words(wp_strip_all_tags(strlen($headline) > strlen($text) ? $headline : $text), 20) . '</p>';
            } 
        } 
        echo ' <a href="' . get_permalink() . '">Read More</a>';

            ?>
        </div>
    </div>

</article>
