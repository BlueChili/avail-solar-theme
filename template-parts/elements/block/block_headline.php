<?php if ( $textblock_headline ) : 
    $textblock_headline_str = str_replace(array('<p>','</p>'),'',$textblock_headline);
    if ( avasol_is_mobile() ) {
        //$textblock_headline_str = str_replace(array('<br />'),'',$textblock_headline);
        //$textblock_headline_str = strip_tags($textblock_headline_str, "<br>");
    } ?>
    <?php if ( $h_tag == 'p' ) : ?>
        <p class="<?= $classes_headline; ?> <?php if ( $extra_class_headline_p ) { echo $extra_class_headline_p; } ?>"><?= $textblock_headline_str; ?></p>
    <?php else : ?>
        <<?= $h_tag; ?> class="<?= $classes_headline; ?> <?php if ( $extra_class_headline ) { echo $extra_class_headline; } ?>"><?= $textblock_headline_str; ?></<?= $h_tag; ?>>
    <?php endif; ?>
<?php endif; ?>