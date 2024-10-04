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
    <section id="<?= esc_attr($id); ?>" class="gp-<?= $block_typ; ?> section <?= esc_attr($className); ?> <?php the_field('block_space_before'); ?> <?php the_field('block_space_after'); ?>" data-aos="fade-zoom-in" data-aos-duration="1000">
        <div class="container position-relative py-7 overflow-hidden">
            <?php
            $cta_bg_image = get_field( 'cta_bg_image' );
            if ( $cta_bg_image ) {
                echo wp_get_attachment_image( $cta_bg_image, 'full', '', array( 'class' => 'img-fluid imagecontainer-img-cover') );
            }; ?>
            <div class="row position-relative mx-0">
                <div class="col-lg-6 offset-lg-6 content">
                    <?php
                    $cta_icon = get_field( 'cta_icon' );
                    if ( $cta_icon ) {
                        echo wp_get_attachment_image( $cta_icon, 'full', '', array( 'class' => 'img-fluid mb-5', 'width' => '65', 'height' => '65') );
                    }; ?>
                    <?php 
                        /* Load Headline */
                        require get_template_directory() . '/template-parts/elements/block/block_headline.php'; 
                    ?>
                    <?php if ( $textblock_field = get_field( 'textblock_field' ) ) : ?>
                        <?= $textblock_field; ?>
                    <?php endif; ?>
                    <?php 
                        if ( $button_item_text ) :
                            $btn_class = 'btn-secondary mt-4';
                            $svg = '<svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_69_3016)"><path d="M11.6667 2.1665H5.00001C4.08334 2.1665 3.33334 2.9165 3.33334 3.83317V17.1665C3.33334 18.0832 4.08334 18.8332 5.00001 18.8332H15C15.9167 18.8332 16.6667 18.0832 16.6667 17.1665V7.1665L11.6667 2.1665ZM5.00001 17.1665V3.83317H10.8333V7.1665H15V17.1665H5.00001ZM9.16668 16.3332H10.8333V15.4998H11.6667C12.125 15.4998 12.5 15.1248 12.5 14.6665V12.1665C12.5 11.7082 12.125 11.3332 11.6667 11.3332H9.16668V10.4998H12.5V8.83317H10.8333V7.99984H9.16668V8.83317H8.33334C7.87501 8.83317 7.50001 9.20817 7.50001 9.6665V12.1665C7.50001 12.6248 7.87501 12.9998 8.33334 12.9998H10.8333V13.8332H7.50001V15.4998H9.16668V16.3332Z" fill="white"/></g><defs><clipPath id="clip0_69_3016"><rect width="20" height="20" fill="white" transform="translate(0 0.5)"/></clipPath></defs></svg>';
                            require get_template_directory() . '/template-parts/elements/buttons/button.php'; 
                        endif;
                    ?>
                </div>
            </div>
        </div>
    </section>
    <?php endif;
endif; ?>
    