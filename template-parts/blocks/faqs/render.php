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
    <?php
    $faqs_page = get_field( 'faq_list' );
    if ( $faqs_page ) : 
    $faq_items_total = count($faqs_page);
    $faq_item_counter = 1;
    ?>
        <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "FAQPage",
            "mainEntity": [
            <?php foreach( $faqs_page as $faq) : ?>
                <?php setup_postdata( $faq ); ?>
                <?php 
                $faq_id = $faq;
                $faq_answer = get_field( 'answer' , $faq_id );
                $faq_answer = str_replace(array('<p>','</p>'),'',$faq_answer);
            ?>
            {
                "@type": "Question",
                "name": "<?= get_the_title( $faq_id ); ?>",
                "acceptedAnswer": {
                "@type": "Answer",
                "text": "<?= $faq_answer; ?>"
                }
            }<?php if ( $faq_item_counter != $faq_items_total ) : ?>,<?php endif; ?>
            <?php 
                $faq_item_counter++;
                endforeach; ?>
            ]
        }
        </script>
    <?php endif; ?>
    <section id="<?= esc_attr($id); ?>" class="gp-<?= $block_typ; ?> section position-relative <?= esc_attr($className); ?> <?php the_field('block_space_before'); ?> <?php the_field('block_space_after'); ?>" data-aos="fade-zoom-in" data-aos-duration="1000">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center position-relative content">
                    <?php if ( $textblock_subline = get_field( 'textblock_subline' ) ) : ?>
                        <div class="subline"><?= $textblock_subline; ?></div>
                    <?php endif; ?>
                    <?php 
                        /* Load Headline */
                        require get_template_directory() . '/template-parts/elements/block/block_headline.php'; 
                    ?>
                    <?php if ( $textblock_field = get_field( 'textblock_field' ) ) :
                        echo $textblock_field;
                    endif; ?>
                    <div class="faq-list text-start" itemscope itemtype="https://schema.org/FAQPage">
                        <?php
                        $posts = get_field( 'faq_list' );
                        $accordion_item_counter = 0;
                        if ( $posts ) : ?>
                            <div class="accordion accordion-flush" id="accordion-<?= $id; ?>">
                                <?php foreach( $posts as $post) : ?>
                                    <?php setup_postdata( $post ); ?>
                                    <?php 
                                        $post_id = $post;
                                        $answer = get_field( 'answer' , $post_id );
                                    ?>
                                    <div itemscope itemtype="https://schema.org/Question" class="accordion-item" itemprop="mainEntity">
                                        <div class="accordion-header position-relative" id="accordion-item-heading-<?= $accordion_item_counter; ?>">
                                            <div class="collapsed header-content d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#accordion-item-collapse-<?= $accordion_item_counter; ?>" aria-expanded="false" aria-controls="accordion-item-collapse-<?= $accordion_item_counter; ?>">
                                                <p itemprop="name" class="--title my-4 pe-5 pe-xxl-9"><?= get_the_title( $post_id ); ?></p>
                                                <div class="accordion-item-status">
                                                    <svg width="18" height="11" viewBox="0 0 18 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M9.53026 9.88389C9.23736 10.1768 8.76256 10.1768 8.46966 9.88389L0.823183 2.23739C0.530293 1.94449 0.530293 1.46969 0.823183 1.17679L1.17674 0.823191C1.46963 0.530291 1.9445 0.530291 2.2374 0.823191L8.99996 7.58579L15.7626 0.823191C16.0555 0.530291 16.5303 0.530291 16.8232 0.823191L17.1768 1.17679C17.4697 1.46969 17.4697 1.94449 17.1768 2.23739L9.53026 9.88389Z" fill="white"/></svg>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div itemprop="acceptedAnswer" itemscope itemtype="https://schema.org/Answer" id="accordion-item-collapse-<?= $accordion_item_counter; ?>" class="accordion-collapse collapse answer" aria-labelledby="accordion-item-heading-<?= $accordion_item_counter; ?>" data-bs-parent="#accordion-<?= $id; ?>">
                                            <?php if ( $answer ) : ?>
                                                <div itemprop="text"><?= $answer; ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php 
                                    $accordion_item_counter = $accordion_item_counter + 1;
                                    endforeach; ?>
                                <?php wp_reset_postdata(); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif;
endif; ?>
    