<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class HC3_Ui_Filter_Uri_Ahref
{
	public function __construct( HC3_Uri $uri )
	{
	}

	public function process( $element )
	{
		$to = $element->getTo();
		if( NULL === $to ){
			return $element;
		}

		if( $to == '#' ){
		}
		else {
			$to = $this->uri->makeUrl( $to );
		}

		$element
			->addAttr('href', $to)
			;

		return $element;
	}
}