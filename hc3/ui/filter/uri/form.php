<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class HC3_Ui_Filter_Uri_Form
{
	public function __construct( HC3_UriAction $uri )
	{
	}

	public function process( $element )
	{
		$to = $element->getAction();
		if( NULL === $to ){
			return $element;
		}

		$to = $this->uri->makeUrl( $to );
		$element->setAction( $to );

		return $element;
	}
}