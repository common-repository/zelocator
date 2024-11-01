<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
interface HC3_Ui_Element_Input_ISubmit
{
	public function setFormAction( $set );
	public function getFormAction();
	public function render();
}

class HC3_Ui_Element_Input_Submit extends HC3_Ui_Abstract_Input implements HC3_Ui_Element_Input_ISubmit
{
	protected $el = 'input';
	protected $uiType = 'input/submit';
	protected $formAction = NULL;

	public function __construct( $htmlFactory, $label, $name = NULL, $alt = NULL )
	{
		$this->htmlFactory = $htmlFactory;
		$this->label = $label;
		$this->alt = strlen($alt) ? $alt : $label; 
		$this->name = $name;
	}

	public function setFormAction( $set )
	{
		$this->formAction = $set;
		return $this;
	}

	public function getFormAction()
	{
		return $this->formAction;
	}

	public function render()
	{
		$this
			->addAttr('type', 'submit' )
			->addAttr('name', $this->htmlName() )
			->addAttr('title', $this->alt )
			->addAttr('value', $this->label, FALSE )
			;

		if( NULL !== $this->formAction ){
			$this
				->addAttr('formaction', $this->formAction )
				;
		}

		$out = parent::render();
		return $out;
	}
}