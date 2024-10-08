<?php get_header(); ?>
<div id="primary" class="content-area">
    <div class="container pt-10 pb-7">
        <?php if ( have_posts() ) : ?>

            <header class="page-header">
                <h1>Blog</h1>
            </header>

            <div class="row row-cols-md-2 row-cols-lg-3 gy-5 gy-lg-6 gx-3">
                <?php
                while ( have_posts() ) :
                    the_post();
                    get_template_part( 'template-parts/summary');
                endwhile;
                ?>
            </div>
        <?php
        avasol_pagination_links();

        else :

            get_template_part( 'template-parts/content', 'none' );

        endif;
        ?>
    </div>
</div>
<?php get_footer(); ?>
