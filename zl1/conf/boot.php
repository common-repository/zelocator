<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class ZL1_Conf_Boot
{
	public function __construct( HC3_Dic $dic )
	{
		$dic->make('HC3_Ui_Topmenu')
			->add( 'conf', array('conf', '__Configuration__') )
			;

		$dic->make('HC3_Router')
			->register( 'get:conf', array('ZL1_Conf_View', 'render') )
			->register( 'post:conf/flushpermalinks', array('ZL1_Conf_Controller_Flushpermalinks', 'execute') )
			;

		$dic->make('HC3_Acl')
			->register( 'get:conf', array('ZL1_AclChecker_Admin', 'check') )
			;
	}
}