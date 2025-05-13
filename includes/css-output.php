<?php
if ( ! defined( 'ABSPATH' ) ) exit;

function digitalmpce_generate_center_navigation() {
    if (!class_exists('GeneratePress_CSS')) return;

    $css = new GeneratePress_CSS();
    $css->start_media_query('(min-width: 769px)');
    $css->set_selector('.main-nav')->add_property('position', 'absolute');
    $css->add_property('transform', 'translateX(-50%)');
    $css->add_property('left', '50%');
    $css->add_property('justify-content', 'center');
    $css->add_property('display', 'flex');
    $css->add_property('width', '55%');

    $css->set_selector('.main-navigation .inside-navigation')->add_property('position', 'static');
    $css->set_selector('.menu-bar-items')->add_property('margin-left', 'auto');
    $css->stop_media_query();

    wp_add_inline_style('generate-style', $css->css_output());
}

global $digitalmpce_renderNav;
$digitalmpce_renderNav = false;

add_filter('generate_navigation_location', function($position) {
    global $digitalmpce_renderNav;
    if ($position === 'nav-center') {
        if (!$digitalmpce_renderNav) {
            digitalmpce_generate_center_navigation();
            $digitalmpce_renderNav = true;
        }
        return 'nav-float-right';
    }
    return $position;
});
