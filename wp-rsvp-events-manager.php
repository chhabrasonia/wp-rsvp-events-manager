<?php
/**
 * Plugin Name: WP RSVP Events Manager
 * Description: A Events Manager Plugin along with RSVP
 * Text Domain: wp-events-manager
 * Author     : Sonia Chhabra
 */

if (!defined('ABSPATH')) exit;

define('WPEM_PATH', plugin_dir_path(__FILE__));
define('WPEM_URL', plugin_dir_url(__FILE__));
define('WPEM_TEXT_DOMAIN', 'wp-events-manager');

/*
************************
 * Load translations 
************************
 */
add_action('plugins_loaded', function () {
    load_plugin_textdomain( WPEM_TEXT_DOMAIN, false, dirname(plugin_basename(__FILE__)) . '/languages');
});

/*
************************
 * Load CSS 
************************
 */
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('wpem-style', WPEM_URL . 'assets/css/style.css', [], '1.0');
});


require_once WPEM_PATH . '/includes/class-installer.php';
require_once WPEM_PATH . '/includes/class-event.php';
require_once WPEM_PATH . '/includes/class-event-meta.php';
require_once WPEM_PATH . '/includes/class-event-admin-columns.php';
require_once WPEM_PATH . '/includes/class-event-shortcode.php';
require_once WPEM_PATH . '/includes/class-event-api-controller.php';
require_once WPEM_PATH . '/includes/class-template-loader.php';

/*
************************
 * Activation Hook
************************
 */
register_activation_hook(__FILE__, ['Event_Installer', 'activate']);
register_deactivation_hook(__FILE__, ['Event_Installer', 'deactivate']);