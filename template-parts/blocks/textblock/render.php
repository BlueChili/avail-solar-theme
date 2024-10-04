<?php
$block_slug = str_replace('acf/', '', $block['name']);
$block_typ = $block_slug;

$id = $block_typ . '_' . $block['id'];
if ( $block_anker = get_field( 'block_anker' ) ) : 
    $id = esc_html( $block_anker );
endif;

require get_template_directory() . '/template-parts/elements/block/block_variables.php';
require get_template_directory() . '/template-parts/elements/block/block_variables_headline.php';
require get_template_directory() . '/template-parts/elements/block/block_variables_button.php';

if( isset( $block['data']['preview_image_help'] )  ) :  /* rendering in inserter preview  */

    echo '<img src="'. $block['data']['preview_image_help'] .'" style="width:100%; height:auto;">';

else : /* rendering in editor body */

    if ( ( !get_field( 'block_disable' ) && !is_admin() ) || is_admin() ) : ?>
    <!-- data-aos="fade-zoom-in" data-aos-duration="1000" -->
    <section id="<?= esc_attr($id); ?>" class="gp-<?= $block_typ; ?> section position-relative <?= esc_attr($className); ?> <?php the_field('block_space_before'); ?> <?php the_field('block_space_after'); ?>">
        <div class="container">
            <div class="row">
                <?php if ( get_field( 'one_column' ) ) : ?>
                    <div class="col-12 content">
                <?php else: ?>
                    <div class="col-lg-6 content pe-xl-7 d-flex flex-column justify-content-between">
                <?php endif; ?>
                    <?php 
                        /* Load Headline */
                        require get_template_directory() . '/template-parts/elements/block/block_headline.php'; 
                    ?>
                    <?php 
                        if ( !avasol_is_mobile() ) {
                            if ( $button_item_text || $second_button_item_text ) :
                                echo '<div class="button-container d-flex gap-4">';
                                    if ( $button_item_text ) :
                                        require get_template_directory() . '/template-parts/elements/buttons/button.php'; 
                                    endif;
                                
                                    if ( $second_button_item_text ) :        
                                        $second_button = true;
                                        require get_template_directory() . '/template-parts/elements/buttons/button.php'; 
                                    endif;
                                echo '</div>';
                            endif; 
                        }
                    ?>
                <?php if ( !get_field( 'one_column' ) ) : ?>
                    </div>
                    <div class="col-lg-6 content ps-xl-7">
                <?php endif; ?>
                    <?php if ( $textblock_field = get_field( 'textblock_field' ) ) : ?>
                        <?= $textblock_field; ?>
                    <?php endif; ?>

                    <?php 
                        if ( avasol_is_mobile() ) {
                            if ( $button_item_text || $second_button_item_text ) :
                                echo '<div class="button-container d-flex flex-column gap-4 mt-4">';
                                    if ( $button_item_text ) :
                                        require get_template_directory() . '/template-parts/elements/buttons/button.php'; 
                                    endif;
                                
                                    if ( $second_button_item_text ) :        
                                        $second_button = true;
                                        require get_template_directory() . '/template-parts/elements/buttons/button.php'; 
                                    endif;
                                echo '</div>';
                            endif; 
                        }
                    ?>
                </div>
            </div>
        </div>
    </section>
    <?php endif;
endif; ?>
    