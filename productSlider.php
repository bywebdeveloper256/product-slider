<?php
/**
 * Plugin Name:       Product Slider
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.4
 * Author:            Raúl Barroso
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       rb-product-slider
 */

if ( ! defined( 'ABSPATH' ) ) exit;
if ( ! defined( 'MAIN_FILE_PATH' ) ) define( 'MAIN_FILE_PATH', __FILE__ );
if ( ! defined( 'MAIN_FOLDER_URL' ) ) define( 'MAIN_FOLDER_URL', plugins_url( '/', __FILE__ ) );
if ( ! defined( 'MAIN_FOLDER_PATH' ) ) define( 'MAIN_FOLDER_PATH', plugin_dir_path( __FILE__ ) );

require MAIN_FOLDER_PATH . 'vendor/autoload.php';

add_action( 'init', 'rb_add_shortcodes' );
add_action( 'init', 'rb_enqueue_scripts_in_front' );
add_action( 'init', 'rb_add_option_page_productSlider' );
add_action( 'wp_ajax_RBProductSliderAction', 'productSlideAjax' );
add_action( 'wp_ajax_nopriv_RBProductSliderAction', 'productSlideAjax' );