<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class DigitalMPCE_Render_Hooks {
    public function __construct() {
        add_action('wp', [$this, 'output_blocks']);
    }

    public function output_blocks() {
        $blocks = get_posts([
            'post_type' => 'digitalmpce_block',
            'post_status' => 'publish',
            'numberposts' => -1
        ]);

        foreach ($blocks as $block) {
            $hook = get_post_meta($block->ID, '_digitalmpce_hook', true);
            $target_id = get_post_meta($block->ID, '_digitalmpce_target_id', true);

            if ($hook) {
                add_action($hook, function () use ($block, $target_id) {
                    $queried = get_queried_object();
                    $post_type = is_singular() && isset($queried->post_type) ? $queried->post_type : null;
                    $post_id = isset($queried->ID) ? $queried->ID : null;

                    if (
                        ($target_id === 'homepage' && !is_front_page()) ||
                        ($target_id === 'allposts' && $post_type !== 'post') ||
                        ($target_id === 'allpages' && $post_type !== 'page') ||
                        (!in_array($target_id, ['homepage', 'allposts', 'allpages', "whole_site"]) && $post_id != $target_id)
                    ) return;

                    echo '<div class="digitalmpce-block">';
                    // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Content is filtered through 'the_content', safe for output
                    echo apply_filters('the_content', $block->post_content);
                    echo '</div>';
                });
            }
        }
    }
}
