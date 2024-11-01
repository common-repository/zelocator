<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class HC3_Ui_Filter_Acl_Form
{
	public function __construct( HC3_Acl $acl )
	{
	}

	public function process( $element )
	{
		$to = $element->getAction();
		if( NULL === $to ){
			return $element;
		}

		if( $to == '#' ){
			return $element;
		}

		if( is_array($to) ){
			$to = array_shift($to);
		}
		$checkTo = 'post:' . $to;

		if( ! $this->acl->check($checkTo) ){
			$return = NULL;
			return $return;
		}

		return $element;
	}
}