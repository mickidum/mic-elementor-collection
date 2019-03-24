<?php
/**
 * Plugin Name: Mic Elementor Collection
 * Description: Elementor custom widgets collections by mickidum.
 * Plugin URI:  https://webworks.ga/elementor-plugin
 * Version:     1.1.0
 * Author:      Michael
 * Author URI:  https://webworks.ga
 * Text Domain: mic-elementor-collection
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

define( 'MIC_ELEMENTOR_COLLECTION__FILE__', __FILE__ );

/**
 * Load Mic Elementor Collection
 *
 * Load the plugin after Elementor (and other plugins) are loaded.
 *
 * @since 1.0.0
 */
function mic_elementor_collection_load() {
	// Load localization file
	load_plugin_textdomain( 'mic-elementor-collection' );

	// Notice if the Elementor is not active
	if ( ! did_action( 'elementor/loaded' ) ) {
		add_action( 'admin_notices', 'mic_elementor_collection_fail_load' );
		return;
	}

	// Check required version
	$elementor_version_required = '1.8.0';
	if ( ! version_compare( ELEMENTOR_VERSION, $elementor_version_required, '>=' ) ) {
		add_action( 'admin_notices', 'mic_elementor_collection_fail_load_out_of_date' );
		return;
	}

	// Require the main plugin file
	require( __DIR__ . '/plugin.php' );
}
add_action( 'plugins_loaded', 'mic_elementor_collection_load' );




function mic_elementor_collection_fail_load_out_of_date() {
	if ( ! current_user_can( 'update_plugins' ) ) {
		return;
	}

	$file_path = 'elementor/elementor.php';

	$upgrade_link = wp_nonce_url( self_admin_url( 'update.php?action=upgrade-plugin&plugin=' ) . $file_path, 'upgrade-plugin_' . $file_path );
	$message = '<p>' . __( 'Elementor Mic Elementor Collection is not working because you are using an old version of Elementor.', 'mic-elementor-collection' ) . '</p>';
	$message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $upgrade_link, __( 'Update Elementor Now', 'mic-elementor-collection' ) ) . '</p>';

	echo '<div class="error">' . $message . '</div>';
}

function register_all_style() {
	wp_enqueue_style( 'timeline-style', plugin_dir_url( __FILE__ ) . 'assets/css/timeline.css' );
	if ( is_rtl() ) {
		wp_enqueue_style(
			'timeline-style-rtl',
			plugin_dir_url( __FILE__ ) . 'assets/css/rtl.timeline.css',
			array ( 'timeline-style' )
		);
	}
}

add_action( 'wp_enqueue_scripts', 'register_all_style' );