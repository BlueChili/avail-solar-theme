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
    <section id="<?= esc_attr($id); ?>" class="gp-<?= $block_typ; ?> section position-relative <?= esc_attr($className); ?> <?php the_field('block_space_before'); ?> <?php the_field('block_space_after'); ?>" data-aos="fade-zoom-in" data-aos-duration="1000">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-xl-7 content">
                    <?php 
                        /* Load Headline */
                        require get_template_directory() . '/template-parts/elements/block/block_headline.php'; 
                    ?>
                    <?php if ( $textblock_field = get_field( 'textblock_field' ) ) : ?>
                        <div class="pe-xxl-9"><?= $textblock_field; ?></div>
                    <?php endif; ?>
                </div>
                <div class="col-lg-4 col-xl-5 content d-flex flex-column align-items-lg-end justify-content-center mt-6">
                    <?php 
                        if ( $button_item_text ) :
                            $btn_class = 'btn-secondary';
                            $svg = '<svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_69_3016)"><path d="M11.6667 2.1665H5.00001C4.08334 2.1665 3.33334 2.9165 3.33334 3.83317V17.1665C3.33334 18.0832 4.08334 18.8332 5.00001 18.8332H15C15.9167 18.8332 16.6667 18.0832 16.6667 17.1665V7.1665L11.6667 2.1665ZM5.00001 17.1665V3.83317H10.8333V7.1665H15V17.1665H5.00001ZM9.16668 16.3332H10.8333V15.4998H11.6667C12.125 15.4998 12.5 15.1248 12.5 14.6665V12.1665C12.5 11.7082 12.125 11.3332 11.6667 11.3332H9.16668V10.4998H12.5V8.83317H10.8333V7.99984H9.16668V8.83317H8.33334C7.87501 8.83317 7.50001 9.20817 7.50001 9.6665V12.1665C7.50001 12.6248 7.87501 12.9998 8.33334 12.9998H10.8333V13.8332H7.50001V15.4998H9.16668V16.3332Z" fill="white"/></g><defs><clipPath id="clip0_69_3016"><rect width="20" height="20" fill="white" transform="translate(0 0.5)"/></clipPath></defs></svg>';
                            require get_template_directory() . '/template-parts/elements/buttons/button.php'; 
                        endif;
                    ?>
                    <?php if ( $textblock_infobox = get_field( 'textblock_infobox' ) ) : ?>
                        <div class="d-flex gap-3 justify-content-end note mt-5">
                            <svg width="21" height="27" viewBox="0 0 21 27" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M21 4C21 2.89543 20.1046 2 19 2H2C0.895431 2 0 2.89543 0 4V22V25.0858C0 25.9767 1.07714 26.4229 1.70711 25.7929L4.91421 22.5858C5.28929 22.2107 5.79799 22 6.32843 22H19C20.1046 22 21 21.1046 21 20V4Z" fill="#1C3F33"/><path d="M10.0484 8.92957H11.7271V17H10.0484V8.92957ZM10.9039 7.75935C10.6456 7.75935 10.4304 7.67596 10.2583 7.50917C10.0861 7.34238 10 7.13255 10 6.87968C10 6.63218 10.0861 6.42504 10.2583 6.25825C10.4304 6.08608 10.6429 6 10.8958 6C11.1433 6 11.3531 6.08608 11.5253 6.25825C11.6975 6.42504 11.7836 6.63218 11.7836 6.87968C11.7836 7.13255 11.6975 7.34238 11.5253 7.50917C11.3585 7.67596 11.1514 7.75935 10.9039 7.75935Z" fill="white"/></svg>
                            <div class="note--text"><?= $textblock_infobox; ?></div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    <?php endif;
endif; ?>
    