<?php
$block_slug = str_replace('acf/', '', $block['name']);
$block_typ = $block_slug;

$id = $block_typ . '_' . $block['id'];
if ( $block_anker = get_field( 'block_anker' ) ) : 
    $id = esc_html( $block_anker );
endif;

$header_image = get_field( 'header_image' );

require get_template_directory() . '/template-parts/elements/block/block_variables.php';
require get_template_directory() . '/template-parts/elements/block/block_variables_headline.php';
require get_template_directory() . '/template-parts/elements/block/block_variables_button.php';

if( isset( $block['data']['preview_image_help'] )  ) :  /* rendering in inserter preview  */

    echo '<img src="'. $block['data']['preview_image_help'] .'" style="width:100%; height:auto;">';

else : /* rendering in editor body */
    
    if ( ( !get_field( 'block_disable' ) && !is_admin() ) || is_admin() ) : ?>
    <section id="<?= esc_attr($id); ?>" class="gp-<?= $block_typ; ?> section vh-100 d-flex flex-column justify-content-center overflow-hidden<?= esc_attr($className); ?> <?php the_field('block_space_before'); ?> <?php the_field('block_space_after'); ?>">
        <div class="container<?php if ( get_field( 'header_image_position' ) ) : ?>-fluid<?php endif; ?> mt-n7 mt-md-0">
            <div class="row">
                <?php if ( $header_image ) : ?>
                    <div class="<?php if ( get_field( 'header_image_position' ) ) : ?>col-lg-6<?php else : ?>col-lg-7<?php endif; ?> d-flex justify-content-center content flex-column">
                        <?php 
                            /* Load Headline */
                            require get_template_directory() . '/template-parts/elements/block/block_headline.php'; 
                        ?>
                        <?php if ( $textblock_field = get_field( 'textblock_field' ) ) : ?>
                            <?= $textblock_field; ?>
                        <?php endif; ?>
                        <?php 
                            if ( $button_item_text || $second_button_item_text ) :
                                echo '<div class="button-container d-md-flex gap-2 mt-5">';
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
                    <div class="<?php if ( get_field( 'header_image_position' ) ) : ?>col-lg-6<?php else : ?>col-lg-5<?php endif; ?> image">
                        <?php
                            if ( avasol_is_mobile() ) :
                                if ( $header_image_mobile = get_field( 'header_image_mobile' ) ) :
                                    if ( $header_image_mobile ) {
                                        echo wp_get_attachment_image( $header_image_mobile, 'full', '', array( 'class' => 'img-fluid imagecontainer-img-cover bg-mobile', 'loading' => 'eager') );
                                    };
                                else : 
                                    if ( $header_image ) {
                                        echo wp_get_attachment_image( $header_image, 'full', '', array( 'class' => 'img-fluid imagecontainer-img-cover', 'loading' => 'eager') );
                                    };
                                endif;
                            else :
                                if ( $header_image ) {
                                    echo wp_get_attachment_image( $header_image, 'full', '', array( 'class' => 'img-fluid imagecontainer-img-cover', 'loading' => 'eager') );
                                };
                            endif;
                        ?>
                    </div>
                <?php else : ?>
                    <div class="col-lg-10 mt-6 mb-4">
                        <?php 
                            /* Load Headline */
                            require get_template_directory() . '/template-parts/elements/block/block_headline.php'; 
                        ?>
                    </div>
                    <div class="col-lg-5 order-lg-2">
                        <?php if ( $textblock_field = get_field( 'textblock_field' ) ) : ?>
                            <?= $textblock_field; ?>
                        <?php endif; ?>
                        <?php 
                            if ( avasol_is_mobile() ) :
                                if ( $button_item_text || $second_button_item_text ) :
                                    echo '<div class="button-container d-md-flex gap-2 mt-5">';
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
                            endif;
                        ?>
                    </div>
                    <div class="col-lg-7 button-container order-lg-1">
                        <?php 
                            if ( !avasol_is_mobile() ) :
                                if ( $button_item_text || $second_button_item_text ) :
                                    echo '<div class="d-sm-flex gap-2 mt-4 mt-lg-0 mb-4 mb-lg-9">';
                                        if ( $button_item_text ) :
                                            $btn_class = 'btn-secondary';
                                            require get_template_directory() . '/template-parts/elements/buttons/button.php'; 
                                        endif;
                                    
                                        if ( $second_button_item_text ) :        
                                            $second_button = true;
                                            $extra_class_button = 'mt-3 mt-sm-0';
                                            $btn_class = 'btn-light';
                                            require get_template_directory() . '/template-parts/elements/buttons/button.php'; 
                                        endif;
                                    echo '</div>';
                                endif;
                            endif;
                        ?>
                        <div class="scrolldown position-absolute bottom-0 mb-3">
                            <a href="#start"><svg width="58" height="58" viewBox="0 0 58 58" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M35 30.125L29 36.125L23 30.125" stroke="#1C3F33"/><path d="M29 21.875L29 35.75" stroke="#1C3F33"/><rect x="57.5" y="0.5" width="57" height="57" rx="28.5" transform="rotate(90 57.5 0.5)" stroke="#1C3F33" stroke-opacity="0.1"/></svg></a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <?php if ( $header_image ) : ?>
                <div class="scrolldown position-absolute bottom-0 mb-3">
                    <a href="#start"><svg width="58" height="58" viewBox="0 0 58 58" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M35 30.125L29 36.125L23 30.125" stroke="#1C3F33"/><path d="M29 21.875L29 35.75" stroke="#1C3F33"/><rect x="57.5" y="0.5" width="57" height="57" rx="28.5" transform="rotate(90 57.5 0.5)" stroke="#1C3F33" stroke-opacity="0.1"/></svg></a>
                </div>
            <?php endif; ?>
        </div>
    </section>
    <?php endif;
endif; ?>