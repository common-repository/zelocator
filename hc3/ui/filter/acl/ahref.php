<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class HC3_Ui_Filter_Acl_Ahref
{
	public function __construct( HC3_Acl $acl )
	{
	}

	public function process( $element )
	{
		$to = $element->getTo();
		if( NULL === $to ){
			return $element;
		}

		if( is_array($to) ){
			$checkSlug = $to[0];
			$checkParams = $to[1];
		}
		else {
			$checkSlug = $to;
			$checkParams = array();
		}

		if( $checkSlug == '#' ){
			return $element;
		}

		$checkSlug = 'get:' . $checkSlug;

		if( ! $this->acl->check($checkSlug, $checkParams) ){
			$return = NULL;
			return $return;
		}

		return $element;
	}
}