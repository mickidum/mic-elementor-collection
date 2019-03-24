<?php
namespace MicElementorCollection;

use MicElementorCollection\Widgets\Hello_World;
use MicElementorCollection\Widgets\Inline_Editing;
use MicElementorCollection\Widgets\Widget_Timeline;
use MicElementorCollection\Widgets\Widget_Google_Maps_He;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Main Plugin Class
 *
 * Register new elementor widget.
 *
 * @since 1.0.0
 */
class Plugin {

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {
		$this->add_actions();
	}

	/**
	 * Add Actions
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function add_actions() {
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'on_widgets_registered' ] );

		add_action( 'elementor/frontend/after_register_scripts', function() {
			wp_register_script( 'mic-elementor-collection', plugins_url( '/assets/js/mic-elementor-collection.js', MIC_ELEMENTOR_COLLECTION__FILE__ ), [ 'jquery' ], false, true );
		} );
	}

	/**
	 * On Widgets Registered
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function on_widgets_registered() {
		$this->includes();
		$this->register_widget();
	}

	/**
	 * Includes
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function includes() {
		require __DIR__ . '/widgets/hello-world.php';
		require __DIR__ . '/widgets/inline-editing.php';
		require __DIR__ . '/widgets/timeline.php';
		require __DIR__ . '/widgets/google-maps-hebrew.php';
	}

	/**
	 * Register Widget
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function register_widget() {
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Hello_World() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Inline_Editing() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widget_Timeline() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widget_Google_Maps_He() );
	}
}

new Plugin();
