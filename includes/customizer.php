<?php

add_action('customize_register', function($wp_customize) {
    $wp_customize->remove_control('generate_settings[nav_position_setting]');

    $wp_customize->add_control('generate_settings[nav_position_setting]', [
        'type' => 'select',
        'label' => __('Navigation Location', 'generatepress-custom-elements'),
        'section' => 'generate_layout_navigation',
        'choices' => [
            'nav-below-header' => __('Below Header', 'generatepress-custom-elements'),
            'nav-above-header' => __('Above Header', 'generatepress-custom-elements'),
            'nav-float-right' => __('Float Right', 'generatepress-custom-elements'),
            'nav-float-left' => __('Float Left', 'generatepress-custom-elements'),
            'nav-center' => __('Center', 'generatepress-custom-elements'),
            'nav-left-sidebar' => __('Left Sidebar', 'generatepress-custom-elements'),
            'nav-right-sidebar' => __('Right Sidebar', 'generatepress-custom-elements'),
            '' => __('No Navigation', 'generatepress-custom-elements'),
        ],
        'settings' => 'generate_settings[nav_position_setting]',
        'priority' => 22,
    ]);
}, 99);
