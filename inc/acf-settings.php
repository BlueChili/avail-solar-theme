<?php 
/* 
 * ACF Settings
 */

if (function_exists('acf_add_options_page')) {
    acf_add_options_page([
        'page_title' => 'Page Settings',
        'menu_slug' => 'acf-site-options',
        'icon_url' => 'dashicons-admin-site-alt',
        'position' => '50'
    ]);
}

add_filter('acf/settings/remove_wp_meta_box', '__return_true');
