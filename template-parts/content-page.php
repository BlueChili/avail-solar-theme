<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package avasol
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
    <div class="entry-content">
		<?php
		the_content();

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'heckm' ),
			'after'  => '</div>',
		) );
		?>
    </div>
</article>