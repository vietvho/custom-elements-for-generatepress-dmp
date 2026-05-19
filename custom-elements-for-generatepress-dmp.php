<?php
/**
 * Plugin Name: Custom Elements for GeneratePress by DigitalMasteryPath
 * Description: Custom Elements for GeneratePress by DigitalMasteryPath makes it easy to insert block-based content into the most useful GeneratePress hooks — without needing GP Premium or writing PHP.
 * Version: 1.01
 * Author: Warren Nguyen
 * Author URI: https://digitalmasterypath.com
 * License: GPL2+
 * License URI: https://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: custom-elements-for-generatepress-dmp
 */

if ( ! defined( 'ABSPATH' ) ) exit;
define("DIGITALMPCEVERSION", "1.01");

class DigitalMPCE_Plugin {
    
    private static $instance = null;

    public static function get_instance() {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        add_action('plugins_loaded', [$this, 'init']);
    }

    public function init() {
        $theme = wp_get_theme();
        if ( $theme->parent() ) {
            $theme = $theme->parent();
        }

        if ( strtolower( $theme->get( 'Name' ) ) !== 'generatepress' ) {
            add_action('admin_notices', [$this, 'admin_notice_missing_generatepress']);
            return;
        }

        if ( ! function_exists( 'is_plugin_active' ) ) {
            require_once ABSPATH . 'wp-admin/includes/plugin.php';
        }

        $this->includes();
        $this->init_classes();
    }

    public function admin_notice_missing_generatepress() {
        echo '<div class="notice notice-warning"><p>';
        esc_html_e('Custom Elements for GeneratePress works only with the GeneratePress theme. Thank you for choosing our plugin.', 'custom-elements-for-generatepress-dmp');
        echo '</p></div>';
    }

    private function includes() {
        require_once plugin_dir_path(__FILE__) . 'includes/class-cpt.php';
        require_once plugin_dir_path(__FILE__) . 'includes/class-meta-boxes.php';
        require_once plugin_dir_path(__FILE__) . 'includes/class-enqueue.php';
        require_once plugin_dir_path(__FILE__) . 'includes/class-render-hooks.php';
        require_once plugin_dir_path(__FILE__) . 'includes/class-customizer.php';
        require_once plugin_dir_path(__FILE__) . 'includes/class-css-output.php';
    }

    private function init_classes() {
        new DigitalMPCE_CPT();
        new DigitalMPCE_Meta_Boxes();
        new DigitalMPCE_Enqueue();
        new DigitalMPCE_Render_Hooks();
        new DigitalMPCE_Customizer();
        new DigitalMPCE_CSS_Output();
    }
}

DigitalMPCE_Plugin::get_instance();
