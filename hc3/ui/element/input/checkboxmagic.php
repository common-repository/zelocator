<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class HC3_Ui_Element_Input_CheckboxMagic extends HC3_Ui_Abstract_Input
{
	protected $el = 'input';
	protected $uiType = 'input/checkbox';

	protected $checked = FALSE;
	protected $readonly = FALSE;
	protected $justLabel = FALSE;

	public function __construct( $htmlFactory, $name, array $labels, $value = NULL, $checked = FALSE )
	{
		parent::__construct( $htmlFactory, $name, $labels, $value );
		$this->value = $value;
		$this->checked = $checked;
	}

	public function getChildren()
	{
		$return = $this->label;
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
			->addAttr('class', 'hc-magictoggle-toggler')
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
		else {
			$out
				->addAttr('class', 'hc-inline-block')
				->addAttr('class', 'hc-mr1')
				->addAttr('class', 'hc-valign-middle')
				;
		}

		$labels = $this->label;

		$labelOn = $this->htmlFactory->makeElement('label', $labels[0])
			->addAttr('for', $htmlId)
			->addAttr('class', 'hc-magictoggle-burger')
			->addAttr('class', 'hc-magictoggle-on')
			->addAttr('class', 'hc-valign-middle')
			;

		$labelOff = $this->htmlFactory->makeElement('label', $labels[1])
			->addAttr('for', $htmlId)
			->addAttr('class', 'hc-magictoggle-burger')
			->addAttr('class', 'hc-magictoggle-off')
			->addAttr('class', 'hc-valign-middle')
			;

		$out = $this->htmlFactory->makeCollection( array($out, $labelOn, $labelOff) );

		$out = $this->htmlFactory->makeBlock( $out )
			->addAttr('class', 'hc-nowrap')
			->addAttr('class', 'hc-magictoggle-container')
			;

		return $out;
	}
}