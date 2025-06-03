<?php
/**
 * Plugin Name: Custom Elements for GeneratePress by DigitalMasteryPath
 * Description: Custom Elements for GeneratePress by DigitalMasteryPath makes it easy to insert block-based content into the most useful GeneratePress hooks — without needing GP Premium or writing PHP.
 * Version: 1.0
 * Author: Warren Nguyen
 * Author URI: https://digitalmasterypath.com
 * License: GPL2+
 * License URI: https://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: custom-elements-for-generatepress-dmp
 */


if ( ! defined( 'ABSPATH' ) ) exit;
define("DIGITALMPCEVERSION", 1.0);

$theme = wp_get_theme();
if ( $theme->parent() ) {
    $theme = $theme->parent();
}

if ( strtolower( $theme->get( 'Name' ) ) !== 'generatepress' ) {

    add_action('admin_notices', function() {
        echo '<div class="notice notice-warning"><p>';
        esc_html_e('Custom Elements for GeneratePress works only with the GeneratePress theme. Thank you for choosing our plugin.', 'custom-elements-for-generatepress-dmp');
        echo '</p></div>';
    });

    return;
}

if (!function_exists('is_plugin_active')) {
    require_once ABSPATH . 'wp-admin/includes/plugin.php';
}

// Load all includes
require_once plugin_dir_path(__FILE__) . 'includes/cpt.php';
require_once plugin_dir_path(__FILE__) . 'includes/meta-boxes.php';
require_once plugin_dir_path(__FILE__) . 'includes/enqueue.php';
require_once plugin_dir_path(__FILE__) . 'includes/render-hooks.php';
require_once plugin_dir_path(__FILE__) . 'includes/customizer.php';
require_once plugin_dir_path(__FILE__) . 'includes/css-output.php';
