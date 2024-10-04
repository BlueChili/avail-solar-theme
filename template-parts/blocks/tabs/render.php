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

if( isset( $block['data']['preview_image_help'] )  ) :  /* rendering in inserter preview  */

    echo '<img src="'. $block['data']['preview_image_help'] .'" style="width:100%; height:auto;">';

else : /* rendering in editor body */
    
    if ( ( !get_field( 'block_disable' ) && !is_admin() ) || is_admin() ) : ?>
    <section id="<?= esc_attr($id); ?>" class="gp-<?= $block_typ; ?> section <?= esc_attr($className); ?> <?php the_field('block_space_before'); ?> <?php the_field('block_space_after'); ?>" data-aos="fade-zoom-in" data-aos-duration="1000">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-xl-7 mx-auto content text-center">
                    <?php if ( $textblock_subline = get_field( 'textblock_subline' ) ) : ?>
                        <div class="subline d-inline-block px-4 mb-5" data-aos="flip-down" data-aos-duration="1000" data-aos-delay="150">
                            <div class="d-flex justify-content-center align-items-center gap-2">
                                <?php
                                $textblock_subline_icon = get_field( 'textblock_subline_icon' );
                                if ( $textblock_subline_icon ) {
                                    echo wp_get_attachment_image( $textblock_subline_icon, 'full', '', array( 'class' => 'img-fluid', 'width' => '16', 'height' => '16' ) );
                                }; ?>
                                <span><?= $textblock_subline; ?></span>  
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php 
                        /* Load Headline */
                        require get_template_directory() . '/template-parts/elements/block/block_headline.php'; 
                    ?>
                    <?php if ( $textblock_field = get_field( 'textblock_field' ) ) : ?>
                        <div class="px-xl-7"><?= $textblock_field; ?></div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row tabs mt-4">
                <div class="col-lg-6 <?php if ( get_field( 'image_position' ) ) : ?>order-lg-2<?php endif; ?>">
                    <div class="nav flex-column nav-pills gap-3" id="<?= $id; ?>-pills-tab" role="tablist" aria-orientation="vertical">
                        <?php if ( have_rows( 'tab_items' ) ) : 
                            $tab_counter = 1;
                            ?>
                            <?php while ( have_rows( 'tab_items' ) ) : the_row(); ?>
                                <div class="nav-link <?php if ( $tab_counter == 1 ) : ?>active<?php endif; ?> text-start" id="<?= $id; ?>-pills-<?= $tab_counter; ?>-tab" data-bs-toggle="pill" data-bs-target="#<?= $id; ?>-pills-<?= $tab_counter; ?>" type="button" role="tab" aria-controls="<?= $id; ?>-pills-<?= $tab_counter; ?>" <?php if ( $tab_counter == 1 ) : ?>aria-selected="true"<?php else: ?>aria-selected="false"<?php endif; ?> data-aos="fade-up" data-aos-duration="1000" data-aos-delay="<?= $aos_delay; ?>">
                                    <?php if ( $tab_item_headline = get_sub_field( 'tab_item_headline' ) ) : ?>
                                        <div class="h5 mb-0"><?= $tab_item_headline; ?></div>
                                    <?php endif; ?>
                                    <?php if ( $tab_item_text = get_sub_field( 'tab_item_text' ) ) : ?>
                                        <div class="tab-text"><?= $tab_item_text; ?></div>
                                    <?php endif; ?>
                                </div>
                            <?php $aos_delay = $aos_delay + 50; $tab_counter++; endwhile; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-lg-6 <?php if ( get_field( 'image_position' ) ) : ?>order-lg-1<?php endif; ?> d-none d-lg-flex" data-aos="fade-up" data-aos-duration="1000">
                    <div class="tab-content" id="<?= $id; ?>-pills-tabContent">
                    <?php if ( have_rows( 'tab_items' ) ) : 
                            $tab_counter = 1;
                            ?>
                            <?php while ( have_rows( 'tab_items' ) ) : the_row(); 
                                    $tab_item_image = get_sub_field( 'tab_item_image' );
                                ?>
                                <div class="tab-pane fade <?php if ( $tab_counter == 1 ) : ?>show active<?php endif; ?>" id="<?= $id; ?>-pills-<?= $tab_counter; ?>" role="tabpanel" aria-labelledby="<?= $id; ?>-pills-<?= $tab_counter; ?>-tab" tabindex="0">
                                    <?php if ( $tab_item_image ) : 
                                        echo avasol_generate_image_size( $tab_item_image, '650', '750', 'center', 'img-fluid w-100', false);
                                        //echo wp_get_attachment_image( $tab_item_image, 'full', '', array( 'class' => 'img-fluid imagecontainer-img-cover') );
                                    endif; ?>
                                </div>
                            <?php $tab_counter++; endwhile; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif;
endif; ?>