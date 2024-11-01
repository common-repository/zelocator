<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class HC3_Ui_Element_Input_Radio extends HC3_Ui_Abstract_Input
{
	protected $el = 'input';
	protected $uiType = 'input/radio';

	protected $checked = FALSE;

	public function __construct( $htmlFactory, $name, $label = NULL, $value = NULL, $checked = FALSE )
	{
		parent::__construct( $htmlFactory, $name, $label, $value );
		$this->checked = $checked;
	}

	public function getChildren()
	{
		$return = array( $this->label );
		return $return;
	}

	public function render()
	{
		$out = $this->htmlFactory->makeElement('input')
			->addAttr('type', 'radio' )
			->addAttr('name', $this->htmlName() )
			// ->addAttr('class', 'hc-field')
			;

		if( strlen($this->value) ){
			$out->addAttr('value', $this->value);
		}

		if( $this->checked ){
			$out->addAttr('checked', 'checked');
		}

		$htmlId = 'hc3_' . mt_rand( 100000, 999999 );
		$out->addAttr('id', $htmlId);

		$attr = $this->getAttr();
		foreach( $attr as $k => $v ){
			$out->addAttr($k, $v);
		}

		if( strlen($this->label) ){
			$label = $this->label;
			$label = $this->htmlFactory->makeElement('label', $label)
				->addAttr('for', $htmlId)
				// ->addAttr('class', 'hc-fs2')
				;

			$out = $this->htmlFactory->makeListInline( array($out, $label) )->gutter(1);
			$out = $this->htmlFactory->makeBlock( $out )
				->addAttr('class', 'hc-nowrap')
				;
		}

		return $out;
	}
}