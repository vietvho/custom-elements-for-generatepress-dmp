<?php
/**
 * Plugin Name: Custom Elements for GeneratePress by DigitalMasteryPath
 * Description: Custom Elements for GeneratePress by DigitalMasteryPath makes it easy to insert block-based content into the most useful GeneratePress hooks — without needing GP Premium or writing PHP.
 * Version: 1.0
 * Author: Warren Nguyen
 * Author URI: https://webtrailx.com
 * License: GPL2+
 * License URI: https://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: custom-elements-for-generatepress-dmp
 */


if ( ! defined( 'ABSPATH' ) ) exit;
define("WINCVERSION", 1.0);

if (!function_exists('is_plugin_active')) {
    require_once ABSPATH . 'wp-admin/includes/plugin.php';
}

if (is_plugin_active('gp-premium/gp-premium.php')) return;

// Load all includes
require_once plugin_dir_path(__FILE__) . 'includes/cpt.php';
require_once plugin_dir_path(__FILE__) . 'includes/meta-boxes.php';
require_once plugin_dir_path(__FILE__) . 'includes/enqueue.php';
require_once plugin_dir_path(__FILE__) . 'includes/render-hooks.php';
require_once plugin_dir_path(__FILE__) . 'includes/customizer.php';
require_once plugin_dir_path(__FILE__) . 'includes/css-output.php';
