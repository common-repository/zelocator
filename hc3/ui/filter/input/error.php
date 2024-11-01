<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class HC3_Ui_Filter_Input_Error
{
	public function __construct(
		HC3_Session $session,
		HC3_Ui $ui
		)
	{
	}

	public function process( $element )
	{
		$errors = $this->session->getFlashdata('form_errors');
		if( ! $errors ){
			return $element;
		}

		$name = $element->name();
		if( is_array($errors) && array_key_exists($name, $errors) ){
			$error = $errors[$name];
			$error = $this->ui->makeBlock( $error )
				->stylePadding( 'y2' )
				->addAttr('class', 'hc-red')
				->addAttr('class', 'hc-border-top')
				->addAttr('class', 'hc-border-red')
				;

			$element = $this->ui->makeList( array($element, $error) );
		}

		return $element;
	}
}