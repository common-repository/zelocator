<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class HC3_Ui_Filter_Uri_DataHref
{
	public function __construct( HC3_Uri $uri )
	{
	}

	public function process( $element )
	{
		$dataHref = $element->getAttr('data-href');
		if( $dataHref ){
			$dataHref = array_shift( $dataHref );
			$dataHref = $this->uri->makeUrl( $dataHref );
			$element
				->setAttr('data-href', $dataHref)
				;
		}
		return $element;
	}
}