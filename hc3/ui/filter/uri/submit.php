<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class HC3_Ui_Filter_Uri_Submit
{
	public function __construct( HC3_Uri $uri )
	{
	}

	public function process( $element )
	{
		$to = $element->getFormAction();
		if( ! $to ){
			return $element;
		}

		$to = $this->uri->makeUrl( $to );
		$element->setFormAction( $to );

		return $element;
	}
}