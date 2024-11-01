<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class ZL1_Publish_Boot
{
	public function __construct( HC3_Ui_Topmenu $topmenu, HC3_Router $router, HC3_Acl $acl )
	{
		$topmenu
			->add( 'publish', array('publish', '__Publish__') )
			;

		$router
			->register( 'get:publish', array('ZL1_Publish_View', 'render') )
			;

		$acl
			->register( 'get:publish', array('ZL1_AclChecker_Admin', 'check') )
			;
	}
}