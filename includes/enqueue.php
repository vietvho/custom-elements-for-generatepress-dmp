<?php
if ( ! defined( 'ABSPATH' ) ) exit;

function digitalmpce_enqueue_selectmenu_assets($hook) {
    if (in_array($hook, ['post.php', 'post-new.php'])) {
        wp_enqueue_script('digitalmpce_select2-js', 
        plugin_dir_url(__DIR__) . 'assets/js/select2.min.js', ['jquery'], DIGITALMPCEVERSION,  array(
            'strategy'  => 'async',
        ));
        wp_enqueue_style('select2-css', plugin_dir_url(__DIR__) . 'assets/css/select2.min.css',[],DIGITALMPCEVERSION);

        wp_add_inline_script('digitalmpce_select2-js', 'jQuery(document).ready(function($){ $(".digitalmpce_select2").select2(); });');
    }
}
add_action('admin_enqueue_scripts', 'digitalmpce_enqueue_selectmenu_assets');
