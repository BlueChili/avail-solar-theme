<?php 

$textblock_headline = get_field( 'textblock_headline' );

$classes_headline = '';
$classes_headline_value = get_field('headline_class');
if ($classes_headline_value) {
    //$classes_headline .= implode(' ', $classes_headline_value);
    $classes_headline .= ' ' . $classes_headline_value;
}
$h_tag = get_field('headline_typ');