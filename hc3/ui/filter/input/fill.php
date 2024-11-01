<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class HC3_Ui_Filter_Input_Fill
{
	public function __construct(
		HC3_Session $session
		)
	{
	}

	public function process( $element )
	{
		$post = $this->session->getFlashdata('post');
		$name = $element->name();

		if( is_array($post) && array_key_exists($name, $post) ){
			$value = $post[$name];
			$element->setValue( $value );
		}

		return $element;
	}
}