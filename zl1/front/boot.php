<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class ZL1_Front_Boot
{
	public function __construct( HC3_Router $router )
	{
		$router
			->register( 'get:front', array('ZL1_Front_View', 'render') )
			->register(	'post:front', array('ZL1_Front_Controller', 'execute') )
			;
	}
}