<?php
if ( ! defined( 'ABSPATH' ) ) exit;

function digitalmpce_register_hook_block_cpt() {
    register_post_type('digitalmpce_block', [
        'labels' => [
            'name' => __('GP Elements','custom-elements-for-generatepress-dmp'),
            'singular_name' => __('GP Elements','custom-elements-for-generatepress-dmp')
        ],
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_rest' => true,
        'supports' => ['title', 'editor'],
        'editor_width' => 1200,
    ]);
}
add_action('init', 'digitalmpce_register_hook_block_cpt');
