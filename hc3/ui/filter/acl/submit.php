<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class HC3_Ui_Filter_Acl_Submit
{
	public function __construct( HC3_Acl $acl )
	{
	}

	public function process( $element )
	{
		$checkSlug = $element->getFormAction();
		if( ! $checkSlug ){
			return $element;
		}

		$checkSlug = 'post:' . $checkSlug;

		if( ! $this->acl->check($checkSlug) ){
			$return = NULL;
			return $return;
		}

		return $element;
	}
}