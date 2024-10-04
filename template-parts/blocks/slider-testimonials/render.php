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
    <section id="<?= esc_attr($id); ?>" class="gp-<?= $block_typ; ?> section <?= esc_attr($className); ?> <?php the_field('block_space_before'); ?> <?php the_field('block_space_after'); ?>">
        <div class="container">
            <div class="row align-items-center" data-aos="fade" data-aos-duration="1000">
                <div class="col-lg-6">
                    <div class="d-flex gap-3">
                        <svg width="36" height="32" viewBox="0 0 36 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.940334 31.8247C0.412136 31.752 0.0545577 31.2589 0.124035 30.7303L0.684291 26.4674C0.753028 25.9444 1.21684 25.571 1.74429 25.5631C3.26783 25.5402 4.47873 25.1796 5.377 24.4815C6.45241 23.6456 7.16934 22.4798 7.52781 20.9841C7.82947 19.7255 7.92487 18.3266 7.81403 16.7875C7.77762 16.2821 7.34769 15.9031 6.8409 15.9031L0.999983 15.9031C0.447699 15.9031 -1.67052e-05 15.4553 -1.67535e-05 14.9031L-1.79689e-05 1.00001C-1.80172e-05 0.447719 0.447694 3.06923e-06 0.999982 3.02094e-06L13.854 1.89721e-06C14.4063 1.84893e-06 14.854 0.447718 14.854 1L14.854 17.2228C14.854 22.4139 13.5994 26.3291 11.0901 28.9686C8.70405 31.4756 5.3208 32.4276 0.940334 31.8247ZM21.6419 31.8247C21.1137 31.752 20.7561 31.2589 20.8256 30.7303L21.3858 26.4674C21.4546 25.9444 21.9184 25.571 22.4458 25.5631C23.9694 25.5402 25.1803 25.1796 26.0785 24.4815C27.1539 23.6456 27.8709 22.4798 28.2293 20.9841C28.531 19.7254 28.6264 18.3266 28.5156 16.7875C28.4792 16.2821 28.0492 15.9031 27.5424 15.9031L21.7015 15.9031C21.1492 15.9031 20.7015 15.4553 20.7015 14.9031L20.7015 1C20.7015 0.447717 21.1492 1.25944e-06 21.7015 1.21116e-06L34.5555 8.74227e-08C35.1078 3.91404e-08 35.5555 0.447716 35.5555 1L35.5555 17.2228C35.5555 22.4139 34.3009 26.3291 31.7916 28.9686C29.4056 31.4756 26.0223 32.4276 21.6419 31.8247Z" fill="#26D538"/>
                        </svg>
                        <?php 
                            /* Load Headline */
                            require get_template_directory() . '/template-parts/elements/block/block_headline.php'; 
                        ?>
                    </div>
                    
                    <?php if ( $textblock = get_field( 'textblock_field' ) ) : ?>
                        <?= $textblock; ?>
                    <?php endif; ?>
                </div>
                <?php if ( !avasol_is_mobile() ) : ?>
                    <div class="col-6 d-flex justify-content-end gap-2">
                        <div class="testimonials-slider-button-prev">
                            <svg width="79" height="44" viewBox="0 0 79 44" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M38.5 28L32.5 22L38.5 16" stroke="white"/><path d="M46.75 22L32.875 22" stroke="white"/><rect x="77.75" y="43" width="76.25" height="42" rx="21" transform="rotate(180 77.75 43)" stroke="white" stroke-opacity="0.1" stroke-width="2"/></svg>
                        </div>
                        <div class="testimonials-slider-button-next">
                            <svg width="79" height="44" viewBox="0 0 79 44" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M41 16L47 22L41 28" stroke="white"/><path d="M32.75 22L46.625 22" stroke="white"/><rect x="1.75" y="1" width="76.25" height="42" rx="21" stroke="white" stroke-opacity="0.1" stroke-width="2"/></svg>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="container-fluid testimonials position-relative px-0 mt-lg-5">
            <?php if ( have_rows( 'testimonials_items' ) ) : ?>
                <div class="swiper swiper-slider-testimonials">
                    <div class="swiper-wrapper pb-5 pt-2">
                    <?php while ( have_rows( 'testimonials_items' ) ) : the_row(); ?>
                        <div class="swiper-slide">
                            <div class="card position-relative text-body" data-aos="fade-up" data-aos-duration="1000">
                                <div class="card-body p-4 p-lg-6">
                                    <?php if ( $testimonials_item_feedback = get_sub_field( 'testimonials_item_feedback' ) ) : ?>
                                        <div class="feedback"><?= $testimonials_item_feedback; ?></div>
                                    <?php endif; ?>
                                    <div class="d-flex gap-3 align-items-center mt-5 person">
                                        <?php
                                        $testimonials_item_image = get_sub_field( 'testimonials_item_image' );
                                        if ( $testimonials_item_image ) {
                                            echo avasol_generate_image_size( $testimonials_item_image, '48', '48', 'center', 'img-fluid person--image', false);
                                        }; ?>
                                        <?php if ( $testimonials_item_name = get_sub_field( 'testimonials_item_name' ) ) : ?>
                                            <p class="mb-0"><?= $testimonials_item_name; ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                    </div>
                </div>
            <?php endif; ?>
            <?php if ( avasol_is_mobile() ) : ?>
                <div class="col-12 d-flex justify-content-center gap-2 mt-3">
                    <div class="testimonials-slider-button-prev">
                        <svg width="79" height="44" viewBox="0 0 79 44" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M38.5 28L32.5 22L38.5 16" stroke="white"/><path d="M46.75 22L32.875 22" stroke="white"/><rect x="77.75" y="43" width="76.25" height="42" rx="21" transform="rotate(180 77.75 43)" stroke="white" stroke-opacity="0.1" stroke-width="2"/></svg>
                    </div>
                    <div class="testimonials-slider-button-next">
                        <svg width="79" height="44" viewBox="0 0 79 44" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M41 16L47 22L41 28" stroke="white"/><path d="M32.75 22L46.625 22" stroke="white"/><rect x="1.75" y="1" width="76.25" height="42" rx="21" stroke="white" stroke-opacity="0.1" stroke-width="2"/></svg>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>
    <?php endif;
endif; ?>
    