<?php 

$block_bg = get_field( 'block_bg_color' );
$block_font_color = get_field( 'block_font_color' );
$block_font_size = get_field( 'block_font_size' );

$classes_value = get_field('block_classes');
$className = ' gp-block';

if ( $block_bg  != 'transparent') {
    $className .= ' ' . $block_bg;
}

if ( $block_font_color  != 'none') {
    $className .= ' ' . $block_font_color;
}

if ( $block_font_size  != 'none') {
    $className .= ' ' . $block_font_size;
}

if ( get_field( 'block_text_center' ) ) {
    $className .= ' text-center';
}

if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

if ($classes_value) {
    $classes = implode(' ', $classes_value);
    $className .= ' ' . $classes;
}
