<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package avasol
 */

get_header();
?>

<div id="primary" class="content-area">
    <main tabindex="-1" id="main" class="site-main pb-6">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );

            echo '<div class="container pt-3">';
			the_post_navigation();
            echo '</div>';

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

    </main>
</div>
<?php get_footer(); ?>
