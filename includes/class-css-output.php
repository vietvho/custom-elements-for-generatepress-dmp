<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class DigitalMPCE_CSS_Output {
    private $render_nav = false;

    public function __construct() {
        add_filter('generate_navigation_location', [$this, 'filter_navigation_location']);
    }

    public function generate_center_navigation() {
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

    public function filter_navigation_location($position) {
        if ($position === 'nav-center') {
            if (!$this->render_nav) {
                $this->generate_center_navigation();
                $this->render_nav = true;
            }
            return 'nav-float-right';
        }
        return $position;
    }
}
