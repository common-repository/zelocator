<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class HC3_Ui_Filter_Print_Collapse
{
	public function __construct( HC3_Request $request )
	{
	}

	public function process( $element )
	{
		if( ! $this->request->isPrintView() ){
			return $element;
		}

		$element
			->setContent( NULL )
			;

		return $element;
	}
}