<?php
namespace HelloWorld;

use HelloWorld\Widgets\Hello_World;
use HelloWorld\Widgets\Inline_Editing;

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
	 * @since 1.0.0
	 * @since 1.7.1 The method moved to this class.
	 *
	 * @access public
	 */

    public function add_elementor_category()
    {
        \Elementor\Plugin::instance()->elements_manager->add_category( '13plus4', [
            'title' => __( '13plus4 - Advanced Code', 'press-elements' ),
        ], 1 );
    }




	/**
	 * Add Actions
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function add_actions() {
		add_action( 'elementor/init', [ $this, 'add_elementor_category' ] );


		add_action( 'elementor/widgets/widgets_registered', [ $this, 'on_widgets_registered' ] );

		add_action( 'elementor/frontend/after_register_scripts', function() {
			wp_register_script( 'hello-world', plugins_url( '/assets/js/hello-world.js', ELEMENTOR_HELLO_WORLD__FILE__ ), [ 'jquery' ], false, true );
			wp_register_script( 'p5', plugins_url('/assets/js/p5.min.js', ELEMENTOR_HELLO_WORLD__FILE__TWO));
			wp_register_script( 'p5-dom', plugins_url('/assets/js/p5.dom.min.js', ELEMENTOR_HELLO_WORLD__FILE__THREE));
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
	}
}

new Plugin();
