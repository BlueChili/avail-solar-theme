<?php
$block_slug = str_replace('acf/', '', $block['name']);
$block_typ = $block_slug;

$id = $block_typ . '_' . $block['id'];
if ( $block_anker = get_field( 'block_anker' ) ) : 
    $id = esc_html( $block_anker );
endif;

$options = [
    'post_type'	=> 'product',
    'orderby'    => 'title',
    'order' => 'ASC',
    'post_status' => 'publish'
];

require get_template_directory() . '/template-parts/elements/block/block_variables.php';
require get_template_directory() . '/template-parts/elements/block/block_variables_headline.php';

if( isset( $block['data']['preview_image_help'] )  ) :  /* rendering in inserter preview  */

    echo '<img src="'. $block['data']['preview_image_help'] .'" style="width:100%; height:auto;">';

else : /* rendering in editor body */
    
    if ( ( !get_field( 'block_disable' ) && !is_admin() ) || is_admin() ) : ?>
    <section id="<?= esc_attr($id); ?>" class="gp-<?= $block_typ; ?> section <?= esc_attr($className); ?> <?php the_field('block_space_before'); ?> <?php the_field('block_space_after'); ?>" data-aos="fade-zoom-in" data-aos-duration="1000">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 content">
                    <?php 
                        /* Load Headline */
                        require get_template_directory() . '/template-parts/elements/block/block_headline.php'; 
                    ?>
                    <?php if ( $textblock_field = get_field( 'textblock_field' ) ) : ?>
                        <?= $textblock_field; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row mt-4">
                <?php 
                $taxonomies = get_terms( array(
                    'taxonomy' => 'products_cat',
                    'hide_empty' => false,
                    'orderby'  => 'title',
                    'order'    => 'ASC'
                ) );
                
                if ( !empty($taxonomies) ) : ?>
                    <div class="col-12 cat-filter mb-4">
                        <ul class="cat-list list-unstyled d-flex gap-3 flex-wrap">
                            <li><span class="cat-list_item active px-3 px-lg-4 py-2 py-lg-3 d-block" data-slug="" data-id=""><?php _e('All', 'avasol'); ?></span></li>

                            <?php foreach( $taxonomies as $category ): ?>
                                <li><span class="cat-list_item px-3 px-lg-4 py-2 py-lg-3 d-block" data-slug="<?= $category->slug; ?>" data-id="<?= $category->term_id; ?>"><?= $category->name; ?></span></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
            <div id="result" class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 cards g-4 mt-3">
                <?php 
                    // query
                    $the_query = new WP_Query($options);
                ?>
                <?php if( $the_query->have_posts() ): ?>
                    <?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
                        <?php get_template_part('template-parts/blocks/products/loop'); ?>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
            <?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>
        </div>
    </section>
    <?php endif;
endif; ?>