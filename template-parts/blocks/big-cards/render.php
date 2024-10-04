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
                <div class="col-lg-9 mx-auto content text-center">
                    <?php 
                        /* Load Headline */
                        require get_template_directory() . '/template-parts/elements/block/block_headline.php'; 
                    ?>
                    <?php if ( $textblock_field = get_field( 'textblock_field' ) ) : ?>
                        <div class="px-xl-7"><?= $textblock_field; ?></div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row cards row-cols-1 gy-5 mt-lg-4">
                <?php if ( have_rows( 'card_items' ) ) : ?>
                    <?php while ( have_rows( 'card_items' ) ) : the_row(); 
                            $card_item_image = get_sub_field( 'card_item_image' );
                            $textblock_headline = get_sub_field( 'textblock_headline' );
                            $classes_headline = '';
                            $classes_headline_value = get_sub_field('headline_class');
                            if ($classes_headline_value) {
                                $classes_headline .= ' ' . $classes_headline_value;
                            }
                            $h_tag = get_sub_field('headline_typ');
                            $button_item_text = get_sub_field( 'button_item_text' );
                        ?>
                        <div class="col cards--item position-sticky" data-aos="fade-zoom-in">
                            <div class="row bg-white g-0 text-body p-4 p-lg-6 shadow-lg">
                                <div class="col-lg-7 <?php if ( !get_sub_field( 'card_item_image_pos' ) ) : ?>order-lg-2 ps-lg-5<?php else: ?>pe-lg-5<?php endif; ?>">
                                    <?php if ( $card_item_image ) : ?>
                                        <?= avasol_generate_image_size( $card_item_image, '650', '400', 'center', 'img-fluid w-100 mb-4 mb-lg-0', false ) ?>
                                    <?php endif; ?>
                                </div>
                                <div class="col-lg-5 <?php if ( !get_sub_field( 'card_item_image_pos' ) ) : ?>order-lg-1 pe-lg-2<?php else: ?>ps-lg-2<?php endif; ?>">
                                    <?php 
                                        /* Load Headline */
                                        $extra_class_headline = 'mb-4';
                                        require get_template_directory() . '/template-parts/elements/block/block_headline.php'; 
                                    ?>
                                    <?php the_sub_field( 'card_item_text' ); ?>
                                    <?php 
                                        if ( $button_item_text ) :
                                            $btn_class = 'btn-dark mt-4';
                                            require get_template_directory() . '/template-parts/elements/buttons/button_sub_field.php'; 
                                        endif;
                                    ?>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
            <?php 
                if ( $button_item_text || $second_button_item_text ) :
                    echo '<div class="button-container d-flex flex-column flex-md-row justify-content-center align-items-center gap-2 mt-5" data-aos="fade-up" data-aos-duration="1000">';
                        if ( $button_item_text ) :
                            $btn_class = 'btn-secondary';
                            require get_template_directory() . '/template-parts/elements/buttons/button.php'; 
                        endif;
                    
                        if ( $second_button_item_text ) :        
                            $second_button = true;
                            $extra_class_button = 'mt-3 mt-md-0';
                            $btn_class = 'btn-light';
                            require get_template_directory() . '/template-parts/elements/buttons/button.php'; 
                        endif;
                    echo '</div>';
                endif;
            ?>
        </div>
    </section>
    <?php endif;
endif; ?>