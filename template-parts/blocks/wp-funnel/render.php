<?php
$block_slug = str_replace('acf/', '', $block['name']);
$block_typ = $block_slug;

$id = $block_typ . '_' . $block['id'];
if ( $block_anker = get_field( 'block_anker' ) ) : 
    $id = esc_html( $block_anker );
endif;

require get_template_directory() . '/template-parts/elements/block/block_variables.php';
require get_template_directory() . '/template-parts/elements/block/block_variables_headline.php';

if( isset( $block['data']['preview_image_help'] )  ) :  /* rendering in inserter preview  */

    echo '<img src="'. $block['data']['preview_image_help'] .'" style="width:100%; height:auto;">';

else : /* rendering in editor body */

    if ( ( !get_field( 'block_disable' ) && !is_admin() ) || is_admin() ) : ?>
    <!-- data-aos="fade-zoom-in" data-aos-duration="1000" -->
    <section id="<?= esc_attr($id); ?>" class="gp-<?= $block_typ; ?> section position-relative <?= esc_attr($className); ?> <?php the_field('block_space_before'); ?> <?php the_field('block_space_after'); ?>">
        <div class="container">
            <div class="row">
                <div class="col-12 content">
                    <?php 
                        /* Load Headline */
                        require get_template_directory() . '/template-parts/elements/block/block_headline.php'; 
                    ?>
                    <?php if ( $textblock_field = get_field( 'textblock_field' ) ) : ?>
                        <?= $textblock_field; ?>
                    <?php endif; ?>
                </div>
                <div class="col-12 funnel">
                    <?php
                    $funnel_id = get_field( 'funnel_id' );
                    $funnel_anchor = get_field( 'funnel_anchor' );
                    if ( $funnel_id ) :
                        if ( $funnel_anchor ) : $funnel_anchor = 'anchor_id="' . $funnel_anchor . '"'; endif;
                        $funnel_shortcode = '[wp_funnel funnel_id="' . $funnel_id  . '" ' . $funnel_anchor . ']';
                        echo do_shortcode( $funnel_shortcode );
                    endif; ?>
                </div>
            </div>
        </div>
    </section>
    <?php endif;
endif; ?>
    