<?php
/*
 * Plugin Name: Zelocator
 * Plugin URI: http://www.hitcode.com/zelocator/
 * Description: Service area locator plugin. Define your service areas, add your locations/stores/dealers and associate them with the service areas.
 * Version: 1.1.4
 * Author: hitcode.com
 * Author URI: http://www.hitcode.com/
 * Text Domain: zelocator
 * Domain Path: /languages/
*/

define( 'ZL1_VERSION', 114 );

if (! defined('ABSPATH')) exit; // Exit if accessed directly

if ( version_compare( PHP_VERSION, '5.3', '<' ) ) {
	add_action( 'admin_notices', create_function( '', "echo '<div class=\"error\"><p>".__('Zelocator requires PHP 5.3 to function properly. Please upgrade PHP or deactivate Zelocator.', 'zelocator') ."</p></div>';" ) );
	return;
}

if( file_exists(dirname(__FILE__) . '/config.php') ){
	$conf = include( dirname(__FILE__) . '/config.php' );
}

$hc3path = defined('HC3_DEV_INSTALL') ? HC3_DEV_INSTALL : dirname(__FILE__) . '/hc3';
include_once( $hc3path . '/_wordpress/abstract/plugin.php' );

class Zelocator1 extends HC3_Abstract_Plugin
{
	public function __construct()
	{
		$this->translate = 'zelocator';
		$this->slug = 'zelocator';
		$this->label = 'Zelocator';
		$this->prfx = 'zl1';
		$this->menuIcon = 'dashicons-location-alt';

		$this->modules = array(
			'serviceareas',
			'locations',
			'publish',
			'conf',
			'front',
			'app'
			);

		parent::__construct( __FILE__ );

		add_shortcode( 'zelocator', array($this, 'front') );
	}

	public function front()
	{
		$this->actionResult = $this->handleRequest( 'front' );

		ob_start();
		echo $this->render();
		$return = ob_get_contents();
		ob_end_clean();
		return $return;
	}
}

$hczl1 = new Zelocator1();
