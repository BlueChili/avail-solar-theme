<?php
$block_slug = str_replace('acf/', '', $block['name']);
$block_typ = $block_slug;

$id = $block_typ . '_' . $block['id'];
if ( $block_anker = get_field( 'block_anker' ) ) : 
    $id = esc_html( $block_anker );
endif;

$delay = 100;

require get_template_directory() . '/template-parts/elements/block/block_variables.php';
require get_template_directory() . '/template-parts/elements/block/block_variables_headline.php';

if( isset( $block['data']['preview_image_help'] )  ) :  /* rendering in inserter preview  */

    echo '<img src="'. $block['data']['preview_image_help'] .'" style="width:100%; height:auto;">';

else : /* rendering in editor body */

    if ( ( !get_field( 'block_disable' ) && !is_admin() ) || is_admin() ) : ?>
    <section id="<?= esc_attr($id); ?>" class="gp-<?= $block_typ; ?> section <?= esc_attr($className); ?> <?php the_field('block_space_before'); ?> <?php the_field('block_space_after'); ?>" data-aos="fade-zoom-in" data-aos-duration="1000">
        <div class="container position-relative mb-4">
            <div class="row align-items-end">
                <div class="col-lg-8 mx-auto content">
                    <?php 
                        /* Load Headline */
                        $extra_class_headline_p = 'mb-0';
                        require get_template_directory() . '/template-parts/elements/block/block_headline.php'; 
                    ?>
                    <?php if ( $textblock_field = get_field( 'textblock_field' ) ) : ?>
                        <?= $textblock_field; ?>
                    <?php endif; ?>
                </div>
                <div class="col-lg-12">
                    <?php if ( have_rows( 'counter_facts' ) ) : ?>
                        <div id="counter_facts" class="counter-facts d-flex gap-xxl-6 gap-xl-5 gap-4 flex-column flex-md-row">
                            <?php while ( have_rows( 'counter_facts' ) ) :
                                the_row();
                                $counter_fact_item_number = get_sub_field( 'counter_fact_item_number' );
                                $counter_fact_item_number_label = get_sub_field( 'counter_fact_item_number_label' );
                                $counter_fact_item_subline = get_sub_field( 'counter_fact_item_subline' );
                                ?>
                                <div class="counter-fact w-100" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="<?= $delay; ?>">
                                    <div class="counter-fact--value d-flex">
                                        <span class="counter" data-TargetNum="<?= $counter_fact_item_number; ?>">0</span><?= $counter_fact_item_number_label; ?>
                                    </div>
                                    <?php if ( $counter_fact_item_subline ) : 
                                        echo $counter_fact_item_subline;  
                                    endif; ?>
                                </div>
                            <?php
                                $delay = $delay + 50; 
                                endwhile; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    <?php endif;
endif; ?>
    