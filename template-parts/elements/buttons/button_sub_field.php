<?php
if ( $second_button ) {
    $btn_prefix = 'second_';
    $btn_class = 'btn-outline-dark';
} else {
    $btn_prefix = '';
    if ( $block_bg == 'bg-primary' ) {
        if ( !$btn_class ) {
            $btn_class = 'btn-dark';
        }
    } else {
        if ( !$btn_class ) {
            $btn_class = 'btn-primary';
        }
    }
}
$svg = '';

if ( $button_item_text = get_sub_field( $btn_prefix . 'button_item_text' ) ) : ?>
    <?php if ( get_sub_field( $btn_prefix . 'button_item_typ' ) == 'intern' ) : ?>
        <?php
            $url = get_sub_field( $btn_prefix . 'button_item_intern' );
            if ( $url ) : ?>
                <p class="mb-0"><a class="btn <?= $btn_class; ?> intern d-block d-sm-inline-block" href="<?= esc_url( $url ); ?>" title="<?= esc_html( $button_item_text ); ?>"><span><?= esc_html( $button_item_text ); ?></span><?= $svg; ?></a></p>
            <?php endif; ?>
    <?php elseif ( get_sub_field( $btn_prefix . 'button_item_typ' ) == 'extern' ) : ?>                                    
        <?php if ( $button_item_extern = get_sub_field( $btn_prefix . 'button_item_extern' ) ) : ?>
            <p class="mb-0"><a class="btn <?= $btn_class; ?> extern d-block d-sm-inline-block" href="<?= esc_url( $button_item_extern ); ?>" title="<?= esc_html( $button_item_text ); ?>" target="_blank"><span><?= esc_html( $button_item_text ); ?></span><?= $svg; ?></a></p>
        <?php endif; ?>
    <?php elseif ( get_sub_field( $btn_prefix . 'button_item_typ' ) == 'anker' ) : ?>
        <?php if ( $button_item_anker = get_sub_field( $btn_prefix . 'button_item_anker' ) ) : ?>
            <?php 
                $check_value = "#";
                if( strpos($button_item_anker, $check_value) === false ){
                    $button_item_anker = '#' . $button_item_anker;
                }
            ?>
            <p class="mb-0"><a class="btn <?= $btn_class; ?> anker d-block d-sm-inline-block" href="<?= esc_html( $button_item_anker ); ?>" title="<?= esc_html( $button_item_text ); ?>"><span><?= esc_html( $button_item_text ); ?></span><?= $svg; ?></a></p>
        <?php endif; ?>
    <?php elseif ( get_sub_field( $btn_prefix . 'button_item_typ' ) == 'download' ) : ?>
        <?php if ( $button_item_download = get_sub_field( $btn_prefix . 'button_item_download' ) ) : ?>
            <p class="mb-0"><a class="btn <?= $btn_class; ?> download d-block d-sm-inline-block" href="<?= esc_html( $button_item_download ); ?>" title="<?= esc_html( $button_item_text ); ?>" target="_blank"><span><?= esc_html( $button_item_text ); ?></span><?= $svg; ?></a></p>
        <?php endif; ?>    
    <?php elseif ( get_sub_field( $btn_prefix . 'button_item_typ' ) == 'funnel' ) : ?>
        <?php if ( get_field( 'general_funnel_button_item_typ' , 'options' ) == 'intern' ) : ?>
            <?php
                $url = get_field( 'general_funnel_button_item_intern' , 'options' );
                if ( $url ) : ?>
                    <p class="mb-0"><a class="btn <?= $btn_class; ?> intern d-block d-sm-inline-block" href="<?= esc_url( $url ); ?>" title="<?= esc_html( $button_item_text ); ?>"><span><?= esc_html( $button_item_text ); ?></span><?= $svg; ?></a></p>
                <?php endif; ?>
            <?php elseif ( get_field( 'general_funnel_button_item_typ' , 'options' ) == 'extern' ) : ?>                                    
                <?php if ( $button_item_extern = get_field( 'general_funnel_button_item_extern' , 'options' ) ) : ?>
                    <p class="mb-0"><a class="btn <?= $btn_class; ?> extern d-block d-sm-inline-block" href="<?= esc_url( $button_item_extern ); ?>" title="<?= esc_html( $button_item_text ); ?>" target="_blank"><span><?= esc_html( $button_item_text ); ?></span><?= $svg; ?></a></p>
                <?php endif; ?>
            <?php elseif ( get_field( 'general_funnel_button_item_typ' , 'options' ) == 'anker' ) : ?>
                <?php if ( $button_item_anker = get_field( 'general_funnel_button_item_anker' , 'options' ) ) : ?>
                    <?php 
                        $check_value = "#";
                        if( strpos($button_item_anker, $check_value) === false ){
                            $button_item_anker = '#' . $button_item_anker;
                        }
                    ?>
                    <p class="mb-0"><a class="btn <?= $btn_class; ?> anker d-block d-sm-inline-block" href="<?= esc_html( $button_item_anker ); ?>" title="<?= esc_html( $button_item_text ); ?>"><span><?= esc_html( $button_item_text ); ?></span><?= $svg; ?></a></p>
                <?php endif; ?>
            <?php elseif ( get_field( 'general_funnel_button_item_typ' , 'options' ) == 'download' ) : ?>
                <?php if ( $button_item_download = get_field( 'general_funnel_button_item_download' , 'options' ) ) : ?>
                    <p class="mb-0"><a class="btn <?= $btn_class; ?> download d-block d-sm-inline-block" href="<?= esc_html( $button_item_download ); ?>" title="<?= esc_html( $button_item_text ); ?>" target="_blank"><span><?= esc_html( $button_item_text ); ?></span><?= $svg; ?></a></p>
            <?php endif; ?>
        <?php endif; ?>  
    <?php endif; ?>
<?php endif; 
?>