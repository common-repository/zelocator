<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class HC3_Ui_Element_Input_Button extends HC3_Ui_Abstract_Input
{
	protected $el = 'input';
	protected $uiType = 'input/button';

	public function __construct( $label, $name = NULL, $alt = NULL )
	{
		$this->label = $label;
		$this->alt = strlen($alt) ? $alt : $label; 
		$this->name = $name;
	}

	public function render()
	{
		$this
			->setAttr('type', 'button' )
			->setAttr('name', $this->htmlName() )
			->setAttr('title', $this->alt )
			->setAttr('value', $this->label )
			;

		$out = parent::render();
		return $out;
	}
}