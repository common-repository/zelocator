<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
interface HC3_ITransients
{
	public function get( $name );
	public function set( $value, $name = NULL );
	public function reset( $name );
}