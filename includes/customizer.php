<?php

add_action('customize_register', function($wp_customize) {
    $wp_customize->remove_control('generate_settings[nav_position_setting]');

    $wp_customize->add_control('generate_settings[nav_position_setting]', [
        'type' => 'select',
        'label' => __('Navigation Location', 'custom-elements-for-generatepress-dmp'),
        'section' => 'generate_layout_navigation',
        'choices' => [
            'nav-below-header' => __('Below Header', 'custom-elements-for-generatepress-dmp'),
            'nav-above-header' => __('Above Header', 'custom-elements-for-generatepress-dmp'),
            'nav-float-right' => __('Float Right', 'custom-elements-for-generatepress-dmp'),
            'nav-float-left' => __('Float Left', 'custom-elements-for-generatepress-dmp'),
            'nav-center' => __('Center', 'custom-elements-for-generatepress-dmp'),
            'nav-left-sidebar' => __('Left Sidebar', 'custom-elements-for-generatepress-dmp'),
            'nav-right-sidebar' => __('Right Sidebar', 'custom-elements-for-generatepress-dmp'),
            '' => __('No Navigation', 'custom-elements-for-generatepress-dmp'),
        ],
        'settings' => 'generate_settings[nav_position_setting]',
        'priority' => 22,
    ]);
}, 99);
