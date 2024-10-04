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
    <section id="<?= esc_attr($id); ?>" class="gp-<?= $block_typ; ?> section <?= esc_attr($className); ?> <?php the_field('block_space_before'); ?> <?php the_field('block_space_after'); ?>" data-aos="fade-zoom-in" data-aos-duration="1000">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-xl-7 mx-auto content text-center">
                    <?php 
                        /* Load Headline */
                        require get_template_directory() . '/template-parts/elements/block/block_headline.php'; 
                    ?>
                    <?php if ( $textblock_field = get_field( 'textblock_field' ) ) : ?>
                        <div class="px-xl-7"><?= $textblock_field; ?></div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row mx-lg-7 g-0">
                <?php if ( have_rows( 'box_one' ) ) : ?>
                    <?php while ( have_rows( 'box_one' ) ) : the_row(); ?>
                        <div class="col-9 col-lg-6 bg-primary text-white box_one d-flex">
                            <div class="box p-5 p-lg-6 d-flex flex-column justify-content-center">
                                <div class="subline mb-3"><?php the_sub_field( 'box_one_subline' ); ?></div>
                                <?php the_sub_field( 'box_one_text' ); ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
                <div class="col-3 col-lg-5 bg-primary box_one_clear d-flex"></div>
                <div class="col-3 col-lg-5 bg-primary box_two_clear d-flex"></div>
                <?php if ( have_rows( 'box_two' ) ) : ?>
                    <?php while ( have_rows( 'box_two' ) ) : the_row(); ?>
                        <div class="col-9 col-lg-6 bg-primary text-white box_two d-flex justify-content-end">
                            <div class="box p-5 p-lg-6 d-flex flex-column justify-content-center">
                                <div class="subline mb-3"><?php the_sub_field( 'box_two_subline' ); ?></div>
                                <?php the_sub_field( 'box_two_text' ); ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <?php endif;
endif; ?>