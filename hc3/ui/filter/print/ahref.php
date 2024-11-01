<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class HC3_Ui_Filter_Print_Ahref
{
	public function __construct( 
		HC3_Request $request,
		HC3_Ui $ui
		)
	{
	}

	public function process( $element )
	{
		if( ! $this->request->isPrintView() ){
			return $element;
		}

		if( $element->isPrintVisible() ){
			$children = $element->getChildren();
			$element = array_shift( $children );
		}
		else {
			$element = NULL;
		}

		return $element;
	}
}