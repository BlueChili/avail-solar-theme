<?php
$block_slug = str_replace('acf/', '', $block['name']);
$block_typ = $block_slug;

$id = $block_typ . '_' . $block['id'];
if ( $block_anker = get_field( 'block_anker' ) ) : 
    $id = esc_html( $block_anker );
endif;

$aos_delay = 150;
$aos_delay_bar = 150;

require get_template_directory() . '/template-parts/elements/block/block_variables.php';
require get_template_directory() . '/template-parts/elements/block/block_variables_headline.php';

if( isset( $block['data']['preview_image_help'] )  ) :  /* rendering in inserter preview  */

    echo '<img src="'. $block['data']['preview_image_help'] .'" style="width:100%; height:auto;">';

else : /* rendering in editor body */
    
    if ( ( !get_field( 'block_disable' ) && !is_admin() ) || is_admin() ) : ?>
    <section id="<?= esc_attr($id); ?>" class="gp-<?= $block_typ; ?> section <?= esc_attr($className); ?> <?php the_field('block_space_before'); ?> <?php the_field('block_space_after'); ?>" data-aos="fade-zoom-in" data-aos-duration="1000">
        <div class="container">
            <div class="bg-primary text-white p-5 border-radius">
                <div class="row">
                    <div class="col-lg-3 content">
                        <?php 
                            /* Load Headline */
                            require get_template_directory() . '/template-parts/elements/block/block_headline.php'; 
                        ?>
                        <?php if ( $textblock_field = get_field( 'textblock_field' ) ) : ?>
                            <?= $textblock_field; ?>
                        <?php endif; ?>
                    </div>
                    <div class="col-lg-9 bars d-flex flex-column flex-lg-row gap-3">
                        <?php if ( have_rows( 'bar_items' ) ) : ?>
                            <?php while ( have_rows( 'bar_items' ) ) : the_row(); 
                                $bar_item_bar_items = get_sub_field( 'bar_item_bar_items' );
                                $bar_item_bar_items_counter = 1;
                                $aos_delay_bar = $aos_delay_bar + 100;
                                ?>
                                <div class="card p-4 bg-transparent w-100 text-center" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="<?= $aos_delay; ?>">
                                    <div class="bar-items d-flex justify-content-center flex-column align-items-center mb-3 mt-2">
                                        <div class="d-flex justify-content-center gap-2 mt-1">
                                            <div class="bar-items--progress d-flex flex-column-reverse justify-content-start position-relative">
                                                <div class="d-flex flex-row justify-content-center gap-2">
                                                    <div class="bar-placeholder position-relative">
                                                        <div class="bar-item"></div>
                                                        <div class="bar-item"></div>
                                                        <div class="bar-item"></div>
                                                        <div class="bar-item"></div>
                                                        <div class="bar-item"></div>
                                                        <div class="bar-item"></div>
                                                        <div class="bar-item"></div>
                                                        <div class="bar-item"></div>
                                                        <div class="bar-active position-absolute">
                                                            <?php if ( $bar_item_bar_items ) : ?>
                                                                <?php 
                                                                    while ($bar_item_bar_items_counter <= $bar_item_bar_items) { ?>
                                                                        <div class="bar-item" data-aos="flip-up" data-aos-duration="3000" data-aos-delay="<?= $aos_delay_bar; ?>"></div>
                                                                    <?php 
                                                                        $bar_item_bar_items_counter++;
                                                                    }
                                                                ?>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    <div class="bar-placeholder position-relative">
                                                        <div class="bar-item"></div>
                                                        <div class="bar-item"></div>
                                                        <div class="bar-item"></div>
                                                        <div class="bar-item"></div>
                                                        <div class="bar-item"></div>
                                                        <div class="bar-item"></div>
                                                        <div class="bar-item"></div>
                                                        <div class="bar-item"></div>
                                                        <div class="bar-active position-absolute">
                                                            <?php if ( $bar_item_bar_items ) :
                                                                $bar_item_bar_items_counter = 1; ?>
                                                                <?php 
                                                                    while ($bar_item_bar_items_counter <= $bar_item_bar_items) { ?>
                                                                        <div class="bar-item" data-aos="flip-up" data-aos-duration="3000" data-aos-delay="<?= $aos_delay_bar; ?>"></div>
                                                                    <?php 
                                                                        $bar_item_bar_items_counter++;
                                                                    }
                                                                ?>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <?php the_sub_field( 'bar_item_text' ); ?>
                                </div>
                            <?php 
                                $aos_delay = $aos_delay + 50;
                                endwhile; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif;
endif; ?>