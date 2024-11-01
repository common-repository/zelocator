<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class HC3_Ui_Element_Input_Checkbox extends HC3_Ui_Abstract_Input
{
	protected $el = 'input';
	protected $uiType = 'input/checkbox';

	protected $checked = FALSE;
	protected $readonly = FALSE;
	protected $justLabel = FALSE;

	public function __construct( $htmlFactory, $name, $label = NULL, $value = NULL, $checked = FALSE )
	{
		parent::__construct( $htmlFactory, $name, $label, $value );
		$this->value = $value;
		$this->checked = $checked;
	}

	public function getChildren()
	{
		$return = array( $this->label );
		return $return;
	}

	public function justLabel( $justLabel = TRUE )
	{
		$this->justLabel = $justLabel;
		return $this;
	}

	public function setValue( $value )
	{
		$this->checked = $value ? TRUE : FALSE;
		$this->value = $value;
		return $this;
	}

	public function setChecked( $set = TRUE )
	{
		$this->checked = $set;
		return $this;
	}

	public function setReadonly( $set = TRUE )
	{
		$this->readonly = $set;
		return $this;
	}

	public function render()
	{
		$out = $this->htmlFactory->makeElement('input')
			->addAttr('type', 'checkbox' )
			->addAttr('name', $this->htmlName() )
			// ->addAttr('class', 'hc-field')
			;

		if( strlen($this->value) ){
			$out->addAttr('value', $this->value);
		}

		if( $this->checked ){
			$out->addAttr('checked', 'checked');
		}

		if( $this->readonly ){
			$out
				->addAttr('readonly', 'readonly')
				->addAttr('disabled', 'disabled')
				;
		}

		$htmlId = 'hc3_' . mt_rand( 100000, 999999 );
		$out->addAttr('id', $htmlId);

		$attr = $this->getAttr();
		foreach( $attr as $k => $v ){
			$out->addAttr($k, $v);
		}

		if( $this->justLabel ){
			$out
				->addAttr('class', 'hc-hide')
				;
		}

		if( strlen($this->label) ){
			$label = $this->htmlFactory->makeElement('label', $this->label)
				->addAttr('for', $htmlId )
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