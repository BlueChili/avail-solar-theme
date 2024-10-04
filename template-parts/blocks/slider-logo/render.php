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
    <section id="<?= esc_attr($id); ?>" class="gp-<?= $block_typ; ?> section<?= esc_attr($className); ?> <?php the_field('block_space_before'); ?> <?php the_field('block_space_after'); ?>" data-aos="fade-zoom-in" data-aos-duration="1000">
        <div class="container">
            <div class="row">
                <div class="col-lg-11 col-xl-9 col-xxl-8 mx-auto content">
                    <?php 
                        /* Load Headline */
                        require get_template_directory() . '/template-parts/elements/block/block_headline.php'; 
                    ?>
                    
                    <?php if ( $textblock_field = get_field( 'textblock_field' ) ) : ?>
                        <?= $textblock_field; ?>
                    <?php endif; ?>
                </div>
                <div class="col-12 logos mt-5">
                    <?php
                        $logos_items = get_field( 'logos_items' );
                        $size = 'full';
                        if ( $logos_items ) : ?>
                            <div class="swiper swiper-slider-logos">
                                <div class="swiper-wrapper">
                                    <?php foreach( $logos_items as $image_id ) : ?>
                                        <div class="swiper-slide text-center"><?php echo wp_get_attachment_image( $image_id, $size ); ?></div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    <?php endif;
endif; ?>
    