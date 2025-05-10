<?php

function gpw_register_hook_block_cpt() {
    register_post_type('gpw_block', [
        'labels' => [
            'name' => __('GP Elements','generatepress-custom-elements'),
            'singular_name' => __('GP Elements','generatepress-custom-elements')
        ],
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_rest' => true,
        'supports' => ['title', 'editor'],
        'editor_width' => 1200,
    ]);
}
add_action('init', 'gpw_register_hook_block_cpt');
