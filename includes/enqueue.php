<?php

function gpw_enqueue_selectmenu_assets($hook) {
    if (in_array($hook, ['post.php', 'post-new.php'])) {
        wp_enqueue_script('select2-js', 
        plugin_dir_url(__DIR__) . 'assets/js/select2.min.js', ['jquery'], WINCVERSION, true);
        wp_enqueue_style('select2-css', plugin_dir_url(__DIR__) . 'assets/css/select2.min.css',[],WINCVERSION);
    }
}
add_action('admin_enqueue_scripts', 'gpw_enqueue_selectmenu_assets');
