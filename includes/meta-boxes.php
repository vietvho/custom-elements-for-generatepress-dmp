<?php

function gpw_add_meta_boxes() {
    add_meta_box('gpw_hook_selector', 'Hook Location', 'gpw_render_hook_selector', 'gpw_block', 'side');
    add_meta_box('gpw_visibility_selector', 'Display Conditions', 'gpw_render_visibility_selector', 'gpw_block', 'side');
}
add_action('add_meta_boxes', 'gpw_add_meta_boxes');

function gpw_render_hook_selector($post) {
    wp_nonce_field('gpw_save_meta_box', 'gpw_meta_box_nonce');

    $selected = get_post_meta($post->ID, '_gpw_hook', true);
    $hooks = [
        'generate_before_header' => 'Before Header',
        'generate_after_header' => 'After Header',
        'generate_after_primary_menu' => 'After Primary Menu',
        'generate_before_main_content' => 'Before Main Content',
        'generate_after_main_content' => 'After Main Content',
        'generate_inside_navigation' => 'Inside Navigation',
        'generate_after_entry_title' => 'After Entry Title',
        'generate_after_content' => 'After Content',
        'generate_footer' => 'Footer',
        'wp_footer' => 'WordPress Footer',
    ];
    echo '<select name="gpw_hook" id="gpw_hook">';
    foreach ($hooks as $key => $label) {
        printf('<option value="%s"%s>%s</option>', esc_attr($key), selected($selected, $key, false), esc_html($label));
    }
    echo '</select>';
}

function gpw_render_visibility_selector($post) {
    wp_nonce_field('gpw_save_meta_box', 'gpw_meta_box_nonce');

    $target_id = get_post_meta($post->ID, '_gpw_target_id', true);
    $types = ['post', 'page'];

    echo '<select class="gpw_select2" name="gpw_target_id">';
    foreach ($types as $type) {
        echo "<optgroup label='" . esc_html(ucfirst($type)) . "'>";
        printf('<option value="all%1$ss"> All %2$ss</option>', esc_attr($type), esc_html(ucfirst($type)));
        if ($type === 'page') echo "<option value='homepage'>Home Page</option>";

        $items = get_posts([
            'post_type' => $type,
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'orderby' => 'title',
            'order' => 'ASC',
        ]);

        foreach ($items as $item) {
            printf(
                '<option value="%d"%s>%s (%s)</option>',
                esc_attr($item->ID),
                esc_attr(selected($target_id, $item->ID, false)),
                esc_html(get_the_title($item->ID)),
                esc_html($item->post_type)
            );
        }
        echo '</optgroup>';
    }
    echo '</select><script>jQuery(document).ready(function($){ $(".gpw_select2").select2(); });</script>';
}

function gpw_save_post($post_id) {
   
    if (
        !isset($_POST['gpw_meta_box_nonce']) ||
        !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['gpw_meta_box_nonce'])), 'gpw_save_meta_box')
    ) {
        return;
    }
    

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (isset($_POST['gpw_hook'])) {
        update_post_meta($post_id, '_gpw_hook', sanitize_text_field(wp_unslash($_POST['gpw_hook'])));
    }
    if (isset($_POST['gpw_target_id'])) {
        update_post_meta($post_id, '_gpw_target_id', sanitize_text_field(wp_unslash($_POST['gpw_target_id'])));
    }
}
add_action('save_post', 'gpw_save_post');
