<?php

/**
 * Plugin Name: WP Tech Lookup
 * Plugin URI: http://wordpress.org/extend/plugins/wp-tech-lookup/
 * Description: WP Tech Lookup plugin is to see all the necessary information about server at one place. 
 * Version: 1.1
 * Author: Ashish Ajani
 * Author URI: http://freelancer-coder.com
 */
 
// Security: Considered blocking direct access to PHP files by adding the following line. 
defined('ABSPATH') or die("No script kiddies please!");

// define required contastants
define('WP_TECH_LOOKUP_VERSION', '1.1'); 

// Define plugin constants
define('WTL_PLUGIN_PATH', plugin_dir_path(__FILE__));
define("WTL_PLUGIN_URL", plugins_url('', __FILE__ ));
define("WTL_PLUGIN_CSS", WTL_PLUGIN_URL . '/css/');
define("WTL_PLUGIN_JS", WTL_PLUGIN_URL . '/js/');


// Activation hook to call plugin activation function of plugin.
register_activation_hook(__FILE__, 'wtl_install');

// Plugin activation function
function wtl_install() {
   // Silence is gold
}

// Deactivation hook to call deactivation function plugin
register_deactivation_hook(__FILE__, 'wtl_deactivate');

// Deactivation function
function wtl_deactivate() {
    // Silence is gold
}

// Add menu to wordpress sidebar menu.
function wtl_admin_menu() {
    add_submenu_page('tools.php', 'WP Tech Lookup', 'WP Tech Lookup', 'manage_options', 'wtl-tech-lookup', 'wtl_tech_lookup');
}
add_action('admin_menu', 'wtl_admin_menu');

// Enqueue scripts
function wtl_admin_script($hook) {
    if ('tools_page_wtl-tech-lookup' != $hook) {
        return;
    }
    // JS
    wp_enqueue_script('postbox');
    wp_enqueue_script('wtl_main_script', WTL_PLUGIN_JS . 'wtl-script.js');

    //CSS
    wp_enqueue_style('wtl_admin_css', WTL_PLUGIN_CSS . 'wtl-style.css');
}

add_action('admin_enqueue_scripts', 'wtl_admin_script');

// Include other files
require_once WTL_PLUGIN_PATH . 'wtl-admin-view.php';
require_once WTL_PLUGIN_PATH . 'classes/wtl-server-info.php';
require_once WTL_PLUGIN_PATH . 'classes/wtl-wordpress-info.php';
require_once WTL_PLUGIN_PATH . 'classes/wtl-filepermisions-info.php';
require_once WTL_PLUGIN_PATH . 'classes/wtl-database-info.php';
require_once WTL_PLUGIN_PATH . 'classes/wtl-cron-info.php';
