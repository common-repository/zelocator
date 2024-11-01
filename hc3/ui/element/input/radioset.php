<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class HC3_Ui_Element_Input_RadioSet extends HC3_Ui_Abstract_Input
{
	protected $el = 'input';
	protected $uiType = 'input/radio';

	protected $options = array();

	public function __construct( $htmlFactory, $name, $label = NULL, $options = array(), $value = NULL )
	{
		parent::__construct( $htmlFactory, $name, $label, $value );
		$this->options = $options;
	}

	public function getChildren()
	{
		$return = array();
		foreach( $this->options as $k => $v ){
			if( is_array($v) ){
				$return = array_merge( $return, $v );
			}
			else {
				$return[] = $v;
			}
		}
		return $return;
	}

	public function render()
	{
		$options = array();

		$rawOptions = $this->options;
		foreach( $rawOptions as $k => $v ){
			if( ! strlen($k) ){
				$k = ' ';
			}
			$checked = ( $k == $this->value ) ? TRUE : FALSE;
			$thisInput = $this->htmlFactory->makeInputRadio( $this->name, $v, $k, $checked );
			$options[] = $thisInput;
		}

		$out = $this->htmlFactory->makeListInline( $options );

		if( strlen($this->label) ){
			$out = $this->htmlFactory->makeLabelled( $this->label, $out, $this->htmlId() );
		}

		return $out;
	}
}