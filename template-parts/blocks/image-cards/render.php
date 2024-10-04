<?php
$block_slug = str_replace('acf/', '', $block['name']);
$block_typ = $block_slug;

$id = $block_typ . '_' . $block['id'];
if ( $block_anker = get_field( 'block_anker' ) ) : 
    $id = esc_html( $block_anker );
endif;

$aos_delay = 150; 

require get_template_directory() . '/template-parts/elements/block/block_variables.php';
require get_template_directory() . '/template-parts/elements/block/block_variables_headline.php';
require get_template_directory() . '/template-parts/elements/block/block_variables_button.php';

if( isset( $block['data']['preview_image_help'] )  ) :  /* rendering in inserter preview  */

    echo '<img src="'. $block['data']['preview_image_help'] .'" style="width:100%; height:auto;">';

else : /* rendering in editor body */
    
    if ( ( !get_field( 'block_disable' ) && !is_admin() ) || is_admin() ) : ?>
    <section id="<?= esc_attr($id); ?>" class="gp-<?= $block_typ; ?> section <?= esc_attr($className); ?> <?php the_field('block_space_before'); ?> <?php the_field('block_space_after'); ?>" data-aos="fade-zoom-in" data-aos-duration="1000">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-xl-7 mx-auto content text-center">
                    <div class="subline d-inline-block px-4 mb-5" data-aos="flip-down" data-aos-duration="1000" data-aos-delay="150">
                        <div class="d-flex justify-content-center align-items-center gap-2">
                            <?php
                            $textblock_subline_icon = get_field( 'textblock_subline_icon' );
                            if ( $textblock_subline_icon ) {
                                echo wp_get_attachment_image( $textblock_subline_icon, 'full', '', array( 'class' => 'img-fluid', 'width' => '16', 'height' => '16' ) );
                            }; ?>
                            <?php if ( $textblock_subline = get_field( 'textblock_subline' ) ) : ?>
                                <span><?= $textblock_subline; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php 
                        /* Load Headline */
                        require get_template_directory() . '/template-parts/elements/block/block_headline.php'; 
                    ?>
                    <?php if ( $textblock_field = get_field( 'textblock_field' ) ) : ?>
                        <div class="px-xl-7"><?= $textblock_field; ?></div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row cards row-cols-1 row-cols-lg-3 g-4 mt-4">
                <?php if ( have_rows( 'card_items' ) ) : ?>
                    <?php while ( have_rows( 'card_items' ) ) : the_row(); 
                            $card_item_bg = get_sub_field( 'card_item_bg' );
                            $textblock_headline = get_sub_field( 'textblock_headline' );
                            $classes_headline = '';
                            $classes_headline_value = get_sub_field('headline_class');
                            if ($classes_headline_value) {
                                $classes_headline .= ' ' . $classes_headline_value;
                            }
                            $h_tag = get_sub_field('headline_typ');
                        ?>
                        <div class="col d-flex" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="<?= $aos_delay; ?>">
                            <div class="card-content position-relative overflow-hidden d-flex align-items-end">
                                <?php if ( $card_item_bg ) : ?>
                                        <?= wp_get_attachment_image( $card_item_bg, 'full', '', array( 'class' => 'img-fluid imagecontainer-img-cover' ) ); ?>
                                <?php endif; ?>
                                <div class="card m-4 text-body">
                                    <?php 
                                        /* Load Headline */
                                        $extra_class_headline = 'mb-3 title';
                                        require get_template_directory() . '/template-parts/elements/block/block_headline.php'; 
                                    ?>
                                    <?php the_sub_field( 'card_item_text' ); ?>
                                </div>
                            </div>
                        </div>
                    <?php 
                        $aos_delay = $aos_delay + 50;
                        endwhile; ?>
                <?php endif; ?>
            </div>
            <?php 
                if ( $button_item_text || $second_button_item_text ) :
                    echo '<div class="button-container d-flex flex-column flex-md-row justify-content-center align-items-center gap-2 mt-7" data-aos="fade-up" data-aos-duration="1000">';
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