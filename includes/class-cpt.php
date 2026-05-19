<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class DigitalMPCE_CPT {
    public function __construct() {
        add_action('init', [$this, 'register_cpt']);
    }

    public function register_cpt() {
        register_post_type('digitalmpce_block', [
            'labels' => [
                'name' => __('DMP GP Elements','custom-elements-for-generatepress-dmp'),
                'singular_name' => __('DMP GP Elements','custom-elements-for-generatepress-dmp')
            ],
            'public' => false,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_rest' => true,
            'supports' => ['title', 'editor'],
            'editor_width' => 1200,
        ]);
    }
}
