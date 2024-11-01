<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class ZL1_Conf_Controller_Flushpermalinks
{
	public function execute()
	{
		flush_rewrite_rules();
		$return = array( 'conf', '__Permalinks rewrite rules flushed__' );
		return $return;
	}
}