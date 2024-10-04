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
            <div class="row cards row-cols-1 row-cols-lg-3 g-4 mt-4">
                <?php if ( have_rows( 'team_items' ) ) : ?>
                    <?php while ( have_rows( 'team_items' ) ) : the_row(); 
                            $team_item_name = get_sub_field( 'team_item_name' );
                            $team_item_text = get_sub_field( 'team_item_text' );
                            $team_item_position = get_sub_field( 'team_item_position' );
                            $team_item_email = get_sub_field( 'team_item_email' );
                            $team_item_linkedin = get_sub_field( 'team_item_linkedin' );
                            $team_item_image = get_sub_field( 'team_item_image' );
                            
                        ?>
                        <div class="col d-flex" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="<?= $aos_delay; ?>">
                            <div class="card overflow-hidden">
                                <?php if ( $team_item_image ) : ?>
                                    <div class="card-image position-relative">
                                        <?= avasol_generate_image_size( $team_item_image, '500', '500', 'center', 'img-fluid w-100' ); ?>
                                        <div class="d-flex gap-2 position-absolute bottom-0 mb-4">
                                            <?php if ( $team_item_position ) : ?>
                                                <div class="position align-items-center d-flex px-3"><?= $team_item_position; ?></div>
                                            <?php endif; ?>
                                            <?php if ( $team_item_linkedin ) : ?>
                                                <a href="<?= $team_item_linkedin; ?>" title="LinkedIn" target="_blank"><svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><rect width="34" height="34" rx="17" fill="white"/><rect x="7" y="7" width="20" height="20" fill="url(#team_linkedin)"/><defs><pattern id="team_linkedin" patternContentUnits="objectBoundingBox" width="1" height="1"><use xlink:href="#team_linkedin_image0_98_476" transform="scale(0.0104167)"/></pattern><image id="team_linkedin_image0_98_476" width="96" height="96" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGAAAABgCAYAAADimHc4AAAACXBIWXMAAAsTAAALEwEAmpwYAAADlUlEQVR4nO2dvWsUURTFXySoYGdhzL6biJDGqNF9NwmRsPdGIRAUwUJstBAEbQQbIY2F2BuMn/+EX9hooXYq2FiojWAnGLQyCUYkceVlmwhJdtzNzJ2dPT+4TWDf5p3z7pl5uzszzgEAAAAAAAAAAAAAkBAS3k/K017CBxKeJ+VqoUt4fnmuyjdIB/eZLZS+ib4tXvguKS+Zi6JmteSV7/T392/OXHxSfpkDAao5qReZmkAS7uVg0tU8lVe+nWXmt3PsVFctCYs9h4f2pm+A8rT5ZDWnJWEqdQO88kfziWo+y0t4n7oBJDxnPVHKbYXZ9A0wnyTnumCAwgDzVUjoAHshCBFkLwYZVAscA8Ir0nCZlE+UpHzcS7hU+5u9eIU2wEtYKEk4tda4PRrOxt2ktYCFNYAqfC7B2FesBSykAV74i3NuU72xu8YHtnkNP61FLJ4Byg+Tju81vLUWsXAGkIT7iccXfmMtYvEMUP6U/IueMGstYhENiMeBownGvmgtYGENIOVvJR06uNa4pdqeYMFawCIbELvgV+3rzPLETinviYZ4LZ8h5Sek/MdavMIb0A7lYADDAOtVSOgAeyEIEWQvBhlULo8BXsLXjRrfK59MMo6XcGvFa3574Ue+whdIBoe6Dg3siJu+XapbeyvDu6kSTnvhpzDApWLAg+5R7k30mjE+5iXMoAN0YwzwwtfcfxJ/8UzC3xFB2pwBPcLjrkFiJ8AAbc6AZvESHuMgrHYG0NigwgC1M8A51+E1fMZpqDZpgGpn7eyGJ+Mnrkm+Gm3mOgiXNq2yD4jQkQOeJLz793/hZ0mvZvESzsMAbdiADlJ+vYaJV5MMQBUehgHamAHdYzy6TkfORIPqjbG8S0YEcYMbMZ5cT7wobt0OGBnZDgO0MQPi5ULrilfh4bqDqHbCAG3+w7jVKkZUIiMRQQwDWvE01KMDYEAqoAMYO2GXAEQQIigdEEGMCHIJQAQhgtIBEcSIIJcARBAiKB0QQYwIcglABLVpubSxniDlvGCAwgDzVUjoAHshCBFkLwYZFI4BCgPMVyEVugNw49bqWuJ7DT9SNwC3LmbjWxcvPznCvtUph+U1XM/AgHgRW+vfXI9a9fb1kfjYDvMJa77KS7jpsiJe4BAf22E9acpLCT/P/Dky8Q3jYzvaOo4kLMaVn7n4K4m5F38KHs8A2uIUVXiuNtcwlVnmAwAAAAAAAAAAAABXBP4Csdh+I6EOkFUAAAAASUVORK5CYII="/></defs></svg></a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="card-body text-body">
                                    <?php if ( $team_item_position ) : ?>
                                        <div class="name mb-1"><?= $team_item_name; ?></div>
                                    <?php endif; ?>
                                    <?php if ( $team_item_email ) : ?>
                                        <div class="email"><a href="mailto:<?= $team_item_email; ?>" title="Email" class="text-decoration-none"><?= $team_item_email; ?></a></div>
                                    <?php endif; ?>
                                    <?php if ( $team_item_text ) : ?>
                                        <div class="text mt-3"><?= $team_item_text; ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php 
                        $aos_delay = $aos_delay + 50;
                        endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <?php endif;
endif; ?>